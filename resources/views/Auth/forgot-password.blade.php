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
                    <a href="{{ url('/forgot-password?locale=en') }}">English</a>
                    <a href="{{ url('/forgot-password?locale=id') }}">Bahasa</a>
                </div>
            </nav>
        </header>
        <div class="container d-flex justify-content-center">
            <div class="row justify-content-center" style="width: 85%;">
                <div class="col-12">
                    <div class="card mt-5">
                        <div class="card-header">{{ __('forgot-password.title') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">{{ __('forgot-password.input.q1') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">{{ __('forgot-password.input.btnlink') }}</button>
                                </div>
                                <div class="form-group mt-3">
                                    <a href="{{ route('login') }}" class="btn btn-success">{{ __('forgot-password.input.btnlogin') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
