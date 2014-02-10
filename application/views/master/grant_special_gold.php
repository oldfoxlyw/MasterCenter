<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>发放绿钻</h1>
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
                    <label class="control-label">全服发放</label>
                    <div class="controls">
                    	<input id="allServer" name="allServer" type="checkbox" value="1" /> 是
                  	</div>
                </div>
                <div class="control-group" id="slideContent">
                    <label class="control-label">角色昵称</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="nickname" name="nickname" placeholder="角色昵称" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">绿钻变化量</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="goldCount" name="goldCount" placeholder="绿钻变化量" />
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
	$("#goldCount").mask("?9999999999");
	$("#allServer").click(function() {
		if($(this).attr("checked")) {
			$("#nickname").val("");
			$("#slideContent").slideUp();
		} else {
			$("#slideContent").slideDown();
		}
	});
    $("#btnSubmit").click(function() {
		$.post("<?php echo site_url('master/grant_special_gold/send'); ?>", {
			"serverIp": $("#serverIp").val(),
			"allServer": $("#allServer").val(),
			"nickname": $("#nickname").val(),
			"goldCount": $("#goldCount").val()
		}, onData);
	});
});

function onData(data) {
	if(data == '1') {
		popupMessage("messageContainer", "success", "已成功发送消息");
	} else {
		popupMessage("messageContainer", "error", "发送消息失败");
	}
}
</script>