<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Eleccion;

class EleccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elecciones = Eleccion::all();
        return view('eleccion.list', compact('elecciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("eleccion.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request);
        $data = $this->prepareData($request);
        $eleccion = Eleccion::create($data);
        return redirect('eleccion')->with('success',
            $eleccion->periodo . ' guardado satisfactoriamente ...');
    }

    private function prepareData(Request $request){
        $data= [
            'periodo' => $request->periodo,
            'fecha' => $request->fecha,
            'fechaapertura' => $request->fechaapertura,
            'horaapertura' => $request->horaapertura,
            'fechacierre' => $request->fechacierre,
            'horacierre' => $request->horacierre,
            'observaciones' => $request->observaciones
        ];
        return $data;
    }

    private function validateData(Request $request){
        $request->validate([
            'periodo' => 'required|max:100',
            'fecha' => 'required',
            'fechaapertura' => 'required',
            'horaapertura' => 'required',
            'fechacierre' => 'required',
            'horacierre' => 'required',
            'observaciones' => 'required|max:100',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = intval($id);
        $eleccion = Eleccion::whereId($id)->first();

        if ($eleccion){
            return view("eleccion.edit", compact("eleccion"));
        } else {
            echo "Dato no encontrado";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateData($request);
        $data = $this->prepareData($request);
        $eleccion= Eleccion::whereId($id)->update($data);
        return redirect('eleccion')->with('success',
            $data['periodo'] . ' guardado satisfactoriamente ...');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Eleccion::whereId($id)->delete();
        return redirect('eleccion')->with('success',
            'El elemento fue borrado ...');
    }
}
