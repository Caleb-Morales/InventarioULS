@extends('layouts.master')

@section('content')
    <h1>Ventas Realizadas</h1>
    <hr>

    @foreach ($ventas as $venta)
        <p>Fecha: {{ $venta->fecha }}</p>
        <ul>
            @foreach ($venta->productos as $producto)
                <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }} - Precio: {{ $producto->pivot->precio }}</li>
            @endforeach
        </ul>
        <hr>
    @endforeach
@endsection