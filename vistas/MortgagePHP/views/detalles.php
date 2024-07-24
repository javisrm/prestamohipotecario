<?php

// Se comprueba que si venga el id del registro como parametro antes de proceder
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
   // desde este archivo se va a acceder a base de datos es necesario incluir la conenfiguracion y conexion a base de datos
    require_once "configuracion.php";    

// Se contruye la sentencia esql en una variable
    $sql = "SELECT * FROM contactos WHERE id = ?";
    //se prepara la sentencia sql
   if($stmt = $pdo -> prepare($sql)){ 
        // se entrega el id copmo parametro
        $param_id = trim($_GET["id"]);
 // Se ejecuta la sentencia para obtener los varoles, si el resultado es true, se contruye la tabla y se pintan los varores
         if($stmt ->execute([$param_id])){ 
             //si el resultado es exitoso se compreuba que si obtengamso registros
            if($stmt ->rowCount() == 1){
                //dado que se obendria solo un registro porque se busca por ID, no es necesario hacer un siclo, el fet devuelve un array asociativo
                $row = $stmt -> fetch();
                // se recuperan los valores en cada variable
                $nombres = $row["nombres"];
                $apellidos = $row["apellidos"];
                $telefonos = $row["telefono"];
                $ciudad = $row["ciudad"];
                $email = $row["email"];
                $pais = $row["pais"];
            } else{
                // si no se encuentra un registro se redirige a la vista de error
                header("location: error.php");
                exit();
            }  
        } else{
            echo "Lo siento! Se ha presentado un error.";
        }
    }
   // cerrrar la variable stmt
    unset($stmt);
    // cerrar la conexion a la base de datos
    unset($mysqli);
} else{
       // si no viene el id se redirige a la vista de error
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Bootstrap CSS -->
       <link href="../css/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
       <!-- JavaScript Bootstrap -->
       <script src="../css/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
   
           <!-- incluye el fichero JavaScript con la programación -->
    <title>Detalles del contacto</title>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Detalles del registro</h1>
                    <div class="form-group">
                        <label  for="onames">Nombres</label>
                        <p id="onames" class="fw-bold"><?php echo $row["nombres"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="osurnames">Apellidos</label>
                        <p id="osurnames" class="fw-bold"><?php echo $row["apellidos"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Telefonos</label>
                        <p id="opnones" class="fw-bold"><?php echo $row["telefono"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p id="oemail" class="fw-bold"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Ciudad</label>
                        <p id="ociudad" class="fw-bold"><?php echo $row["ciudad"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Pais</label>
                        <p id="opais" class="fw-bold"><?php echo $row["pais"]; ?></p>
                    </div>
                    <p><a href="./contact.php" class="btn btn-primary">Regresar</a></p>
                </div>
            </div>        
        </div>
    </div>  
</body>
</html>