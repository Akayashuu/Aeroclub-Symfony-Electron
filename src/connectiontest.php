<?php
    $host = '192.168.77.115';
    $dbname = 'aeroclub';
    $username = 'app';
    $password = 'ua95qI0eTN^Y8@99a8@a5pF3Tyw96';
 
  $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
   
  try{
     $conn = new PDO($dsn);
     
     if($conn){
      echo "Connecté à $dbname avec succès!";
     }
  }catch (PDOException $e){
     echo'erreur';
  }
?>