

<?php
require_once('config/loader.php');
?>


<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود و ثبت نام </title>
</head>
<!-- sign up -->
<body>
  <div class="container" id="container">
    <div class="form-container sign-up">
      
    <form method="POST" action="action/sign-up.php">
        <h1>ساخت حساب</h1>
        <span>ایمیل/رمز ورود را وارد کنید</span>
        <input type="text" name="username" placeholder="نام کاربری">
        <input type="email"name="email" placeholder="ایمیل">
        <input type="text" name="mobile" placeholder="شماره تلفن">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="signup">ثبت نام</button>
      </form>
    </div>



    <div class="form-container sign-in">
      <form method="POST" action="action/signin.php">
        <h1>ورود</h1>
        <div class="social-icons">
        </div>
        <span>ایمیل/رمز ورود را وارد کنید</span>
        <input type="text" name="inputer" placeholder="ایمیل / نام کاربری /موبایل">
        <input type="password" name="password" placeholder="Password">
        <a href="#">فراموشی رمز عبور؟</a>
        <div style="display: inline;">
          <button type="submit" name="signin">ورود</button>
          <a href="./otp.php">sms ارسال  </a>   
        </div>
        <?php if(isset($_GET['notuser'])) { ?>
          ایمیل  موبایل یا یوزر نیم شما غلط است 
          <?php  }  ?>
      </form>
    </div>
    <div class="toggle-container">
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
    </div>
  </div>
</body>

<script src="./script.js"></script>

</html>
