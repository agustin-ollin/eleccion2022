@extends('plantilla')
@section('content')

<div class="card">
    <div class="card-header">
        Editar Candidato
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="POST" action="{{ route('candidato.update', $candidato->id) }}" 
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" 
                readonly="true" value="{{$candidato->id}}" name="id" />
            </div>
            <div class="form-group">
                <label for="nombrecompleto">Nombre completo:</label>
                <input type="text" value="{{$candidato->nombrecompleto}}" 
                class="form-control" 
                name="nombrecompleto" />
            </div>    
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <?php 
                    $selectedWomen = $candidato->sexo=='M'?" selected ":""; 
                    $selectedMen =   $candidato->sexo=='H'?" selected ":""; 
                ?>
                <select name="sexo" id="sexo">
                    <option value="M" {{$selectedWomen}}>Mujer</option>
                    <option value="H" {{$selectedMen}} >Hombre</option>
                </select>
            </div>  
            <div class="form-group">
            <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto" 
                accept="image/png, image/jpeg" 
                 >
            </div>
            <div class="form-group">
                <label for="perfil">Perfil:</label>
                <input type="file" id="perfil" name="perfil" 
                accept="application/pdf"
                >
            </div>                            
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@endsection

