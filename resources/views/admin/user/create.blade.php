@extends('admin.layouts.master')

<!-- Main content -->
@section('content')
    @include('admin.includes.forms')

    <div class="card-header">
        <h1 class="card-title">प्रयाेगकर्ता थप्नुहाेस</h1>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="quickForm" novalidate="novalidate" method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">नाम</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">इमेल </label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">फाेन नं</label>
                <input type="text" name="mobile_no" class="form-control" id="exampleInputEmail1" placeholder="Enter mobile number">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">कार्यालय</label>
                <input type="text" name="office" class="form-control" id="exampleInputEmail1" placeholder="Enter office">
            </div>
            <div class="form-group">
                <label>राेल</label>
                <select class="form-control" name="role">
                    @if (isset($role))
                        @foreach ($role as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="mt-3">
                <div class="form-group mb-3">
                    <label for="state_id">प्रदेश</label>
                    <select name="state_id" id="state_id">
                        <option disabled selected value> -- प्रदेश छान्नुहाेस -- </option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3 mb-3">
                    <select name="district_id" id="district">
                        <option disabled selected value> -- जिल्ला छान्नुहाेस -- </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Active Status</label>
                <select class="form-control" name="is_active">
                    <option value="0">निष्कृय</option>
                    <option value="1">सक्रिय</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">पासवर्ड</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">सिर्जना गर्नुहाेस</button>
        </div>
    </form>
    </div>
    <script>
        $(function() {
            $.noConflict();
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    name: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    name: {
                        required: "Please provide a name",
                        minlength: "Name should be at least 6 characters long"
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

        $(document).ready(function() {
            $('#state_id').change(function() {
                var stateId = $(this).val();
                console.log(stateId); // Check if the provinceId is correct
                var url = '/admin/users/get-districts/' + stateId;
                $('#district').empty();

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.length > 0) {
                            $.each(response, function(key, value) {
                                $('#district').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });

                            // Add this part to set the selected district value if it exists in the database
                            var selectedDistrict =
                                "{{ old('district', $user->district ?? '') }}";
                            if (selectedDistrict !== '') {
                                $('#district').val(selectedDistrict);
                            }
                        } else {
                            $('#district').append(
                                '<option value="">No districts found</option>');
                        }
                    }
                });
            });

            // Add this part to set the selected district value when the page loads
            var selectedDistrict = "{{ old('district', $user->district ?? '') }}";
            if (selectedDistrict !== '') {
                $('#district').val(selectedDistrict);
            }
        });
    </script>

@endsection
