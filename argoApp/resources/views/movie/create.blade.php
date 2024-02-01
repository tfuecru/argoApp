@extends('app.base')

@section('title', 'Argo Create Movie')

@section('content')
<form action="{{ url('movie') }}" method="post">

    <!-- Solución de error por CSRF -->
    <!--<input type="hidden" name="_method" value="post">-->
    <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
    @csrf

    <!-- Inputs del formulario -->

    <div class="mb-3">

        <label for="title" class="form-label">Movie title</label>

        <input type="text" class="form-control" id="title" name="title" maxlength="60" required  value="{{ old('title') }}">

    </div>

    <div class="mb-3">

        <label for="director" class="form-label">Movie director</label>

        <input type="text" class="form-control" id="director" name="director" maxlength="110" required value="{{ old('director') }}">

    </div>

    <div class="mb-3">

        <label for="year" class="form-label">Movie year</label>

        <input type="number" class="form-control" id="year" name="year" step="1" min="1" max="9999" required value="{{ old('year') }}">

    </div>

    <div class="mb-3">

        <label for="genre" class="form-label">Movie genre</label>

        <input type="text" class="form-control" id="genre" name="genre" maxlength="50" value="{{ old('genre') }}">

    </div>

    <button type="submit" class="btn btn-success">Create</button>

</form>
@endsection