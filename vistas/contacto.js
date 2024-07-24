//se crea el objeto persona
const persona={
    id: 0,
    nombre: '',
    apellido: '',
    Telefono: '',
    correo: '',
    ciudad: '',
    pais: ''
}

// se asigna lo q entra por el formulario al objeto persona
function enviarDatos(e){  
    persona.nombre= document.forms['fcontacto']['fnombre'].value        
    persona.apellido = document.forms['fcontacto']['fapellido'].value
    persona.Telefono = document.forms['fcontacto']['fntelefono'].value
    persona.correo = document.forms['fcontacto']['fcorreo'].value
    persona.pais = document.forms['fcontacto']['fpais'].value
    persona.ciudad = document.forms['fcontacto']['fciudad'].value
    if(persona.id <= 0){     
        //Crea un id unico para los contactos basado en la fecha del sistemas , toma la fecah y la convierte a milisegundos.
        persona.id = new Date().valueOf();
    }   

    // se convierte el objeto en un json objeto
    let personaJson= JSON.stringify(persona)

    localStorage.setItem(persona.id,personaJson)
    
    // guardo el json en el array
    //personaArray.push(personaJson)
   
  
    e.preventDefault();
    alert("Datos guardados con éxito");
    listarContactos();  
    limpiarFormularioform();
    
}
function limpiarFormularioform(){
    document.forms["fcontacto"].reset();
    persona.id = 0;
}

// pintar tabla de contactos en el formulario
function listarContactos(){
 let tablaDinamica= "";
//cabecera de al tabla
 tablaDinamica+= "<table class='table table-striped table-hover'>";
 tablaDinamica+= "<tr>";
 tablaDinamica+= "<th>ID</th>";
 tablaDinamica+= "<th>Nombre</th>";
 tablaDinamica+= "<th>Apellido</th>";
 tablaDinamica+= "<th>Telefono</th>";
 tablaDinamica+= "<th>Correo</th>";
 tablaDinamica+= "<th>Pais</th>";
 tablaDinamica+= "<th>Ciudad</th>";
 tablaDinamica+= "<th>Accion</th>";

 tablaDinamica+= "</tr>"; 
 //filas con la informacios de contactos 
 let personasGuardadas=[];
 personasGuardadas = todoStoras();
for (let i = 0; i < personasGuardadas.length; i++) {
    tablaDinamica+= "<tr>";
    let personaObjeto= JSON.parse(personasGuardadas[i]);
    tablaDinamica+= "<td>";
    tablaDinamica+=personaObjeto.id ;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    tablaDinamica+=personaObjeto.nombre ;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    tablaDinamica+= personaObjeto.apellido;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    tablaDinamica+= personaObjeto.Telefono;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    tablaDinamica+= personaObjeto.correo;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    tablaDinamica+= personaObjeto.pais;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    tablaDinamica+= personaObjeto.ciudad;
    tablaDinamica+= "</td>";
    tablaDinamica+= "<td>";
    // tablaDinamica+= '<a href="./detalles.html?id=' + personaObjeto.id + '"> Ver </a>'+' ';
   
    // tablaDinamica+= '<a href="javascript:editarContacto('+personaObjeto.id+');">Editar</a>'+' ';
    tablaDinamica+= '<a href="./detalles.html?id=' + personaObjeto.id + '"> Ver</a>'+' ';
    tablaDinamica+= '<a href="javascript:editarContacto('+personaObjeto.id+');">Editar</a>'+' ';
    tablaDinamica+= '<a href="javascript:eliminarContacto('+personaObjeto.id+');">Eliminar</a>';
    tablaDinamica+= "</td>";    
    tablaDinamica+= " </tr>";
    tablaDinamica+= "<tr>";
}
tablaDinamica+= "</table>";
 document.getElementById('tablaContacto').innerHTML=tablaDinamica
 
}
//recupera todo lo que hay en el localstorage 
function todoStoras(){
    var values =[],
    keys= Object.keys(localStorage),
    i=keys.length;
while(i--){
    values.push(localStorage.getItem(keys[i]))
}
    return values;
} 

//Pinta en la vista de detalles la informacion del cotnacto seleccionado
function verDetalles(){
    let contactoId = obteneParametroUrl();
    let contacto = localStorage.getItem(contactoId);
   if(contacto.length > 0){
    let personaObjeto = JSON.parse(contacto);
    document.getElementById("onombre").innerText = personaObjeto.nombre;
    document.getElementById("oapellido").innerText = personaObjeto.apellido;
    document.getElementById("ontelefono").innerText = personaObjeto.Telefono;
    document.getElementById("ocorreo").innerText = personaObjeto.correo;
    document.getElementById("ociudad").innerText = personaObjeto.ciudad;
    document.getElementById("opais").innerText = personaObjeto.pais;

   }

}

//busca un contacto y lo pinta en el formulario para permitir modificarlo
function editarContacto(id){
    let contacto = localStorage.getItem(id);
    if(contacto.length > 0){
        let personaObjeto = JSON.parse(contacto);
        document.getElementById("fnombre").value = personaObjeto.nombre;
        document.getElementById("fapellido").value = personaObjeto.apellido;
        document.getElementById("fntelefono").value = personaObjeto.Telefono;
        document.getElementById("fcorreo").value = personaObjeto.correo;
        document.getElementById("fciudad").value = personaObjeto.ciudad;
        document.getElementById("fpais").value = personaObjeto.pais;    
        persona.id = id;
       }
       listarContactos();
}

//elimina un contacto del localstorage 
function eliminarContacto(id){
    let contacto = localStorage.getItem(id);
    if(contacto.length > 0){
        localStorage.removeItem(id);
        alert("Contacto eliminado con éxito");
    }
    listarContactos();
}

function obteneParametroUrl(){
    
    let url = window.location.href;
    let paramString = url.split('?')[1];
    let queryString = new URLSearchParams(paramString);
    let parameterID = 0;
    
    for (let pair of queryString.entries()) {
        console.log("Key is:" + pair[0]);
        console.log("Value is:" + pair[1]);
        parameterID = Number(pair[1]);
    }
    return parameterID;
}

/* 
function limpiarFormulario(){
    document.forms['fcontacto'].reset(); 
    
}*/