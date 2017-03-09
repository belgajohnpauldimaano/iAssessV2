
@if($users)
    @foreach($users as $user)
        <tr>
            <td> {{ $user->user_detail->first_name }} {{ $user->user_detail->last_name }} </td>
            <td> {{ $user->user_detail->email_address }}  </td>
            <td> {{ $user->user_type->user_type }}  </td>
            <td> {{ $user->branch->branch_name }}  </td>
            <td> 
                <button class="btn btn-default btn-block btn-flat btn-edit" data-id="{{ encrypt($user->id) }}">Edit</button> 
                <button class="btn btn-default btn-block btn-flat btn-delete" data-id="{{ encrypt($user->id) }}">Delete</button> 
            </td>
        </tr>
    @endforeach
@else
    <div class="alert alert-danger alert-dimissible">
        No Data
    </div>
@endif