<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionario.list', compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("funcionario.create");
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
        $funcionario= Funcionario::create($data);
        return redirect('funcionario')->with('success',
                $funcionario->nombrecompleto . ' guardado satisfactoriamente ...');
    }

    private function validateData(Request $request){
        $request->validate([
            'nombrecompleto' => 'required|max:100',
            'sexo' => 'required'
        ]);
    }

    private function prepareData(Request $request){
        $data= [
            "nombrecompleto"=>$request->nombrecompleto,
            "sexo"=>$request->sexo
        ];
        return $data;
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
        $funcionario = Funcionario::whereId($id)->first();

        if ($funcionario){
            return view("funcionario.edit", compact("funcionario"));
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
        $funcionario= Funcionario::whereId($id)->update($data);
        return redirect('funcionario')->with('success',
                $data['nombrecompleto'] . ' guardado satisfactoriamente ...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Funcionario::whereId($id)->delete();
        return redirect('funcionario')->with('success',
            'El elemento fue borrado ...');
    }
}
