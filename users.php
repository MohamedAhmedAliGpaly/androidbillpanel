<html dir="rtl">

<?php
	include('system_load.php');
	//This loads system.
	//user Authentication.
	authenticate_user('admin');
	
	//Delete user.
	if(isset($_POST['delete_user']) && $_POST['delete_user'] != '') { 
		$message = $new_user->delete_user($_SESSION['user_type'], $_POST['delete_user']); 
	}//delete ends here.
		
	$page_title = "الحسابات والآشخاص"; //You can edit this to change your page title.
	 $sub_title = "ادارة كل شيء عن الحسابات";
	 require_once("includes/header.php"); //including header file.

	//display message if exist.
    if(isset($message) && $message != '') { 
        echo '<div class="alert alert-success">';
        echo $message;
        echo '</div>';
    }
?>
    <p><a href="manage_users.php" class="btn btn-primary btn-default pull-left"><?php echo $language["add_new"]; ?></a> <a href="#" class="btn btn-primary btn-default pull-right" data-toggle="modal" data-target="#modal_all_user"><?php echo $language["message_to_all_users"]; ?></a><div class="clearfix"></div></p>
    
 <script type="text/javascript">
$(function(){
$("#message_all_user").on("submit", function(e){
  e.preventDefault();
  tinyMCE.triggerSave();
  $.post("includes/messageprocess.php", 
	 $("#message_all_user").serialize(), 
	 function(data, status, xhr){
	   $("#success_message_admin").html("<div class='alert alert-success'>"+data+"</div>");
	 });
});
});
</script>				
<div class="modal fade" id="modal_all_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="message_all_user" method="post" name="send_message">
	<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $language["send_message"]; ?></h4>
      </div>
	  
      <div class="modal-body">
      		<div id="success_message_admin"></div>
	   		<div class="form-group">
				<label class="control-label"><?php echo $language["message_to"]; ?></label>
				<input type="text" class="form-control" name="message_to" value="<?php echo $language['message_all_users']; ?>" readonly="readonly" />
			</div>
			
			<div class="form-group">
				<label class="control-label"><?php echo $language["subject"]; ?></label>
				<input type="text" class="form-control" name="subject" value="" />
			</div>
			
			<div class="form-group">
				<label class="control-label"><?php echo $language["message"]; ?></label>
				<textarea class="form-control tinyst" name="message"></textarea>
			</div>
      </div>
      <input type="hidden" name="all_users" value="1" />
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language["close"]; ?></button>
		<input type="submit" value="<?php echo $language["send_message"]; ?>" class="btn btn-primary" />
      </div>
    </div><!-- /.modal-content -->
   </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   
    
	<style type="text/css">
    	th {
			text-align:center; 
		}
    </style>
    <table cellpadding="0" cellspacing="0" border="0" class="table-responsive table-hover table display table-bordered" id="wc_table" width="100%">
        <thead>
            <tr>
                <th>الآسم بالكامل</th>
                <th>المكان</th>
                <th>اسم الحساب او الدخول</th>
                <th>الآيميل</th>
                <th>الحالة</th>
                <th>نوع الحساب</th>
                <th>أخر مشاهدة او فعالية</th>
                <th>اي بي</th>
                <th style="min-width:197px;"><?php echo $language["action"]; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php echo $new_user->list_users($_SESSION['user_type']); ?>
        </tbody>
    </table>
    <!-- Button trigger modal -->
<?php
	require_once("includes/footer.php");
?>