const persona = {
    id: 0,
    nombres: '',
    apellidos: '',
    telefono: '',
    email: '',
    ciudad: '',
    pais: ''
}

//Funcion para recojer los datos del formulario de contacto y guardarlos en el localstorage
function processContactForm(e) {
 
    persona.nombres = document.forms["fcontact"]["fnames"].value;
    persona.apellidos = document.forms["fcontact"]["fsurname"].value;
    persona.telefono = document.forms["fcontact"]["fphone"].value;
    persona.email = document.forms["fcontact"]["femail"].value;
    persona.ciudad = document.forms["fcontact"]["fcity"].value;
    persona.pais = document.forms["fcontact"]["fcountry"].value;   
    if(persona.id <= 0){     
        //Crea un id unico para los contactos basado en la fecha del sistemas , toma la fecah y la convierte a milisegundos.
        persona.id = new Date().valueOf();
    }   
  //convierte un objeto a formato json (estructura de datos de clave valor)
    let personajson = JSON.stringify(persona);
    //guarda el objeto en formato json en el localstorage del navegador (la informacion del contacto)
    localStorage.setItem(persona.id,personajson);


    e.preventDefault();
    alert("Datos guardados con éxito");
    listarcontactos();  
  resetform();
 }
 function resetform(){
    document.forms["fcontact"].reset();
    persona.id = 0;
}



function listarcontactos() {
    let dinmicTable = "";
    //cabecera de la tabla
    dinmicTable += "<table class='table' ";
    dinmicTable += "<tr>";
    dinmicTable += "<th>ID</th>";
    dinmicTable += "<th>Nombres</th>";
    dinmicTable += "<th>Appelidos</th>";
    dinmicTable += "<th>Telefonos</th>";
    dinmicTable += "<th>Email</th>";
    dinmicTable += "<th>Acción</th>";
    dinmicTable += "</tr>";
    //filas con la informacion
    let personasGuardadas =[];
    //obtiene todos los contactos guardados en el localstorage para mostrarlo en la tabla
    personasGuardadas = allStorge();
    //por cada contacto se pinta un renglon o fila de a tabla cada vez que se llama a esta funcion
    for (let i = 0; i < personasGuardadas.length; i++) {
        dinmicTable += "<tr>";
        let personaobjecto = JSON.parse(personasGuardadas[i]);
        dinmicTable += "<td>";
        dinmicTable += personaobjecto.id;
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        dinmicTable += personaobjecto.nombres;
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        dinmicTable += personaobjecto.apellidos;
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        dinmicTable += personaobjecto.telefono;
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        dinmicTable += personaobjecto.email;
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        //la etiqueta a permite poner un enlace interno, en este caso adiional se envia el id del contacto como parametro en la url
        dinmicTable += '<a href="./detalles.html?id='+personaobjecto.id+'">Ver</a>';
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        dinmicTable += '<a href="javascript:editarContacto('+ personaobjecto.id+');">Editar</a>';
        dinmicTable += "</td>";
        dinmicTable += "<td>";
        dinmicTable += '<a href="javascript:eliminarContacto('+ personaobjecto.id+');">Eliminar</a>';
        dinmicTable += "</td>";
        dinmicTable += "</tr>";
        dinmicTable += "<tr>";
    }

    dinmicTable += "</table>";
    document.getElementById("tablecontact").innerHTML = dinmicTable;
}




//recupera todo lo que hay en el localstorage
function allStorge() {
    var values = [],
        keys = Object.keys(localStorage),
        i = keys.length;
    while (i--) {
        values.push(localStorage.getItem(keys[i]));
    }
    return values;
}

//Pinta en la vista de detalles la informacion del cotnacto seleccionado
function verDetalles(){
    let contactoId = obtenerOarametroUrl();
    let contacto = localStorage.getItem(contactoId);
   if(contacto.length > 0){
    let personaobjecto = JSON.parse(contacto);
    document.getElementById("onames").innerText = personaobjecto.nombres;
    document.getElementById("osurnames").innerText = personaobjecto.apellidos;
    document.getElementById("opnones").innerText = personaobjecto.telefono;
    document.getElementById("oemail").innerText = personaobjecto.email;
    document.getElementById("ociudad").innerText = personaobjecto.ciudad;
    document.getElementById("opais").innerText = personaobjecto.pais;

   }

}

//busca un contacto y lo pinta en el formulario para permitir modificarlo
function editarContacto(id){
    let contacto = localStorage.getItem(id);
    if(contacto.length > 0){
        let personaobjecto = JSON.parse(contacto);
        document.getElementById("fnames").value = personaobjecto.nombres;
        document.getElementById("fsurname").value = personaobjecto.apellidos;
        document.getElementById("fphone").value = personaobjecto.telefono;
        document.getElementById("femail").value = personaobjecto.email;
        document.getElementById("fcity").value = personaobjecto.ciudad;
        document.getElementById("fcountry").value = personaobjecto.pais;    
        persona.id = id;
       }
       listarcontactos();
}

//elimina un contacto del localstorage 
function eliminarContacto(id){
    let contacto = localStorage.getItem(id);
    if(contacto.length > 0){
        localStorage.removeItem(id);
        alert("Contacto eliminado con éxito");
    }
    listarcontactos();
}

//Obtiene la url de una vista y obtiene el id que gfue enviado como parametro.
function obtenerOarametroUrl(){
    
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
