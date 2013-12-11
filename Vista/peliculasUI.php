<?php

$listPeliculas = $ctlrModelo->getPeliculas();
echo "<table>";
for ($i = 0; $i < count($listPeliculas); $i++) {
    $sala = $ctlrModelo->getSala($listPeliculas[$i]->genero);
    $pelicula = $listPeliculas[$i];
    /* @var $pelicula  Pelicula */
    $id = $pelicula->id;
  //  $function = "xajax_visualizarCinema($costo,$capacidad,$nombre,$horaInicio,$fecha,$genero);";
    $funcion = elementButton(22, "@@@","visualizarCinema('$id')" , "comprar");
//$action = "<A  id='55' HREF='##$nombre' onClick = '$funcion'>";
    echo "<tr><td>$funcion" . $listPeliculas[$i]->nombre . "</a><td>";
    echo "<td>" . $listPeliculas[$i]->director . "<td>";
    echo "<td>" . $listPeliculas[$i]->fecha . "<td>";
    echo"<td>" . $listPeliculas[$i]->horaInicio . "<td>";
    echo "<td>" . $listPeliculas[$i]->genero . "<td></tr>";
}
echo "</table>";


   function elementButton($id,$url,$action,$word)
    {
        $action = "xajax_".$action;
            $text = " <input type='submit' id='$id'  value='$word'  style='WIDTH: 100px; HEIGHT: 30px' onClick=$action >";
        return $text;
    }
