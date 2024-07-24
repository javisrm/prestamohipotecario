<?php
   if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["id"])  ) {
    $id = $_GET["id"];
    eliminarRegistro($id);
   }


function  eliminarRegistro($id){
    require_once "configuracion.php";
 $sql = "DELETE FROM contactos WHERE  id = :idpar";
 if($stmt= $pdo->prepare($sql)){
    $stmt -> bindParam("idpar",  $id);
    if ($stmt->execute()) {
        // Si se ha guardado con exito se redirige a la pagina de contacto
        header("location: contact.php");
       
        exit();          
    } else {
        echo "Lo siento! Se ha presentado un error.";
    }

 }else{
// si no viene el id se redirige a la vista de error
header("location: error.php");
exit();
 }
    //cerramos la sentencia
    unset($stmt);
        //cerramos laconexion a la base de datos 
        unset($pdo);
}
?>