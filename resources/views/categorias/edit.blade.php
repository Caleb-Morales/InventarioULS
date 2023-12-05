@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col">
        <h1>Formulario de modificacion de categoria</h1>
    </div>
    <div class="col">
        <x-form enctype="multipart/form-data" method="PUT">
            <div class="mb-3">
                <label for="" class="form-label">Nombre categoria</label>
                <input type="text"
                  class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" required value="{{$cat->nombre}}">
                <small id="helpId" class="form-text text-muted">Help text</small>
              </div>
              <img src="{{url($cat->img)}}" alt="" class="img-fluid">
              <div class="mb-3">
                <label for="" class="form-label">Imagen Categoria</label>
                <input type="file" class="form-control" name="img" id="" placeholder="" aria-describedby="fileHelpId">
                <div id="fileHelpId" class="form-text">Help text</div>
              </div>
              
              <button type="submit" class="btn btn-primary">Modificar</button>
        </x-form>
    </div>
</div>    
@endsection