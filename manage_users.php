<html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
<?php
	include('system_load.php');
	//This loads system.
	
	//user Authentication.
	authenticate_user('admin');
	
	//User object.
	$new_user = new Users;
	//user level object
	$new_userlevel = new Userlevel;
	
	//Profile Image Processing.
	if(isset($_FILES['profile_image']) && $_FILES['profile_image'] != '') { 
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["profile_image"]["name"]);
		$extension = end($temp);
		
		if ((($_FILES["profile_image"]["type"] == "image/gif")
		|| ($_FILES["profile_image"]["type"] == "image/jpeg")
		|| ($_FILES["profile_image"]["type"] == "image/jpg")
		|| ($_FILES["profile_image"]["type"] == "image/pjpeg")
		|| ($_FILES["profile_image"]["type"] == "image/x-png")
		|| ($_FILES["profile_image"]["type"] == "image/png"))
		&& ($_FILES["profile_image"]["size"] < 2048000)
		&& in_array($extension, $allowedExts)) {
 			 if ($_FILES["profile_image"]["error"] > 0) {
    			$message = "Return Code: " . $_FILES["profile_image"]["error"];
    	} else 	{
			$phrase = substr(md5(uniqid(rand(), true)), 16, 16);
	  if (file_exists("upload/" .$phrase.$_FILES["profile_image"]["name"])) {
	      $message = $_FILES["profile_image"]["name"] . " already exists. ";
      } else {
		  move_uploaded_file($_FILES["profile_image"]["tmp_name"],
		  "upload/".$phrase.str_replace(' ', '-',$_FILES["profile_image"]["name"]));
		  $profile_image = "upload/".$phrase.str_replace(' ', '-', $_FILES["profile_image"]["name"]);
	  } //if file not exist already.
	  
    } //if file have no error
  }//if file type is alright.
} //if image was uploaded processing.
/*Image processing ends here.*/

