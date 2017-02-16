  <html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
  <div class="sidebar-menu">
    	<nav class="navbar navbar-default" role="navigation">
  		<!-- Brand and toggle get grouped for better mobile display -->
  		<div class="navbar-header">
            <p align="right">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
    			</p>
			<p align="right"><a class="navbar-brand" href="dashboard.php">اهلآ بك في لوحة التحكم</a>
                        <!--collapse user info box opner-->
                        </p>
                        <div class="settings-icon">
						<a href="#collapseExample" data-toggle="collapse" title="View user detail" data-animate="true">
							<i class="glyphicon glyphicon-triangle-bottom"></i>
						</a>
						</div>
		
  	</div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
            <li><a href="dashboard.php">لوحة التحكم الرئيسية</a></li>
            <li>
            	<a data-toggle="dropdown" class="dropdown-toggle" href="stores.php">
				المتاجر والآنشطة <b class="caret"></b></a>
                <ul>
                	<li><a href="users.php">الحسابات</a></li>
                    <li><a href="store.php">المتاجر والآنشطة والشركات وانظمه العمل</a></li>
                	<li><a href="stores.php">أختر من المتاجر او الخدمات</a></li>
                	<li><a href="store_access.php">أذونات الحسابات في المتاجر من مشرفين او محاسبين او بائعين الخ</a></li>
                    <li><a href="pos_settings.php">أعدادات المتاجر </a></li>
                </ul>
            </li>
            <?php include('store_nav.php'); ?>
          </ul>
  </div><!-- /.navbar-collapse -->
</nav>
</div>
<!--==================Sidebar Ends Here===========================-->