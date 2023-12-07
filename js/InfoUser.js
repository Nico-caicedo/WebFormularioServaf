// seccion para vista evaluados


ContainerInfo = document.getElementById("ContainerCardInfo");
Active = document.getElementsByClassName("user_line");
cardInfo = document.getElementById("CardInfo");



function CerrarV() {
  ContainerInfo.style.display = "none";
  CardInfo.style.display = "none";
}

var IdEva;
var infoUser;
function AbrirVentanaV(element) {
  var ContainerEvas = document.getElementsByClassName("Evas_container")[0];
  var info = document.getElementsByClassName("UserInfo")[0];
  infoUser = element.getAttribute("data-infoUser");
  IdEva = element.getAttribute("data-eva");
  console.log(infoUser);
  ContainerInfo.style.display = "flex";
  CardInfo.style.display = "flex";

  var requestBody =
    "infoUser=" +
    encodeURIComponent(infoUser) +
    "&IdEva=" +
    encodeURIComponent(IdEva);

  fetch("./php/evasUser.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: requestBody,
  })
    .then((response) => response.json())
    .then((data) => {
      // Insertar la respuesta en el contenedor EVAS_CONTAINER
      ContainerEvas.innerHTML = data.containerContent;
      info.innerHTML = data.userInfo;
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
    });
}




function OpenPdf(IdEvas) {
  
  // Crear un objeto FormData para enviar datos mediante POST
  

  var url =
    "./php/ReportePdf.php?IdEva=" +
    encodeURIComponent(IdEvas) +
    "&infoUser=" +
    encodeURIComponent(IdEva);

  // Abrir la nueva pestaña con la URL que incluye los parámetros
  window.open(url, "_blank");
}


function DownloadPdf(IdEvas) {
  
  // Crear un objeto FormData para enviar datos mediante POST
  

  var url =
    "./php/DownloadPdf.php?IdEva=" +
    encodeURIComponent(IdEvas) +
    "&infoUser=" +
    encodeURIComponent(IdEva);

  // Abrir la nueva pestaña con la URL que incluye los parámetros
 
window.location.href = url;
}



// funciones para abrir la ventana de evaluacion en la sección de


var catalyst = document.getElementById('add')
var addUser = document.getElementById('addUser')

Containershow = document.getElementById("Containershow");
Active = document.getElementsByClassName("show");
showInfo = document.getElementById("ShowInfo");



function CerrarS() {
  Containershow.style.display = "none";
  showInfo.style.display = "none";
  addUser.style.display = 'none';
}

// 
function AbrirVentanaS(element) {
  var ContainerEvas = document.getElementsByClassName("Evas_container")[1];
  var info = document.getElementsByClassName("UserInfo")[1];
  infoUser = element.getAttribute("data-infoUser");
  IdEva = element.getAttribute("data-eva");
  console.log(infoUser);
  Containershow.style.display = "flex";
  showInfo.style.display = "flex";

  var requestBody =
    "infoUser=" +
    encodeURIComponent(infoUser) +
    "&IdEva=" +
    encodeURIComponent(IdEva);

  fetch("./php/evasUser.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: requestBody,
  })
    .then((response) => response.json())
    .then((data) => {
      // Insertar la respuesta en el contenedor EVAS_CONTAINER
      ContainerEvas.innerHTML = data.containerContent;
      info.innerHTML = data.userInfo;
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
    });
}



// configrucacion para agregar usuario





catalyst.addEventListener('click', () => {
  Containershow.style.display = "flex";
  addUser.style.display = 'flex';


})




   $(document).ready(function () {
      // Manejar el evento de entrada en el campo de búsqueda
      $('#searchInput').on('input', function () {
         // Obtener el valor del campo de búsqueda
         var searchTerm = $(this).val();

         // Realizar la solicitud AJAX al servidor
         $.ajax({
            url: './php/buscarUsuarios.php',
            method: 'POST',
            data: { searchTerm: searchTerm },
            success: function (data) {
               // Limpiar el contenedor antes de agregar nuevos resultados
               $('#Users').empty();

               // Mostrar los resultados en el contenedor
               $('#Users').html(data);
            }
         });
      });
   });

