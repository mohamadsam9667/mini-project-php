  <?php
  require_once("../login/config/loader.php");

  $sent=false;
  $message = "";
  $number_phone="";
  if(isset($_POST['sender'])){
    $number_phone=$_POST["mobile"];
    $number_otp=rand(1000,9999);
    
    $query="SELECT * FROM users WHERE mobile=?";
    $stmt=$conn->prepare($query);
    $stmt->bindValue(1,$number_phone);
    $stmt->execute();
    
    if($stmt->rowCount()>0){
      $updateQuery = "UPDATE users SET otp = ? WHERE mobile = ?";
      $updateStmt = $conn->prepare($updateQuery);
      $updateStmt->bindValue(1, $number_otp);
      $updateStmt->bindValue(2, $number_phone);
      $updateStmt->execute();
      if($updateStmt->rowCount()>0){
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
                  $message = "<p class='alert alert-error'>خطا در ارتباط: " . $error . "</p>";
              } else {
                  $sent = true; // سوئیچ به مرحله بعد
                  $message = "<p class='alert alert-success'>کد تأیید برای شماره {$number_phone} ارسال شد.</p>";
              }
          } else {
              $message = "<p class='alert alert-error'>خطا در بروزرسانی کد تأیید.</p>";
          }
      } else {
          $message = "<p class='alert alert-error'>کاربری با این شماره وجود ندارد. <a href='./index.php'>ثبت‌نام کنید</a></p>";
      }
  }
      if (isset($_POST['verify_otp'])) {
      $number_phone = trim($_POST["mobile"]);
      $user_otp = trim($_POST["sms"]);

      $checkQuery = "SELECT * FROM users WHERE mobile = ? AND otp = ?";
      $checkStmt = $conn->prepare($checkQuery);
      $checkStmt->bindValue(1, $number_phone);
      $checkStmt->bindValue(2, $user_otp);
      $checkStmt->execute();

      if ($checkStmt->rowCount() > 0) {
          // پاک کردن OTP پس از ورود موفق
          $clearStmt = $conn->prepare("UPDATE users SET otp = NULL WHERE mobile = ?");
          $clearStmt->bindValue(1, $number_phone);
          $clearStmt->execute();

          header('Location: ./otp.php?logined=ok');
          exit();
      } else {
          $sent = true; // نگه داشتن فرم در مرحله ورود کد
          $message = "<p class='alert alert-error'>کد وارد شده صحیح نیست.</p>";
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

          <!-- نمایش پیام موفقیت یا خطا -->
          <?= $message; ?>

          <?php if (!$sent): ?>
            <!-- مرحله اول: دریافت شماره تلفن -->
            <span>شماره تلفن را وارد کنید</span>
            <input type="number" name="mobile" placeholder="برای مثال :09125487654" required>
            
            <a href="#">فراموشی رمز عبور؟</a>
            <div style="display:inline;">
                <button type="submit" name="sender">ارسال به تلفن</button>  
                <a href="./otp.php">ارسال به ایمیل</a>
            </div>

          <?php else: ?>
            <!-- مرحله دوم: دریافت کد OTP -->
            <span>کد ۴ رقمی ارسال شده به شماره <?= htmlspecialchars($number_phone); ?> را وارد کنید:</span>
            
            <!-- ارسال مخفیانه شماره برای بررسی در مرحله verify_otp -->
            <input type="hidden" name="mobile" value="<?= htmlspecialchars($number_phone); ?>">
            <input type="number" name="sms" placeholder="مثال: 2548" required autofocus>
            
            <div style="display:inline;">
                <button type="submit" name="verify_otp">تأیید و ورود</button>  
            </div>
          <?php endif; ?>
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




