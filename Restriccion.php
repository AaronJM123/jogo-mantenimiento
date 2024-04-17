<?php
if((!isset($_SESSION['email'])) and (!isset($_SESSION['fecha_login'])) 
and (!isset($_SESSION['username'])) and (!isset($_SESSION['id_sesion']))){
    echo '<h1 style="color: red;">"No puede acceder a esta pagina ya que no se a iniciado sesion";</h1>'; 
    exit();
} else{
    include 'conexion.php';
    try{
        $sql = "SELECT * FROM sesiones_iniciadas WHERE id = '".$_SESSION['id_sesion']."' AND email = '".$_SESSION['email']."' 
        AND fecha_login = '".$_SESSION['fecha_login']."'";
        $resultado = $pdo->query($sql);

        if (!($resultado->rowCount() > 0)) {
            echo '<h1 style="color: red;">"Se a logeado de una manera incorrecta o su sesion no se a 
            podido iniciar de la manera que deberia, vuelva a logearse e intentelo de nuevo";</h1>'; 
            exit();
        } 
    } catch(PDOException $e){
        echo '<h1 style="color: red;">"Error en la consulta con la base de datos, cierre sesion en 
        caso de que este iniciada y reinicie la pagina";</h1>';
        exit(); 
    }
}
?>