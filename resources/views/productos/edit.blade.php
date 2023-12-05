@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Formulario de modificación de producto</h1>
        </div>
        <div class="col">
            <x-form enctype="multipart/form-data" method="PUT">
                <div class="mb-3">
                    <label for="" class="form-label">Nombre Producto</label>
                    <input type="text" class="form-control" name="nombre" aria-describedby="helpId" placeholder="" value="{{ $producto->nombre }}">
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <img src="{{ url($producto->img) }}" alt="" class="img-fluid">
                <div class="mb-3">
                    <label for="" class="form-label">Imagen Producto</label>
                    <input type="file" class="form-control" name="img" placeholder="" aria-describedby="fileHelpId">
                    <div id="fileHelpId" class="form-text">Help text</div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precio" aria-describedby="helpId" placeholder="" value="{{ $producto->precio }}">
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="stock" aria-describedby="helpId" placeholder="" value="{{ $producto->stock }}">
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Categoría</label>
                    <select class="form-select form-select-lg" name="catId">
                        @foreach ($listaCat as $cat)
                            <option value="{{ $cat->id }}" {{ $cat->id == $producto->categoria_id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Modificar</button>
            </x-form>
        </div>
    </div>
@endsection
