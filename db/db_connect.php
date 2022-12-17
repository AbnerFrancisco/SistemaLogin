<?php
$servername = "localhost";
$username  = "root";
$password = "";
$db_name = "sistemalogin";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(mysqli_connect_error()):
    echo "Falha na conexão com o servidor. Erro " . mysqli_connect_error();


else:
    //echo "tudo ok";// 

endif;

?>