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
		
	if(partial_access('admin') || $store_access->have_module_access('sales')) {} else { 
		HEADER('LOCATION: store.php?message=products');
		exit();
	}

	$page_title = "نقاط البيع"; //You can edit this to change your page title.
	$page = "pos";
	
	if(get_option($_SESSION['store_id'].'_default_warehouse') == '') { 
		$message = "Please select default warehouse to access POS going to Dashboard >> Store >> <a href='pos_settings.php'>Store Settings</a> so POS can process invoices from that warehouse because there is no option to select different warehouses, if you want to use different warehouse for each product please go to Sales >> <a href='manage_sale.php'>Add new</a>.";
		HEADER("LOCATION: pos_settings.php?message=".$message);
	}
	
	require_once('includes/header.php');
	
	if(isset($message) && $message != '') { 
		echo "<script type='text/javaScript'>
				alert('".$_GET['message']."');
			  </script>";
	}
	if(isset($_GET['message']) && $_GET['message'] != '') { 
		echo "<script type='text/javaScript'>
				alert('".$_GET['message']."');
			  </script>";
	}
	
	if(isset($_GET['sale_id'])) { ?>
	<script type="text/javascript">
		window.open('reports/view_pos_sale_invoice.php?sale_id=<?php echo $_GET['sale_id']; ?>', '_blank'); 
	</script>
<?php } ?>

<head>

<link rel="stylesheet" type="text/css" href="css/pos.css" media="all" />
<script type="text/javascript">
	jQuery(function($) {
		$('form[data-async]').on('submit', function(event) {
			
			var $form = $(this);
			var $target = $($form.attr('data-target'));

			$.ajax({
				type: $form.attr('method'),
				url: 'includes/otherprocesses.php',
				data: $form.serialize(),
				dataType: 'json',
 
			success: function(response) {
				var message = response.message;
				var client_options = response.client_options;
				var client_id = response.client_id;
			
				$('#client_id').html(client_options);
				$("#client_id").select2().select2('val', client_id);
				$('#success_message').html('<div class="alert alert-success">'+message+'</div>');
			}
		});
		event.preventDefault();
	});
});
</script>

<!-- Add new vendor modal starts here. -->
</head>

<div class="modal fade" id="addnewclient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
		×</span></button>
        <h4 class="modal-title" id="myModalLabel">اضف عميل جديد</h4>
      </div>
     	
         <div class="modal-body">
         <form data-async data-target="#addnewclient" method="POST" enctype="multipart/form-data" role="form">
         <div id="success_message"></div>
         		<table style="width:100%;">
                	<tr>
                    	<td>
                    <div class="form-group">
                        	الآسم بالكامل<label class="control-label"> *</label>
                            <input type="text" class="form-control" name="full_name" placeholder="أسم العميل بالكامل" value="" required="required" />
                      </div>
                      		</td>
                            <td>
                      <div class="form-group">
                        	اسم النشاط التجاري<label class="control-label"> </label>
                            <input type="text" class="form-control" name="business_title" placeholder="اسم الشركه اسم النطاق التجاري - الخ" value="" />
                      </div>
                      	</td>
                        </tr>
                        <tr>
                        <td>
                      <div class="form-group">
                        	موبايل
                            <input type="text" class="form-control" name="mobile" placeholder="رقم الموبايل " value="" />
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        	هاتف
                            <input type="text" class="form-control" name="phone" placeholder="رقم الهاتف " value="" />
                      </div>
                      </td>
                      </tr>
                      <tr>
                      	<td>
                      		<div class="form-group">
                        		العنوان
                        	    <input type="text" class="form-control" name="address" placeholder="العنوان" value="" />
                      		</div>
                      	</td>
                      <td>
                      <div class="form-group">
                        	المدينة
                            <input type="text" class="form-control" name="city" placeholder="المدينة" value="" />
                      </div>
                      </td>
                      </tr>
                      <tr>
                      <td>
                      <div class="form-group">
                        	المنطقة
                            <input type="text" class="form-control" name="state" placeholder="المنطقة مثال المعادي" value="" />
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        	رمز بريدي
                            <input type="text" class="form-control" name="zipcode" placeholder="رمز بريدي مثال 1234" value="" />
                      </div>
                      </td>
                      </tr>
                      <tr>
                      <td>
                      <div class="form-group">
                        	المحافظة
                            <input type="text" class="form-control" name="country" placeholder="المحافظة" value="" />
                      </div>
                      </td>
                      <td>
				     <div class="form-group">
                        	ايميل
                            <input type="text" class="form-control" name="email" placeholder="ايميل" value="" />
                      </div>
                      </td>
                      </tr>
                      <tr>
                      	<td>
                      <div class="form-group">
                        	درجه الآسعار
                            <select name="price_level" class="form-control">
                            	<option value="default_rate">الآفتراضي</option>
                                <option value="level_1">Level 1</option>
                                <option value="level_2">Level 2</option>
                                <option value="level_3">Level 3</option>
                                <option value="level_4">Level 4</option>
                                <option value="level_5">Level 5</option>
                            </select>
                      </div>
                      	</td>
                        <td>
                      <div class="form-group">
                        	ملاحظات
                            <textarea class="form-control" name="notes"></textarea>
                      </div>
                      	</td>
                        	</tr>
                      </table>	
                        <input type="hidden" name="add_client" value="1" />
                         <input type="submit" id="submit" class="btn btn-primary" value="اضف العميل الآن">
                      </form>   
                              </div>
      <div class="modal-footer">
      	  <button type="button" class="btn btn-default" data-dismiss="modal">
			أغلاق وشكرآ</button>
      </div>
    </div>
  </div>
