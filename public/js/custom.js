function preview(event, divDestination) {
    for (let file of event.target.files) {
        let src = URL.createObjectURL(file);
        let iframe = document.createElement("iframe");
        iframe.src = src;
        var destination = document.getElementById(divDestination);
        if (destination.hasChildNodes()) {
            destination.removeChild(destination.firsElementChild);
        }
        destination.appendChild(iframe);
        destination.style.display = "block";
    }
    ;
}

const validateSize = (fileId, maxSize) => {
    let size = document.getElementById(fileId).files[0].size;
    console.log("SIZE:" + size);
    return (size <= maxSize);
}

const validateType = (fileId, ...fileTypes) => {
    const NOT_FOUND = -1;
    let type = document.getElementById(fileId).files[0].type;
    const upperCased = fileTypes.map(it => it.toUpperCase());
    return (upperCased.indexOf(type.toUpperCase()) !== NOT_FOUND);
}

function validateData() {
    let isValid = true;
    if (!validateSize('foto', 2048 * 1024)) {
        alert("El tamaño de la foto debe ser menor a 2MB");
        isValid = false;
    }
    return isValid;
}


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
