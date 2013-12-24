<!DOCTYPE html>
<html lang="en">
<head>
<title>后台管理 - 信息</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap-responsive.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/css/matrix-style.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/css/matrix-media.css'); ?>" />
<link href="<?php echo base_url('resources/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<?php echo $meta_data; ?>
</head>
<body>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span6 center">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5><?php if($type != MESSAGE_TYPE_SUCCESS): ?>错误<?php endif; ?>信息</h5>
          </div>
          <div class="widget-content">
            <div class="error_ex">
              <h1><?php if($type != MESSAGE_TYPE_SUCCESS): ?><span style="color:#F00">Error</span><?php else: ?>Success<?php endif; ?></h1>
              <h3><?php echo lang($info); ?></h3>
              <p><?php echo $return_content; ?></p>
              <a class="btn btn-warning btn-big"  href="<?php echo $redirect; ?>">跳转</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in/">Themedesigner.in</a> </div>
</div>
<!--end-Footer-part-->
</body>
</html>
