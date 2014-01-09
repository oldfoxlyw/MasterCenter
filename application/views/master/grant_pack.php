<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>发放礼包</h1>
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
                    <label class="control-label">角色昵称</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="nickname" name="nickname" placeholder="角色昵称" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">礼包ID</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="packId" name="packId" placeholder="礼包ID" /><span class="help-block"><strong><a id="btnGetPack" href="#">礼包列表</a></strong></span>
                        <div class="modal hide" id="modalGetPack">
                        <div class="modal-header">
                          <button type="button" id="modalGetPackClose" class="close" data-dismiss="modal">×</button>
                          <h3>装备列表</h3>
                        </div>
                        <div class="modal-body nopadding">
                        <table class="table table-bordered data-table" id="listTable">
                          <thead>
                            <tr>
                              <th>礼包ID</th>
                              <th>名称</th>
                              <th>说明</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="gradeA">
                              <td colspan="3">载入中...</td>
                            </tr>
                          </tbody>
                        </table>
                        </div>
                        <div class="modal-footer"><a href="#" id="modalBtnGetPackClose" class="btn btn-primary">关闭</a></div>
                      </div>
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">数量</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="count" name="count" placeholder="数量" value="1" />
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
<script src="<?php echo base_url('resources/js/jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript">
var dataTableHandler;

$(function() {
	$("#serverIp").select2();
	$("#count").mask("?99");
	$("#btnGetPack").click(function() {
		if(dataTableHandler != null) {
			return false;
		}
		$.post("<?php echo site_url('master/grant_pack/get'); ?>", {
			"serverIp": $("#serverIp").val()
		}, onPackData);
	});
    $("#btnSubmit").click(function() {
		$.post("<?php echo site_url('master/grant_pack/send'); ?>", {
			"serverIp": $("#serverIp").val(),
			"nickname": $("#nickname").val(),
			"packId": $("#packId").val(),
			"goldCount": $("#goldCount").val()
		}, onData);
	});
	$("#btnGetPack").click(function() {
		$("#modalGetPack").removeClass("hide");
		return false;
	});
	$("#modalGetPackClose, #modalBtnGetPackClose").click(function() {
		$("#modalGetPack").addClass("hide");
	});
});

function onPackData(data) {
	if(data) {
		var aaData = [];
		var rowData;
		for(var i in data) {
			rowData = [data[i].item_id, data[i].name, data[i].description];
			aaData.push(rowData);
		}
		
		if(dataTableHandler) {
			dataTableHandler.fnDestroy();
		}
		dataTableHandler = $('#listTable').dataTable({
			"bAutoWidth": false,
			"bJQueryUI": true,
			"bStateSave": true,
			"sPaginationType": "full_numbers",
			"sDom": '<"H"lr>t<"F"fp>',
			"aaData": aaData,
			"oLanguage": {  
				"sProcessing":   "处理中...",
				"sLengthMenu":   "显示 _MENU_ 项结果",
				"sZeroRecords":  "没有匹配结果",
				"sInfo":         "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
				"sInfoEmpty":    "显示第 0 至 0 项结果，共 0 项",
				"sInfoFiltered": "(由 _MAX_ 项结果过滤)",
				"sInfoPostFix":  "",
				"sSearch":       "搜索:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "首页",
					"sPrevious": "上页",
					"sNext":     "下页",
					"sLast":     "末页"
				}
			}
		});
		$('select').select2();
	}
}

function onData(data) {
	if(data == '1') {
		popupMessage("messageContainer", "success", "已成功发送消息");
	} else {
		popupMessage("messageContainer", "error", "发送消息失败");
	}
}
</script>