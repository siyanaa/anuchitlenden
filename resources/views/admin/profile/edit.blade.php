@extends('admin.layouts.master')


@section('content')

<div class="container" style="display: flex; flex-direction: column; align-items: center;  ">

    <div class="pw-container col-md-6" >
        
        <div class="card-header">पासवर्ड परिवर्तन गर्नुहोस</div>
        <form method="POST" action="{{ route('admin.users.update-password') }}" id="passwordChangeForm">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
        
            <div class="card-body">
                <div class="form-group">
                    <label for="password">पासवर्ड परिवर्तन गर्नुहोस</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="नयाँ पासवर्ड">
                </div>
                <div class="form-group mt-5">
                    <label for="retype-pass">पुन: टाइप गर्नुहोस्</label>
                    <input type="password" name="retype_password" class="form-control" id="retype-pass" placeholder="पुन: टाइप गर्नुहोस्">
                </div>
        
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    const passwordField = document.getElementById("password");
    const retypePasswordField = document.getElementById("retype-pass");
    const submitButton = document.getElementById("submitBtn");
    
    passwordField.addEventListener("input", function () {
        if (passwordField.value === retypePasswordField.value) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "true");
        }
    });

    retypePasswordField.addEventListener("input", function () {
        if (passwordField.value === retypePasswordField.value) {
            submitButton.removeAttribute("disabled");
        } else {
            submitButton.setAttribute("disabled", "true");
        }
    });
</script>
@endsection