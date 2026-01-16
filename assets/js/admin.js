

function mostrarMenuConfirmacion() {
    // Utiliza la función window.confirm para mostrar un cuadro de diálogo de confirmación
    var confirmacion = window.confirm("¿Quieres salir de la creación del nivel?");

    // Si el usuario hace clic en "Aceptar", redirecciona o realiza la acción deseada
    if (confirmacion) {
        window.location.href = "niveles.php";  // Reemplaza con tu URL de salida
    }
    // Si el usuario hace clic en "Cancelar", no hagas nada
}

function completarPaso() {
    const progressStep = document.getElementById(`step`);
    progress = (progressStep.offsetWidth / progressStep.parentElement.offsetWidth) * 100;
    progress += 25;
    if (progressStep) {
        progressStep.style.width = progress + '%';
    }
}
let currentStep = 1;

function nextStep() {
    console.log()
    const currentStepElement = document.getElementById(`paso-${currentStep}`);
    currentStepElement.classList.remove('active');

    currentStep += 1;

    if (currentStep > 4) {
        currentStep = 4; // Evitar pasar más allá del paso final
        finish();
    }

    const nextStepElement = document.getElementById(`paso-${currentStep}`);
    nextStepElement.classList.add('active');
}

function uploadActs(){
    const memo = document.getElementById("memorama").value;
    const desc = document.getElementById("describir").value;
    const selecOp = document.getElementById('selecOp').value;
    const selecGif = document.getElementById('selecGif').value;
    var formData = new FormData();
    formData.append('accion', 'act');
    formData.append('memo', memo);
    formData.append('desc',desc);
    formData.append('sOp',selecOp);
    formData.append('sGif',selecGif);
    fetch('sessionNivel.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(result => {
        console.log(result);
        /*document.getElementById('sign').value = '';

        // Limpiar el input de tipo archivo
        var inputArchivo = document.getElementById('gif');
        inputArchivo.value = '';

        alert('Gif cargado temporalmente.');*/
        sig();
    })
    .catch(error => {
        console.error('Error al cargar el documento:', error.message);
        alert('Error al cargar el documento.');
    });
}

function finish() {
    $.ajax({
        type: "POST",
        url: "nuevoNivel.php",  // Ruta al archivo PHP que manejará la inserción en la base de datos
        //data: { datos: JSON.stringify(datos) },  // Envía los datos como JSON
        success: function(response) {
            console.log(response);
            // Maneja la respuesta del servidor (si es necesario)
            alert('Nivel creado exitosamente');
        },
        error: function(error) {
            console.error('Error al enviar los datos:', error);
            alert('Error al crear el nivel');
        }
    });
    // Lógica para finalizar la creación del nivel
    //alert('Nivel creado exitosamente');
}


function uploadVideo(){
    var video = document.getElementById('video').files[0];
        
    if (video) {
        // Simular la carga del documento (puedes reemplazar esto con tu lógica real de carga)
        uploadFileToTempFolder(video);
        setTimeout(function () {
            console.log('Video cargado correctamente');
            // Luego de cargar el documento, permitir cargar el video
            //enableDocUpload();
        }, 2000);
    } else {
        alert('Selecciona un documento antes de continuar.');
    }
}

function uploadFileToTempFolder(file) {
    var formData = new FormData();
    formData.append('accion', 'video');
    //formData.append('v1', tipo);
    formData.append('video', file);

    fetch('sessionVideo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        alert('Video cargado temporalmente.');
        // Realiza acciones adicionales después de cargar el documento
    })
    .catch(error => {
        console.error('Error al cargar el documento:', error);
        alert('Error al cargar el documento.');
    });
}

function enableDocUpload() {
    //document.getElementById('video').disabled = false;
    var label = document.createElement('label');
    label.innerText = 'Subir documento:';
    label.for = 'documento';
    document.getElementById('upload-form').appendChild(label);
    var iFile = document.createElement('input');
    iFile.type = 'file';
    iFile.id = 'documento';
    iFile.name = 'documento';
    iFile.setAttribute('accept', '.pdf, .doc, .docx');
    document.getElementById('upload-form').appendChild(iFile);
    var button = document.createElement('button');
    button.type = 'button';
    button.innerText = 'Subir documento';
    button.classList.add('btn');
    button.onclick = uploadDoc;
    document.getElementById('upload-form').appendChild(button);
}

