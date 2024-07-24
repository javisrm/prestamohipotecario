<?php

require_once "configuracion.php";

$sql = "SELECT * FROM contactos";

if($resultado = $pdo -> query($sql)){
    if($resultado -> rowCount()){ 
    //cabecera de la tabla
    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombres</th>";
    echo "<th>Appelidos</th>";  
    echo "<th>Email</th>";
    echo "<th>Acción</th>";
    echo "</tr>";   
    //por cada contacto se pinta un renglon o fila de a tabla cada vez que se llama a esta funcion
    while ($row = $resultado -> fetch()) {
        echo "<tr>";    
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["nombres"]."</td>";
        echo "<td>".$row["apellidos"]."</td>";
        echo "<td>".$row["email"]."</td>";    
        echo "<td>";
        //la etiqueta a permite poner un enlace interno, en este caso adiional se envia el id del contacto como parametro en la url
        echo '<a href="./detalles.php?id='.$row["id"].'" class="p-2">Ver</a>';   
        echo '<a href="./create.php?id='.$row["id"].'" class="p-2">Modificar</a>'; 
        echo '<a href="./delete.php?id='.$row["id"].'" class="p-2">Eliminar</a>';

        echo "</td>";     
        echo "</tr>";
        echo "<tr>";
    }
    echo "</table>";
     // cerrar el resultado
     unset($resultado);
    }else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
}else{
    echo "Lo siento! Se ha presentado un error.";
}


?>