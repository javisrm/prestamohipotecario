<?php
include "create.php";
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
        <link rel="stylesheet" href="../css/mortgage.css">
    <title>Inmogestion</title>
</head>

<body class="bg-dark">
    <h1 class="card-title mb-3 text-primary p-2">Inmogestión SA</h1>

    <!--Definir el contenedor con 5p de espacio en el margen superior-->
    <div class="container p-2">
        <!--Definir un componente card para ubicar todo el formulario-->
        <div class="card mx-3 mt-n5 shadow-lg"
            style="border-radius: 10px; border-left:8px #007bff solid; border-right: none; border-top:none; border-bottom:none">
            <!--Definir un componente card para ubicar el cuerpo del formulario-->
            <div class="card-body">
                <!--Definir titulo del formulario-->
                <h4 class="card-title mb-3 text-primary text-uppercase">Formulario de contacto</h4>
                <!--Definir el formulario-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="fcontact"  method="post">
                    <!--Definir semento con la clase fila-->
                    <div class="row">
                        <!--Definir semento con la clase columna-->
                        <div class="col">
                            <label for="fnames">Nombres</label>
                            <input class="form-control" type="text" name="fnames" id="fnames" value="<?php echo $nombres ?>">
                        </div>
                        <div class="col">

                            <label for="fsurname">Apellidos</label>
                            <input class="form-control" type="text" name="fsurname" id="fsurname" value="<?php echo $apellidos ?>">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="fphone">Númeo de teléfono</label>
                            <input class="form-control" type="text" name="fphone" id="fphone"  value="<?php echo $telefono ?>">
                        </div>
                        <div class="col">
                            <label for="femail">Email</label>
                            <input class="form-control" type="text" name="femail" id="femail"  value="<?php echo $email ?>" >
                        </div>
                        <div class="col">
                            <label for="fcity">Ciudad</label>
                            <input class="form-control" type="text" name="fcity" id="fcity"  value="<?php echo $ciudad ?>">
                        </div>
                        <div class="col">
                            <label for="fcountry">País</label>
                            <input class="form-control" type="text" name="fcountry" id="fcountry"  value="<?php echo $pais ?>">
                        </div>
                    </div>
                    <br>
                    <button class="btn-primary" style="border-radius:0px" type="submit">Guardar</button>                   
                </form>
                      <br />
                <button class="btn-primary" style="border-radius:0px" type="submit"
                    onclick="window.location.href='../index.html'">Atras</button>
                      </div>
            <div id="tablecontact" class="tableFixHead">
                <?php
                require_once "read.php";
                ?>
            </div>
        </div>
    </div>    
</body>

</html>