function uploadDoc() {
    var docFile = document.getElementById('document').files[0];

    if (docFile) {
        uploadFileDoc(docFile);
        //alert("hasta aqui");
        // Simular la carga del video (puedes reemplazar esto con tu lógica real de carga)
        setTimeout(function () {
            //alert("aca");
            console.log('Documento cargado correctamente');
            alert('Ambos archivos han sido cargados exitosamente.'); 
            activarbtn();
            siguiente();
        }, 2000);

    } else {
        alert('Selecciona un documento antes de continuar.');
    }
}
function activarbtn(){
    var btn = document.getElementById("siguiente-button");
    btn.disable = false;
}
function siguiente(){
    //alert("yeii");
    
    // Eliminar el botón existente si hay uno
    var existingButton = document.getElementById('siguiente-button');
    if (existingButton) {
        existingButton.parentNode.removeChild(existingButton);
    }

    // Crear un nuevo botón "Siguiente"
    var button = document.createElement('button');
    button.type = "button";
    button.id = 'siguiente-button';
    button.innerText = 'Siguiente';
    button.classList.add('btn');
    button.onclick = sig;
    // Agregar el nuevo botón al formulario
    document.getElementById('upload-form').appendChild(button);
}

function sig(){
    completarPaso();
    nextStep();
}

function uploadFileDoc(file) {
    var formData = new FormData();
    formData.append('accion', 'archivos');
    formData.append('documento', file);
    event.preventDefault()
    //alert("ahi voyy");
    fetch('sessionNivel.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(result => {
        console.log(result);
        //alert('Documento cargado temporalmente.');
    })
    .catch(error => {
        console.error('Error al cargar el documento:', error.message);
        alert('Error al cargar el documento.');
    });
}


//-------------------GIF----------------------------------
function uploadGif(){
    //actualizarTabla();
    var gif = document.getElementById('gif').files[0];
    var sign = document.getElementById('sign').value.trim();
    console.log(gif);
    console.log(sign);
    if (gif && sign != "") {
        // Simular la carga del documento (puedes reemplazar esto con tu lógica real de carga)
        verificarExistenciaEnSession(gif, sign)
        .then(noHay => {
            // Hacer algo con noHay
            console.log("Resultado:", noHay);
            if (noHay) {
                uploadFileGif(gif, sign);
                setTimeout(function () {
                    console.log('Gif cargado correctamente');
                    actualizarTabla();
                    // Luego de cargar el documento, permitir cargar el video
                    //enableDocUpload(); MEJOR FUNCION PARA MOSTRAR EN LA TABLA UWU
                }, 2000);
                // Aquí puedes realizar acciones adicionales si la verificación es exitosa
            }else{
                alert('El archivo/respuesta ya existe en el nivel.');
            }
        })
        .catch(error => {
            // Manejar errores si es necesario
            console.error("Error:", error);
        });
        
    } else {
        alert('Completa todos los campos para agregar una respuesta.');
    }
}

function obtenerNombreArchivo(rutaCompleta) {
    console.log(rutaCompleta);
    // Obtener el nombre del archivo desde la ruta completa
    var partesRuta = rutaCompleta.split('/');
    return partesRuta[partesRuta.length - 1];
}

function verificarExistenciaEnSession(nombreArchivo, nombreRespuesta) {
    return new Promise((resolve, reject) => {
        var noHay = true;
        fetch('listarArchivos.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener la lista de archivos: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                data.forEach(archivo => {
                    console.log("xxsdd");
                    var a = obtenerNombreArchivo(archivo.ruta);
                    console.log(a);
                    console.log(nombreArchivo.name);
                    console.log(archivo.nombre);
                    console.log(nombreRespuesta);
                    if (a === nombreArchivo.name || nombreRespuesta.toUpperCase() === archivo.nombre.toUpperCase()) {
                        noHay = false;
                    }
                });

                resolve(noHay);  // Resuelve la promesa con el valor de noHay
            })
            .catch(error => {
                console.error('Error al obtener la lista de archivos:', error);
                reject(error);  // Rechaza la promesa si hay un error
            });
    });
}

