<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;

use App\UserModel;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    // public function index()
    // {
    //     return view('userlogin');
    // }
    public function getLogin(Request $request)
    {   

        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $UserModel = UserModel::
            with(['user_type', 'user_detail'])
            ->where('username', $username)
            ->first();
        
        if(count($UserModel) == 1)
        {
            $pass = decrypt($UserModel->password);

            if($pass == $password)
            {
                $msg = 'Correct Password';
                $request->session()->put('USER_ID', $UserModel->id);
                $request->session()->put('USER_NAME', $UserModel->username);
                $request->session()->put('USER_TYPE', $UserModel->user_type->user_type);
                $request->session()->put('USER_FULLNAME', $UserModel->user_detail->first_name . ' ' . $UserModel->user_detail->last_name);

                Auth::loginUsingId($UserModel->id);

                echo $request->session()->get('USER_ID');
                echo $request->session()->get('USER_NAME');
                echo $request->session()->get('USER_TYPE');
                echo $request->session()->get('USER_FULLNAME');


                return redirect()->route('home');

            }
            else
            {
                $msg =  'Invalid Password';
                return redirect('login')
                        ->withMsg($msg)
                        ->withInput($request->all());
            }
        }
        else
        {
            $msg = 'Invalid username or passowrd';

            return redirect('login')
                        ->withMsg($msg)
                        ->withInput($request->all());
        }
        //return json_encode($UserModel);

    }
    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('userlogin');
    }
}
