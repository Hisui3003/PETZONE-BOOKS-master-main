@extends('admin.layouts.app')

@section('title' , 'Admin-Add User')
@section('content')
<div class="col-12 mt-5">
    <div class="card">
        <form id="userForm" action="{{ route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="name" type="text" class="form-control" placeholder="Name" aria-label="name">
                    </div>
                    <div class="col">
                        <input name="email" type="text" class="form-control" placeholder="Email" aria-label="email">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="password" type="password" class="form-control" placeholder="Password" aria-label="password">
                    </div>
                    <div class="col">
                        <select name="role" id="inputState" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="phone_number" type="text" class="form-control" placeholder="Phone number" aria-label="phone_number">
                    </div>
                    <div class="col">
                        <input name="address" type="text" class="form-control" placeholder="Address" aria-label="address">
                    </div>
                    <div class="col">
                        <input name="image_path" type="file" accept="image/*" aria-label="image_path">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- Include jQuery and jQuery Validation plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    $("#userForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 3
            },
            role: {
                required: true
            },
            phone_number: {
                required: true,
                digits: true,
            },
            address: {
                required: true,
                minlength: 3
            },
            image_path: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "The name field is required",
                minlength: "The name must be at least 3 characters"
            },
            email: {
                required: "The email field is required",
                email: "The email must be a valid email address"
            },
            password: {
                required: "The password field is required",
                minlength: "The password must be at least 3 characters"
            },
            role: {
                required: "Select a role"
            },
            phone_number: {
                required: "The phone number field is required",
                digits: "The phone number must be a number",
            },
            address: {
                required: "The address field is required",
                minlength: "The address must be at least 3 characters"
            },
            image_path: {
                required: "The image path field is required",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection