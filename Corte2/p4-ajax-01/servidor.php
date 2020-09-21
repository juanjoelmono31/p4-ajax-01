<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/estilos.css">
    <title>Document</title>
</head>
<body>


    <h3 class="titulo">
        Listado de busqueda
    </h3>

   
   <?php
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbn = 'trabajo_final';
        
        //$conn = mysqli_connect($host, $user, $pass, $dbn);
        $conn = new PDO("mysql:host=$host;dbname=$dbn",$user,$pass);
        
        if(mysqli_connect_errno()){
            //echo "Error al conctar a la base de datos";
            $statusConn = false;
        }else {
            //echo "Esta conectada";
            $statusConn = true;
        }

        if($_GET['busqueda'] === "OR"){
            $nombre = $_GET['nombre_usuario'];
            $correo = $_GET['correo'];
            $contrasena = $_GET['contrasena'];
            $listado = "SELECT * FROM usuario WHERE (nombre_usuario LIKE '%$nombre%') OR (correo LIKE '%$correo%') OR (contraseña LIKE '%$contrasena%' ) " ;
        }
        elseif($_GET['busqueda'] === "AND"){

            $nombre = $_GET['nombre_usuario'];
            $correo = $_GET['correo'];
            $contrasena = $_GET['contrasena'];
            $listado = "SELECT * FROM usuario WHERE (nombre_usuario LIKE '%$nombre%') AND (correo LIKE '%$correo%') AND (contraseña LIKE '%$contrasena%' ) " ;

        }
        else{
            $listado = "SELECT * FROM usuario " ;
        }

        

        $x = $conn -> prepare($listado);
        $result = $x->execute();
        $resultado = $x->fetchAll();

        //print_r($resultado);
        foreach($resultado as $usuario){ ?>

        <ul>
            <li>
            id:
                <?php
                    echo($usuario['id_usuario']);
                    
                ?>
            </li>
            <li>
            Nombre de usuario:
                <?php
                    echo($usuario['nombre_usuario']);
                    
                ?>
            </li>
            <li>
            Correo:
                <?php
                    echo($usuario['correo']);
                    
                ?>
            </li>
            <li>
            Contraseña:
                <?php
                    echo($usuario['contraseña']);
                    
                ?>
            </li>
        </ul>

            
        <?php }

    ?>


</body>
</html>