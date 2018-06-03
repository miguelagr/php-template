    <?php
$nombre="";
if (!empty($_REQUEST['nombre'])){
$nombre=$_REQUEST['nombre'];
}
 
$apellido_pat="";
if (!empty($_REQUEST['ApP'])){
$apellido_pat=$_REQUEST['ApP'];
}

$apellido_mat="";
if (!empty($_REQUEST['ApM'])){
$Apellido_mat=$_REQUEST['ApM'];
}
 
$correo="";
if (!empty($_REQUEST['correo'])){
$correo=$_REQUEST['correo'];
}
 
$Numero_tar="";
if (!empty($_REQUEST['NumTar'])){
$Numero_tar=$_REQUEST['NumTAr'];
}

$Codigo="";
if (!empty($_REQUEST['Codigo'])){
$Codigo=$_REQUEST['Codigo'];
}

 
//Luego sobrescribo el txt
  
$archivo="datos.txt"; 
  
     $file=fopen($archivo,"a"); 
     fwrite($file,$nombre,$apellido_mat,$apellido_pat.$correo.$Numero_tar.$Codigo); 
     fclose($file);  
?>