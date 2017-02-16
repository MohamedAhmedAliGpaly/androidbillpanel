<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
<?php
	include('system_load.php');
	//This loads system.
	//user Authentication.
	authenticate_user('subscriber');
	//creating company object.
	
	if(partial_access('admin') || $store_access->have_module_access('clients')) {} else { 
		HEADER('LOCATION: store.php?message=products');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	
	
	//updating user level
	if(isset($_POST['update_client'])) { 
		extract($_POST);
		$message = $client->update_client($edit_client, $full_name, $business_title, $mobile, $phone, $address, $city, $state, $country, $email, $price_level, $notes);
	}//update ends here.
	
	//setting level data if updating or editing.
	if(isset($_POST['edit_client'])) {
		$client->set_client($_POST['edit_client']);	
	} //level set ends here
	
	if(isset($_POST['add_client'])) {
		$add_client = $_POST['add_client'];
		if($add_client == '1') { 
			extract($_POST);
			$message = $client->add_client($add_client, $full_name, $business_title, $mobile, $phone, $address, $city, $state, $country, $email, $price_level, $notes);
		}
	}//isset add level
	
	if(isset($_POST['edit_client'])){ $page_title = 'Edit Client'; } else { $page_title = 'Add Client';}; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.

	//display message if exist.
		if(isset($message) && $message != '') { 
			echo '<div class="alert alert-success">';
			echo $message;
			echo '</div>';
		}
?>
                    <div class="col-sm-12">
                    <form action="<?php $_SERVER['PHP_SELF']?>" id="add_client" name="level" method="post">
                    <div class="form-group">
                        	<label class="control-label">* الآسم بالكامل او الآول</label>
                            <input type="text" class="form-control" name="full_name" placeholder="اكتب اسم العميل بالكامل" value="<?php echo $client->full_name; ?>" required="required" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">اسم النشاط او الشركه </label>
                            <input type="text" class="form-control" name="business_title" placeholder="الآسم التجاري" value="<?php echo $client->business_title; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">الهاتف</label>
                            <input type="text" class="form-control" name="mobile" placeholder="رقم الهاتف" value="<?php echo $client->mobile; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">هاتف اخر او ارضي</label>
                            <input type="text" class="form-control" name="phone" placeholder="رقم الهاتف " value="<?php echo $client->phone; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">العنوان</label>
                            <input type="text" class="form-control" name="address" placeholder="العنوان الآول" value="<?php echo $client->address; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">المدينة</label>
                            <input type="text" class="form-control" name="city" placeholder="المدينة" value="<?php echo $client->city; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">المنطقة</label>
                            <input type="text" class="form-control" name="state" placeholder="مثال المعادي" value="<?php echo $client->state; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">المحافظة</label>
                            <input type="text" class="form-control" name="country" placeholder="المحاظة مثال القاهرة" value="<?php echo $client->country; ?>" />
                      </div>
				     <div class="form-group">
                        	<label class="control-label">الآيميل</label>
                            <input type="text" class="form-control" name="email" placeholder="ايميل" value="<?php echo $client->email; ?>" />
                      </div>
                      <div class="form-group">
                        	<label class="control-label">مستوي الآسعار </label>
                            <select name="price_level" class="form-control">
                            	<option <?php if($client->price_level == 'default_rate') echo 'selected="selected"'; ?> value="default_rate">
								Default</option>
                                <option <?php if($client->price_level == 'level_1') echo 'selected="selected"'; ?> value="level_1">
								Level 1</option>
                                <option <?php if($client->price_level == 'level_2') echo 'selected="selected"'; ?> value="level_2">
								Level 2</option>
                                <option <?php if($client->price_level == 'level_3') echo 'selected="selected"'; ?> value="level_3">
								Level 3</option>
                                <option <?php if($client->price_level == 'level_4') echo 'selected="selected"'; ?> value="level_4">
								Level 4</option>
                                <option <?php if($client->price_level == 'level_5') echo 'selected="selected"'; ?> value="level_5">
								Level 5</option>
                            </select>
                      </div>
                      <div class="form-group">
                        	<label class="control-label">تنبيهات وملاحظات</label>
                            <textarea class="form-control" name="notes"><?php echo $client->notes; ?></textarea>
                      </div>	
						<?php 
						if(isset($_POST['edit_client'])){ 
							echo '<input type="hidden" name="edit_client" value="'.$_POST['edit_client'].'" />';
							echo '<input type="hidden" name="update_client" value="1" />'; 
						} else { 
							echo '<input type="hidden" name="add_client" value="1" />';
						} ?>
                        <input type="submit" class="btn btn-primary" value="<?php if(isset($_POST['edit_client'])){ echo 'تعديل'; } else { echo 'اضف جديد';} ?>" />
                    </form>
                    <script>
						$(document).ready(function() {
							// validate the register form
							$("#add_category").validate();
						});
                    </script>
                   </div><!--left-side-form ends here.-->
                   
<?php
	require_once("includes/footer.php");
?>