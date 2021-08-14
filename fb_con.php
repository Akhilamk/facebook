<?php
$host="host=127.0.0.1";
$port="port=5432";
$db_name="dbname=facebook";
$credentials="user=postgres password=akhila123";
$db=pg_connect("$host $port $db_name $credentials");
if(!$db){
    echo"Unable to connect database!";
}else{
    // echo"Database connection Successful!";
}
?>