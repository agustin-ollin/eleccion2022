<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Casilla;

class CasillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casillas = Casilla::all();
        return view('casilla.list', compact('casillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("casilla.create");
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
        $data['ubicacion'] = $request->ubicacion;
        $casilla = Casilla::create($data);
        return redirect('casilla')->with('success',
            $casilla->ubicacion . 'guardado satisfactoriamente ...');
    }

    private function validateData(Request $request){
        $request->validate([
            'ubicacion' => 'required|max:100',
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
        $casilla = Casilla::find($id);

        if($casilla)
            return view("casilla.edit", compact("casilla"));
        else 
            echo "No se encontró";
        
        
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
        $data['ubicacion'] = $request->ubicacion;
        Casilla::whereId($id)->update($data);
        return redirect('casilla')->with('success',
            'El cambio se realizó correctamente ...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Casilla::whereId($id)->delete();
        return redirect('casilla')->with('success',
            'El elemnto fue borrado ...');
    }
}
