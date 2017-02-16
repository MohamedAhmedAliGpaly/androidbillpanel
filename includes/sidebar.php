  <html dir="rtl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ar-eg">
</head>
<div class="col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">الملف الشخصي والمعلومات</h3>
        </div>
            <ul class="list-group">
            	<li class="list-group-item"><center><img src="<?php echo $profile_img; ?>" class="img-thumbnail" style="width:100px" /></center></li>
                <li class="list-group-item"><strong>رقم الحساب:</strong> <?php echo $_SESSION['user_id']; ?></li>
                <li class="list-group-item"><strong>الآسم الآول:</strong> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'first_name'); ?></li>
                <li class="list-group-item"><strong>الآسم الآخير:</strong> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'last_name');; ?></li>
                <li class="list-group-item"><strong>أسم الحساب:</strong> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'username');; ?></li>
                <li class="list-group-item"><strong>الآيميل:</strong> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'email');; ?></li>
                <li class="list-group-item"><strong>حالة الحساب:</strong> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'status');; ?></li>
                <li class="list-group-item"><strong>نوع الحساب:</strong> <?php echo $new_user->get_user_info($_SESSION['user_id'], 'user_type');; ?></li>
                <li class="list-group-item"><p><a href="edit_profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">
				اضغط هنا للتعديل</a></p></li>
            </ul>
    </div>
</div><!--righ sidebar ends here.-->