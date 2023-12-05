@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Modificar Usuario</h1>
        </div>
        <div class="col-md-6">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <x-form action="{{ route('user.update', $usuario->id) }}" method="PUT">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre Usuario</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $usuario->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $usuario->email }}" required>
                </div>
                <div class="mb-3">
                    <label for="roles" class="form-label">Roles</label>
                    @foreach ($roles as $r)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="{{ $r }}" id="{{ $r }}"
                                name="roles[]" {{ in_array($r, $usuario->getRoleNames()->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $r }}">
                                {{ $r }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Modificar</button>
            </x-form>
        </div>
    </div>
@endsection
