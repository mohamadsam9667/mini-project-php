<?php
require_once("../config/loader.php");

if(isset($_POST["signin"])){

  try{  $inputer=$_POST["inputer"];
    $password=$_POST["password"];

    $query="SELECT * FROM `users` 
WHERE (username=?
     or mobile=?
      or email=? )
       AND (password=?)";

    $stmt=$conn->prepare($query);

    $stmt->bindValue(1,$inputer);
    $stmt->bindValue(2,$inputer);
    $stmt->bindValue(3,$inputer);
    $stmt->bindValue(4,$password);

    $stmt->execute();
 
 
    //     $resault = $stmt-> fetch(PDO::FETCH_ASSOC);
    //     echo"<pre>";
    //  var_dump($resault);
    //     echo "</pre>"; 
    

    $numberUserFind=$stmt->rowCount();
    
    if($numberUserFind){
    
        header('Location:../index.php?logined=ok');
    
    }else{
        header('Location:../index.php?notuser=ok');
    }
    
    
}catch(PDOException $e){
    echo "ورودی های شما درست نیست !";
}

}


?>