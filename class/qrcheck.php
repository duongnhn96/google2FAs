<?php
  if (!(isset($_SESSION['user'])& isset($_SESSION['googleCode']))){
    if(isset($_SESSION['user'])) {
      $ga = new GoogleAuthenticator();
      $secret = $db->getSecret($_SESSION['user']);
      $secret_code="";
      $email="";
      while( $row = mysqli_fetch_array($secret)) {
            $secret_code = $row[0];
            $email=$row[1];
      }
      $QRUrl= $ga->getQRCodeGoogleUrl($email,$secret_code,'Duong2FA');
      // otpauth://totp/?secret=BFS2C4TNID6WMDKP
      
    }
    if($_POST['code'])
    {
         $code=$_POST['code'];
         $secret = $db->getSecret($_SESSION['user']);
         $secret_code="";
         while( $row = mysqli_fetch_array($secret)) {
                 $secret_code = $row[0];
         }
         $ga = new GoogleAuthenticator();
         $checkResult = $ga->verifyCode($secret_code, $code, 2);  
         if ($checkResult) {
                 $_SESSION['googleCode']=$code;
                 header('Location: '.$url.'QRcode-check.html');
         } 
         else 
         {
             $error='<div class=" text-center" style="margin-top:2px; align-item:center; color:red;">Invalid Code!</div>';
         }
     }   

?>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt style="margin:-10px 10px 70px 100px;">
        
					<img src="<?php echo $QRUrl ?>"   alt="IMG">
				</div>

				<form class="login100-form validate-form" name="form1" method="post" action="" style="margin-top:-10px">
					<span class="login100-form-title">
						Enter you code
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="code" required id="code" placeholder="YOUR CODE HERE">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>
          <?php if (isset($error)) echo $error;?>
					<div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit"  value="CHECK" />
					</div>
                    
                   
				</form>
			</div>
		</div>
	</div>
  <?php } else {
		 header("Location: ".$url."Dashboard.html");
	} ?>