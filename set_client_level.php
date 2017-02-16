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
	$product = new Product;
	
	if(partial_access('admin') || $store_access->have_module_access('price_level')) {} else { 
		HEADER('LOCATION: store.php?message=products');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	
	if(isset($_POST['update_client'])) { 
		extract($_POST);
		$message = $product->update_client_level($update_client, $price_level);
	}
	
	$new_store->set_store($_SESSION['store_id']); //setting store.
	 
	$page_title = 'ضبط مستوي البيع والشراء للعملاء وللآسماء'; //You can edit this to change your page title.
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
    <style type="text/css">
    	.rate { 
			width:70px;
		}
    </style>
	<!--content here-->
    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>الآسم بالكامل </th>
                <th>اسم النشاط </th>
                <th>موبايل</th>
                <th>هاتف</th>
                <th>بريد</th>
                <th>مستوي النشاط</th>
                <th>تحديث</th>
            </tr>
        </thead>
        <tbody>
			<?php $product->list_client_levels(); ?>
        </tbody>
    </table> 
    <!--content Ends here.-->

<?php
	require_once("includes/footer.php");
?>