<?php

class Ctlr_MODELO {
    function getCostos()
    {
        include_once'../Datos/DAO_Modelo.php';
        $dao_modelo = new DAO_Modelo();
        return $dao_modelo->getCostos();
    }
    function getPeliculas() {
        include_once'../Datos/DAO_Modelo.php';
        include_once '../Modelo/Pelicula.php';
        $dao_modelo = new DAO_Modelo();
        return $dao_modelo->getPeliculas();
    }
    function existeSillaComprada($fila,$columna,$id)
    {
        include_once'../Datos/DAO_Modelo.php';
        $dao_modelo = new DAO_Modelo();
       
        return $dao_modelo->getBoleta($fila, $columna,$id);
    }
    function getCantidad($id, $tipo)
    {
        include_once'../Datos/DAO_Modelo.php';
        $dao_modelo = new DAO_Modelo();
        return $dao_modelo->getCantidadAsistentes($id, $tipo);
    }
    function ingresarBoleta($boleta)
    {
        /* @var $boleta Boleta*/
        /* @var $daoModelo DAO_modelo*/
        include_once'../Datos/DAO_Modelo.php';
        include_once'../Modelo/Boleta.php';
        $daoModelo = new DAO_Modelo();
        $daoModelo->comprarBoleta($boleta);
    }
    function getPelicula($id) {
        include_once'../Datos/DAO_Modelo.php';
        include_once '../Modelo/Pelicula.php';
        $dao_modelo = new DAO_Modelo();
        return $dao_modelo->getPelicula($id);
    }

    function getSala($genero) {
        include_once'../Datos/DAO_Modelo.php';
        include_once '../Modelo/Sala.php';
        $dao_modelo = new DAO_Modelo();
        return $dao_modelo->getSala($genero);
    }

}

?>
