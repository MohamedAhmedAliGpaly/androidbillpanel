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
	$new_store = new Store;
	$store_access = new StoreAccess;
	$product_category = new ProductCategory;
	
	if(partial_access('admin') || $store_access->have_module_access('products')) {} else { 
		HEADER('LOCATION: store.php?message=products');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	
	
	//updating user level
	if(isset($_POST['update_category'])) { 
		extract($_POST);
		$message = $product_category->update_category($edit_category,$category_name, $category_description);
	}//update ends here.
	//setting level data if updating or editing.
	if(isset($_POST['edit_category'])) {
		$product_category->set_category($_POST['edit_category']);	
	} //level set ends here
	if(isset($_POST['add_category'])) {
		$add_category = $_POST['add_category'];
		if($add_category == '1') { 
			extract($_POST);
			$message = $product_category->add_category($category_name, $category_description);
		}
	}//isset add level
	
	if(isset($_POST['edit_category'])){ $page_title = 'تعديل الآقسام'; } else { $page_title = 'اضافة قسم او علامه تجاريه او نوع جديد';}; //You can edit this to change your page title.
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
                    <div class="col-sm-12">
                    <form action="<?php $_SERVER['PHP_SELF']?>" id="add_category" name="level" method="post">
                    <div class="form-group">
                        	اسم القسم او الفئة او النوع<label class="control-label"> 
							*</label>
                            <input type="text" class="form-control" name="category_name" placeholder="ادخل الآسم هنا مثال موبايلات او كمبيوتر او انترنت" value="<?php echo $product_category->category_name; ?>" required="required" />
                      </div>
                      
                     <div class="form-group">
                        	معلومات عن ال<label class="control-label">قسم او 
							النوع او الشركه او العلامه التجارية&nbsp; </label>
                            <textarea class="form-control" placeholder="تفاصيل اضافيه مثلآ هذا قسم للهواتف المستعملة" name="category_description"><?php echo $product_category->category_description; ?></textarea>
                      </div>
						<?php 
						if(isset($_POST['edit_category'])){ 
							echo '<input type="hidden" name="edit_category" value="'.$_POST['edit_category'].'" />';
							echo '<input type="hidden" name="update_category" value="1" />'; 
						} else { 
							echo '<input type="hidden" name="add_category" value="1" />';
						} ?>
                        <input type="submit" class="btn btn-primary" value="<?php if(isset($_POST['edit_category'])){ echo 'التحديث'; } else { echo 'اضف جديد الآن ';} ?>" />
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