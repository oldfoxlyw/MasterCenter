<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <title>Matrix Admin</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="<?php echo base_url("resources/css/bootstrap.min.css"); ?>" />
		<link rel="stylesheet" href="<?php echo base_url("resources/css/bootstrap-responsive.min.css"); ?>" />
        <link rel="stylesheet" href="<?php echo base_url("resources/css/matrix-login.css"); ?>" />
        <link href="<?php echo base_url("resources/font-awesome/css/font-awesome.css"); ?>" rel="stylesheet" />
		<!--
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        -->

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="<?php echo site_url("login/submit"); ?>" method="post">
				<div class="control-group normal_text"> <h3><img src="<?php echo base_url("resources/img/logo.png"); ?>" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"></i></span><input type="text" placeholder="用户名" id="accountName" name="accountName" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="密码" id="accountPass" name="accountPass" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                	<div class="controls">
                        <div class="main_input_checkbox">
                    		<input type="checkbox" id="cookieRemain" name="cookieRemain" value="1" />
                            <label for="cookieRemain">记住密码？</label>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-right"><a type="submit" href="javascript:loginform.submit();" class="btn btn-success" /> Login</a></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>
        </div>
        
        <script src="<?php echo base_url("resources/js/jquery.min.js"); ?>"></script>  
        <script src="<?php echo base_url("resources/js/matrix.login.js"); ?>"></script> 
    </body>

</html>
