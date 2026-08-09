<?php

require_once('../config/loader.php');
if(isset($_POST['sigun'])){
try{    echo"is ok";
    $username=$_POST['username'];
    $password=$_POST['password'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];    

    $query = "INSERT INTO users SET  username=?,email=?,mobile=?,password=?";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(1,$username);
    $stmt->bindValue(2,$email);
    $stmt->bindValue(3,$mobile);
    $stmt->bindValue(4,$password);

    $stmt->execute();

    echo "یوزر ساخته شد";

}catch(PDOException $e){
echo $e->getMessage();
}
}
?>