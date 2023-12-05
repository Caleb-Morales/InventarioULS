<?php
// app/Http/Controllers/VentaController.php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $prods = Producto::all();
        return view('salidas.salidas', ['prods' => $prods]);
    }

    public function store(Request $r)
    {
        DB::transaction(function () use ($r) {
            $v = new Venta();
            $v->fecha = Carbon::now();
            $v->save();

            $vecId = $r->id;
            $vecCants = $r->cantidad;
            $vecPrecios = $r->precio;

            for ($i = 0; $i < count($vecId); $i++) {
                $p = Producto::find($vecId[$i]);

                if ($p) {
                    $p->stock -= $vecCants[$i];
                    $p->save();

                    $v->productos()->attach($vecId[$i], ['cantidad' => $vecCants[$i], 'precio' => $vecPrecios[$i]]);
                }
            }

            // Recuperar las ventas realizadas
            $ventasRealizadas = Venta::with('productos')->get();

            // Puedes pasar $ventasRealizadas a una vista o hacer lo que necesites con esta información
            // Por ejemplo, pasarlas a la vista 'ventas.index'
            return view('ventas.index', ['ventas' => $ventasRealizadas]);
        });
    }
}
