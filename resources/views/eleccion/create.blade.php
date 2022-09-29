@extends('plantilla')
@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Agregar Elección
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
            <form method="post" action="{{ route('eleccion.store') }} " enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="periodo">Periódo:</label>
                    <input type="text" class="form-control" name="periodo"/>
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" class="form-control" name="fecha"/>
                </div>
                <div class="form-group">
                    <label for="fechaapertura">Fecha de Apertura:</label>
                    <input type="date" class="form-control" name="fechaapertura"/>
                </div>
                <div class="form-group">
                    <label for="horaapertura">Hora de Apertura:</label>
                    <input type="time" class="form-control" name="horaapertura"/>
                </div>
                <div class="form-group">
                    <label for="fechacierre">Fecha de Cierre:</label>
                    <input type="date" class="form-control" name="fechacierre"/>
                </div>
                <div class="form-group">
                    <label for="horacierrre">Hora de Cierre:</label>
                    <input type="time" class="form-control" name="horacierre"/>
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones:</label>
                    <input type="text" class="form-control" name="observaciones"/>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@endsection