//User update submission image processing edit user password setting if not changed.
if(isset($_POST['edit_user']) && $_POST['edit_user'] != '') { 
	if(isset($profile_image)) { 
		$profile_image = $profile_image;
	} else { 
		if(isset($_POST['already_img'])) { 
			$profile_image = $_POST['already_img'];
		} else { 
			$profile_image = '';
		}
	}
	if(isset($_POST['password']) && $_POST['password'] != '') { 
		if($_POST['password'] == $_POST['confirm_password']) { 
			$password_set = $_POST['password'];
		} else { 
			$message = "Password does not match.";
		}
	} else { 
		$password_set = '';
	}
	if(isset($_POST['update_user']) && $_POST['update_user'] == '1') {
	extract($_POST);
	if($password != $confirm_password){ 
		$message = 'Password does not match!';
	} else {
	$message = $new_user->update_user($_POST['edit_user'], $_SESSION['user_type'], $first_name, $last_name, $gender, $date_of_birth, $address1, $address2, $city, $state, $country, $zip_code, $mobile, $phone, $username, $email, $password_set, $profile_image, $description, $status, $user_type);
		}
	}
}//update user submission.
	
	if(isset($_POST['edit_user']) && $_POST['edit_user'] != '') { 
		$new_user->set_user($_POST['edit_user'], $_SESSION['user_type'], $_SESSION['user_id']);
	}//setting user data if editing. 	
	
	//add user processing.
	if(isset($_POST['add_user']) && $_POST['add_user'] == '1') { 
		extract($_POST);
		if($first_name == '') { 
			$message = 'First name is required!';
		} else if($username == '') { 
			$message = 'Username is required!';
		} else if($email == '') { 
			$message = 'Email is required!';
		} else if($password == ''){ 
			$message = 'Password Cannot be empty!';
		} else if($password != $confirm_password){ 
			$message = 'Password does not match!';
		} else if($status == '0') { 
			$message = 'Please select user status.';
		} else if($user_type == '0') { 
			$message = 'Please select user type.';
		}  else {
		$message = $new_user->add_user($first_name, $last_name, $gender, $date_of_birth, $address1, $address2, $city, $state, $country, $zip_code, $mobile, $phone, $username, $email, $password, $profile_image, $description, $status, $user_type);
		}
	}//add user processing ends here.
	
	if(isset($_POST['edit_user'])){ $page_title = 'Edit user'; } else { $page_title = 'Add New User';} //page title set.
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
                    <form action="<?php $_SERVER['PHP_SELF']?>" id="add_user" name="user" method="post" enctype="multipart/form-data" role="form">
                     <div class="form-group">
                     <label class="control-label">الآسم الآول *</label>
                     <input type="text" class="form-control" name="first_name" placeholder="Enter first name" value="<?php echo $new_user->first_name; ?>" required="required" />
                     </div>
                        
                       <div class="form-group">
                     	<label class="control-label">*الآسم الآخير </label>
                        <input class="form-control" type="text" name="last_name" placeholder="Enter last name" value="<?php echo $new_user->last_name; ?>" required="required" />
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
                       <?php if(isset($_POST['edit_user'])) { ?> 
                        <div class="form-group">
                        	<label class="control-label">كلمة المرور</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" value="" /><small>اترك هذا فارغ اذا لم تريد تغير كلمه المرور</small>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">تأكيد كلمة المرور </label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="تأكيد كلمه المرور مره اخري" value="" />
                        </div>
                        <?php } else {?>
                        <div class="form-group">
                        	<label class="control-label">كلمة المرور*</label>
                            <input type="password" class="form-control" name="password" placeholder="كلمة السر" value="" required="required" /> 
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">تأكيد كلمة المرور *</label>
                            <input type="password" class="form-control" name="confirm_password" placeholder="تأكيد كلمة السر " value="" required="required" />
                        </div>
						<?php } ?>
                        <div class="form-group">
                        	<label class="control-label">صورة الشخص او صوره الملف الشخصي</label>
                           	<div class="clearfix"></div>
                            <input type="file" class="pull-left clearfix" name="profile_image" placeholder="اختر صوره للشخص فضلآ" />
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
                        	<label class="control-label">Status*</label>
                            <select name="status" required="required" class="form-control" id="status" class="required">
									<option value="0">Select Status</option>
                                    <option <?php if($new_user->status == 'activate'){echo 'selected="selected"';} ?> value="activate">
									مفعل</option>
                                    <option <?php if($new_user->status == 'deactivate'){echo 'selected="selected"';} ?> value="deactivate">
									غير مفعل</option>
                                    <option <?php if($new_user->status == 'ban'){echo 'selected="selected"';} ?> value="ban">
									محظور</option>
                                    <option <?php if($new_user->status == 'suspend'){echo 'selected="selected"';} ?> value="suspend">
									ايقاف مؤقت وتعطيل مؤقت</option>                           	
	                            </select>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">نوع الحساب</label>
                            <select name="user_type" class="form-control" required="required" id="user_type" class="required">
									<option value="">اختر نوع الحساب الآن</option>
                                    <option <?php if($new_user->user_type == 'admin'){echo 'selected="selected"';} ?> value="admin">
									مدير</option>
                                    <?php $new_userlevel->userlevel_options($new_user->user_type); ?>                          	
	                            </select>
                         </div>
							  <?php 
						if(isset($_POST['edit_user'])){ 
							echo '<input type="hidden" name="edit_user" value="'.$_POST['edit_user'].'" />';
							echo '<input type="hidden" name="update_user" value="1" />'; 
						} else { 
							echo '<input type="hidden" name="add_user" value="1" />';
						} ?>
                        <div class="form-group">
                        	<input type="submit" value="<?php if(isset($_POST['edit_user'])){ echo 'تحديث المعلومات'; } else { echo 'اضف الآن وشكرآ';} ?>" class="btn btn-primary" />
                        </div>
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