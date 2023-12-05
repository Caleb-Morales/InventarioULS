<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\venta;

class ProductoController extends Controller
{
    public function index()
    {
        $listaCat = Categoria::all();
        $listaProd = Producto::all();
        return view('productos.index', ['listaCat' => $listaCat, 'listaProd' => $listaProd]);
    }

    public function store(Request $r)
    {
        $validate = $r->validate([
            "nombre" => "required|unique:productos,nombre|max:50",
            "img" => "required|image|mimes:png,jpg|max:3000"
        ]);

        $p = new Producto();
        $p->nombre = $r->input("nombre");
        $p->img = $r->img->store('images', 'pub');
        $p->precio = $r->precio;
        $p->stock = $r->stock;
        $p->categoria_id = $r->catId;
        $p->save();

        return redirect('/productos');
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        $listaCat = Categoria::all();

        return view('productos.edit', ['producto' => $producto, 'listaCat' => $listaCat]);
    }

    public function putEdit(Request $r, $id)
    {
        $validate = $r->validate([
            "nombre" => "required|unique:productos,nombre,$id|max:50",
            "img" => "image|mimes:png,jpg|max:3000"
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return redirect('/productos')->with('error', 'El producto no existe.');
        }

        $producto->nombre = $r->input("nombre");

        if ($r->hasFile('img')) {
            $producto->img = $r->img->store('images', 'pub');
        }

        $producto->precio = $r->precio;
        $producto->stock = $r->stock;
        $producto->categoria_id = $r->catId;
        $producto->save();

        return redirect('/productos')->with('success', 'Producto modificado correctamente.');
    }

    public function delete($id)
    {
        $p = Producto::find($id);

        if (!$p) {
            return redirect('/productos')->with('error', 'El producto no existe.');
        }

        // Eliminar registros relacionados en producto_venta
        $p->ventas()->detach();

        // Ahora puedes eliminar el producto
        $p->delete();

        return redirect('/productos')->with('success', 'Producto eliminado correctamente.');
    }
    public function ventas()
    {
        return $this->belongsToMany('App\Models\Venta', 'producto_venta', 'producto_id', 'venta_id')
                    ->withPivot('cantidad', 'precio')
                    ->withTimestamps();
    }
}
