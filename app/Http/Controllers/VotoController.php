<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Candidato;
use App\Models\Casilla;
use App\Models\Eleccion;
use App\Models\Voto;
use App\Models\Votocandidato;
use Exception;
use Illuminate\Support\Facades\DB;

class VotoController extends Controller
{
    private $DUPLICATE_KEY_CODE=23000;
    private $DUPLICATE_KEY_MESSAGE="Ya existe un dato igual en la BD, ".
            "no se permiten duplicados";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casillas = Casilla::all();
        return view ("voto.list", compact ("casillas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $casillas = Casilla::all();
        $elecciones = Eleccion::all();
        $candidatos = Candidato::all();
        return view ("voto.create", compact (["casillas","elecciones","candidatos"]));
    }

    private function validateVote($request){
        foreach($request->all() as $key=>$value){
            if (substr($key,0,10)=="candidato_")
                if ($value<0){
                    return false;
                }
        }
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($this->validateVote($request)){
            $dataVote= [
                "eleccion_id"=>$request->eleccion_id,
                "casilla_id"=>$request->casilla_id,
            ];
            $candidates = [];
            foreach($request->all() as $key=>$value){
                if (substr($key,0,10)=="candidato_")
                    $candidates[substr($key,10)]=$value;
            }
            if ($request->hasFile('evidencia')) {
                $evidenceFileName = $request->file('evidencia')->getClientOriginalName();
                $request->file('evidencia')->move(public_path('pdf'), $evidenceFileName);
            }


            $dataVote['evidencia']=$evidenceFileName;

            $success= true;
            $message="save successful...";
            DB::beginTransaction();
            try {
                //--- save to voto
                $vote =Voto::create($dataVote);
                    //--- save to votocandidato
                foreach($candidates as $key=>$value){
                    $voteCandidate=[];
                    $voteCandidate['voto_id']= $vote->id;
                    $voteCandidate['candidato_id'] = $key;
                    $voteCandidate['votos']=$value;
                    Votocandidato::create($voteCandidate);
                }
                DB::commit();

            } catch (\Exception $e) {
                $success=false;
                DB::rollback();
                if ($e->getCode()==$this->DUPLICATE_KEY_CODE)
                    $message=$this->DUPLICATE_KEY_MESSAGE;
                else
                    $message=$e->getMessage();
            }
            return view('message',compact('message','success'));

        } else {
            $message="Votos no válidos";
            $success=false;
            return view('message',compact('message','success'));
        }


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
        $voto = Voto::find($id);

        if($voto)
            return view("voto.edit", compact("voto"));
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
        //
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



