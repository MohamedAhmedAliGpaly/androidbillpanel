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
	$sale_return = new SaleReturn;
	$client = new Client;
	$products = new Product;
	$warehouses = new Warehouse;
	$return_reason = new Returnreason;
		
	if(partial_access('admin') || $store_access->have_module_access('returns')) {} else { 
		HEADER('LOCATION: store.php?message=products');
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	

	if(isset($_POST['edit_purchase'])){ $page_title = 'تعديل مرتجع'; } else { $page_title = 'أضف مرتجع جديد';}; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.
?>

<?php if(isset($_GET['sale_rt_id'])) { ?>
	<script type="text/javascript">
		window.open('reports/view_sale_return_invoice.php?sale_rt_id=<?php echo $_GET['sale_rt_id']; ?>', '_blank'); 
	</script>
<?php } ?>
                	<?php
					//display message if exist.
						if(isset($_GET['message']) && $_GET['message'] != '') { 
							echo '<div class="alert alert-success">';
							echo $_GET['message'];
							echo '</div>';
						}
						if(isset($message) && $message != '') { 
							echo '<div class="alert alert-success">';
							echo $message;
							echo '</div>';
						}
					?>
<style type="text/css">
textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delme:hover { background-color:#EEFF88; }

#items input[type=text] {width:60px;border:0px;}
.delete-wpr { position: relative; }
.delme { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>                    
<form action="includes/process_sale_return.php" method="post">
      <div class="row">              
        <div class="col-sm-5">
    <table border="0" cellpadding="5">
        	<tr>
            	<td width="110">التاريخ</td>
                <td width="300"><input type="text" name="date" class="form-control datepick" readonly="readonly" value="<?php echo date('Y-m-d'); ?>" /></td>
            </tr>
            
            <tr>
            	<td>فاتورة فرعية او رقم فاتوره متعلقة</td>
                <td><input type="text" placeholder="رقم فاتوره البيع" name="sale_inv_no" class="form-control" /></td>
            </tr>
            
            <tr>
            	<td>مذكرة/ملاحظات</td>
                <td><textarea placeholder="ملاحظاتك هنا" name="memo" class="form-control"></textarea></td>
            </tr>
            
            <tr>
            	<th>اختر العميل</th>
                <td>
                	<select name="client_id" id="client_id" class="autofill" style="width:100%">
                    <option value="">اختر العميل او الآسم عبر الهاتف او الآسم</option>
                    <?=$client->client_options($client->client_id); ?>	
                    </select>	
                </td>
            </tr>
            
            <tr>
            	<th>سبب العودة</th>
                <td>
                	<select name="reason_id" id="reason_id" class="autofill" style="width:100%">
                    <option value="">اختر سبب الآرجاع</option>
                    <?php 
						//accept parameter in case of edit.
						$return_reason->reason_options('0'); ?>	
                    </select>	
                </td>
            </tr>
            
        </table>
       </div><!--left-side-form ends here.-->
<script type="text/javascript">
function update_total() { 
	var grand_total = 0;
	i = 1;	
	$('.total').each(function(i) {
        var total = $(this).html();
		total = parseFloat(total);
		grand_total = total+grand_total;
    });
	$('#grand_total').html(grand_total.toFixed(2));
}//Update total function ends here.

function getProduct() {
	$.ajax({
	 data: {
	  product_id: $("#product_id").val(),
	  warehouse_id: $("#warehouse_id").val()
	 },
	 type: 'POST',
	 dataType: 'json',
	 url: 'includes/get_purchase_data.php',
	 success: function(response) {
	   var product_name = response.product_name;
	   var product_manual_id = response.product_manual_id;
	   var warehouse_name = response.warehouse_name;
	   
	   var product_id = $("#product_id").val();
	   var quantity = $("#quantity").val();
	   var selling_price = $("#selling_price").val();
	   var tax_rate = $("#tax_rate").val();
	   var warehouse_id = $("#warehouse_id").val();
	   
	   var total_price = quantity*selling_price;
	   var total_tax = quantity*tax_rate;
	   
	   var total_p = total_price+total_tax;
	   
	   var content_1 = "<tr class='item-row'><td><div class='delete-wpr'>"+product_manual_id+"<input type='hidden' name='product_id[]' value='"+product_id+"'><a class='delme' href='javascript:;' title='Remove row'>X</a></div></td>";
	   var content_2 = "<td>"+product_name+"</td>";
	   var content_3 = "<td><input type='text' readonly='readonly' class='qty' name='qty[]' value='"+quantity+"'></td>";
	   var content_4 = "<td><input type='text' readonly='readonly' class='cost' name='price[]' value='"+selling_price+"'></td>";
	   var content_5 = "<td><input type='text' readonly='readonly' class='cost' name='tax[]' value='"+tax_rate+"'></td>";
	   var content_6 = "<td>"+warehouse_name+"<input type='hidden' name='warehouse_id[]' value='"+warehouse_id+"'></td>";
	   var content_7 = 	"<td class='total'>"+total_p+"</td></tr>";   
	   
	   $(".item-row:first").before(content_1+content_2+content_3+content_4+content_5+content_6+content_7);
	   
	   $("#product_id").select2("val", null);
	   $("#quantity").val('');
	   $("#selling_price").val('');
	   $("#tax_rate").val(''); 
	   $("#warehouse_id").select2("val", null);
	   update_total();
	   }
	});
}
	$(document).ready(function(e) {
    	$("#add_product").click(function() {
			var client_id = $('#client_id').val();
			var reason_id = $('#reason_id').val();
			var product_id = $("#product_id").val();
	  	 	var quantity = $("#quantity").val();
	   		var selling_price = $("#selling_price").val();
	   		var tax_rate = $("#tax_rate").val();
			
			if(client_id == '' || client_id == 0) { 
				alert('Please select client.');
			} else if(reason_id == '' || reason_id == 0) { 
				alert('Please select return reason.');
			} else if(product_id == '' || quantity == '' || selling_price == '' || tax_rate == '') { 
				alert('Please set product, quantity, selling price and tax rate.');
			} else { 
				//if client id and reason id is set this will proceed.
				getProduct();
			}
		});    
	//delete Row.
	$('#items').on('click', '.delme', function() {
		   $(this).parents('.item-row').remove();
		   update_total();
		});
    });
	
</script>
       <div class="col-sm-7">
       		<h4>أضف المنتج الآن</h4>
            <table border="0" cellpadding="5">
				<tr>
                    <td>أختر من المنتجات والخدمات </td>
                    <td width="400">
                    <select name="product" id="product_id" style="width:400px;" class="autofill">
                        <option value="">اختر معرف العنصر او الآسم</option>
                        <?php $products->product_options($products->product_id); ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>العدد/الكمية</td>
                    <td width="400">
                    	<input type="text" name="quantity" id="quantity" class="form-control" placeholder="اكتب العدد او الكمية" />
                    </td>
                </tr>
                <tr>
                    <td>سعر البيع</td>
                    <td width="400">
                    	<input type="text" name="selling_price" id="selling_price" class="form-control" placeholder="اكتب سعر البيع" />
                    </td>
                </tr>
                <tr>
                    <td>ضريبة لكل منتج؟</td>
                    <td width="400">
                    	<input type="text" name="cost" id="tax_rate" class="form-control" placeholder="ادخل ضريبة مثال 1" />
                    </td>
                </tr>
                <tr>
                    <td>اختر المخزن</td>
                    <td>
                    	<select name="warehouse" id="warehouse_id" class="autofill" style="width:400px;">
                    		<option value="0">اختر المخزن من هنا</option>
                        	<?php $warehouses->warehouse_options($warehouses->warehouse_id); ?>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td><div id="add_product" class="btn btn-default">أضغط هنا الآن للآضافة</div></td>
                </tr>
            </table>
       </div><!--add product Section-->
	</div><!--row ends here.-->
    <br />
    <div class="row">
    	<div class="col-sm-9">
        	<table id="items" class="table table-condensed table-hover table-bordered">
            	<tr>
                    <th>Id</th>
                    <th>أسم الخدمه او المنتج</th>
                    <th width="60">العدد/الكمية</th>
                    <th width="60">السعر</th>
                    <th width="60">الضريبة</th>
                    <th>المخزن</th>
                    <th>الكلي</th>
                </tr>
                
                <tr class='item-row'>
                    <td colspan="6">مدخلات وفواتير</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
        	<div class="well">
            	<h4>المبلغ الإجمالي: <span id="grand_total">0.00</span></h4>
        		<h5>طريقة الدفع</h5>
                <select name="payment_method" class="form-control">
                	<option value="0">اختر طريقة الدفع من القائمة</option>
                    <option value="credit">فاتورة ارجاع</option>
                    <option value="cash">أسترجاع النقود</option>
                </select><br />
            <input type="submit" class="btn btn-primary" name="save" value="حفظ" /> 
				&nbsp;<input type="submit" class="btn btn-primary" name="print" value="طباعة" />
        	</div>
        </div>
    </div><!--product_Detail_row ends here.-->
    </form>
                       
<?php
	require_once("includes/footer.php");
?>