<?php 
if (isset($_POST['dangky'])) {
    $username=$_POST['username'];
    $password=sha1(md5(md5($_POST['password'])));
	$email = $_POST['email'];
	$fullname = $_POST['fullname'];
	$ga = new GoogleAuthenticator();
	$secret_code = $ga->createSecret();
	$resultreg=$db->insertuser($username,$password,$email,$fullname,$secret_code);
	if($resultreg){
		$_SESSION["user"] = $username;
		header('Location: '.$url.'QRcode-check.html');
		
	} else { 
		header('Location: '.$url.'Dang-ky.html');
	} 
}
?>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="padding-top:120px;">
				<div class="login100-pic js-tilt" style="padding-top:105px;" data-tilt>
					<img src="assets/img/gg.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" id="registerForm" name="form1" method="post" action="">
					<span class="login100-form-title">
						Create your account
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" required name="username" id="username" onblur="checkUser(this.value)" value="<?php echo $_POST['username'];    ?>" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
                        <i class="fa fa-user" aria-hidden="true"></i>
						</span>
						<div class=" text-center" id="user_error"></div>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="password" required name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						<div class="text-center" id="pass_error"></div>
					</div>
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="password" required name="confirm_password" id="confirm_password" placeholder="Confirm password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						<div class="text-center" id="pass_error2"></div>
					</div>
                    <div class="wrap-input100 validate-input" >
						<input class="input100" type="email" required name="email" id="email" onblur="checkEmail(this.value)" value="<?php echo $_POST['email'];    ?>" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
						<div class=" text-center" id="email_error"></div>
					</div>
					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" required name="fullname" id="fullname" placeholder="Full Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" name="dangky" value="Register" id="reg2" />
					</div>
					<div id="message" style="margin-top:25px; align-item:center;"></div>
					<div class="text-center p-t-136">
						<a class="txt2" href="<?php echo $url?>Dang-nhap.html">
                        Have account? Login now
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
	
	$('#password, #confirm_password').on('keyup', function () {
		if ($('#password').val().length > 5) {
			$('#reg2').removeAttr('disabled');
			$('#pass_error').html('');
		} else {
			$('#pass_error').html('Mật khẩu quá yếu!');
			$('#reg2').css('background','gray');
			$('#reg2').attr({
				"disabled": ''
			});
		}
		if ($('#password').val() == $('#confirm_password').val()) {
			$('#reg2').removeAttr('disabled');
			$('#reg2').removeAttr('style');
			$('#pass_error2').html('');
		} else {
			$('#pass_error2').html('Không khớp!');
			$('#reg2').css('background','gray');
			$('#reg2').attr({
				"disabled": ''
			});
		}
	});
	$('#username').on('keyup change', function () {
		$("#username").val($(this).val().split(' ').join(''));
	});

	$('#email').on('keyup change', function () {
		$("#email").val($(this).val().split(' ').join(''));
	});
	function checkUser(username){
		$.post('class/checkuser.php', {'username': username}, function(data) {
				
				if(data=="true"){
				
				$("#user_error").text("Tên tài khoản đã tồn tại");
				$('#reg2').css('background','gray');
				$('#reg2').attr({
					"disabled": ''
				});
				
				

			}
			else{ $("#user_error").text("");
				$('#reg2').removeAttr('disabled');
				$('#reg2').removeAttr('style');
		}
	});
	}
	function checkEmail(email){
		$.post('class/checkemail.php', {'email': email}, function(data) {
				
				if(data=="true"){
				
				$("#email_error").text("Email đã tồn tại");
				$('#reg2').css('background','gray');
				$('#reg2').attr({
					"disabled": ''
				});

				

			}
			else{ $("#email_error").text("");
				$('#reg2').removeAttr('disabled');
				$('#reg2').removeAttr('style');
		}
	});
	}
	</script>
	
	
