<?php

class Graphics_SILLA {

    private $cantidadSillasFila = 20;
    private $cantidadSillas;
    //para efectos practicos se asume un valor 
    private $porcentajeSillasPreferencial = 0.1;
    private $cantidaSillasPreferencial;

    function Graphics_SILLA($cantidadSillas) {
        $this->cantidadSillas = $cantidadSillas;
        $this->cantidaSillasPreferencial = $this->cantidadSillas * $this->porcentajeSillasPreferencial;
    }

    function pintar($id, $namePelicula, $valorPelicula, $genero, $fecha, $hora) {
        include_once '../Controlador/Controlador-Negocio/Ctlr_MODELO.php';
        $ctlModelo = new Ctlr_MODELO();
        $cantidadSillasPrefencial = 0;
        $cantidadSillasGeneral = 0;
        $cantidadFila = 1;
        $cantidadColumna = 1;
        $cp = $ctlModelo->getCantidad($id,"PREFERENCIAL");
        $cg = $ctlModelo->getCantidad($id,"GENERAL");
        $costoPreferencial = $this->costoTotal("PREFERENCIAL", $cp, $valorPelicula);
        $costoGeneral = $this->costoTotal("GENERAL", $cg, $valorPelicula);
        $text = "<center><table><tr><h2>PELICULA:$namePelicula<br></h1></td></tr>
       <tr> <td>Costo de Boleta: <h2>$valorPelicula</h1></td>
        <td>Total Costos Recaudados: </td>
        <td>PREFERENCIAL:<h2>COP$ $costoPreferencial</H2></td>
        <td>GENERAL:<h2>COP$ $costoGeneral</H2></td>
        </tr>
        
        
        <tr> <td>Sala de Cine : <h2>$genero</h1></td>
        <td>Total de Asistentes: </td>
        <td>PREFERENCIAL:<h2>$cp</H2></td>
        <td>GENERAL:<h2>$cg</H2></td>
        </tr>
        
       <tr> <td> Fecha y hora : $fecha-$hora.horas</td></tr>
           </table><center><table>
            <tr>
            <td>
            *sillas que no tengan el boton B2b  , estan compradas
            </td>
            
            </tr>
         <tr>
            <td>
            **Al oprimir en el botón B2b , es decir que le intereza dicho boleto , el sistema le notificará la información básica ,en la seccion de Compra
            </td>
            
            </tr>
            </table></center><center><HR><table>
        <tr>";
        for ($i = 1; $i <= $this->cantidadSillas; $i++) {
            if ($cantidadFila - 1 == $this->cantidadSillasFila) {
                $text .= "</tr><tr>";
                $cantidadFila = 1;
                $cantidadColumna++;
            }




            if ($cantidadSillasPrefencial < $this->cantidaSillasPreferencial) {
                $text .="<td>" . $this->getImagenSilla("PREFERENCIAL", $this->changeFila($cantidadColumna), $cantidadFila, $id) . "<br><h3>" . $this->changeFila($cantidadColumna) . "" . $cantidadFila . "</td>";
                $cantidadSillasPrefencial++;
            } else {
                $text .="<td>" . $this->getImagenSilla("GENERAL", $this->changeFila($cantidadColumna), $cantidadFila, $id) . "<br><h3>" . $this->changeFila($cantidadColumna) . "" . $cantidadFila . "</td>";
            }
            $cantidadFila++;
        }

        $text .= "</tr></table><HR><h1>PANTALLA</H1>";

        return $text;
    }
    function costoTotal($tipo,$cantidad,$costo)
    {
        if($tipo == "PREFERENCIAL")
        {
            $costo = $costo + ($costo * 0.20);
            return $cantidad*$costo;
        }
        return $cantidad*$costo;
    }
    function changeFila($fila) {
        switch ($fila) {
            case 1: return "A";
                break;
            case 2: return "B";
                break;
            case 3: return "C";
                break;
            case 4: return "D";
                break;
            case 5: return "E";
                break;
            case 6: return "F";
                break;
            case 7: return "G";
                break;
            case 8: return "H";
                break;
            case 9: return "I";
                break;
            case 10: return "J";
                break;
            case 11: return "K";
                break;
            case 12: return "L";
                break;
        }
    }

    function getImagenSilla($tipo, $fila, $columna, $id) {
        $sizeWidth = 40;
        $sizeHeigth = 40;
        if ($this->verificadorSillasCompradas($fila, $columna,$id)) {
            $word = "B2b";
            $action = "comprarBoleta('$tipo','$fila','$columna','$id')";
            $action = "xajax_" . $action;
            $text = " <input type='submit' id='$id'  value='$word'  style='WIDTH: 40px; HEIGHT: 30px' onClick=$action >";
        } else {
            $text = "";
        }
        if ($tipo == "PREFERENCIAL") {
            return "$text<img src='Imagenes/SP.jpg' width=$sizeWidth height=$sizeHeigth /></a>";
        }
        return "$text<A href='#compraGeneral|' onClick='xajax_comprarBoleta('$tipo')'><img src='Imagenes/SG.jpg' width=$sizeWidth height=$sizeHeigth /></a>";
    }

    function verificadorSillasCompradas($fila, $columna,$id) {
        include_once '../Controlador/Controlador-Negocio/Ctlr_MODELO.php';
        $ctlModelo = new Ctlr_MODELO();
        if ($ctlModelo->existeSillaComprada($fila, $columna,$id)) {
            return false;
        }
        return true;
    }

}

?>
