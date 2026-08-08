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
    <div class="form-container sign-up">
      <form>
        <h1>ساخت حساب</h1>
       
        <span>ایمیل/رمز ورود را وارد کنید</span>
        <input type="text" placeholder="نام کاربری">
        <input type="email" placeholder="ایمیل">
        <input type="text" placeholder="شماره تلفن">
        <input type="password" placeholder="Password">
        <button>ثبت نام</button>
      </form>
    </div>
    <div class="form-container sign-in">
      <form>
        <h1>ورود</h1>
       
        <span>ایمیل/رمز ورود را وارد کنید</span>
        <input type="number" placeholder="مثال کد تایید :23424">
        <a href="#">فراموشی رمز عبور؟</a>
        <div style="display:inline;">
            <button>ارسال به تلفن</button>  
           <a href="./otp.php">ارسال به ایمیل</a>
        </div>
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