<?php

class DAO_Modelo {

    function getBoleta($fila, $columna, $id) {
        include_once 'Connections/Connection.php';
        include_once '../Modelo/Boleta.php';
        /* @var $boleta Boleta */
        $connection = getConnection();
        $SQL = "select * FROM boleta WHERE Pelicula_id=" . $id . " AND Fila='" . $fila . "' AND Columna=" . $columna;
        $registros = mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
        if ($reg = mysql_fetch_array($registros)) {
            return true;
        }
        return false;
    }

    function getCantidadAsistentes($id, $tipo) {
        include_once 'Connections/Connection.php';
        include_once '../Modelo/Boleta.php';
        /* @var $boleta Boleta */
        $connection = getConnection();
        $SQL = "SELECT DISTINCT  * FROM boleta WHERE Pelicula_id=" . $id . " AND Tipo='" . $tipo . "'";
        $cantidad = 0;
        $registros = mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
        while ($reg = mysql_fetch_array($registros)) {
            $cantidad++;
        }
        return $cantidad;
    }

    function getCostos() {
        include_once 'Connections/Connection.php';
        $connection = getConnection();
        $SQL = "SELECT DISTINCT SUM( Valor ) AS total, Pelicula_Sala_Genero
FROM boleta
GROUP BY Pelicula_Sala_Genero";
        $registros = mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
        $text = "<CENTER>INGRESOS POR SALAS(DATOS ACTUALES)<table><CENTER>";
        while ($reg = mysql_fetch_array($registros)) {
           $text .= "<tr><td>";
            $text .= $reg['Pelicula_Sala_Genero']."</td><td><h2>";
            $text .= $reg['total'];
            $text .= "</h2></td></tr>";
        }
        $text .= "</table></CENTER>";
        return $text;
    }

    function comprarBoleta($boleta) {
        include_once 'Connections/Connection.php';
        include_once '../Modelo/Boleta.php';
        /* @var $boleta Boleta */
        $connection = getConnection();
        $SQL = "INSERT INTO `boleta`
            (`Fila`,
            `Columna`,
            `Silla`,
            `Valor`, 
            `Tipo`, 
            `Pelicula_Nombre`,
            `Pelicula_Hora_Inicio`,
            `Pelicula_Hora_salida`,
            `Pelicula_Fecha`,
            `Pelicula_Id`,
            `Pelicula_Sala_Genero`,
            `Nmbre_Cliente`)
            VALUES (
            '$boleta->fila',
            '$boleta->columna',
            '$boleta->nroSilla',
            '$boleta->valor',
            '$boleta->tipo',
            '$boleta->peliculaNombre',
            '$boleta->peliculaHoraInicio',
            '$boleta->peliculaHoraSalida',
            '$boleta->peliculaFecha',
            '$boleta->idPelicula',
            '$boleta->genero',
            'MILTON YESID FERNANDEZ')";
        mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
    }

    function getPeliculas() {
        include_once 'Connections/Connection.php';
        include_once '../Modelo/Pelicula.php';
        $connection = getConnection();
        $SQL = "select * FROM Pelicula";
        $registros = mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
        $peliculas = array();
        while ($reg = mysql_fetch_array($registros)) {
            $pelicula = new Pelicula();
            $pelicula->nombre = $reg['Nombre'];
            $pelicula->director = $reg['Director'];
            $pelicula->horaInicio = $reg['Hora_Inicio'];
            $pelicula->horaSalida = $reg['Hora_salida'];
            $pelicula->fecha = $reg['Fecha'];
            $pelicula->genero = $reg['Sala_Genero'];
            $pelicula->id = $reg['Id'];
            $peliculas[] = $pelicula;
        }
        close($connection);
        return $peliculas;
    }

    function getPelicula($id) {
        include_once 'Connections/Connection.php';
        include_once '../Modelo/Pelicula.php';
        $connection = getConnection();
        $SQL = "select * FROM Pelicula WHERE Id =" . $id;
        $registros = mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
        $pelicula = new Pelicula();
        if ($reg = mysql_fetch_array($registros)) {
            $pelicula->nombre = $reg['Nombre'];
            $pelicula->director = $reg['Director'];
            $pelicula->horaInicio = $reg['Hora_Inicio'];
            $pelicula->horaSalida = $reg['Hora_salida'];
            $pelicula->fecha = $reg['Fecha'];
            $pelicula->genero = $reg['Sala_Genero'];
            $pelicula->id = $reg['Id'];
        }
        close($connection);
        return $pelicula;
    }

    function getSala($genero) {
        include_once 'Connections/Connection.php';
        include_once '../Modelo/Sala.php';
        $connection = getConnection();
        $SQL = "select * FROM Sala WHERE Genero ='" . $genero . "'";
        $registros = mysql_query($SQL, $connection) or die("Problemas en el select" . mysql_error());
        $sala = new Sala();
        if ($reg = mysql_fetch_array($registros)) {
            $sala->setCapacidad($reg['Capacidad']);
            $sala->setCosto($reg['Costo_Boleta']);
            $sala->setGenero($genero);
        }
        close($connection);
        return $sala;
    }

}