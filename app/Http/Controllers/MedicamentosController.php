<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\medicamentos;
use Illuminate\Support\Facades\Redirect;

use DB;

class MedicamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function _construct(){
        $this->middleware('auth');
    }*/

    /*public function __construct()
    {
      //  $this->middleware('auth');
    }*/

    public function index()
    {
        // if (!$request->ajax()) return redirect('/');
    
    //return ['medicamentos' => $medicamentos];
    $medicamentos = DB::table('gmedicamentos')
    ->select('idgmedicamentos','nombre','marca'
    ,'cantidad','concentracion','tipomedicamento'
    ,'condicion')
    ->get();

    return  $medicamentos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request)
    {
         //if (!$request->ajax()) return redirect('/');

    $medicamento = new medicamentos();
    //dd($request);
    
        $medicamento->nombre = $request->nombre;
        $medicamento->marca = $request->marca;
        $medicamento->cantidad = $request->cantidad;
        $medicamento->concentracion = $request->concentracion;
        $medicamento->tipomedicamento = $request->tipomedicamento;
        $medicamento->condicion = 1;
        $medicamento->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');

    $medicamento = medicamentos::findOrFail($request->idgmedicamentos);
    $medicamento->nombre = $request->nombre;
    $medicamento->marca = $request->marca;
    $medicamento->cantidad = $request->cantidad;
    $medicamento->concentracion = $request->concentracion;
    $medicamento->tipomedicamento = $request->tipomedicamento;
    $medicamento->condicion = 1;
    $medicamento->save();
    }

    public function desactivar(Request $request)
{
    //if (!$request->ajax()) return redirect('/');

    $medicamento = medicamentos::findOrFail($request->idgmedicamentos);
    $medicamento->condicion = 0;
    $medicamento->save();
}

public function activar(Request $request)
{
  //  if (!$request->ajax()) return redirect('/');
     
    $medicamento = medicamentos::findOrFail($request->idgmedicamentos);
    $medicamento->condicion = 1;
    $medicamento->save();
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
