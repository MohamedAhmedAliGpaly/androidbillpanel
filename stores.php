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
	//creating store object.
	
	if(isset($_GET['message']) && $_GET['message'] != '') { 
		$message = 'من فضلك اختر المتجر واضغط علي ولوج حتي تستطيع البدء في العمل';
	}//Message ends here select store
	
	//delete store if exist.
	if(isset($_POST['delete_store']) && $_POST['delete_store'] != '') { 
		$message = $new_store->delete_store($_POST['delete_store']);
	}//delete account.
		
	$page_title = "المتاجر والمحلات والخدمات او الشركات الخاص بي - النظام يعمل بأمكانيه وضع واداره اكثر من متجر :)"; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.

    //display message if exist.
        if(isset($message) && $message != '') { 
            echo '<div class="alert alert-success">';
            echo $message;
            echo '</div>';
        }
    ?>
    <?php if(partial_access('admin')) { ?><p>
	    <a href="manage_store.php" class="btn btn-primary btn-default">اضف متجر او محل او نشاط جديد مختلف </a>
    </p><?php } ?>

    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>اي دي</th>
                <th>الآسم</th>
                <th>النوع</th>
                <th>المدينة</th>
                <th>الهاتف</th>
                <th>البريد</th>
                <th>العملة</th>
                <th>لوجو</th>
                <th>خيارات ادارية</th>
                <?php if(partial_access('admin')) { ?><th>تعديل</th>
                <th>حذف</th><?php } ?>
            </tr>
        </thead>
        <tbody>
           <?php echo $new_store->list_stores(); ?>
        </tbody>
    </table>
                        
<?php
	require_once("includes/footer.php");
?>