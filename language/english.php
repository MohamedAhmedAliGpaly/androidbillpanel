<?php
//File includes all language related variables you can change them to any language you want. Please do not change variable names.
	$language = array();
	$language = array(
	"home_title" => "Home Page!",
	"settings_saved1" => "Settings Saved!",
	//Home page settings
	"home_des_1" => "You can create new user levels, and after login those users will redirected to the pages you specify for their level in admin area. Admins will redirected to dashboard.php.",
	"home_heading_1" => "How to make page for admins",
	"home_description_2" => "Using following code you can secure a page and admins can only access.",
	"home_comment_1" => "//This loads system.",
	"home_heading_2" => "Secure page for a user level",
	"home_description_3" => "Using code below you can secure a page for user level, Lets say you want a page to access only by subscriber user level.",
	"home_comment_2" => "//This loads system.",
	"home_heading_3" => "How to make a page accessable to all loged in users.",
	"home_description_4" => "You can use the following code in start of your document that will make your page to accessable all loged in users but only when they are signed in.",
	"home_heading_4" => "Partial Access",
	"home_comment_3" => "You are admin",
	"home_comment_4" => "You are subscriber.",
	"home_comment_5" => "You are loged in user.",
	"home_comment_6" => "You are not loged in user.",
	"home_heading_5" => "Working Example below",
	//Login page settings
	"login_title" => "Login Page!",
	"login_email_error" => "Email cannot be empty!",
	"login_password_error" => "Password cannot be empty!",
	"login_success_message" => "Login successful!",
	"login_form_label_1" => "Email or Username*",
	"login_form_label_2" => "Password*",
	"login_form_label_3" => "Keep me sign in",
	"submit_button" => "Submit",
	"forgot_password" => "Forgot Password?",
	"recover_password" => "Recover Password",
	"not_member_yet" => "Not a member yet?",
	"sign_up" => "Sign up",
	"sign_in" => "Sign in",
	//forgot password Page. settings
	"already_account" => "Already have an account?",
	"forgot_pass_title" => "Forgot Password!",
	"password_no_match" => "Passwords doesnt match. Enter again",
	"form_label" => "Please enter your email address or username to recover your password.",
	"new_password" => "New Password",
	"confirm_password" => "Confirm Password",
	//registration page 
	"register_button" => "Register",
	"policy_text" => "You agree with our Privacy Policy",
	"first_name" => "First Name",
	"last_name" => "Last Name",
	"username" => "Username",
	"email" => "Email",
	"password" => "Password",
	"registration_page_title" => "Registeration Page!",
	"register_err_1" => "User type cannot be empty!",
	"register_err_2" => "Please accept our Privacy Policy!",
	"register_err_3" => "Password Cannot be empty!",
	"register_err_4" => "Email is not valid.",
	"register_err_5" => "Email is required!",
	"register_err_6" => "Username is required.",
	"register_err_7" => "First name is required!",
	"register_err_8" => "The reCAPTCHA wasn't entered correctly.",
	//Navigation Settings. 
	//Non loged in user nav settings.
	"toggle_navigation" => "Toggle Navigation",
	"home" => "Home",
	"all_users" => "All Users",
	"subscriber" => "Subscriber",
	"join_now" => "Join Now",
	"register" => "Register",
	//admin nav.
	"dashboard" => "Dashboard",
	"logout" => "Logout",
	"general_settings" => "General Settings",
	"my_notes" => "My Notes",
	"messages" => "Messages",
	"user_settings" => "User Settings",
	"welcome" => "Welcome",
	"users" => "Users",
	"user_levels" => "User Levels",
	"edit_profile" => "Edit Profile",
	//footer settings
	"copyright" => "Copyright",
	"all_rights_reserved" => "All rights reserved.",
	//Sidebar Settings.
	"your_profile" => "Your Profile",
	"user_id" => "User ID",
	"user_status" => "Status",
	"user_type" => "Type",
	//users class
	"registrat_success" => "Your registration is done. Now please check your email inbox to confirm your email address Thank you.",
	//all.php
	"all_page_title" => "Accessible only loged in users all type.",
	"all_page_title_2" => "All users page",
	"all_page_des_1" => "This page is for all loged in users they can access only when they are loged in.",
	"all_page_title_3" => "How to make a page accessable to all loged in users.",
	"all_page_des_2" => "You can use the following code in start of your document that will make your page to accessable all loged in users but only when they are signed in.",
	"page_title_4" => "How to make more subscriber pages",
	"all_page_des_3" => "You can put the following code in top of any page that will become a subscriber accessable page. Note: admin can access all pages of all levels.",
	//dashboard.php
	"dashboard_title" => "Dashboard",
	"welcome_back" => "Welcome Back!",
	"dashboard_des_1" => "Here you can manage users, User levels, your messages and notes.",
	"system_information" => "System Information",
	"user_info" => "Users info",
	"total_users" => "Total Users",
	"active_users" => "Active Users",
	"deactivate_users" => "Deactive Users",
	"ban_users" => "Ban Users",
	"suspend_users" => "Suspend Users",
	"dashboard_des_2" => "You can manage users by going to users management",
	"manage_users" => "Manage Users",
	"name" => "Name",
	"default_page" => "Default Page",
	//edit_profile.php
	"return_code" => "Return Code",
	"already_exists" => "already exists.",
	"password_do_not_match" => "Password does not match.",
	"edit_your_profile" => "Edit your profile",
	"enter_first_name" => "Enter first name",
	"enter_last_name" => "Enter last name",
	"update_user" => "Update User",
	"description" => "Description",
	"user_description" => "User Description",
	"gender" => "Gender",
	"male" => "Male",
	"female" => "Female",
	"select_gender" => "Select Gender",
	"date_of_birth_format" => "Date of birth Format",
	"date_of_birth" => "Date of Birth",
	"address" => "Address",
	"profile_image" => "Profile Image",
	"dont_want_to_change" => "Leave blank if you don't want to change password",
	"your_email_address" => "Your email address",
	"phone" => "Phone",
	"city" => "City",
	"state_province" => "State/Province",
	"country" => "Country",
	"zip_code" => "Zip Code",
	"mobile" => "Mobile",
	//general_settings.php page.
	"site_url_empty" => "Site url cannot be empty!",
	"email_from_required" => "Email from cannot be empty!",
	"reply_cannot_empty" => "Reply to cannot be empty!",
	"general_setting_page_title" => "General Settings",
	"public_key" => "Public Key",
	"private_key" => "Private Key",
	"activate_captcha" => "Activate Captcha",
	"captcha_settings" => "Captcha Settings",
	"captcha_des_1" => "Captcha Settings Please",
	"captcha_des_2" => "sign up to google recaptcha",
	"captcha_des_3" => "get your captcha public key and private key",
	"reply_to" => "Reply To",
	"email_from" => "Email From",
	"email_des_1" => "Email settings used for the system will send Emails to users.",
	"activate_without_verification" => "Active user without email verification?",
	"activate_without_2" => "You can check this box if you want users to register without verifying their email address.",
	"default_system_language" => "Default System Language",
	"site_name" => "Site Name",
	"site_url" => "Site URL",
	"site_url_des" => "Please include / at end of site url e.g http://localhost/",
	"select_skin" => "Select Skin",
	
	//manage_notes.php manage notes page.
	"note_title_required" => "Note Title is required!",
	"note_detail_required" => "Note Detail is required!",
	"edit_note" => "Edit Note",
	"add_note" => "Add Note",
	"note_title" => "Note Title",
	"note_detail" => "Note Detail",
	
	//manage_user_level.php page settings.
	"edit_user_level" => "Edit user level",
	"add_new_user_level" => "Add New User Level",
	"level_name" => "Level Name",
	"level_description" => "Level Description",
	"page_name" => "Page Name",
	"level_des_1" => "This would be default page where user of stated level redirected after login.",
	"user_level_page" => "User level page",
	"level_des_2" => "e.g manager.php this would be default page for user types of entered name. You can use ../manager.php if your file is one directory back of this script.",
	"level_des_3" => "To make a page password secure and accessable by entered level name users let's say you created user level manager and setup default page manager.php. Now you want to secure manager_2.php with password but manager user level users can access and admins we need to put",
	"load_properly" => "Please make sure this file loads properly.",
	"level_des_4" => "PHP code in start of manager.php and manager_2.php Both files will need login and user level manager.",
	"update_level" => "Update Level",
	"add_level" => "Add Level",
	
	//manage_users.php file settings.
	"select_user_status_req" => "Please select user status",
	"select_user_type_req" => "Please select user type.",
	"edit_user" => "Edit User",
	"add_new_user" => "Add new user",
	"add_user" => "Add user",
	"select_user_type" => "Select User Type",
	"status" => "Status",
	"select_status" => "Select Status",
	"active" => "Active",
	"deactive" => "Deactive",
	"ban" => "Ban",
	"suspend" => "Suspend",
	
	//messages.php settings
	"inbox" => "Inbox",
	"sent" => "Sent",
	"close" => "Close",
	"send_message" => "Send Message",
	"subject" => "Subject",
	"email_or_username" => "Email or username",
	"message_to" => "Message To",
	"my_messages" => "My Messages",
	"message_is_empty" => "Your message is empty!",
	"message" => "Message",
	"add_new" => "Add New",
	"edit" => "Edit",
	"delete" => "Delete",
	"id" => "ID",
	"date" => "Date",
	
	//user_levels.php
	"manage_user_levels" => "Manage User Levels",
	"level_page_name" => "User Level Page",
	"default_level_for_admins" => "Default level for admins",
	"all_admin_users" => "All admin level users",
	
	//Subscribers page settings.
	"title_sub_page" => "Page for subscribers user level.",
	"sub_page_des_1" => "This is a default page for subscriber user level, Subscriber user level is deafault level on registration. This page is only accessable when user is signed in and his access level is subscriber. If you are loged in as admin you still can see this page.",

	//alert_messages
	"confirm_delete" => "Do you really want to delete this record?",
	"admin_exist_alert" => "Admin already exist cannot be addedd!",
	"sender_me" => "Me",
	"sender_from" => "From",
	"sender_to" => "To",
	"send_a_reply" => "Send a reply ...",
	"message_sent_success" => "Message sent successfuly!",
	"no_user_to_message" => "No user with email or username",
	"message_to_all" => "Message was sent to all",	
	//notes_messages
	"note_delete_success" => "Note was deleted successfuly!",
	"note_added_success" => "Note added successfuly!",
	"note_update_success" => "Note updated Successfuly!",
	//userlevel class alerts
	"userlevel_update_success" => "User level updated Successfuly!",
	"userlevel_cannot_add" => "You cannot add duplicate user levels.",
	"userlevel_add_success" => "User level added successfuly!",
	"user_level_delete_succ" => "Level was deleted successfuly!",
	"user_level_cannot_del" => "You dont have access to delete this user level.",
	"cannot_view_this_list" => "You cannot view this list.",
	"admin" => "Admin",
	"level_err_1" => "You cannot view list of levels.",
	//users class alert messages.
	"user_update_success" => "User updated Successfuly!",
	"cannot_delete_user_err" => "You dont have access to delete this user.",
	"user_delete_succ" => "User was deleted successfuly!",
	"email_exit_user_err" => "User could not added Email",
	"already_REgistered" => "already registered.",
	"username_couldniot_add" => "User could not added Username",
	"email_register_1" => "Thank you for registration.",
	"email_register_2" => "Your Username is",
	"email_register_3" => "Kindly click the link below to confirm your account and start using our services.",
	"email_register_4" => "Confirm Email Address",
	"email_register_5" => "Thank you again. Please contact us if you need any assistance.",
	"email_register_6" => "Confirm your email id.",
	"suspend_help" => "Your account has been suspended. Please contact the administrator for help.",
	"activation_succ_ms" => "Congratulations! You are activated successfuly now you can use email and password to login and use our services.",
	"cannot_activate_acc_1" => "Your account cannot be activated.",
	"your_account_registered" => "Your account have been registered.",
	"use_following_details" => "Please use the following details to sign in on our website",
	"email_or_username" => "Email/Username:",
	"registration_details" => "Registration Details",
	"user_add_details_sent" => "User added successfuly details are sent to Email.",
	"password_reset_msg" => "Your Password has been reset please use new password to login.",
	"activation_key_expire" => "Your activation key is expired and password cannot be reset.",
	"trying_do_to_illegal" => "You are trying to do you are not allowed for.",
	"you_have_no_rights" => "You dont have permission to update this user.",
	"not_active_yet_em" => "Your account is not activated yet please confirm your Email address to activate your account!",
	"ban_suspend_login_con" => "Your are ban or suspended please contact administrator to login!",
	"password_do_not_match_err" => "Password do not match!",
	"could_not_find_email" => "Sorry but we could not find this email address.",
	"email_not_in_system" => "The email address is not in our system.",
	"reset_your_pass_1" => "Reset your password.",
	"click_link_reset_pass" => "Kindly click the link below to reset your password.",
	"reset_your_pass1" => "Reset your Password.",
	"check_email_rest_pass" => "Please check your email and proceed to reset your password.",
	"cannot_i_user" => "You cannot view list of users.",
	
	"submiting_empty_msg" => "Message cannot be empty!",
	//Update 4 June 14
	"activate_facebook_login" => "Activate facebook login?",
	"facebook_login_check_title" => "Check this box if you want users to login with facebook.",
	"facebook_api_key_label" => "Enter your facebook API key.",
	"facebook_api_helper" => "Please go to http://facebook.com/developers/ Register new app add your website url to its Web URL make your app live. And get your API key from dashboard.",
	"login_button" => "Login!",
	"facebook_login_btn" => "Login with facebook",
	"fb_reg_thanks" => 'Thank you for registration',
	"fb_reg_des" => 'You can use facebook login or following login information to access our system.',
	'facebook_register_btn' => "Register with facebook.",
	'message_to_all_users' => "Message All",
	'message_all_users' => "Message to all users",
	'message_sent_to_all' => "Message sent to all users.",
	'email_seeting' => 'Email Settings',
	'facebook_login_setting' => 'Facebook Login Settings',
	'redirect_on_logout' => 'Redirect on logout',
	'disable_login' => 'Disable login',
	'disable_registration' => 'Disable registration',
	'disable_registration_title' => 'Disable registration from register.php page',
	'disable_login_check_title' => 'Disable login for all users except admins',
	'login_disabled_temporary' => 'Sorry you cannot login right now. Login is disabled temporary.',
	'subscribers' => 'Subscribers',
	'registeration_disabled_temporary' => 'Sorry you cannot register right now. Registration is disabled temporary.',
	'default_system_user_type' => 'Default registration user type',
	'session_timeout' => 'Session timeout in minutes',
	'notify_user_group' => 'Notify user group on new registration',
	'notify_user_group_title' => 'Notify other users of same group on new registration in that group.',
	'full_name' => 'Full&nbsp;Name',
	'location' => 'Location',
	'last_login_time' => 'Last login on',
	'last_login_ip' => 'Last login IP',
	'action' => 'Action',
	'maximum_login_attempts' => 'Maximum wrong login attempts',
	'wrong_attempts_time' => 'Account lock time on wrong login attempts (in minutes)',
	'wrong_attempt_lock' => 'You have reached maximum tries to login your account is locked please try again later.',
	'notify_user_on_message' => 'Email notification on new message: ',
	'announcements' => 'Announcements',
	'announcement_update_success' => 'Announcement updated successfuly.',
	'announcement_delete_success' => 'Announcement deleted successfuly.',
	'announcement_added_success' => 'Announcement added successfuly.',
	'announcement_title_required' => 'Announcement title required.',
	'announcement_detail_required' => 'Announcement detail required.',
	'edit_announcement' => 'Update announcement',
	'add_announcement' => 'Add announcement',
	'announcement_title' => 'Announcement title',
	'announcement_detail' => 'Announcement detail',
	'user_type' => 'User type',
	'announcement_status' => 'Announcement status',
);