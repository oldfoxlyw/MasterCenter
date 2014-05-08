<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>生成兑换码</h1>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
<!--End-Action boxes-->    
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>选项</h5>
          </div>
          <div class="widget-content nopadding">
			<div id="messageContainer"></div>
              <form action="" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">兑换码抬头字符</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="prefix" name="prefix" placeholder="兑换码抬头字符" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">所需数量</label>
                    <div class="controls">
                      <input type="text" class="span8" id="count" name="count" placeholder="所需数量" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">备注</label>
                    <div class="controls">
                      <input type="text" class="span8" id="comment" name="comment" placeholder="备注" />
                    </div>
                </div>
                <div class="form-actions">
                  <button id="btnSubmit" type="button" class="btn btn-success">生成</button>
                </div>
              </form>
          </div>
        </div>
    </div>
    
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>兑换码</h5>
          </div>
          <div id="info" class="widget-content">
          
          </div>
          <div id="coupon" class="widget-content">
          
          </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/masked.js'); ?>"></script>

<script type="text/javascript">
$(function() {
    $("#count").mask("?99999");
    $("#btnSubmit").click(function() {
		if($("#prefix").val() == "") {
			alert("请填写兑换码抬头字符");
			return false;
		}
    else if($("#count").val() == "") {
      alert("请填写所需数量");
      return false;
    }
    $(this).attr("disabled", "disabled");
		$.post("<?php echo site_url('coupon/generate/process'); ?>", {
			"prefix": $("#prefix").val(),
			"count": $("#count").val()
		}, onData);
	});
});

function onData(data) {
	if(!data) {
		return;
	}
	
  $("#btnSubmit").attr("disabled", false);
	$("#info").text('成功：' + data.success + "，失败：" + data.fail);

  for(var i = 0; i<data.result.length; i++) {
    $("#coupon").append(data.result[i] + "<br>");
  }
}
</script>