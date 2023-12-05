<!-- resources/views/salidas.blade.php -->
@extends('layouts.master')

@section('content')
    <h1>REGISTRO DE SALIDA DE PRODUCTOS</h1>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="prod" class="form-label">Productos</label>
                <select class="form-select form-select-lg" name="prod" id="prod">
                    <option selected>Select one</option>
                    @forelse ($prods as $p)
                        <option value="{{ $p->id }}" data-precio="{{ $p->precio }}" data-stock="{{ $p->stock }}">{{ $p->nombre }}</option>
                    @empty
                        <option>No hay datos</option>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-primary" id="btnAdd">Agregar</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <x-form id="frmSalida">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody id="salida">
                            <!-- Aquí se insertarán dinámicamente las filas de productos -->
                        </tbody>
                    </table>
                    <input type="submit" value="Vender" class="btn btn-success">
                </div>
            </x-form>
        </div>
    </div>

    

@endsection

@section('script')
    <script>
        // Script JS para manejar la dinámica de agregar productos a la salida
        document.addEventListener('DOMContentLoaded', function () {
            let btnAdd = document.getElementById("btnAdd");
            btnAdd.onclick = function (e) {
                let prod = document.getElementById("prod");
                let el = `
                    <tr class="">
                        <td>
                            <input type="text" class="form-control" name="id[]" placeholder="" value="${prod.value}" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="cantidad[]" placeholder="" value="1">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="precio[]" placeholder="" value="${prod.options[prod.selectedIndex].dataset.precio}" readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="eliminar(this)">Eliminar</button>
                        </td>
                    </tr>
                `;
                let f = document.getElementById("salida");
                f.insertAdjacentHTML('beforeend', el);
            };

            function eliminar(elemento) {
                elemento.parentNode.parentNode.remove();
            }
        });
    </script>
@endsection
