 <?php
//cadena de conexion
mysql_connect("host","usuario","password");
// DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe
if ($busqueda<>''){
  //CUENTA EL NUMERO DE PALABRAS
  $trozos=explode(" ",$busqueda);
  $numero=count($trozos);
  if ($numero==1) {
    //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
    $cadbusca="SELECT  pokemon  FROM pokemones WHERE VISIBLE =1
      AND nombre LIKE  '%$busqueda%' LIKE  '%$busqueda%' LIMIT 50";
  } elseif ($numero>1) {
    //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
    //busqueda de frases con mas de una palabra y un algoritmo especializado
    $cadbusca="SELECT  pokemon ( pokemon )
      AGAINST (  '$busqueda' ) AS Score FROM pokemones WHERE
      MATCH ( nombre ) AGAINST (  '$busqueda' ) ORDER  BY Score DESC LIMIT 50";
  }
  $result=mysql("Diguda", $cadbusca);
  While($row=mysql_fetch_object($result))
  {
    //Mostramos los titulos de los articulos o lo que deseemos...
    $nombre=$row->nombre;
    
    echo $nombre."<br>";
  }
}
?>