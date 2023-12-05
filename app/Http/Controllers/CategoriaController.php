<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
class CategoriaController extends Controller
{
    function index()  
    {
        $listaCat = Categoria::all();
        return view('categorias.index',array('listaCat'=>$listaCat));
    }
    public function store(Request $r){
        //var_dump($r->all());
        
        $cat = new Categoria();
        $cat->nombre = $r->input("nombre");
        $cat->img = $r->img->store('images','pub');
        $cat->save();
        return redirect('/categorias');
     }
    function edit($id)  
    {
        $cat = Categoria::find($id);
        return view('categorias.edit',array('cat'=>$cat));
    }
    public function putedit(Request $r, $id){
        //var_dump($r->all());
        
        $cat = Categoria::find($id);
        $cat->nombre = $r->nombre;
        if ($r->hasFile('img')) {
            $cat->img = $r->img->store('images','pub');
        }
        $cat->save();
        return redirect('/categorias');
    }
    function delete($id)
    {
        $cat = Categoria::find($id);

        if (!$cat) {
            return redirect('/categorias')->with('error', 'La categoría no existe.');
        }

        $cat->delete();

        return redirect('/categorias')->with('success', 'Categoría eliminada correctamente.');
    }
}