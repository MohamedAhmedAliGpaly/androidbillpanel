  <html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
<?php 
if(isset($_SESSION['store_id'])):
$st_access = new StoreAccess; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('sales')): ?>
	<li>
        <a href="#">المبيعات</a><ul>
            <li><a href="manage_sale.php">اضف جديد</a></li>
            <li><a href="sale.php">المبيعات</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('purchase')): ?>
	<li>
        <a href="#">المشتريات</a><ul>
            <li><a href="manage_purchase.php">اضف جديد</a></li>
            <li><a href="purchase.php">المشتريات</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('vendors')): ?>
	<li>
        <a href="vendors.php">الباعة لديك * مهم</a><ul>
            <li><a href="vendors.php">الباعة</a></li>
            <li><a href="payments.php">المدفوعات</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('clients')): ?>
	<li>
        <a href="clients.php">العملاء - البائعين</a><ul>
            <li><a href="clients.php">الحسابات</a></li>
            <li><a href="receivings.php">سجلات العمليات</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('products')): ?>
	<li>
        <a href="products.php">المنتجات والخدمات</a><ul>
            <li><a href="products.php">المنتجات والخدمات</a></li>
            <li><a href="product_categories.php">اقسام وفئات الخدمات والمنتجات</a></li>
            <li><a href="product_taxes.php">ضرائب المنتجات والخدمات</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('warehouse')): ?>
    <li>
        <a href="warehouse.php">المخازن والنقلّ</a><ul>
            <li><a href="warehouse.php">المخازن</a></li>
            <li><a href="manage_warehouse_inventory.php">إدارة مخزون السلع في 
			المخازن</a></li>
            <li><a href="warehouse_transfer_logs.php">سجلات النقل</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('returns')): ?>
	<li>
        <a href="#">المسترجعات</a><ul>
            <li><a href="sale_returns.php">المبيعات المسترجعة </a></li>
            <li><a href="purchase_returns.php">المشتريات المسترجعة</a></li>
            <li><a href="return_reasons.php">أسباب الآسترجاع</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('price_level')): ?>
	<li>
        <a href="set_product_rates.php">مستويات ونظام الاسعار</a><ul>
            <li><a href="set_product_rates.php">تحديد أسعار المنتجات</a></li>
            <li><a href="set_client_level.php">مستوي الآسعار للعملاء والمشتريين</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('expenses')): ?>
	<li>
        <a data-toggle="dropdown" class="dropdown-toggle" href="expenses.php">
		النفقات <b class="caret"></b></a>
        <ul>
            <li><a href="expense_types.php">أنواع النفقات</a></li>
            <li><a href="expenses.php">قائمة النفقات</a></li>
        </ul>
    </li>
<?php endif; ?>
<?php if(partial_access('admin') || $st_access->have_module_access('reports')): ?>
	<li><a href="reports.php">كافة التقارير</a></li>
<?php endif; endif; ?>