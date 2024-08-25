<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <title>A-Lister</title>
    </head>
    <body>
        <header>
            <nav class="navbar d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ url('/login?locale=en') }}">English</a>
                    <a href="{{ url('/login?locale=id') }}">Bahasa</a>
                </div>
            </nav>
        </header>
        <div class="container d-flex justify-content-center">
            <div class="row justify-content-center" style="width: 85%;">
                <div class="col-12">
                    <br>
                    <h2>A-Lister</h2>
                    <div class="mt-3">
                        <a href="{{ route('register') }}" class="btn btn-primary">{{ __('login.input.btnregister') }}</a>
                    </div>
                    <hr>
                    <div class="card mt-1">
                        <div class="card-header">{{ __('login.title') }}</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('login.input.q1') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password">{{ __('login.input.q2') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="checkbox" name="remember" id="remember"> {{ __('login.input.sub1') }}
                                </div>
                                <div class="form-group mt-3">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">{{ __('login.input.btnlogin') }}</button>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('password.request') }}" class="btn btn-warning">{{ __('login.input.btnforgot') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> 