<?php

/* @var $xajax xajax */
$xajax = new xajax;
$compra;

function visualizarCinema($id) {
    $respuesta = new xajaxResponse;
    /* @var $pelicula  Pelicula */
    /* @var $sala  Sala */
    /* @var $ctlrModelo Ctlr_MODELO */
    $ctlrModelo = new Ctlr_MODELO();
    $pelicula = $ctlrModelo->getPelicula($id);

    $sala = $ctlrModelo->getSala($pelicula->genero);
    $costo = $sala->getCosto();
    $capacidad = $sala->getCapacidad();
    $nombre = $pelicula->nombre;
    $horaInicio = $pelicula->horaInicio;
    $fecha = $pelicula->fecha;
    $genero = $sala->getGenero();
    include_once 'Graphics_SILLA.php';
    $graficador = new Graphics_SILLA($capacidad);
    $text = $graficador->pintar($id, $nombre, $costo, $genero, $fecha, $horaInicio);
    $respuesta->addAssign("sillas", "innerHTML", $text);

    return $respuesta;
}

function comprarBoleta($tipo, $fila, $columna, $id) {
    $respuesta = new xajaxResponse();
    /* @var $pelicula  Pelicula */
    /* @var $sala  Sala */
    /* @var $ctlrModelo Ctlr_MODELO */
    /* @var $boleto Boleta */
    include_once '../Modelo/Boleta.php';
    $ctlrModelo = new Ctlr_MODELO();
    $pelicula = $ctlrModelo->getPelicula($id);
    $sala = $ctlrModelo->getSala($pelicula->genero);
    $costo = $sala->getCosto();

    $capacidad = $sala->getCapacidad();
    $nombre = $pelicula->nombre;
    $horaInicio = $pelicula->horaInicio;
    $horaSalida = $pelicula->horaSalida;
    $fecha = $pelicula->fecha;
    $genero = $sala->getGenero();
    $text = "INFORMACION DE LA BOLETA-CINEMARELAX";
    $text .= "<h2>PELICULA:" . $nombre . "</h2>";
    $text .= "ASIENTO:PREFERENCIAL";
    $text .= "<h2>Sala:$genero</h2>    ";
    if ($tipo == "PREFERENCIAL") {
        $costo = $costo + ($costo * 0.2);
    }
    $text .= "<h2>Costo:" . $costo . "</h2>";
    $text .= "<h2>Ubicación:" . $fila . $columna . "</h2>";
    $text .= "fecha:" . $fecha . $horaInicio . "";
    $text .= "<br>Oprima AQUI para finalizar la COMPRA";
    $action = "xajax_efectuarCompra('$tipo','$fila','$columna','$id')";
    $text = '  <a href="#compra" onClick=' . $action . ' class="button scrolly">' . $text . "</a>";
    $text .= '<br><h2>ò</h2><br><a href="#cancelar" onClick="xajax_cancelarCompra()" class="button scrolly">Cancelar</a>';
setCostos();
    /* fin de construccion de boleto */
    $respuesta->addAssign("boleta", "innerHTML", $text);
    return $respuesta;
}

function efectuarCompra($tipo, $fila, $columna, $id) {
    $respuesta = new xajaxResponse;
    $respuesta->addAlert("Se ha efectuado con éxito la compra");
    $ctlrModelo = new Ctlr_MODELO();
    /* @var $pelicula  Pelicula */
    /* @var $sala  Sala */
    /* @var $ctlrModelo Ctlr_MODELO */
    /* @var $boleto Boleta */
    include_once '../Modelo/Boleta.php';
    $ctlrModelo = new Ctlr_MODELO();
    $pelicula = $ctlrModelo->getPelicula($id);
    $sala = $ctlrModelo->getSala($pelicula->genero);
    $costo = $sala->getCosto();
    $capacidad = $sala->getCapacidad();
    $nombre = $pelicula->nombre;
    $horaInicio = $pelicula->horaInicio;
    $horaSalida = $pelicula->horaSalida;
    $fecha = $pelicula->fecha;
    $genero = $sala->getGenero();
    /* CONSTRUYENDO EL POSIBLE BOLETO */
    $boleto = new Boleta();
    $boleto->columna = $columna;
    $boleto->fila = $fila;
    $boleto->idPelicula = $id;
    $boleto->peliculaFecha = $fecha;
    $boleto->peliculaHoraInicio = $horaInicio;
    $boleto->peliculaHoraSalida = $horaSalida;
    if ($tipo == "PREFERENCIAL") {
        $costo = $costo + ($costo * 0.2);
    }
    $boleto->valor = $costo;
    $boleto->tipo = $tipo;
    $boleto->nroSilla = rand();
    $boleto->genero = $genero;
    $boleto->peliculaNombre = $nombre;
    $ctlrModelo->ingresarBoleta($boleto);
    $respuesta->addAssign("boleta", "innerHTML", "");
    $respuesta = visualizarCinema($id);
    $respuesta->addAssign("boleta", "innerHTML", "");
    setCostos();
    return $respuesta;
}

function cancelarCompra() {
    $respuesta = new xajaxResponse;
    $respuesta->addAssign("boleta", "innerHTML", "");
    return $respuesta;
}

function setCostos() {
    $respuesta = new xajaxResponse;
    $ctlrModelo = new Ctlr_MODELO();
   $text = $ctlrModelo->getCostos();
    $respuesta->addAssign("costos", "innerHTML", $text);
    return $respuesta;
}

$xajax->registerFunction("visualizarCinema");
$xajax->registerFunction("comprarBoleta");
$xajax->registerFunction("efectuarCompra");
$xajax->registerFunction("cancelarCompra");
$xajax->registerFunction("setCostos");
$xajax->processRequests("utf-8");

