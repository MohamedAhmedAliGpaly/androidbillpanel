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
	
	$new_store = new Store;
	
	//Profile Image Processing.
	if(isset($_FILES['store_logo']) && $_FILES['store_logo'] != '') { 
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["store_logo"]["name"]);
		$extension = end($temp);
		
		if ((($_FILES["store_logo"]["type"] == "image/gif")
		|| ($_FILES["store_logo"]["type"] == "image/jpeg")
		|| ($_FILES["store_logo"]["type"] == "image/jpg")
		|| ($_FILES["store_logo"]["type"] == "image/pjpeg")
		|| ($_FILES["store_logo"]["type"] == "image/x-png")
		|| ($_FILES["store_logo"]["type"] == "image/png"))
		&& ($_FILES["store_logo"]["size"] < 2048000)
		&& in_array($extension, $allowedExts)) {
 			 if ($_FILES["store_logo"]["error"] > 0) {
    			$message = "Return Code: " . $_FILES["store_logo"]["error"];
    	} else 	{
			$phrase = substr(md5(uniqid(rand(), true)), 16, 16);
	  if (file_exists("upload/" .$phrase.$_FILES["store_logo"]["name"])) {
	      $message = $_FILES["store_logo"]["name"] . " already exists. ";
      } else {
		  move_uploaded_file($_FILES["store_logo"]["tmp_name"],
		  "upload/".$phrase.str_replace(' ', '-',$_FILES["store_logo"]["name"]));
		  $store_logo = "upload/".$phrase.str_replace(' ', '-', $_FILES["store_logo"]["name"]);
	  } //if file not exist already.
	  
    } //if file have no error
  }//if file type is alright.
} //if image was uploaded processing.
/*Image processing ends here.*/

//User update store but don't change store logo. setting old logo 
if(isset($_POST['edit_store']) && $_POST['edit_store'] != '' && isset($_POST['update_store'])) { 
	if(isset($store_logo)) { 
		$store_logo = $store_logo;
	} else { 
		if(isset($_POST['already_logo'])) { 
			$store_logo = $_POST['already_logo'];
		} else { 
			$store_logo = '';
		}
	}//logo setting on update ends here.
	extract($_POST);
		if($store_name == '') { 
			$message = 'store name is required!';
		} else if($store_manual_id == '') { 
			$message = 'store unique manual id is required!';
		}  else {
		$message = $new_store->update_store($edit_store, $store_manual_id, $store_name, $business_type, $address1, $address2, $city, $state, $country, $zip_code, $phone, $email, $currency, $store_logo, $description);
		}
}//edit store query ends here.

if(isset($_POST['edit_store']) && $_POST['edit_store'] != '') { 
		$new_store->set_store($_POST['edit_store']);
	}//setting store data if editing.

//add store processing.
	if(isset($_POST['add_store']) && $_POST['add_store'] == '1') { 
		extract($_POST);
		if($store_name == '') { 
			$message = 'store name is required!';
		} else if($store_manual_id == '') { 
			$message = 'store unique manual id is required!';
		}  else {
		$message = $new_store->add_store($store_manual_id, $store_name, $business_type, $address1, $address2, $city, $state, $country, $zip_code, $phone, $email, $currency, $store_logo, $description);
		}
	}//add store processing ends here.
	
	if(isset($_POST['edit_store'])){ $page_title = 'Edit store'; } else { $page_title = 'Add New store';} //page title set.
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
                    <form action="<?php $_SERVER['PHP_SELF']?>" id="add_store" name="user" method="post" enctype="multipart/form-data">
                    		<div class="form-group">
                        	<label class="control-label">أسم المتجر*</label>
                            <input type="text" class="form-control" name="store_name" placeholder="أسم المتجر" value="<?php echo $new_store->store_name; ?>" required="required" />
                        	</div>
                            
                        <div class="form-group">
                        	<label class="control-label">اي دي او رقم المتجر*</label>
                            <input type="text" class="form-control" name="store_manual_id" placeholder="لو حابب تكتب اي دي هنا مهم اكتبه ويكون رقم فقط وغير مكرر" value="<?php echo $new_store->store_manual_id; ?>" required="required" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">نوع النشاط</label>
                            <input type="text" class="form-control" name="business_type" placeholder="نوع نشاطك التجاري هنا" value="<?php echo $new_store->business_type; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">العنوان 1</label>
                            <textarea class="form-control" name="address1" placeholder="عنوان 1"><?php echo $new_store->address1; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">العنوان 2</label>
                            <textarea class="form-control" name="address2" placeholder="عنوان 2"><?php echo $new_store->address2; ?></textarea>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">المدينة</label>
                            <input type="text" class="form-control" name="city" placeholder="المدينة" value="<?php echo $new_store->city; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">المنطقة/الحي</label>
                            <input type="text" class="form-control" name="state" placeholder="المنطقة او الحي او المحطة" value="<?php echo $new_store->state; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">المحافظه</label>
                            <input type="text" class="form-control" name="country" placeholder="المحافوظة" value="<?php echo $new_store->country; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">الرمز البريدي </label>
                            <input type="text" class="form-control" name="zip_code" placeholder="كود البريدي" value="<?php echo $new_store->zip_code; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">الهاتف</label>
                            <input type="text" class="form-control" name="phone" placeholder="رقم هاتفك" value="<?php echo $new_store->phone; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">البريد الآلكتروني</label>
                            <input class="form-control" type="text" name="email" placeholder="البريد الآلكتروني مهم" value="<?php echo $new_store->email; ?>" />
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">العملة</label>
                            <input class="form-control" type="text" name="currency" placeholder="عملة نشاطك التجاري" value="<?php echo $new_store->currency; ?>" />
                        </div>
             
                        <div class="form-group">
                        	<label class="control-label">لوجو او صوره للمكان او للنشاط ..</label>
                            	<div class="clearfix"></div>
                            	<input type="file" class="pull-left clearfix" name="store_logo" placeholder="صوره" />
                            	<?php
									if(isset($new_store->store_logo) && $new_store->store_logo != '') {
										echo '<a href="'.$new_store->store_logo.'" target="_blank"><img src="'.$new_store->store_logo.'" height="80" /></a><input type="hidden" name="already_logo" value="'.$new_store->store_logo.'">';	
									}
								?>
                                <div class="clearfix"></div>
                        </div>
                        
                        <div class="form-group">
                        	<label class="control-label">Description</label>
                            <textarea class="form-control" name="description" placeholder="store Description"><?php echo $new_store->description; ?></textarea>
                        </div>
                       
					  <?php 
						if(isset($_POST['edit_store'])){ 
							echo '<input type="hidden" name="edit_store" value="'.$_POST['edit_store'].'" />';
							echo '<input type="hidden" name="update_store" value="1" />'; 
						} else { 
							echo '<input type="hidden" name="add_store" value="1" />';
						} ?>
                        <div class="form-group">
                            <input type="submit" value="<?php if(isset($_POST['edit_store'])){ echo 'تحديث المتجر'; } else { echo 'أضف جديد';} ?>" class="btn btn-primary" />
                        </div>

                    </form>
                    <script type="text/javascript">
						$(document).ready(function() {
						// validate the register form
					$("#add_store").validate();
						});
                    </script>
            </div><!--admin wrap ends here.-->
<?php
	require_once('includes/sidebar.php');
?>
<?php require_once("includes/footer.php"); ?>