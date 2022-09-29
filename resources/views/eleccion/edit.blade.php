@extends('plantilla')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Editar Elección
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
                  action="{{ route('eleccion.update', $eleccion->id) }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text"
                           class="form-control"
                           readonly="true"
                           value="{{$eleccion->id}}"
                           name="id"/>
                </div>
                <div class="form-group">
                    <label for="periodo">Periódo:</label>
                    <input type="text" class="form-control" name="periodo" value="{{$eleccion->periodo}}"/>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" name="fecha" value="{{$eleccion->fecha}}"/>
                </div>
                <div class="form-group">
                    <label for="fechaapertura">Fecha de Apertura:</label>
                    <input type="date" class="form-control" name="fechaapertura" value="{{$eleccion->fechaapertura}}"/>
                </div>
                <div class="form-group">
                    <label for="horaapertura">Hora de Apertura:</label>
                    <input type="time" class="form-control" name="horaapertura" value="{{$eleccion->horaapertura}}"/>
                </div>
                <div class="form-group">
                    <label for="fechacierre">Fecha de Cierre:</label>
                    <input type="date" class="form-control" name="fechacierre" value="{{$eleccion->fechacierre}}"/>
                </div>
                <div class="form-group">
                    <label for="horacierrre">Hora de Cierre:</label>
                    <input type="time" class="form-control" name="horacierre" value="{{$eleccion->horacierre}}"/>
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones:</label>
                    <input type="text" class="form-control" name="observaciones" value="{{$eleccion->observaciones}}"/>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection
