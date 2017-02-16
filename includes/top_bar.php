	
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
<div class="top_section">
    	<nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->
			<?php if(isset($page)) { ?>
            <ul class="user-info-menu left-links list-inline list-unstyled">
                	<li><a class="navbar-brand" href="<?php echo get_option('site_url'); ?>"><?php echo $new_store->get_store_info($_SESSION['store_id'], 'store_name'); ?></a></li>
			</ul>
            <?php } ?>
                
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
					<li class="dropdown hover-line">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="glyphicon glyphicon-envelope"></i>
							<span class="badge badge-green"><?php $message_obj->unread_count(); ?></span>
						</a>
			
						<ul class="dropdown-menu messages">
							<li>
								<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
									<?php $message_obj->message_widget(); ?>
								</ul>
							</li>
							
							<li class="external">
								<a href="messages.php">كل الرسائل والتنبيهات 
								الخاصه بي</a></li>
						</ul>
					</li>
			
					<li class="dropdown hover-line">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="glyphicon glyphicon-paperclip"></i>
							<span class="badge"><?php $notes_obj->notes_count(); ?></span>
						</a>
			
						<ul class="dropdown-menu notifications">
							<li>
								<ul class="dropdown-menu-list list-unstyled ps-scrollbar">
									<?php $notes_obj->notes_widget(); ?>
								</ul>
							</li>
							
							<li class="external">
								<a href="notes.php">
									<span>عرض جميع الملاحظات</span>
									<i class="glyphicon glyphicon-calendar"></i>
								</a>
							</li>
						</ul>
					</li>
                    <?php if(isset($_SESSION['store_id']) && (partial_access('admin') || $store_access->have_module_access('products'))) { ?> 
						<li>
						<a href="products.php?alert=1" class="btn btn-default btn-default">
						تنبيهات المنتجات والمبيعات <span class="label label-default"><?=$product->products_alert_count(); ?></span></a></li>
					<?php } ?>
			</ul>
			
			
				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">
                	<?php if(isset($_SESSION['store_id']) && (partial_access('admin') || $store_access->have_module_access('sales'))) { ?>
                     <?php if(!isset($page)) { ?>
                    <li>
                    	<a href="point_of_sale.php" class="btn btn-default btn-primary" style="color:#FFF;">
						نقاط البيع</a>
                    </li>
                    <?php } else { ?>
                    <li>
                    	<a href="store.php" class="btn btn-default btn-primary" style="color:#FFF;">
						لوحه تحكم الرئيسية</a>
                    </li>
					<?php } } ?>
                    <li class="dropdown user-profile">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo $profile_img; ?>" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								<?php echo $new_user->get_user_info($_SESSION['user_id'], 'first_name'); ?> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'last_name'); ?>
								<b class="caret"></b>
							</span>
						</a>
			<?php if(partial_access('admin')): //following nav is for admin users only. ?>
				<ul class="dropdown-menu">
                	<li><a href="messages.php">الرسائل</a></li>
                    <li><a href="notes.php">التنبيهات والملاحظات</a></li>
                	<li role="presentation" class="divider"></li>
                    <li><a href="general_settings.php">الآعدادات</a></li>
                    <li><a href="announcements.php">الآشعارات والتنبيهات</a></li>
			        <li>
					<a href="edit_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">
					تعديل حسابي</a></li>
                    <li><a href="dashboard.php?logout=1">تسجيل الخروج</a></li>
                </ul>
              <?php elseif(partial_access('all')) : //following nav for all other loged in users. ?>
              	<ul class="dropdown-menu">
                	<li><a href="messages.php">الرسائل</a></li>
                    <li><a href="notes.php">ملاحظاتي الخاصه بي</a></li>
                    <li role="presentation" class="divider"></li>
                	<li>
					<a href="edit_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">
					تعديل الملف الشخصي</a></li>
                    <li><a href="dashboard.php?logout=1">تسجيل الخروج</a></li>
                </ul>
               <?php endif; ?>   
					</li>
				</ul>
			</nav>
    </div><!--topbar ends here-->