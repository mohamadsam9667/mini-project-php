<?php
require_once("../login/config/loader.php");

if(isset($_POST['sender'])){

  $number_phone=$_POST["mobile"];
  $number_otp=rand(1000,9999);
  
  $query="SELECT * FROM users WHERE mobile=?";
  $stmt=$conn->prepare($query);
  $stmt->bindValue(1,$number_phone);
  $stmt->execute();
  
  if($stmt->rowCount()>0){
    
    $query1="INSERT INTO users otp=?";
    $stmt->bindValue(1,$number_otp);
    $stmt=$conn->prepare($query1);
    $stmt->execute();
    if(isset($_POST['sms'])){
      if($_POST['sms']==$number_otp){
         header('Location:./otp.php?logined=ok');
      }else{
        echo "<p class='alert alert-error'>کد وارد شده صحیح نیست .</p>";
      }
    }
    $apiKey = "PSw9Ru3Qfy8UnKPTI4whTh8px7taG07inwfQ03wFxK2NusM6";
    $apiUrl = "https://api.sms.ir/v1/send/verify";


  $model = [
    "mobile" => $number_phone,
    "templateId" => 781286,
    "parameters" => [
      [ "name" => "CODE", "value" => $number_otp ]
      ]
      ];

  $ch = curl_init($apiUrl);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($model));
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'x-api-key: ' . $apiKey
      ]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      
      $response = curl_exec($ch);
      $error = curl_error($ch);
      curl_close($ch);
      
      if ($error) {
        echo "Error: " . $error;
        } else {
          echo $response;
          }
          }else{
            echo "<p>یوزری با این شماره وجود ندارد <a href='./index.php'>ثبت نام کنید</a></p>";
          }
 
          
}

  ?>

<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sms ارسال </title>
</head>

<body>
  <div class="container" id="container">
   
    <div class="form-container sign-in">
      
    <form method="post">
        
        <h1>ورود</h1>
        <span>ایمیل/شماره تلفن را وارد کنید</span>
        <input type="number" name="mobile" placeholder=" برای مثال :09125487654">
        <input type="number"name="sms" placeholder="2548">
        <a href="#">فراموشی رمز عبور؟</a>
        <div style="display:inline;">
            <button type="submit" name="sender">ارسال به تلفن</button>  
           <a href="./otp.php">ارسال به ایمیل</a>
        </div>
      
      </form>
    </div>
    <!-- <div class="toggle-container">
      <div class="toggle">
        <div class="toggle-panel toggle-left">
          <h1>برگشت به عقب !</h1>
          <p>برای در اختیار داشتن امکانات سایت اطلاعات خود را وارد کنید </p>
          <button class="hidden" id="login">ورود</button>
        </div>
        <div class="toggle-panel toggle-right">
          <h1>سلام کاربر عزیز</h1>
          <p>برای استفاده از تمام امکانات سایت، با اطلاعات شخصی خود ثبت نام کنید</p>
          <button class="hidden" id="register">ساخت حساب کاربری</button>
        </div>
      </div>
    </div> -->
  </div>
</body>

<script src="./script.js"></script>

</html>




