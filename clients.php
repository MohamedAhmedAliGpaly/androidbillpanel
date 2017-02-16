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
	$client = new Client;
	
	if(partial_access('admin') || $store_access->have_module_access('clients')) {} else { 
		HEADER('LOCATION: store.php?message=warehouse');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	
	//delete store if exist.
	if(isset($_POST['delete_client']) && $_POST['delete_client'] != '') { 
		$message = $client->delete_client($_POST['delete_client']);
	}//delete account.
	
	$new_store->set_store($_SESSION['store_id']); //setting store.
	 
	$page_title = 'العملاء والحسابات وبأمكانك استخدامها بالآسم المناسب لعملك'; //You can edit this to change your page title.
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
	    <a href="manage_client.php" class="btn btn-primary btn-default">اضفط جديد الآن </a>
    </p>
    
    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>الآسم بالكامل</th>
                <th>الآسم التجاري</th>
                <th>موبايل</th>
                <th>هاتف</th>
                <th>عنوان</th>
                <th>ايميل</th>
                <th>درجات الاسعار </th>
                <th>الرصيد </th>
                <?php if(partial_access('admin')) { ?>
                <th>تعديل</th>
                <th>حذف</th>
				<?php } ?>
            </tr>
        </thead>
        <tbody>
			<?php $client->list_clients(); ?>
        </tbody>
    </table> 
    <!--content Ends here.-->

<?php
	require_once("includes/footer.php");
?>