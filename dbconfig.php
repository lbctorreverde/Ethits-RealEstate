<?php 
// $connect = mysqli_connect("sql210.epizy.com","epiz_31445837","viC1YVSVdW","epiz_31445837_rental");
$connect = mysqli_connect("localhost:3306","root","","agentfinder");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>