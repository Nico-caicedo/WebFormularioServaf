// Desplegar menu al dar click 
const desplegarMenu = document.getElementById('desplegarMenu');
const cerrarMenu = document.getElementById('cerrarMenu');

desplegarMenu.addEventListener('click', ()=>{
    desplegarMenu.classList.add('animacionMenu');
    cerrarMenu.classList.add('animacionCerrar');
    document.getElementById('aside').classList.add('mostrarMenu')
})

cerrarMenu.addEventListener('click', ()=>{
    
    cerrarMenu.classList.remove('animacionCerrar');
    desplegarMenu.classList.remove('animacionMenu');
    document.getElementById('aside').classList.remove('mostrarMenu')
})


botones_del_aside = document.querySelectorAll('.botones');
botones_del_aside.forEach(boton =>{
    boton.addEventListener('click', ()=>{
        cerrarMenu.classList.remove('animacionCerrar');
        desplegarMenu.classList.remove('animacionMenu');
        document.getElementById('aside').classList.remove('mostrarMenu')
    })
}) 
    