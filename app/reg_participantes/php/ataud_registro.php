<?php 
error_reporting(0);
date_default_timezone_set('America/Lima');
include_once '../../../common/conexion.php';
include 'barcode.php';
$modelo = $_POST['modelo'];
$barras = $_POST['barras'];
$color = $_POST['color'];
$tipo = $_POST['tipo'];
$proveedor = $_POST['proveedor'];

$fecha_registro = date('d/m/Y');
$id_sucursal=$_SESSION['sucursal'];
$filepath = '../../cbarras/codigos/';
$text = $barras;
$size = '80';
$orientation = 'horizontal';
$code_type = 'code128'; // codabar, code128,code39
$print = 'true';
$sizefactor = '1';


$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
$limite_kb = 4096;


$tiempo1=explode(" ",microtime());
$cadena = $tiempo1[0];
$sacado = substr($cadena,2,10);
$time1 = date('His');
$fechaHora = date("YmdHis", $time1);
$codigoUnico = $fechaHora.$sacado;


 $dupli= mysqli_query($link, "SELECT * FROM ataudes WHERE codigo_barras ='$barras'&&id_sucursal='$id_sucursal'");
 $dupli1= mysqli_num_rows($dupli);
if($dupli1==0){  
if(in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024){
$arch = new SplFileInfo($_FILES['foto']['name']);
$arch1 = ($arch->getExtension());
$imagen = $codigoUnico.".".$arch1;

$ruta = "../uploads/".$imagen;
 if (!file_exists($ruta)){ 
$resultado = @move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

if ($resultado){    
$RegBien = mysqli_query($link, "INSERT INTO ataudes SET
       id_ataud = '$codigoUnico',
       id_sucursal = '$id_sucursal',
       codigo_barras = '$barras',
       modelo = '$modelo',
       tipo = '$tipo',
       color = '$color',
       cantidad = '1',
       id_proveedor = '$proveedor',
       estado = 'Activo',
       foto = '$imagen'");
if(!$RegBien){ echo "Ocurió un error";}elseif($RegBien){
    barcode($filepath .$text.'.png', $text, $size, $orientation, $code_type, $print,$sizefactor);
   ?> <script languaje="javascript"> addToast();ListadoAtaudes(); </script>
<?php
}
}else{ echo "<script> alert ('EL servidor no permite guardar la foto'); </script>";}
 }else{ echo "<script> alert ('No encuentro la ruta para guardar la foto'); </script>";}

}else{ echo "<script> alert ('la foto debe ser  .JPG y menos a 4MB'); </script>";}
}else{    echo "<script> alert ('Este Ataud ya se encuentra registrado'); </script>"; }


?>


