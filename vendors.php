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
	$vendor = new Vendor;
	
	if(partial_access('admin') || $store_access->have_module_access('vendors')) {} else { 
		HEADER('LOCATION: store.php?message=warehouse');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	
	//delete store if exist.
	if(isset($_POST['delete_vendor']) && $_POST['delete_vendor'] != '') { 
		$message = $vendor->delete_vendor($_POST['delete_vendor']);
	}//delete account.
	
	$new_store->set_store($_SESSION['store_id']); //setting store.
	 
	$page_title = 'الباعة'; //You can edit this to change your page title.
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
	<!--content here-->
    <p>
	    <a href="manage_vendor.php" class="btn btn-primary btn-default">أضف جديد وشكرآ</a>
    </p>
    
    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>الآسم بالكامل </th>
                <th>الشخص الذي يمكن الاتصال به</th>
                <th>موبايل</th>
                <th>هاتف</th>
                <th>عنوان</th>
                <th>مقدم من</th>
                <th>رصيد</th>
                <?php if(partial_access('admin')) { ?>
                <th>تعديل</th>
                <th>حذف</th>
				<?php } ?>
            </tr>
        </thead>
        <tbody>
			<?php $vendor->list_vendors(); ?>
        </tbody>
    </table> 
    <!--content Ends here.-->

<?php
	require_once("includes/footer.php");
?>