function uploadFileGif(file,s) {
    console.log(s);
    var formData = new FormData();
    formData.append('accion', 'gif');
    formData.append('gif', file);
    formData.append('significado',s);
    //event.preventDefault()
    //alert("ahi voyy");
    //console.log(formData);
    fetch('sessionNivel.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(result => {
        console.log(result);
        document.getElementById('sign').value = '';

        // Limpiar el input de tipo archivo
        var inputArchivo = document.getElementById('gif');
        inputArchivo.value = '';

        alert('Gif cargado temporalmente.');
        
       
    })
    .catch(error => {
        console.error('Error al cargar el documento:', error.message);
        alert('Error al cargar el documento.');
    });
}


// ActualizarTabla.js

function actualizarTabla() {
    console.log("actualizando?");
    var tabla = document.getElementById('gifs');
    // Realizar solicitud AJAX al script PHP
    fetch('listarArchivos.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al obtener la lista de archivos: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Limpiar la tabla
            var cuerpoTabla = tabla.getElementsByTagName('tbody')[0];
            console.log("bbb");
            console.log(tabla);
            console.log(cuerpoTabla);
            if (cuerpoTabla) {
                console.log("vvv");
                while (cuerpoTabla.rows.length > 0) {
                    cuerpoTabla.deleteRow(0);
                }
            }
            // Crear filas de la tabla con los datos obtenidos
            data.forEach(archivo => {
                console.log("xxsdd");
                agregarFilaTabla(archivo.ruta, archivo.nombre);
            });
            //agregarFooter();
        })
        .catch(error => console.error('Error al obtener la lista de archivos:', error));
}

function agregarFooter(){
    var tabla = document.getElementById('gifs');

    // Crear el elemento tfoot
    var tfoot = document.createElement('tfoot');

    // Crear una fila y celdas para el tfoot
    var fila = tfoot.insertRow();
    var celda1 = fila.insertCell(0);
    var celda2 = fila.insertCell(1);
    var celda3 = fila.insertCell(2);

    // Llenar las celdas del tfoot (puedes ajustar según tus necesidades)
    celda1.innerHTML = 'Nombre del archivo';
    celda2.innerHTML = 'Significado';
    celda3.innerHTML = 'Eliminar';

    // Agregar el tfoot a la tabla
    tabla.appendChild(tfoot);
}

function agregarFilaTabla(nombreArchivo, significado) {
    console.log(nombreArchivo);
    console.log(significado);
    // Obtener la referencia de la tabla
    var tabla = document.getElementById('gifs').getElementsByTagName("tbody")[0];

    // Crear una nueva fila y celdas
    var fila = tabla.insertRow();
    var celdaNombreArchivo = fila.insertCell(0);
    var celdaSignificado = fila.insertCell(1);
    var celdaEliminar = fila.insertCell(2);

    // Llenar las celdas con la información del archivo
    celdaNombreArchivo.innerHTML = nombreArchivo;
    celdaSignificado.innerHTML = significado;

    // Agregar un botón de eliminar
    var botonEliminar = document.createElement('button');
    botonEliminar.innerText = 'Eliminar';
    botonEliminar.classList.add('btn');
    botonEliminar.onclick = function () {
        // Lógica para eliminar el archivo, puedes llamar a una función aquí
        // que maneje la eliminación y actualización de la tabla
        console.log('Eliminar archivo:', nombreArchivo);
        // Ejemplo de cómo podrías eliminar la fila de la tabla
        tabla.deleteRow(fila.rowIndex);
    };

    // Agregar el botón de eliminar a la celda correspondiente
    celdaEliminar.appendChild(botonEliminar);
    verificarNumeroFilas();
}

function verificarNumeroFilas() {
    var tabla = document.getElementById('gifs');
    var tbody = tabla.getElementsByTagName('tbody')[0];
    var numeroFilas = tbody.rows.length;

    // Obtener una referencia al botón "Seguir"
    var botonSeguir = document.getElementById('botonSeguir');

    // Habilitar el botón si hay al menos 5 filas
    if (numeroFilas >= 7) {
        botonSeguir.disabled = false;
    } else {
        botonSeguir.disabled = true;
    }
}

// Llamar a la función para la carga inicial
actualizarTabla();


window.addEventListener('popstate', function(event) {
    // Mostrar el menú de confirmación cuando se detecta un cambio en el historial
    mostrarMenuConfirmacion();
});

// Agregar una entrada en el historial para que se pueda detectar el primer cambio
history.pushState({}, '');