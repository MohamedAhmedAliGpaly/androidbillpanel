<?php
	include('../system_load.php');
	//This loads system.
	//user Authentication.
	authenticate_user('subscriber');
	//creating company object.
	$sale = new Sale;
	$store_access = new StoreAccess;
	$store = new Store;
	$user = new Users;
	$client = new Client;
		
	if(partial_access('admin') || $store_access->have_module_access('sales')) {} else { 
		HEADER('LOCATION: ../store.php?message=products');
	}
	if(!isset($_SESSION['store_id']) || $_SESSION['store_id'] == '') { 
		HEADER('LOCATION: ../stores.php?message=1');
	} //select company redirect ends here.
?>	
<html>
<html dir="rtl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
	<head>
    	<title>فاتورة بيع </title>
        <link rel="stylesheet" type="text/css" media="all" href="reports.css" />
    </head>
    
    <body>
    	<div id="reportContainer">
        	<table width="100%" cellpadding="10px" border="0px">
            	<tr>
                	<td style="text-align:left;">
                    	<h2 style="text-align: right"><?php echo $store->get_store_info($_SESSION['store_id'], 'store_name'); ?></h2>
                        <p class="phone" style="text-align: right">الهاتف: <?php echo $store->get_store_info($_SESSION['store_id'], 'phone'); ?><br />
                        العنوان : <?php echo $store->get_store_info($_SESSION['store_id'], 'address1'); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'address2'); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'city'); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'state'); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'country'); ?><br>
						بريد الكتروني : <?php echo $store->get_store_info($_SESSION['store_id'], 'email'); ?>
                        </p>
                    </td>
                    <td style="text-align:right;">
                    	<h1 style="color:#CCC;"><span lang="ar-eg">فاتورة بيع
						</span>&nbsp;</h1>
                        <?php $mysqldate = strtotime($sale->get_sale_info($_GET['sale_id'], 'datetime')); ?>
                        <p>التاريخ: <?php echo date('d-M-Y', $mysqldate); ?><br />
                        سيريال الفاتورة # : <?php echo $_GET['sale_id']; ?><br />
                        <?php $agent_id = $sale->get_sale_info($_GET['sale_id'], 'agent_id'); ?>
                        الموظف: <?php echo $user->get_user_info($agent_id, 'first_name').' '.$user->get_user_info($agent_id, 'last_name'); ?><br>
						رقم الفاتورة الخاص #: <?php echo $sale->get_sale_info($_GET['sale_id'], 'manual_inv_no'); ?><br>
						طريقة الدفع : <?php echo $sale->get_sale_info($_GET['sale_id'], 'payment_status'); ?>
                        </p>
                        
                    </td>
                </tr>
            </table>
            <br />
<table width="45%" border="1px" cellspacing="0" cellpadding="5px">
	<tr>
    	<td bgcolor="#666666">
		<p align="right"><strong><span style="color: #FFFFFF" lang="ar-eg">
		بيانات تخص العميل</span></strong></td>
    </tr>
    <tr>
    	<td>
        <?php $client_id = $sale->get_sale_info($_GET['sale_id'], 'client_id'); ?>
    	<h4 align="right"><?php echo $client->get_client_info($client_id, 'full_name'); ?></h4>
        <p align="right"><span lang="ar-eg">الهاتف</span>: <?php echo $client->get_client_info($client_id, 'phone'); ?> 
		&nbsp;<span lang="ar-eg">رقم الموبايل </span>&nbsp;: <?php echo $client->get_client_info($client_id, 'mobile'); ?><br />
		<span lang="ar-eg">العنوان </span>: <?php echo $client->get_client_info($client_id, 'address'); ?> <?php echo $client->get_client_info($client_id, 'city'); ?> <?php echo $client->get_client_info($client_id, 'state'); ?> <?php echo $client->get_client_info($client_id, 'country'); ?></p>
        <p style="text-align:right; background-color:#CCC; font-weight:bold; padding:2px; width:80%; float:right;">
		إجمالي المستحقّ: <?php echo currency_format($client->get_client_balance($client_id)); ?></p>
        </td>
    </tr>
</table>
			<p align="right"><br />
<?php $invoice_detail = $sale->view_sale_invoice($_GET['sale_id']); ?>
</p>
<table width="100%" cellpadding="5px" cellspacing="0" border="1">
	<tr bgcolor="#CCCCCC">
    	<th>
		<p align="right"><span lang="ar-eg">رقم المنتج</span></th>
        <th>
		<p align="right"><span lang="ar-eg">أسم المنتج</span> </th>
        <th>
		<p align="right"><span lang="ar-eg">السعر</span></th>
        <th>
		<p align="right"><span lang="ar-eg">العدد&nbsp; / الكمية</span></th>
        <th>
		<p align="right"><span lang="ar-eg">الضريبة</span></th>
        <th width="75">
		<p align="right"><span lang="ar-eg">الكلي</span></th>
    </tr>
    <?php echo $invoice_detail['rows']; ?>
    
</table>

<table width="100%" cellpadding="5px" cellspacing="0" align="right">
	<tr>
    	<td>
        	<p align="right">
        	<strong>محلاظات أضافية :</strong><br />
            </p>
            <div style="width:450px; min-height:70px; border:1px solid #000; padding:5px;"><?php echo $sale->get_sale_info($_GET['sale_id'], 'memo'); ?></div>
			
        </td>
        <td width="350px" valign="top" style="text-align:right;">
        	<table width="95%" align="right" cellspacing="0" style="margin-top:5px;" cellpadding="5" border="1px">
        		<tr>
                	<th>
					<p align="right"><span lang="ar-eg">المبلغ الكي</span></th>
                    <th>
					<p align="right"><span lang="ar-eg">تم أستلام</span></tH>
                    <th>
					<p align="right"><span lang="ar-eg">الرصيد</span></th>
                </tr>
                <tr>
                	<td align="right"><?php echo currency_format($invoice_detail['grand_total']); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'currency'); ?></td>
                    <td align="right"><?php echo currency_format($invoice_detail['received_amount']); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'currency'); ?></td>
                    <td align="right"><?php echo currency_format($invoice_detail['grand_total']-$invoice_detail['received_amount']); ?> <?php echo $store->get_store_info($_SESSION['store_id'], 'currency'); ?></td>
                </tr>
                </table>
        </td>
    </tr>
</table>
<div style="clear:both;">
	<p align="right"></div>

      <p style="text-align:right; margin-top:20px">هذه الفاتوره تم انشاءها اليآ 
		عبر نظام المحاسبة لدينا وتمت مراجعتها مع الشكر</p>      
        </div><!--reportContainer Ends here.-->
    </body>
</html>