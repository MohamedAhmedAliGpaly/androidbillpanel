<?php
	include('system_load.php');
	//This loads system.	
	$new_user = new Users; //creating user object.
	
	//Activation of user confirm email id
	if(isset($_GET['confirmation_code']) && $_GET['confirmation_code'] != '' && $_GET['user_id'] != '') {
		$confirmation_code = $_GET['confirmation_code'];
		$user_id = $_GET['user_id'];
		$message = $new_user->match_confirm_code($confirmation_code,$user_id);
	}
	
	if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') { 
		HEADER('LOCATION: dashboard.php');
	} //If user is loged in redirect to specific page.
	
	if(isset($_POST['login']) && $_POST['login']==1) { 
		extract($_POST);
		if($email == '') { 
			$message = $language['login_email_error'];
		} else if($password == '') { 
			$message = $language['login_password_error'];
		}//validation ends here.
		$message = $new_user->login_user($email, $password);
		if($message == 1) {
			if(get_option('disable_login') == '1' && $new_user->user_type != 'admin') { 
				$message = $language['login_disabled_temporary'];	
			} else {
			$_SESSION['user_id'] = $new_user->user_id;
			$_SESSION['first_name'] = $new_user->first_name;
			$_SESSION['last_name'] = $new_user->last_name;
			$_SESSION['username'] = $new_user->username;
			$_SESSION['email'] = $new_user->email;
			$_SESSION['status'] = $new_user->status;
			$_SESSION['user_type'] = $new_user->user_type;
			$_SESSION['timeout'] = time();
			//Setting user meta information.
			$user_ip = get_client_ip();//Function is inside function.php to get ip
			$new_user->set_user_meta($_SESSION['user_id'], 'last_login_time', date("Y-m-d H:i:s")); //setting last login time.
			$new_user->set_user_meta($_SESSION['user_id'], 'last_login_ip', $user_ip); //setting last login IP.
			$new_user->set_user_meta($_SESSION['user_id'], 'login_attempt', '0'); //On login success default loign attempt is 0.
			$new_user->set_user_meta($_SESSION['user_id'], 'login_lock', 'No'); //setting last login time.
			
			$message = $language['login_success_message'];
			redirect_user($new_user->user_type); //Checks authentication and redirect user as per his/her level.
			}
		}//setting session variables if user loged in successful!
	}//login process ends here if form submits

	$page_title = $language['login_title']; //You can edit this to change your page title.
	$sub_title = "Please login below to access the dashboard.";
	require_once('includes/header.php');

	//adding facebook if activate.
	if(get_option('facebook_login') == '1') { 
		include('includes/add_facebook.php');
		echo '<div id="fb_return_msg"></div>';
	}

	if(isset($message) && $message != '') { 
		echo '<div class="alert alert-success">';
		echo $message;
		echo '</div>';
	}
	if(isset($_GET['message']) && $_GET['message'] != '') { 
		echo '<div class="alert alert-success">';
		echo $_GET['message'];
		echo '</div>';
	}
?>
<link rel="stylesheet" type="text/css" href="css/signin.css" media="all" />
        	<form action="<?php $_SERVER['PHP_SELF']?>" id="login_form" name="login" class="form-signin" method="post">
              <div class="form-group">
              <label>Email or Username*</label>
              <input type="text" name="email" class="form-control" placeholder="Username OR Email*" required="required" />
              </div>
              <div class="form-group">
              <label>Password*</label>
              <input type="password" name="password" class="form-control" placeholder="Password*" required="required"/>
              </div>
              <label class="checkbox">
              <input type="checkbox" name="keep_login" /> Keep me sign in
              </label>
              <input type="hidden" value="1" name="login" />
              <input type="submit" class="btn btn-lg btn-primary btn-block" value="Submit" />
            </form>
             <?php if(get_option('facebook_login') == '1') { ?>
            	<center><fb:login-button scope="public_profile,email" size="xlarge" onlogin="checkLoginState();">
				<?php echo $language["facebook_login_btn"]; ?>
           		</fb:login-button></center>
            <?php } ?>
            <script>
				$(document).ready(function() {
					// validate the register form
					$("#login_form").validate();
				});
            </script>
            
            <div class="text-center">
            	Forgot Password? <a href="forgot.php">Recover password</a><br />
        		Not a member yet? <a href="register.php">Sign up</a>
        	</div>
<?php
	require_once("includes/footer.php");
?>