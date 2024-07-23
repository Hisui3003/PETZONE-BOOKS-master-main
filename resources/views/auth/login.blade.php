@extends('layout')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/login-register.css') }} ">

@section('content')
<main class="login-form">

    <div class="form-contain">
        <div class="huh-log ">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="login-container">
                        {{-- <div class="">Login</div> --}}
                        <div class="card-body">

                            <form action="{{ route('login.post') }}" method="POST" id="handleAjax">
                                @csrf

                                <div id="errors-list"></div>

                                <div class="input_box form-group row">
                                    <label for="email_address" class="col-md-3 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email"
                                            placeholder="E-mail" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="input_box form-group row">
                                    <label for="password" class="col-md-3 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="Password">
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
{{--
                                <div class="form-group row">
                                    <div class="option_field col-md-4 offset-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="contain">
                                    <button type="submit" class="login-btn ">
                                        Login
                                    </button>
                                </div>

                                <div class="reg">
                                    <p>
                                        Don't have an account yet?
                                    </p>

                                    <p>
                                        <a class="tis nav-link" href="{{ route('register') }}">Register</a>
                                    </p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(function() {
      $(document).on("submit", "#handleAjax", function(event) {
          event.preventDefault();

          var e = this;
          $(this).find("[type='submit']").html("Login...");

          $.ajax({
              url: $(this).attr('action'),
              data: $(this).serialize(),
              type: "POST",
              dataType: 'json',
              success: function (data) {
                $(e).find("[type='submit']").html("Login");

                if (data.status) {

                    window.location.href = data.redirect;
                } else {
                    $(".alert").remove();
                    $.each(data.errors, function (key, val) {
                        $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                    });
                }
              },
              error: function () {
                  $(e).find("[type='submit']").html("Login");
                  $("#errors-list").append("<div class='alert alert-danger'>An error occurred. Please try again.</div>");
              }
          });

          return false;
      });
  });
</script>
@endsection