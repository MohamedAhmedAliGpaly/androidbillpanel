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
	}
	
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: stores.php?message=1');
	} //select company redirect ends here.
	

	if(isset($_POST['edit_purchase'])){ $page_title = 'تعديل البيع'; } else { $page_title = 'إضافة بيع';}; //You can edit this to change your page title.
	require_once("includes/header.php"); //including header file.
?>

<?php if(isset($_GET['sale_id'])) { ?>
	<script type="text/javascript">
		window.open('reports/view_sale_invoice.php?sale_id=<?php echo $_GET['sale_id']; ?>', '_blank'); 
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
<div class="modal fade" id="addnewclient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
		×</span></button>
        <h4 class="modal-title" id="myModalLabel">أضف شاري او عميل جديد</h4>
      </div>
     	
         <div class="modal-body">
         <form data-async data-target="#addnewclient" method="POST" enctype="multipart/form-data" role="form">
         <div id="success_message"></div>
         		<table style="width:100%;">
                	<tr>
                    	<td>
                    <div class="form-group">
                        	<label class="control-label">الآسم بالكامل*</label>
                            <input type="text" class="form-control" name="full_name" placeholder="ادخل الآسم هنا " value="" required="required" />
                      </div>
                      		</td>
                            <td>
                      <div class="form-group">
                        	الاسم التجاري<label class="control-label"> </label>
                            <input type="text" class="form-control" name="business_title" placeholder="اسم الشركه " value="" />
                      </div>
                      	</td>
                        </tr>
                        <tr>
                        <td>
                      <div class="form-group">
                        	رقم الهاتف
                            <input type="text" class="form-control" name="mobile" placeholder="رقم الهاتف " value="" />
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        	هاتف
                            <input type="text" class="form-control" name="phone" placeholder="هاتف ارضي او اضافي" value="" />
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
                            <input type="text" class="form-control" name="city" placeholder="المحافظة" value="" />
                      </div>
                      </td>
                      </tr>
                      <tr>
                      <td>
                      <div class="form-group">
                        	المنطقة او الحي
                            <input type="text" class="form-control" name="state" placeholder="المنطة او الحي" value="" />
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        	كود البريدي
                            <input type="text" class="form-control" name="zipcode" placeholder="كود بريدي " value="" />
                      </div>
                      </td>
                      </tr>
                      <tr>
                      <td>
                      <div class="form-group">
                        	المحافظة
                            <input type="text" class="form-control" name="country" placeholder="المنطقة" value="" />
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
                        	مستوي الاسعار<label class="control-label"> </label>
                            <select name="price_level" class="form-control">
                            	<option value="default_rate">Default</option>
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
                         <input type="submit" id="submit" class="btn btn-primary" value="اضافه الآن  ">
                      </form>   
                              </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">أغلاق</button>
      </div>
    </div>
  </div>
</div>
<!--add new vendor modal ends here.-->

                    
<form action="includes/process_sale.php" method="post">
      <div class="row">              
        <div class="col-sm-5">
        <table border="0" cellpadding="5">
        	<tr>
            	<td width="110">التاريخ</td>
                <td width="300"><input type="text" name="date" class="form-control datepick" readonly="readonly" value="<?php echo date('Y-m-d'); ?>" /></td>
            </tr>
            <tr>
            	<td>فاتورة مخصصه#</td>
                <td><input type="text" placeholder="ادخل رقم الفاتوره المخصصه" name="custom_inv_no" class="form-control" /></td>
            </tr>
            
            <tr>
            	<td>ملاحظات</td>
                <td><textarea placeholder="ادخل ملاحظات هنا عن عمليه البيع او العميل" name="memo" class="form-control"></textarea></td>
            </tr>
            
            <tr>
            	<th>أختر العميل او املوظف</th>
                <td>
                	<select name="client_id" id="client_id" class="autofill" style="width:100%">
	                    <option value="">اختر اسم الحساب من رقم الهاتف او الآسم</option>
	                    <?=$client->client_options($client->client_id); ?>	
                    </select>	
                </td>
            </tr>
            
            <tr>
            	<td>&nbsp;</td>
                <td><a class="btn btn-default btn-xs" data-toggle="modal" href="#addnewclient">
				أضغط هنا واضف بيانات العميل او بيانات الموظف</a></td>
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

function get_warehouse() {
	$.ajax({
	 data: {
	  product_id: $("#product_id").val()
	 },
	 type: 'POST',
	 dataType: 'json',
	 url: 'includes/get_sale_data.php',
	 success: function(response) {
	   var warehouse_options = response.warehouse_options;
	   var default_warehouse = response.default_warehouse;
	   $('#warehouse_id').html(warehouse_options);
	   $("#warehouse_id").select2().select2('val', default_warehouse);
	   }
	});
}

function getProduct() {
	$.ajax({
	 data: {
	  product_id: $("#product_id").val(),
	  client_id: $("#client_id").val(),
	  warehouse_id: $("#warehouse_id").val()
	 },
	 type: 'POST',
	 dataType: 'json',
	 url: 'includes/get_sale_data.php',
	 success: function(response) {
	   var product_name = response.product_name;
	   var product_manual_id = response.product_manual_id;
	   var warehouse_name = response.warehouse_name;
	   var product_price = response.product_price;
	   var tax = response.tax;
	   
	   var product_id = $("#product_id").val();
	   var quantity = $("#quantity").val();
	   var warehouse_id = $("#warehouse_id").val();	   
		   
	   var content_1 = "<tr class='item-row'><td><div class='delete-wpr'>"+product_manual_id+"<input type='hidden' name='product_id[]' value='"+product_id+"'><a class='delme' href='javascript:;' title='Remove row'>X</a></div></td>";
	   var content_2 = "<td>"+product_name+"</td>";
	   var content_3 = "<td><input type='text' readonly='readonly' class='qty' name='qty[]' value='"+quantity+"'></td>";
	   
	   var content_4 = "<td><input type='text' readonly='readonly' class='cost' name='selling_price[]' value='"+product_price+"'></td>";
	   var content_5 = "<td><input type='text' readonly='readonly' class='cost' name='tax_rate[]' value='"+tax+"'></td>";
	   
	   var content_6 = "<td>"+warehouse_name+"<input type='hidden' name='warehouse_id[]' value='"+warehouse_id+"'></td>";
	   var total = parseFloat(product_price)*parseFloat(quantity);
	   var tax = parseFloat(tax)*parseFloat(quantity);
	   var grand_total = total+tax;
	   
	   var content_7 = 	"<td class='total'>"+grand_total+"</td></tr>";   
	   
	   $(".item-row:first").before(content_1+content_2+content_3+content_4+content_5+content_6+content_7);
	   $("#product_id").select2("val", null);
	   $("#quantity").val('');
	   $("#warehouse_id").select2("val", null);
	   update_total();
	   }
	});
}
	$(document).ready(function(e) {
    	$("#add_product").click(function() {
			var product_id = $('#product_id').val();
			var warehouse_id = $('#warehouse_id').val();
			var quantity = $('#quantity').val();
			var client_id = $('#client_id').val();
			//get product ends here.
			if(product_id == '') { 
				alert('Please select product.');
			} else if(warehouse_id == '') { 
				alert('Please select warehouse.');
			} else if(quantity == '') { 
				alert('Please set quantity.');
			} else if(client_id == '') { 
				alert('Please select client first.');
			} else {
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
       		<h4>اضف منتج </h4>
            <table border="0" cellpadding="5">
				<tr>
                    <td>أختر المنتج </td>
                    <td width="400">
                    <select name="product" id="product_id" onchange="get_warehouse();" style="width:400px;" class="autofill">
                        <option value="">اختر اي دي المنتج او الآسم</option>
                        <?php $products->product_options($products->product_id); ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>الكمية او العدد</td>
                    <td width="400">
                    	<input type="text" name="quantity" id="quantity" class="form-control" placeholder="اكتب العدد او الكمية المطلوبة" />
                    </td>
                </tr>
                <tr>
                    <td>أختر المخزن او مكان الحفظ </td>
                    <td>
                    	<select name="warehouse" id="warehouse_id" class="autofill" style="width:400px;">
							<option value="">أختر المخزن</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                    <td><div id="add_product" class="btn btn-default">اضف المنتج </div></td>
                </tr>
            </table>
       </div><!--add product Section-->
	</div><!--row ends here.-->
    <br />
    <div class="row">
    	<div class="col-sm-9">
        	<table id="items" class="table table-condensed table-hover table-bordered">
            	<tr>
                    <th>رقم المنتج او الخدمه</th>
                    <th>اسم المنتج او الخدمه </th>
                    <th width="60">الكمية او العدد</th>
                    <th width="60">السعر</th>
                    <th width="60">الضريبة</th>
                    <th>المخزن</th>
                    <th>الكل</th>
                </tr>
                
                <tr class='item-row'>
                    <td colspan="7">الفواتير </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
        	<div class="well">
            	<h4>المبلغ الإجمالي: <span id="grand_total">0.00</span></h4>
        		<h5>طريق الدفع ؟ </h5>
                <select name="payment_method" class="form-control">
                	<option value="0">اختر طريقة الدفع</option>
                    <option value="credit">حوالة او طريقه دفع كريدت</option>
                    <option value="credit_card">فيزا او فوري</option>
                    <option value="cash">كاش وفوري</option>
                </select><br />

            <input type="submit" class="btn btn-primary" name="save" value="Save" /> 
				&nbsp;<input type="submit" class="btn btn-primary" name="print" value="Print" />
        	</div>
        </div>
    </div><!--product_Detail_row ends here.-->
    </form>
                       
<?php
	require_once("includes/footer.php");
?>