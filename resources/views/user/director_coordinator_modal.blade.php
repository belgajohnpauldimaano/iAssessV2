@if($modal == 1) {{--update--}} 
    <div class="modal fade modal_update">
        <div class="modal-dialog">
            <div class="modal-content">
                
            <form id="frm_save_edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User Information</h4>
                </div>
                
                <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ encrypt($user->id) }}">
                        <div class="help-block text-center" id="id_error"></div>
                        <div class="form-group">
                            <label for="">First name</label>
                            <input type="text" class="form-control" value="{{ $user->user_detail->first_name }}" id="inp_edit_first_name" name="inp_edit_first_name">
                            <div class="help-block text-center" id="inp_edit_first_name_error">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">First name</label>
                            <input type="text" class="form-control" value="{{ $user->user_detail->last_name }}" id="inp_edit_first_name" name="inp_edit_last_name">
                            <div class="help-block text-center" id="inp_edit_last_name_error">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">First name</label>
                            <input type="text" class="form-control" value="{{ $user->user_detail->email_address }}" id="inp_edit_first_name" name="inp_edit_email">
                            <div class="help-block text-center" id="inp_edit_email_error">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">First name</label>
                            <select name="inp_edit_branch" id="inp_edit_branch" class="form-control">
                                    <option value="">Select branch</option>
                                @foreach($branches as $b)
                                    <option value="{{ $b->branch_name }}">{{ $b->branch_name }}</option>
                                @endforeach
                            </select>
                            <div class="help-block text-center" id="inp_edit_branch_error">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">First name</label>
                            <select name="inp_edit_user_type" id="inp_edit_user_type" class="form-control">
                                    <option value="">Select user type</option>
                                @foreach($types as $t)
                                    <option value="{{ $t->user_type }}">{{ $t->user_type }}</option>
                                @endforeach
                            </select>
                            <div class="help-block text-center" id="inp_edit_user_type_error">
                            </div>
                        </div>
                        
                </div>

                <div class="modal-footer">
                    <button class="btn btn-flat btn-primary btn_save_edit" type="submit">
                        Save
                    </button>
                    <button class="btn btn-flat btn-default" type="button" data-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>

            </form>
            </div>
        </div>
    </div>
    <script>
        $('#inp_edit_branch').val( "{{ $user->branch->branch_name }}" );
        $('#inp_edit_user_type').val( "{{ $user->user_type->user_type }}" );
    </script>
@elseif($modal == 2)
    <div class="modal fade modal_delete_confirmation">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete Confirmation</h4>
                </div> {{--/.modal-header --}}

                <div class="modal-body">
                    <strong>
                        Are you sure you want to delete the information?
                    </strong>
                    <form id="frm_confirm_delete">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" value=" {{ $id }} " name="data">
                    </form>
                </div> {{-- /.modal-body --}}
 
                <div class="modal-footer">
                    <button class="btn btn-flat btn-primary btn_confirm_delete">
                        Yes
                    </button>
                    <button class="btn btn-flat btn-default" data-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div> {{-- /.modal-footer --}}

            </div> {{-- /. modal-content --}}

        </div> {{--/. modal-dialog --}}

    </div> {{--/. modal fade--}}
@endif