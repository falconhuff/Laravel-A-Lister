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
                    <a href="{{ url('/index/upload?locale=en') }}">English</a>
                    <a href="{{ url('/index/upload?locale=id') }}">Bahasa</a>
                </div>
            </nav>
        </header>
        <div class="container mt-3">
            <h2>{{ __('upload.title') }}</h2>
            <hr>

            <a href="{{ route('index') }}" class="btn btn-secondary mb-3">{{ __('upload.input.btnlist') }}</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/index/upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-3">
                    <label for="title">{{ __('upload.q1') }}</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('upload.sub1') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="file">{{ __('upload.q2') }}</label>
                    <br>
                    <input type="file" class="form-control-file" id="file" name="file">
                    @error('file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="description">{{ __('upload.q3') }}</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="{{ __('upload.sub2') }}"></textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary my-2">{{ __('upload.input.btnupload') }}</button>
            </form>
        </div>
    </body>
</html>