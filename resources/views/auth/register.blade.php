<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Assistant:400,700" rel="stylesheet"><link rel="stylesheet" href="{{asset('loginform/css/style.css')}}">
</head>
<body>

    <section class='login' id='login'>
        <div class='head'>
            <h1 class='company'>Register</h1>
            </div>
            <p class='msg'>Welcome</p>


                <div class="form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"  class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Role</label>
                            <div class="Radio">
                                <label>
                                    <input type="Radio" name="role" value="Costumer"> Costumer
                                </label>
                            </div>
                            <div class="Radio">
                                <label>
                                    <input type="Radio" name="role" value="delivery_serviceprovider"> Service Provider
                                </label>
                            </div>
                            <div class="Radio">
                                <label>
                                    <input type="Radio" name="role" value="shop_owner"> Shop owner
                                </label>
                            </div>
                        </div>
<br>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-login"  id="#demoNotify">
                                    {{ __('Create your Account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
</section>
<script  src="{{asset('loginform/js/script.js')}}"></script>
<script type="text/javascript">
    $('#demoNotify').click(function(){
        $.notify({
            title: "Register Complete : ",
            message: "Account Created Welcome!",
            icon: 'fa fa-check'
        },{
            type: "info"
        });
    });
</body>
</html>