</div>
<!--add new vendor modal ends here.-->

<script type="text/javascript">
	$('body').ready(function(){ 
		$("input[name='to_auto']").focus();
	});
</script>
    
  	<div class="point_of_sale">
    	<!--Left sidebar-->
        <div class="pos_left">
        <form action="includes/process_sale.php" method="post">
      	  <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" />
      	  <input type="hidden" name="custom_inv_no" value="POS Sale" />
     	   <input type="hidden" name="memo" value="Sale processed from POS Module" >
        
        	<table>
            	<tr>
                	<td width="370px">
                        <div class="form-group">
                            <select name="client_id" id="client_id" class="autofill" style="width:100%">
                                <option value="">اختر الآسم او رقم الموبايل للعميل</option>
                                <?=$client->client_options(get_option($_SESSION['store_id'].'_default_customer')); ?>	
                        	</select>
                    	</div>
                    </td>
                    <td><div class="form-group"><a data-toggle="modal" href="#addnewclient" style="font-size:22px;" title="Add new client"><i class="glyphicon glyphicon-plus-sign"></i></a></div></td>
                </tr>

                <tr>
                	<td colspan="2">
                    	<div class="form-group">
            			    <input type="text" class="form-control" name="to_auto" id="to" placeholder="اسم المنتج او الخدمه او البار كود" value="" />
          				</div>
                    </td>
                </tr>
            </table>
            
            <div class="items_container">
            <table class="table" id="items">
            	<tr>
                	<th><i class="glyphicon glyphicon-trash" title="Delete item"></i></th>
                    <th>المنتجات</th>
                    <th>الكمية/العدد</th>
                    <th>الضريبة</th>
                    <th>السعر</th>
                    <th>السعر الكلي</th>
                </tr>
                <tr class="item-row">
                </tr>
            </table>
            </div>
            
            <div class="calculations">
            	<div class="styletotal">السعر الكلي: <span class="totalamount">0.00</span> 
					&nbsp;&nbsp;&nbsp;الضريبة: <span class="taxamount">0.00</span> &nbsp;&nbsp;&nbsp;العناصر: <span class="numberofitems">
					0</span></div>
                <div class="paymentamount">أستلام: <span id="grand_total" class="receiveable">
					0.00</span></div>
                <table>
                	<tr>
                    	<td>
                        <select name="payment_method" class="form-control">
                			<option value="0">Select payment method</option>
                    		<option value="cash" selected="selected">Cash</option>
                			<option value="credit_card">Credit Card</option>
                            <option value="credit">Credit</option>
                		</select>
                        </td>
                        <td>
                        <input type="hidden" name="sale_type" value="pos_sale" />
                        <input type="submit" class="btn btn-primary" name="save" value="Save" /> 
						&nbsp;<input type="submit" class="btn btn-primary" name="print" value="Print" />
                        </td>
                    </tr>
                </table>
            </div>
		</form>
        </div>
        <!--leftSide bar Ends here-->
		<div class="rightsidepos">
        	<select name="product_cat_id" id="product_cat_id" class="autofill" style="width:100%">
            	<option value="all">From all categories</option>
                <?php $product_category->category_options('all'); ?>
            </select>
            <div id="productscontainer">
             	<?php $_SESSION['category_id'] = 'all'; echo $product->list_pos_products($_SESSION['category_id']); ?>
            </div><!--productsContainer Ends here-->
        	
        </div>
  </div>
<?php
	require_once("includes/footer.php");
?>