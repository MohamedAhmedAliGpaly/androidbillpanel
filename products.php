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
	
	if(partial_access('admin') || $store_access->have_module_access('products')) {} else { 
		HEADER('LOCATION: store.php?message=products');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	
	if(isset($_POST['delete_product']) && $_POST['delete_product'] != '') { 
		$message = $product->delete_product($_POST['delete_product']);
	}//delete account.
	
	$new_store->set_store($_SESSION['store_id']); //setting store.
	 
	$page_title = 'المنتجات والخدمات'; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.
	
    //display message if exist.
        if(isset($message) && $message != '') { 
            echo '<div class="alert alert-success">';
            echo $message;
            echo '</div>';
        }
    ?>
	<!--content here-->
	<p>
<a href="manage_products.php" class="btn btn-primary btn-default">أضف منتج او خدمه جديده</a>
<a href="products.php?alert=1" class="btn btn-primary btn-default">تنبيهات الخدمات والمنتجات</a>

    </p>
    <?php if(isset($_GET['alert']) && $_GET['alert'] == '1') { ?>
    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th><span lang="ar-eg">العنوان</span></th>
                <th><span lang="ar-eg">التفاصيل</span></th>
                <th><span lang="ar-eg">التنبيهات بالوحدات</span></th>
                <th><span lang="ar-eg">الوحدات المتوفرة</span></th>
            </tr>
        </thead>
        <tbody>
			<?php $product->products_alert();  ?>
        </tbody>
    </table>
    <div class="clearfix"></div><br />
<br />
 
    <p>
    <a href="products.php"><span lang="ar-eg">العوده الي المنتجات</span></a>
    </p>
    <!--content Ends here.-->
    <?php } else { ?>
    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th><span lang="ar-eg">العنوان</span></th>
                <th><span lang="ar-eg">التفاصيل</span></th>
                <th><span lang="ar-eg">الوحدات</span></th>
                <th><span lang="ar-eg">الآقسام</span></th>
                <th><span lang="ar-eg">الضريبة</span></th>
                <th><span lang="ar-eg">الصوره</span></th>
                <th><span lang="ar-eg">تنبيهات بالوحدات</span></th>
                <th><span lang="ar-eg">الوحدات المتوفرة</span></th>
                <?php if(partial_access('admin')) { ?>
                <th><span lang="ar-eg">التكلفة</span></th>
                <?php } ?>
                <th><span lang="ar-eg">سعر البيع</span></th>
                <?php if(partial_access('admin')) { ?><th class="no-print">
				<span lang="ar-eg">التعديل</span></th>
                <th class="no-print"><span lang="ar-eg">الحذف</span></th><?php } ?>
            </tr>
        </thead>
        <tbody>
			<?php $product->list_products();  ?>
        </tbody>
    </table> 
    <!--content Ends here.-->
	<?php } ?>
<?php
	require_once("includes/footer.php");
?>