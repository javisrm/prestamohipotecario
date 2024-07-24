<?php
$id = 0;
$nombres = '';
$apellidos = '';
$telefono = '';
$email = '';
$ciudad = '';
$pais = '';

//En este bloque if se valida si se esta modificando o eliminando un cotnacto.
//la vairable $_SESSION es una super variable que esta disponible para todos los scrips
//inicia la variable session $_SESSION
session_start();
// row es la clave del objeto que se ha guardado en la super variable $_SESSION cuando se selecciona editar el registro
if (isset($_SESSION) && !empty($_SESSION)) {
    $id = $_SESSION["row"]["id"];
    $nombres =  $_SESSION["row"]["nombres"];
    $apellidos =   $_SESSION["row"]["apellidos"];
    $telefono =  $_SESSION["row"]["telefono"];
    $ciudad =   $_SESSION["row"]["ciudad"];
    $email =    $_SESSION["row"]["email"];
    $pais =    $_SESSION["row"]["pais"];
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["id"])  ) {
    $id = $_GET["id"];
   readForUpdate($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    processContactForm();
}

function processContactForm()
{
    require_once "configuracion.php";
    $nombres = $_POST["fnames"];
    $apellidos = $_POST["fsurname"];
    $telefono = $_POST["fphone"];
    $email =  $_POST["femail"];
    $ciudad = $_POST["fcity"];
    $pais = $_POST["fcountry"];

    session_start();
    $id = $_SESSION["row"]["id"];

    if(!empty($id)){
      $sql = "UPDATE contactos SET nombres = :nombres, apellidos = :apellidos, telefono =:tlefonos,  email = :email ,ciudad = :ciudadparm ,pais=:pais  WHERE id = :idpar";
      if ($stmt = $pdo->prepare($sql)) {
        $stmt -> bindParam("nombres",  $nombres);
        $stmt -> bindParam("apellidos",  $apellidos);
        $stmt -> bindParam("tlefonos",  $telefono);
        $stmt -> bindParam("email",  $email);
        $stmt -> bindParam("ciudadparm",  $ciudad);
        $stmt -> bindParam("pais",  $pais);
        $stmt -> bindParam("idpar",  $id);
        if ($stmt->execute()) {
            // Si se ha guardado con exito se redirige a la pagina de contacto
            header("location: contact.php");
            limpiarFormulario();
            exit();          
        } else {
            echo "Lo siento! Se ha presentado un error.";
        }
      }
    
    }else{

    $sql = "INSERT INTO contactos (nombres, apellidos, telefono, email,ciudad,pais) VALUES (?,?,?,?,?,?)";
    //Para acceder a la base de datos siempre se usa la viable $pdo que esta definida en el archivo config.php
    //con  el api $pdo necesitamos definir un objeto $stmt para ejecutar los comandos
    if ($stmt = $pdo->prepare($sql)) {
        // Se ejecuta la sentencia sql que devolvera falso o verdadero para indicar exito o error
        if ($stmt->execute([$nombres, $apellidos, $telefono, $email, $ciudad, $pais])) {
            // Si se ha guardado con exito se redirige a la pagina de contacto
            header("location: contact.php");
            limpiarFormulario();
            exit();           
        } else {
            echo "Lo siento! Se ha presentado un error.";
        }
    }
}
    // cerrrar la variable stmt
    unset($stmt);
    // cerrar la conexion a la base de datos
    unset($pdo);
}


//Esta funcion consulta en la base de datos $la informacion de los contactos.
function readForUpdate($id)
{
    //Estamos usando la variable session para almacenar los valores que recupera es necesario limpiarla antes de ir a busar datos.
    // desde este archivo se va a acceder a base de datos es necesario incluir la conenfiguracion y conexion a base de datos
    require_once "configuracion.php";
    // Se contruye la sentencia esql en una variable
    $sql = "SELECT * FROM contactos WHERE id = :id";
    //se prepara la sentencia sql
    if ($stmt = $pdo->prepare($sql)) {
        // Se ejecuta la sentencia para obtener los varoles, si el resultado es true, se contruye la tabla y se pintan los varores
        if ($stmt->execute([$id])) {
            if ($stmt->rowCount() == 1) {
                //si el resultado es exitoso se compreuba que si obtengamso registros
                $row = $stmt->fetch();
                //dado que se obendria solo un registro porque se busca por ID, no es necesario hacer un siclo, el fech devuelve un array asociativo
                //se guardan los valores en la super variabel global  $_SESSION para ser accedidos desde el bloque superior que los asigna a las variabels individuales
                $_SESSION["row"] = $row;
                // Si la consulta es exitosa se redirige a la vista de contacto
                header("location: contact.php");
                // cerrrar la variable stmt
                unset($stmt);
                exit();
            } else {
                // si no viene el id se redirige a la vista de error
                header("location: error.php");
                exit();
            }
        } else {
            echo "Lo siento! Se ha presentado un error.";
        }
    }
    // cerrar la conexion a la base de datos
    unset($pdo);
}

function limpiarformulario(){
    unset($_SESSION["row"]);
    $id = 0;
$nombres = '';
$apellidos = '';
$telefono = '';
$email = '';
$ciudad = '';
$pais = '';
}
