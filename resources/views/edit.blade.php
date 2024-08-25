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
                    <a href="{{ url('/index/edit/' . $movie->id . '?locale=en') }}">English</a>
                    <a href="{{ url('/index/edit/' . $movie->id . '?locale=id') }}">Bahasa</a>
                </div>
            </nav>
        </header>
        <div class="container mt-3">
            <h2>{{ __('edit.title') }}</h2>
            <hr>

            <form action="{{ url('/index/edit', $movie->id) }}" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <label for="file">{{ __('edit.q1') }}</label>
                    <br>
                    <input type="file" class="form-control-file" id="file" name="file">
                    @error('file')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                <div class="form-group mt-3">
                    <label for="title">{{ __('edit.q2') }}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $movie->title }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="description">{{ __('edit.q3') }}</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $movie->description }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary my-2">{{ __('edit.input.btnsave') }}</button>
                <a href="{{ route('index') }}" class="btn btn-secondary my-2">{{ __('edit.input.btncancel') }}</a>
            </form>
        </div>
    </body>
</html>