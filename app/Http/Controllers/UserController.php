<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BranchesModel;
use App\UserTypesModel;
use App\UserModel;
use App\UserDetailsModel;

use Validator;
use DB;
class UserController extends Controller
{
    public function index () {
   
        $BranchesModel = BranchesModel::all();
        $UserTypesModel = UserTypesModel
                            ::whereIn('id', [2, 3])
                            ->get();
        
        return view('user.index', ['branches' => $BranchesModel, 'types' => $UserTypesModel]);
    }

    public function list_users (Request $request) 
    {
        $UserModel = UserModel
                        ::with(['user_type', 'user_detail', 'branch'])
                        ->where(function ($query) use($request){
                            $query->where('username', 'like', '%'. $request->input('inp_email_add') .'%');
                            $query->where('isactive', 1);
                        })
                        ->whereHas('user_detail', function ($query) use($request){
                            $query->where('first_name', 'like', '%'.$request->input('inp_first_name').'%');
                            $query->where('last_name', 'like', '%'.$request->input('inp_last_name').'%');
                        })
                        ->whereHas('branch', function ($query) use($request){
                            $query->where('branch_name', 'like', '%'.$request->input('inp_branch').'%');
                        })
                        ->whereHas('user_type', function ($query) use($request){
                            $query->where('user_type', 'like', '%'.$request->input('inp_user_type').'%');
                        })
                        ->get();

        return view('user.director_coordinator_list', ['users' => $UserModel])->render();
    }

    public function create_user (Request $request)
    {
        //str_random(10);

        $rules =
                [
                    'inp_first_name'    => 'required',
                    'inp_last_name'     => 'required',
                    'inp_email_add'     => 'required|email',
                    'inp_branch'        => 'required',
                    'inp_user_type'     => 'required',
                    
                ];
        $messages = 
                    [
                        'inp_first_name.required'    => 'First name is required.',
                        'inp_last_name.required'     => 'Last name is required.',
                        'inp_email_add.required'     => 'Email is required.',
                        'inp_email_add.email'     => 'Email should be in a correct format.',
                        'inp_branch.required'        => 'Branch is required.',
                        'inp_user_type.required'     => 'User Type is required.',
                    ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return json_encode(['errRes' => 1, 'errMsg' => $validator->getMessageBag()]);
        }

        try
        {
            DB::beginTransaction();
            $BranchesModel = BranchesModel::where('branch_name', $request->input('inp_branch'))->first();

            $UserTypesModel = UserTypesModel::where('user_type', $request->input('inp_user_type'))->first();

            $UserDetailsModel = new UserDetailsModel();
            $UserDetailsModel->first_name       = $request->input('inp_first_name');
            $UserDetailsModel->last_name        = $request->input('inp_last_name');
            $UserDetailsModel->email_address    = $request->input('inp_email_add');
            $UserDetailsModel->save();

            $UserModel = new UserModel();
            $UserModel->username = $request->input('inp_email_add');
            $UserModel->password = encrypt( str_random(10));
            $UserModel->user_type_id = $UserTypesModel->id;
            $UserModel->user_detail_id = $UserDetailsModel->id;
            $UserModel->isactive = 1;
            $UserModel->branch_id = $BranchesModel->id;
            $UserModel->save();

            DB::commit();
            return json_encode(['errRes' => 0, 'retMsg' => [ 'successMsg' => [ '<strong>'.$UserDetailsModel->first_name . ' ' . $UserDetailsModel->last_name . '</strong> information successfully created'] ] ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            DB::rollBack();
        }
        

        return json_encode(['errRes' => 0]);
    }

    public function edit_user_modal (Request $request) 
    {
        if ( $request->input('type') == 1 )
        {
            $BranchesModel = BranchesModel::all();
            $UserTypesModel = UserTypesModel
                                ::whereIn('id', [2, 3])
                                ->get();
            
            $id = decrypt($request->input('id'));
            $UserModel = UserModel
                            ::where('id', $id)
                            ->with(['user_detail'])
                            ->first();

            return view('user.director_coordinator_modal', [ 'modal' => 1, 'branches' => $BranchesModel, 'types' => $UserTypesModel, 'user' => $UserModel ]);
        }
        else if ( $request->input('type') == 2 )
        {
            return view('user.director_coordinator_modal', [ 'modal' => 2, 'id' => $request->input('id') ]);
        }

    }

    public function edit_user (Request $request)
    {
        $rules = 
                [
                    'id'                    => 'required',
                    'inp_edit_first_name'   => 'required', 
                    'inp_edit_last_name'    => 'required', 
                    'inp_edit_email'        => 'required|email', 
                    'inp_edit_branch'       => 'required', 
                    'inp_edit_user_type'    => 'required'
                ];
        $messages = 
                    [
                        'id.required'                       => 'Invalid selection',
                        'inp_edit_first_name.required'      => 'First name is required', 
                        'inp_edit_last_name.required'       => 'Last name is required', 
                        'inp_edit_email.required'           => 'Email address is required', 
                        'inp_edit_email.email'              => 'Email address should be in a correct format', 
                        'inp_edit_branch.required'          => 'Branch is required', 
                        'inp_edit_user_type.required'       => 'User type is required'
                    ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return json_encode(['errRes' => 1, 'retMsg' => $validator->getMessageBag()]);
        }

        try
        {
            $id = decrypt($request->input('id'));


            DB::beginTransaction();

            $BranchesModel = BranchesModel::where('branch_name', $request->input('inp_edit_branch'))->first();
            $UserTypesModel = UserTypesModel::where('user_type', $request->input('inp_edit_user_type'))->first();


            $UserModel = UserModel
                            ::where('id', $id)
                            ->first();

            $UserModel->branch_id = $BranchesModel->id;
            $UserModel->user_type_id = $UserTypesModel->id;
            $UserModel->save();

            $UserDetailsModel = UserDetailsModel
                                    ::where('id', $UserModel->user_detail_id)
                                    ->first();
            $UserDetailsModel->first_name       = $request->input('inp_edit_first_name');
            $UserDetailsModel->last_name        = $request->input('inp_edit_last_name');
            $UserDetailsModel->email_address    = $request->input('inp_edit_email');
            $UserDetailsModel->save();



            DB::commit();
            return json_encode(['errRes' => 0, 'retMsg' => [ 'successMsg' => [ '<strong>'.$UserDetailsModel->first_name . ' ' . $UserDetailsModel->last_name . '</strong> information successfully updated'] ] ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            DB::rollBack();
            return json_encode(['errRes' => 1, 'retMsg' => 'ds']);
        }
    }

    public function delete_user (Request $request) 
    {
        $id = decrypt($request->input('data'));
        $UserModel = UserModel
                            ::where('id', $id)
                            ->first();
        $UserModel->isactive = 0;
        $UserModel->save();

        return json_encode(['errRes' => 0, 'retMsg' => [ 'successMsg' => [ '<strong>'.$UserModel->user_detail->first_name . ' ' . $UserModel->user_detail->last_name . '</strong> information successfully deleted'] ] ]);
        //return json_encode(['errRes' => 0, 'retMsg' => $UserModel->first_name . ' ' . $UserModel->user_detail->last_name . ' information successfully deleted.']);
    }
}
