<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>发送邮件</h1>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
<!--End-Action boxes-->    
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>搜索</h5>
          </div>
          <div class="widget-content nopadding">
			<div id="messageContainer"></div>
              <form action="" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">选择服务器</label>
                    <div class="controls">
                        <select id="serverIp" name="serverIp">
                        <?php foreach($server_result as $server): ?>
                            <option value="http://<?php echo $server->server_ip; ?>:<?php echo $server->server_port; ?>"><?php echo $server->server_name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">全服发送</label>
                    <div class="controls">
                    	<input id="allServer" name="allServer" type="checkbox" value="" /> 是
                  	</div>
                </div>
                <div class="control-group" id="slideContent">
                    <label class="control-label">角色昵称</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="nickname" name="nickname" placeholder="角色昵称" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">邮件标题</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="mailTitle" name="mailTitle" placeholder="邮件标题" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">邮件内容</label>
                    <div class="controls">
                    	<textarea name="mailContent" rows="10" class="span11" id="mailContent" ></textarea>
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">道具ID</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="itemId" name="itemId" placeholder="道具ID" />
                  	</div>
                </div>
                <div class="form-actions">
                  <button id="btnSubmit" type="button" class="btn btn-success">发送</button>
                </div>
              </form>
          </div>
        </div>
    </div>
</div>
</div>
<link rel="stylesheet" href="<?php echo base_url('resources/css/select2.css'); ?>" />
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/masked.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/select2.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/matrix.popup_message.js'); ?>"></script> 

<script type="text/javascript">
$(function() {
	$("#serverIp").select2();
	$("#allServer").click(function() {
		if($(this).attr("checked")) {
			$("#nickname").val("");
			$("#allServer").val("1");
			$("#slideContent").slideUp();
		} else {
			$("#allServer").val("");
			$("#slideContent").slideDown();
		}
	});
    $("#btnSubmit").click(function() {
		$.post("<?php echo site_url('master/send_mail/send'); ?>", {
			"serverIp": $("#serverIp").val(),
			"allServer": $("#allServer").val(),
			"nickname": $("#nickname").val(),
			"itemId": $("#itemId").val(),
			"title": $("#mailTitle").val(),
			"content": $("#mailContent").val()
		}, onData);
	});
});

function onData(data) {
	if(data == '1') {
		popupMessage("messageContainer", "success", "已成功发送");
	} else {
		popupMessage("messageContainer", "error", "发送失败");
	}
}
</script>