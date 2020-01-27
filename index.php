<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
require_once "conector.php";
include "SimpleXLSX.php";
echo '<h1>Tiobe Index August 2019</h1><pre>';
$idexcel=10;
if ( $xlsx = SimpleXLSX::parse('Libro1.xlsx') ) {
  echo '<table><tbody>';
  $i = 0;
  $aux=[];
  foreach ($xlsx->rows() as $elt) {
      $ln=count($elt);
    //   echo "ln: ".$ln;
    echo "<tr>";
    
    if ($i == 0) {
      $campos=implode("#",$elt);
      // echo "campos: ".$campos;
      $cad="insert into titulos values(null,'10','".$campos."')";
      echo $cad;
      for($k=0;$k<$ln;$k++){
        echo "<th>" . $elt[$k] . "</th>";
      }
      echo "</tr>";
    } else {
       if($elt[0]!=""){
        $aux=[];
        for($k=0;$k<$ln;$k++){
          if($k>1){
            $aux[]=$elt[$k];
          }
          echo "<td>" . $elt[$k] . "</td>";
        }
        echo "</tr>";
        $campos=implode("#",$aux);
        echo "</br>";
        $cad="insert into listas values(null,'10','".$elt[0]."','".$elt[1]."','".$campos."')";
        echo $cad;
       }
    }      
    $i++;
  }
  echo "</tbody></table>";
} else {
  echo SimpleXLSX::parseError();
}
// print_r($aux);
?>

</body>
</html>