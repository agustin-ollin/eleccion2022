<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\GenericController as GenericController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Candidato;

class CandidatoController extends GenericController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidatos = Candidato::all();
        $resp = $this->sendResponse($candidatos, "Listado de candidatos");
        return ($resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    private function validateData(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nombrecompleto' => 'unique:candidato|required|max:200',
            'sexo' => 'required'
        ]);

        if ($validation->fails())
            return $this->sendError("Error de validacion", $validation->errors());

    }


    private function prepareData(Request $request)
    {
        $foto = "";
        $perfil = "";
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('images'), $foto);

        }
        if ($request->hasFile('perfil')) {
            $perfil = $request->file('perfil')->getClientOriginalName();
            $request->file('perfil')->move(public_path('pdf'), $perfil);
        }

        $data = [
            "nombrecompleto" => $request->nombrecompleto,
            "sexo" => $request->sexo,
            "foto" => $foto,
            "perfil" => $perfil
        ];
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        $fields = $this->prepareData($request);

        $candidate = Candidato::create($fields);
        $resp = $this->sendResponse($candidate, "Guardado...");
        return ($resp);
    } //--- End store

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidato=Candidato::find($id);
        $candidato->update($request->all());
        return $candidato;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Candidato::destroy($id);
    }

}
