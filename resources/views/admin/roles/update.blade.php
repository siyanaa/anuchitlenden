@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    <div class="card-header">
        <h1 class="card-title">Update Role</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form id="quickForm" novalidate="novalidate" method="POST" action="/admin/roles/update">
        @csrf

        <div class="form-group">
            <input type="hidden" value="{{ $role->id }}" name="id" id="">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" id="exampleInputName"
                placeholder="Name" onkeyup="replaceFunction(this.value)">
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Permissions <input type="checkbox" id="check-all-permissions"></th>
                    <th>Create</th>
                    <th>View</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Users</td>
                    @foreach ($user_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Roles</td>
                    @foreach ($role_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Permissions</td>
                    @foreach ($permission_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Registration</td>
                    @foreach ($register_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Discussion</td>
                    @foreach ($discussion_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Release</td>
                    @foreach ($release_permissions as $up)
                        <td>
                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>Report</td>
                    @foreach ($report_permissions as $up)
                        <td>
                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>History</td>
                    <td></td>
                    @foreach ($history_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td>User Delete/Restore</td>
                    <td></td>
                    @foreach ($userDeletion_permissions as $up)
                        <td>

                            <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                                @if ($role->permissions->contains($up->id)) checked @endif>
                            <label for="permission"> {{ $up->name }}</label><br>
                        </td>
                    @endforeach
                </tr>
            </tbody>


        </table>



























        {{-- <div class="card-body">
            <div class="form-group">
                <input type="hidden" value="{{ $role->id }}" name="id" id="">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $role->name }}" id="exampleInputName"
                    placeholder="Name" onkeyup="replaceFunction(this.value)">
            </div>

            <div class="form-group" data-select2-id="39">
                <label for="">USER PERMISSIONS</label>
                <div class="select2-purple">
                    @foreach ($user_permissions as $up)
                    <input type="checkbox" id="permission" name="permissions[]" value="{{ $up->id }}"
                    @if ($role->permissions->contains($up->id)) checked @endif>
                    <label for="permission"> {{ $up->name }}</label><br>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                
                <label for="">ROLE PERMISSIONS</label>
                <div class="select2-purple">
                    @foreach ($role_permissions as $rp)
                    <input type="checkbox" id="permission" name="permissions[]" value="{{ $rp->id }}"
                    @if ($role->permissions->contains($rp->id)) checked @endif>
                    <label for="permission"> {{ $rp->name }}</label><br>
                    @endforeach
                </div>
            </div>
        </div> --}}
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    <script>
        $(function() {
            $.noConflict();
            //Initialize Select2 Elements
            $('.select2').select2()

            $(document).ready(function() {
                $('.select2').select2();
            });

            $(document).ready(function() {
                $('.chosen-select').chosen();
            });

            $('#quickForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    permissions: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please provide a name of role",
                    },
                    permissions: {
                        required: "Choose at lease one permission",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

        function replaceFunction(val) {
            document.getElementById('exampleInputName').value = val.replace(' ', '-');
        }

        // JavaScript code to handle the "Check All" checkbox
        document.addEventListener('DOMContentLoaded', function() {
            const checkAllCheckbox = document.getElementById('check-all-permissions');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

            checkAllCheckbox.addEventListener('change', function() {
                permissionCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = checkAllCheckbox.checked;
                });
            });
        });
    </script>
@endsection
