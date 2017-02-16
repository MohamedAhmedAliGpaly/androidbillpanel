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
	//creating store object.

	if(isset($_POST['user_id']) && isset($_POST['store_id'])) { 
		if($_POST['user_id'] == '' && $_POST['store_id'] == '') { 
			$message = 'Store id and user id required. Please select.';
		} else { 
			$message =  $store_access->add_store_access($_POST['user_id'], $_POST['store_id'], $_POST['access_to']);
		}
	}//add store access ends here.
	//delete access
	if(isset($_POST['delete_access']) && $_POST['delete_access'] != '') { 
		$message = $store_access->delete_access($_POST['delete_access']);
	}
	//delete access ends here.	
	$page_title = "أذونات الحسابات في المتاجر من مشرفين او محاسبين او بائعين الخ"; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.
    	
	//display message if exist.
	if(isset($message) && $message != '') { 
		echo '<div class="alert alert-success">';
		echo $message;
		echo '</div>';
	}
     ?>

                    <h3>أذونات الحسابات في المتاجر من مشرفين او محاسبين او 
					بائعين الخ</h3>
                    <form name="grand_access" id="grand_access" action="" method="post">
                    <table cellpadding="10" style="padding:10px;" border="0">
                    	<tr>
                        	<th style="padding:10px;"><span lang="ar-eg">أختر 
							الحساب للموظف من هنا</span></th>
                            <th style="padding:10px;"><span lang="ar-eg">اختر 
							النظام او المتجر</span></th>
                        </tr>
                        <tr>
                        	<td style="padding:10px;">
                            	<select class="form-control" name="user_id" required="required">
                                	<option value="">أختر الحساب</option>
                                    <?php $new_user->subscriber_options(); ?>
                                </select>
                            </td>
                            <td style="padding:10px;">
                            	<select class="form-control" name="store_id" required="required">
                                	<option value="">اختر المتجر من الثائمة هنا</option>
                                    <?php $new_store->store_options(); ?>
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:10px;">
                                <strong><span lang="ar-eg">ادراج بأداره ومسؤلية</span>:
								</strong>
                                    <input type="checkbox" name="access_to[]" value="sales" /> 
								<span lang="ar-eg">المبيعات</span>&nbsp;&nbsp;
                                    <input type="checkbox" name="access_to[]" value="purchase" /> 
								<span lang="ar-eg">المشتريات</span>&nbsp;&nbsp;
                                    <input type="checkbox" name="access_to[]" value="vendors" /> 
								<span lang="ar-eg">البائعين</span>&nbsp;&nbsp;
                                    <input type="checkbox" name="access_to[]" value="clients" /> 
								<span lang="ar-eg">الحسابات</span>&nbsp;&nbsp;
                                    <input type="checkbox" name="access_to[]" value="products" /> 
								<span lang="ar-eg">المنتجات والخدمات</span>&nbsp;&nbsp;
                                    <input type="checkbox" name="access_to[]" value="warehouse" /> 
								<span lang="ar-eg">المخازن</span>&nbsp;&nbsp;
                                    <input type="checkbox" name="access_to[]" value="returns" /> 
								<span lang="ar-eg">المسترجعات</span>&nbsp;
                                    <input type="checkbox" name="access_to[]" value="price_level" /> 
								<span lang="ar-eg">درجات الاسعار</span>&nbsp;
                                    <input type="checkbox" name="access_to[]" value="reports" /> 
								<span lang="ar-eg">التقارير</span>
                                    <input type="checkbox" name="access_to[]" value="expenses" /> 
								<span lang="ar-eg">النفقات</span>
                                </td>
                            </tr>
                            <tr>
                            	<td style="padding:10px;"><input type="submit" class="btn btn-primary btn-sm" value="Grant Access" /></td>
                                <td>&nbsp;</td>
                            </tr>
                        </tr>
                    </table>
                    </form>
                    <br />
					<br />
					<table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">	
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th><span lang="ar-eg">اسم الحساب</span>&nbsp;</th>
                                <th><span lang="ar-eg">البريد</span></th>
                                <th><span lang="ar-eg">اذونات الدخول</span></th>
                                <th><span lang="ar-eg">موديل</span></th>
                                <th><span lang="ar-eg">حذف</span></th>
                            </tr>
                        </thead>
                        <tbody>
							<?php $store_access->list_store_access(); ?>
                        </tbody>
                    </table>
                  <script type="text/javascript">
						$(document).ready(function() {
						// validate the register form
					$("#grand_access").validate();
						});
                    </script>
<?php
	require_once("includes/footer.php");
?>