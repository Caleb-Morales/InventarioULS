@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Modulo de administracion de categorias</h1>
    </div>
    <div class="col-md-6">
        <!-- Modal trigger button -->
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalIns">
          Añadir
        </button>
        
        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalIns" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    
                    <x-form enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">Insercion de Categoria</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <div class="mb-3">
                              <label for="" class="form-label">Nombre categoria</label>
                              <input type="text"
                                class="form-control" name="nombre" id="" aria-describedby="helpId" placeholder="" required>
                              <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                            <div class="mb-3">
                              <label for="" class="form-label">Imagen Categoria</label>
                              <input type="file" class="form-control" name="img" id="" placeholder="" aria-describedby="fileHelpId">
                              <div id="fileHelpId" class="form-text">Help text</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
        
        
        <!-- Optional: Place to the bottom of scripts -->
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
        
        </script>
    </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>IMAGEN</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listaCat as $cat)
                    <tr>
                        <th>{{$cat->id}}</th>
                        <td>{{$cat->nombre}}</td>
                        <td> <img src="{{url($cat->img)}}" alt="" width="64"></td>
                        <td>
                            <a href="{{ url('categorias/edit/'.$cat->id)}}" class="btn btn-block btn-warning">Modificar</a>
                            <x-form-btn method="DELETE" action="{{ url('categorias/delete/'.$cat->id)}}" class="btn btn-danger">Eliminar</x-form-btn>
                        </td>
                    </tr>    
                @empty
                    <tr>
                        <td>No hay datos...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</div>
@endsection