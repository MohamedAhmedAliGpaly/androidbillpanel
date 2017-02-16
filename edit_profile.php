  <html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
<?php
	include('system_load.php');
	//This loads system.

	//user Authentication.
	authenticate_user('all');

	//User object.
	$new_user = new Users;

	//user level object
	$new_userlevel = new Userlevel;
	$notes_obj = new Notes;
	
	if(isset($_POST['profile_image']) && $_POST['profile_image'] != '') { 
		$pr_img = $_POST['profile_image'];
	}

//User update submission image processing edit user password setting if not changed.
if(isset($_GET['user_id']) && $_GET['user_id'] != '') { 
	if(isset($pr_img)) { 
		$pr_img = $pr_img;
	} else { 
		if(isset($_POST['already_img'])) { 
			$pr_img = $_POST['already_img'];
		} else { 
			$pr_img = '';
		}
	}
	if(isset($_POST['password']) && $_POST['password'] != '') { 
		if($_POST['password'] == $_POST['confirm_password']) { 
			$password_set = $_POST['password'];
		} else { 
			$message = $language['password_do_not_match'];
		}
	} else { 
		$password_set = '';
	}
	if(isset($_POST['update_user']) && $_POST['update_user'] == '1') {
	extract($_POST);
	if($password != $confirm_password){ 
		$message = $language['password_do_not_match'];
	} else {
	$message = $new_user->edit_profile($_SESSION['user_id'], $first_name, $last_name, $gender, $date_of_birth, $address1, $address2, $city, $state, $country, $zip_code, $mobile, $phone, $username, $email, $password_set, $pr_img, $description);
		if(isset($_POST['message_email_notification']) && $_POST['message_email_notification'] == '1') {
			$new_user->set_user_meta($_SESSION['user_id'], 'message_email', $_POST['message_email_notification']);
		} else { 
			$new_user->set_user_meta($_SESSION['user_id'], 'message_email', '0');
		}
		}
	}
}//update user submission.
	
	if(isset($_GET['user_id']) && $_GET['user_id'] != '') { 
		$new_user->set_user($_GET['user_id'], $_SESSION['user_type'], $_SESSION['user_id']);
	}//setting user data if editing. 	
	
	$page_title = "تحرير الملف الشخصي"; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.
	?>

	<?php
    //display message if exist.
        if(isset($message) && $message != '') { 
            echo '<div class="alert alert-success">';
            echo $message;
            echo '</div>';
        }
    ?>
                    <div class="col-sm-8">
                    <form action="<?php $_SERVER['PHP_SELF']?>" id="add_user" name="user" method="post" enctype="multipart/form-data">

                    	<div class="form-group">
                        	<label class="control-label">الآسم الآول*</label>
                            <input type="text" name="first_name" class="form-control" placeholder="<?php echo $language['enter_first_name']; ?>" value="<?php echo $new_user->first_name; ?>" required="required" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">الآسم الآخير*</label>
                            <input type="text" name="last_name" class="form-control" placeholder="<?php echo $language['enter_last_name']; ?>" value="<?php echo $new_user->last_name; ?>" required="required" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">الجنس</label>
                            <select class="form-control" name="gender">
                            	<option vale=''>اختر من القائمة</option>
                                <option value="Male" <?php if($new_user->gender == 'Male') { echo 'selected="selected"'; } ?>>
								ذكر</option>
                                <option value="Female" <?php if($new_user->gender == 'Female') { echo 'selected="selected"'; } ?>>
								انثي</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">تاريخ الميلاد</label>
                            <input type="text" class="form-control" name="date_of_birth" placeholder="تاريخ الميلاد" value="<?php echo $new_user->date_of_birth; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">العنوان</label>
                            <textarea name="address1" class="form-control" placeholder="العنوان بالتفاصيل"><?php echo $new_user->address1; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">عنوان اخر او رقم البطاقة</label>
                            <textarea name="address2" class="form-control" placeholder="رقم بطاقة او عنوان اخر"><?php echo $new_user->address2; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">المدينة</label>
                            <input type="text" name="city" class="form-control" placeholder="المدينة مثال القاهرة" value="<?php echo $new_user->city; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">المنطية / الحي</label>
                            <input type="text" name="state" class="form-control" placeholder="الحي مثال المعادي" value="<?php echo $new_user->state; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">الدولة</label>
                            <input type="text" class="form-control" name="country" placeholder="المنطقة" value="<?php echo $new_user->country; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">رمز بريدي </label>
                            <input type="text" class="form-control" name="zip_code" placeholder="رمز المنطقة او الكود البريدي" value="<?php echo $new_user->zip_code; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">الهاتف</label>
                            <input type="text" class="form-control" name="mobile" placeholder="رقم الموبايل او هاتف اخر" value="<?php echo $new_user->mobile; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">رقم ارضي او رقم اخر</label>
                            <input type="text" class="form-control" name="phone" placeholder="رقم هاتف 2" value="<?php echo $new_user->phone; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">اسم الدخول او السم الحساب مهم* بالآنجليزي</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $new_user->username; ?>" required="required" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">ايميل * مهم</label>
                            <input type="text" class="form-control" name="email" placeholder="Your email address" value="<?php echo $new_user->email; ?>" required="required" />
                        </div>
                       
                        <div class="form-group">
                        	<label class="control-label">كلمة المرور</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="" /><small>اترك هذا فارغ اذا لم تريد تغير كلمه المرور</small>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">تأكيد كلمة المرور </label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="تأكيد كلمه المرور مره اخري" value="" />
                        </div>
                       
                        <div class="form-group">
                        	<label class="control-label">صورة الشخص او صوره الملف الشخصي</label>
                            <div class="clearfix"></div>
                           	<div class="clearfix"></div>
                            <div class="col-lg-4 ">
                                <div id="cropContaineroutput"></div>
                                <input type="hidden" name="profile_image" id="cropOutput" value="" />
                            </div>
                            	<?php
									if(isset($new_user->profile_image) && $new_user->profile_image != '') {
										echo '<a href="'.$new_user->profile_image.'" target="_blank"><img src="'.$new_user->profile_image.'" height="80" class="pull-left img-thumbnail" style="height:80px;" /></a><input type="hidden" name="already_img" value="'.$new_user->profile_image.'">';	
									}
								?>
                                <div class="clearfix"></div>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">تفاصيل ومعلومات اضافية</label>
                            <textarea name="description" class="form-control" placeholder="معلومات عن الشخص او الحساب"><?php echo $new_user->description; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                        <label class="control-label">اشعار المستخدم برسالة:</label>
                        <input type="checkbox" name="message_email_notification" <?php if($new_user->get_user_meta($_SESSION['user_id'], 'message_email') == '1'){echo 'checked="checked"'; }?> value="1" />
                        </div>
                        
                       	<input type="hidden" name="update_user" value="1" /> 
						<input type="submit" value="<?php echo $language['update_user']; ?>" class="btn btn-primary" />

                    </form>
		<script type="text/javascript">
            $(document).ready(function() {
            // validate the register form
        $("#add_user").validate();
            });
        </script>
	</div><!--left-side-form ends here.-->                
<?php
	require_once('includes/sidebar.php');
?>                        
<?php
	require_once("includes/footer.php");
?>