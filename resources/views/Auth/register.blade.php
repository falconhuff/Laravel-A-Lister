<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <title>A-Lister</title>
    </head>
    <body>
        <header>
            <nav class="navbar d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ url('/register?locale=en') }}">English</a>
                    <a href="{{ url('/register?locale=id') }}">Bahasa</a>
                </div>
            </nav>
        </header>
        <div class="container d-flex justify-content-center">
            <div class="row justify-content-center" style="width: 85%;">
                <div class="col-12">
                    <br>
                    <h2>A-Lister</h2>
                    <div class="mt-3">
                        <a href="{{ route('login') }}" class="btn btn-success">{{ __('register.input.btnlogin') }}</a>
                    </div>
                    <hr>
                    <div class="card mt-1">
                        <div class="card-header">{{ __('register.title') }}</div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('register.input.q1') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">{{ __('register.input.q2') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password">{{ __('register.input.q3') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                 <div class="form-group mt-3">
                                    <label for="password_confirmation">{{ __('register.input.q4') }}</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                 </div>
                                 <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">{{ __('register.input.btnregister') }}</button>
                                 </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>