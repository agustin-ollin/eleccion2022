@extends('plantilla')
@section('content')

    <div class="card uper">
        <div class="card-header">
            Agregar Candidato
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
            <form method="post"
                  action="{{ route('candidato.store') }} "
                  enctype="multipart/form-data"
                  onsubmit="return validateType('perfil', 'aplication/pdf');">
                @csrf
                <div class="form-group">
                    <label for="nombrecompleto">Nombre:</label>
                    <input type="text" class="form-control"
                           id="nombrecompleto"
                           name="nombrecompleto"/>
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo">
                        <option value="M" selected>Mujer</option>
                        <option value="H">Hombre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="foto">Foto:</label>
                    <input type="file" id="foto" name="foto"
                           accept="image/png, image/jpeg"
                           onchange="loadImg()"
                    >
                    <div id="previewImage"></div>
                    <img id="img" height="500px"/>
                </div>
                <div class="form-group">
                    <label for="perfil">Perfil:</label>
                    <input type="file" id="perfil" name="perfil"
                           accept="application/pdf"
                           onchange="loadFile()"
                    >
                    <div>
                        <embed id="vistaPrevia" type="application/pdf" width="700">
                    </div>
                </div>

                <div class="form-group">
                    <label for="curp">curp:</label>
                    <input type="text"
                           id="curp"
                           name="curp"
                           onfocusout="validate(this)"
                    >
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
    <!--<script type="text/javascript"
            src="{{ URL::asset('js/custom.js') }}">
    </script>-->
    <script>
        var MAX_SIZE = 2048;
        var ONE_MB = 1000000;

        let loadImage = function (e) {
            let img = document.getElementById("out-img");
            img.src = URL.createObjectURL(event.target.files[0])
        }

        //Previsualizar la imagen
        let loadImg = () => {
            let a = document.getElementById("foto").files[0].size;
            a = (a / 1024)
            console.log(a);
            if (a > MAX_SIZE) {
                alert("Imagen muy grande, tamaño actual " + a);
                //setear a null la eleccion
                document.getElementById('foto').value = null;
                // setear a null la imagen, en caso de que se haya elegido una anterior
                document.getElementById("out-img").style.display = 'none';
            } else {
                alert("Imagen aceptable ");
                // obtiene el id de la imagen
                let img = document.getElementById("out-img");

                //Visualizamos la imagen
                var archivo = document.getElementById("foto").files[0];
                var reader = new FileReader();
                if (foto) {
                    reader.readAsDataURL(archivo);
                    reader.onloadend = function () {
                        document.getElementById("img").src = reader.result;
                    }
                }
            }
        }


        //Previsualizar el pdf
        let loadFile = () => {
            //Obtener el file
            let a = document.getElementById("perfil").files[0].size;
            //Dividir para tener una relacion con el tamaño de php.ini -> 2M
            a = (a / 1024)
            console.log(a);
            if (a > MAX_SIZE) {
                alert("Imagen muy grande, tamaño actual " + a + "MB");
                //setear a null la eleccion
                document.getElementById('perfil').value = null;
            } else {
                alert("Archivo aceptable ");

                //visualizamos el pdf
                var archivo = document.getElementById("perfil").files[0];
                var reader = new FileReader();
                if (perfil) {
                    reader.readAsDataURL(archivo);
                    reader.onloadend = function () {
                        document.getElementById("vistaPrevia").src = reader.result;
                    }
                }
            }

        }
    </script>
@endsection
