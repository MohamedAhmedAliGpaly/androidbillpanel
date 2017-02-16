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
	
	if(isset($_POST['product_id']) && isset($_POST['update_rate'])) { 
		extract($_POST);
		$message = $product->update_product_rates($product_id, $update_rate, $default_rate, $level_1, $level_2, $level_3, $level_4, $level_5);
	}
	
	$new_store->set_store($_SESSION['store_id']); //setting store.
	 
	$page_title = 'ضبط المستويات والنقاط'; //You can edit this to change your page title.
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
                <th>أسم المنتج</th>
                <th>المعدل الآفتراضي</th>
                <th>المستوي الآول</th>
                <th>المستوي الثاني</th>
                <th>المستوي الثالث</th>
                <th>المستوي الرابع</th>
                <th>المستوي الخامس</th>
                <th>تحديث</th>
            </tr>
        </thead>
        <tbody>
			<?php $product->list_product_rates(); ?>
        </tbody>
    </table> 
    <!--content Ends here.-->

<?php
	require_once("includes/footer.php");
?>