<?php 
if (!(isset($_SESSION['user'])& isset($_SESSION['googleCode']))){
include_once('userDB.php');
if (isset($_POST['dangnhap'])) {
    $kn= mysqli_connect("localhost","root","","google2fa");
	$user = mysqli_real_escape_string($kn,$_POST['username']);
	$pass =sha1(md5(md5(addslashes($_POST['password']))));
	$resultuser= $db->login($user,$pass);
	$n=mysqli_num_rows($resultuser);
	if($n==0){
		$error='<div class="alert alert-danger" style="margin-top:25px; align-item:center;">Username or password is incorrect</div>';
	}
	else {
		$rowuser=mysqli_fetch_array($resultuser);
		$_SESSION['user']=$rowuser['username'];
		$link= $url.'Login-check.html';
        header("Location: $link");
        
    }
}
?>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="assets/img/gg.png" style="padding-top:45px;"  alt="IMG">
				</div>

				<form class="login100-form validate-form" id="loginForm" name="form1" method="post" action="">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="username" required id="username" placeholder="Username/Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input"  >
						<input class="input100" type="password" required name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" name="dangnhap" value="Login" id="dangnhap" />
					</div>
                    
                    <?php if (isset($error)) echo $error;?>
					<div class="text-center p-t-136">
						<a class="txt2" href="<?php echo $url?>Dang-ky.html">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
    <script type="text/javascript">
function validate()
{
    if(   document.getElementById("text1").value == "workshop"
       && document.getElementById("text2").value == "workshop" )
    {
        alert( "validation succeeded" );
        location.href="run.html";
    }
    else
    {
        alert( "validation failed" );
        location.href="fail.html";
    }
}
</script>
    <?php } else {
		 header("Location: ".$url."Dashboard.html");
	} ?>