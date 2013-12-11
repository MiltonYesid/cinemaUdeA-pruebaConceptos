<?php
    function getConnection() {
        include 'DataBaseConfig.php';
        $connection = mysql_connect($Host,$UserName,$Password) 
        or die("Tricky Connection");
        mysql_select_db($DataBaseName,$connection) or
        die("Problemas en la seleccion de la base de datos");
        return $connection;
    }
    function close($connection){
        mysql_close($connection);
    }
    


?>
