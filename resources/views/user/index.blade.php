@extends('layouts.main')

@section('page-title')
    User Information
@endsection

@section('page-description')
    Director and Practicum Coordinator
@endsection


@section('scripts')
    <script>

        $(function () {

            fetch_data();

        });
        // will be called after the button edit was clicked
        $('body').on('click', '.btn-edit', function(){ 
            var id = $(this).data('id');
            $.ajax({
                url         : "{{ route('dir_coordi_edit_modal') }}",
                type        : 'POST',
                data        : { _token : "{{ csrf_token() }}" , id : id, type : 1},
                success     : function (data) {
                    $('.modal_holder').empty().append(data);
                    $('.modal_update').modal({ backdrop : false });
                }
            });
        });
        // when submits the form it calls an ajax request
        $('body').on('submit', '#frm_save_edit', function (e){
            e.preventDefault();
            $.ajax({
                url         : "{{ route('dir_coordi_edit') }}",
                type        : 'POST',
                data        : new FormData( $(this)[0] ),
                dataType    : 'json',
                processData : false,
                contentType : false,
                success     : function (data){
                    $('div.help-block.text-center').empty();
                    if( data['errRes'] != 0 )
                    {
                        for(var ret in data['retMsg'])
                        {
                            $('#'+ret+'_error').html('<code>'+ data['retMsg'][ret] +'</code>');
                        }
                    }
                    else
                    {
                        var msg = '<div class="alert alert-success alert-dismissible">'+
                                        '<button class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                                        '<h5>'+
                                            '<i class="icon fa fa-check"></i>' +
                                            data['retMsg']['successMsg'] +
                                        '</h5>' +
                                    '</div>'

                        $('.main_content').empty().append(msg).slideDown();
                        setTimeout(function (){
                            $('.main_content').slideUp().empty();
                        },7000);
                        fetch_data();
                        $('.modal_update').modal('hide');
                    }
                }
            });
        });
        // triggered after the modal is hidden
        $('body').on('hidden.bs.modal', '.modal_update', function (){ // clear the modal holder
            $('.modal_holder').empty();
        });

        // delete user
        $('body').on('click', '.btn-delete', function(){
            var id = $(this).data('id');
            $.ajax({
                url         : "{{ route('dir_coordi_edit_modal') }}",
                type        : 'POST',
                data        : { _token : "{{ csrf_token() }}" , id : id, type : 2},
                success     : function (data) {
                    $('.modal_holder').empty().append(data);
                    $('.modal_delete_confirmation').modal({ backdrop : false });
                }
            });
        });
        // on click the confirm delete button it will be triggered
        $('body').on('click', '.btn_confirm_delete', function () {
            $('#frm_confirm_delete').submit();
        });
        // after clicking the confirm delete button it will submit the form confirm delete
        $('body').on('submit', '#frm_confirm_delete', function (e) {
            e.preventDefault();
            var formData = new FormData( $(this)[0] );
            $.ajax({
                url         : "{{ route('dir_coordi_delete') }}",
                dataType    : 'json',
                type        : 'POST',
                data        : formData,
                processData : false,
                contentType : false,
                success     : function (data) {
                    $('.modal_delete_confirmation').modal('hide');
                    if(data['errRes'] == 0)
                    {
                        var msg = '<div class="alert alert-success alert-dismissible">'+
                                        '<button class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                                        '<h5>'+
                                            '<i class="icon fa fa-check"></i>' +
                                            data['retMsg']['successMsg'] +
                                        '</h5>' +
                                    '</div>'

                        $('.main_content').empty().append(msg).slideDown();
                        setTimeout(function (){
                            $('.main_content').slideUp().empty();
                        },7000);
                        fetch_data();
                    }
                }
            });
        });
        // create new user
        $('body').on('submit', '#frm_new_user', function (e){
            e.preventDefault();
            var formData = new FormData($('#frm_new_user')[0]);
            $.ajax({
                url         : "{{ route('dir_coordi_create') }}",
                type        : 'POST',
                dataType    : 'json',
                data        : formData,
                processData : false,
                contentType : false,
                success     : function (data) {
                    $('.help-block.text-center').empty();
                    if(data['errRes'] != 0 )
                    {
                        for(var ret in data['errMsg'])
                        {
                            $('#'+ret+'_error').html('<code>'+ data['errMsg'][ret] +'</code>');
                        }
                    }
                    else
                    {
                        var msg = '<div class="alert alert-success alert-dismissible">'+
                                        '<button class="close" data-dismiss="alert" aria-hidden="true">x</button>' +
                                        '<h5>'+
                                            '<i class="icon fa fa-check"></i>' +
                                            data['retMsg']['successMsg'] +
                                        '</h5>' +
                                    '</div>'

                        $('.main_content').empty().append(msg).slideDown();
                        setTimeout(function (){
                            $('.main_content').slideUp().empty();
                        },7000);
                        fetch_data();
                    }
                }
            });
        });
        $('body').on('change', '.new_info', function (){
            fetch_data();
        });

        // list all data
        function fetch_data () {
            $('.table_list_overlay').removeClass('hidden');
            var formData = new FormData($('#frm_new_user')[0]);
            $.ajax({
                url         : "{{ route('dir_coordi') }}",
                type        : 'POST',
                data        : formData,
                processData : false,
                contentType : false,
                success     : function (data) {
                    $('#table_user_list tbody').empty().append(data);
                    $('.table_list_overlay').addClass('hidden');
                }
            });
        }

    </script>
@endsection
@section('content')
        <div class="row">
            
            <div class="col-md-3">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            New User Information
                        </h3>
                    </div>

                    <div class="box-body">
                        <form id="frm_new_user">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="inp_first_name">First name</label>
                                <input type="text" id="inp_first_name" name="inp_first_name" class="form-control new_info" placeholder="First name">
                                <div class="help-block text-center" id="inp_first_name_error">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inp_last_name">Last name</label>
                                <input type="text" id="inp_last_name" name="inp_last_name" class="form-control new_info" placeholder="Last name">
                                <div class="help-block text-center" id="inp_last_name_error">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inp_email_add">Email address</label>
                                <input type="text" id="inp_email_add" name="inp_email_add" class="form-control new_info" placeholder="Email Address">
                                <div class="help-block text-center" id="inp_email_add_error">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inp_branch">Branch</label>
                                <select name="inp_branch" id="inp_branch" class="form-control new_info">
                                    <option value="">select branch</option>
                                    @foreach($branches as $b)
                                        <option value="{{ $b->branch_name }}">{{ $b->branch_name }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block text-center" id="inp_branch_error">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inp_user_type">User Type</label>
                                <select name="inp_user_type" id="inp_user_type" class="form-control new_info">
                                    <option value="">select user type</option>
                                    @foreach($types as $t)
                                        <option value="{{ $t->user_type }}">{{ $t->user_type }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block text-center" id="inp_user_type_error">
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-flat btn-block">Create</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-9">


                <div class="box box-primary">
                    <div class="overlay table_list_overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-body">
                        <div class="main_content"></div>
                        <table class="table table-bordered" id="table_user_list">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Branch</th>
                                <th>Actions</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div> {{-- /. row --}}
        
        <div class="modal_holder">
        </div>
@endsection