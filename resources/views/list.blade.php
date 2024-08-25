<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>A-Lister</title>
    </head>
    <body>
        <header>
            <nav class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ url('/index?locale=en') }}">English</a>
                    <a href="{{ url('/index?locale=id') }}">Bahasa</a>
                </div>
                <span class="navbar-text">
                    {{ __('list.welcome') }}, {{ auth()->user()->name }}!
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">{{ __('list.input.btnlogout') }}</button>
                </form>
            </nav>
        </header>
        <div class="container mt-3">
            <h2>{{ __('list.title') }}</h2>
            <hr>

            <a href="{{ url('/index/upload') }}" class="btn btn-primary mb-3">{{ __('list.input.btnreview') }}</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                @foreach ($movies as $movie)
                    <div class="col-md-12 mb-4">
                        <div class="card custom-card">
                            <img src="{{ asset('storage/' . $movie->path) }}" class="card-img-top" alt="{{ $movie->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="text-muted">{{ __('list.uploaded_on') }} {{ $movie->created_at->format('d M Y, H:i') }} {{ __('list.by') }} {{ $movie->client->name }}</p>
                                <div class="card-text">
                                    <p style="border: 1px solid #ddd; padding: 10px; background-color: #f9f9f9;">
                                        {{ $movie->description }}
                                    </p>
                                </div>
                                @if ($movie->edited_by)
                                    <p class="text-muted">{{ __('list.last_updated_by') }}: {{ $movie->editor->name }} {{ __('list.on') }} {{ $movie->updated_at->format('F j, Y, g:i a') }}</p>
                                @endif
                                <a href="{{ url('/index/edit', $movie->id) }}" class="btn btn-warning">{{ __('list.input.btnedit') }}</a>
                                <form action="{{ url('/index/delete', $movie->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ __('list.input.btndelete') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>