<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sala
 *
 * @author Milton Yesid
 */
class Sala {
    //put your code here
    private $genero;
    private $capacidad;
    private $costo;
    function getGenero()
    {
    return $this->genero;
    }
    function setGenero($genero)
    {
        $this->genero = $genero;
    }
    function getCapacidad()
    {
        return $this->capacidad;
    }
    function setCapacidad($capa)
    {
        $this->capacidad = $capa;
    }
    function getCosto()
    {
        return $this->costo;
    }
    function setCosto($costo)
    {
        $this->costo = $costo;
    }
}

?>
