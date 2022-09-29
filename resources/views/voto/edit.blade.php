@extends('plantilla')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Voto
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <form method="POST"
                  action="{{ route('voto.update', $voto->id) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text"
                           class="form-control"
                           readonly="true"
                           value="{{$voto->id}}"
                           name="id"/>
                </div>
                <div class="form-group">
                    <label for="eleccion_id">Elección:</label>
                    <select name="eleccion_id" id="eleccion_id" >
                        @foreach ($elecciones as $eleccion)
                            <option value="{{$eleccion->id}}">{{$eleccion->periodo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="casilla_id">Casilla:</label>
                    <select name="casilla_id" id="casilla_id" >
                        @foreach ($casillas as $casilla)
                            <option value="{{$casilla->id}}">{{$casilla->ubicacion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <table class="table">
                        <thead>
                        <th>Candidato</th>
                        <th>Votos</th>
                        </thead>
                        <tbody>
                        @foreach ($candidatos as $candidato)
                            <tr>
                                <td>{{$candidato->nombrecompleto}}</td>
                                <td><input type="number" id=""
                                           name="candidato_{{$candidato->id}}" >
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="evidencia">Evidencia:</label>
                    <input type="file" id="evidencia" name="evidencia" value="{{$voto->evidencia}}">
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection
