const cargarImagenInput = document.getElementById('imagenUsuario');
const iconoAdd = document.getElementById('iconadd');
const cargada = document.getElementById('imagen_cargadaadd');

cargarImagenInput.addEventListener('change', function() {
    if (cargarImagenInput.files.length > 0) {
        iconoAdd.style.display = 'none';
        cargada.style.display = 'block';
        const reader = new FileReader();
        reader.onload = function(e) {
            cargada.src = e.target.result;
        };
        reader.readAsDataURL(cargarImagenInput.files[0]);
    } else {
        iconoAdd.style.display = 'block';
        cargada.style.display = 'none';
    }
});

const cargarImagenI = document.getElementById('imagenAmbiente');
const iconoAddr = document.getElementById('iconaddA');
const cargadad = document.getElementById('imagen_cargadaaddA');

cargarImagenI.addEventListener('change', function () {
    if (cargarImagenI.files.length > 0) {
        iconoAddr.style.display = 'none';
        cargadad.style.display = 'block';
        const reader = new FileReader();
        reader.onload = function (e) {
            cargadad.src = e.target.result;
        };
        reader.readAsDataURL(cargarImagenI.files[0]);
    } else {
        iconoAddr.style.display = 'block';
        cargadad.style.display = 'none';
    }
});

const cargarImagenAngular = document.getElementById('imagenAngular');
const iconAngular = document.getElementById('iconaddAngular');
const cargarAngular = document.getElementById('imagenaddAngular');

cargarImagenAngular.addEventListener('change', function () {
    if (cargarImagenAngular.files.length > 0) {
        iconAngular.style.display = 'none';
        cargarAngular.style.display = 'block';
        const reader = new FileReader();
        reader.onload = function (e) {
            cargarAngular.src = e.target.result;
        };
        reader.readAsDataURL(cargarImagenAngular.files[0]);
    } else {
        iconAngular.style.display = 'block';
        cargarAngular.style.display = 'none';
    }
});