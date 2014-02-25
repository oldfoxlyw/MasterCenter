<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>订单查询</h1>
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
                        <select id="serverId" name="serverId">
                        <?php foreach($server_result as $server): ?>
                            <option value="<?php echo $server->account_server_id; ?>"><?php echo $server->server_name; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">GUID</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="guid" name="guid" placeholder="GUID" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">用户名</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="accountName" name="accountName" placeholder="用户名" />
                  	</div>
                </div>
                <div class="control-group">
                    <label class="control-label">角色昵称</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="nickname" name="nickname" placeholder="角色昵称" />
                  	</div>
                </div>
                <div class="form-actions">
                  <button id="btnSubmit" type="button" class="btn btn-success">搜索</button>
                </div>
              </form>
          </div>
        </div>
    </div>
    
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>订单列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="listTable">
              <thead>
                <tr>
                  <th>GUID</th>
                  <th>用户名</th>
                  <th>角色昵称</th>
                  <th>充值金额</th>
                  <th>绿钻变化量</th>
                  <th>凭证有效性</th>
                  <th>时间</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeA">
                  <td colspan="7"></td>
                </tr>
              </tbody>
            </table>
            <div class="modal hide" id="modalFreeze">
                <div class="modal-header">
                  <button type="button" id="modalFreezeClose" class="close" data-dismiss="modal">×</button>
                  <h3>检查凭证有效性</h3>
                </div>
                <div class="modal-body">
                	
                </div>
                <div class="modal-footer"><a href="#" class="btn btn-primary" data-dismiss="modal" id="modalBtnFreezeSubmit">确定并关闭</a><a href="#" id="modalBtnFreezeClose" class="btn">关闭</a></div>
              </div>
          </div>
        </div>
    </div>
</div>
</div>
<link rel="stylesheet" href="<?php echo base_url('resources/css/select2.css'); ?>" />
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.popup_message.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript">
var dataTableHandler;

$(function() {
	$("#serverId").select2();
    $("#btnSubmit").click(function() {
		if(dataTableHandler) {
			dataTableHandler.fnDestroy();
		}
		$.post("<?php echo site_url('master/order_check/lists'); ?>", {
			"serverId": $("#serverId").val(),
			"guid": $("#guid").val(),
			"accountName": $("#accountName").val(),
			"nickname": $("#nickname").val()
		}, onData);
	});
	
	$("#modalFreezeClose, #modalBtnFreezeClose").click(function() {
		$("#modalFreeze").addClass("hide");
	});
	
	$("#modalBtnFreezeSubmit").click(function() {
		var parameter = {
			"guid": $("#guidConfirm").val(),
			"endtime": $("input[name='closureEndTime']:checked").val()
		};
		$.post("<?php echo site_url('master/order_check/check_receipt') ?>", parameter, onFreezeCallback);
	});
});

function onFreezeCallback(data) {
	$("#modalFreeze").addClass("hide");
	
	if(data) {
		
	}
}

function onData(data) {
	if(!data) {
		return;
	}
	
	var json = eval("(" + data + ")");
	dataTableHandler = $('#listTable').dataTable({
		"bAutoWidth": false,
		"bJQueryUI": true,
		"bStateSave": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"lr>t<"F"fp>',
		"aaData": json,
		"aoColumns": [
			{"mData": "account_guid"},
			{"mData": "account_name"},
			{"mData": "account_nickname"},
			{"mData": "funds_amount"},
			{"mData": "funds_item_amount"},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.is_verified == '1') {
						return "<span class=\"label label-success\">有效</span>";
					} else {
						return "<span class=\"label label-important\">无效</span>";
					}
				}
			},
			{"mData": "funds_time_local"},
			{
				"mData": null,
				"fnRender": function(obj) {
					return "<div class=\"btn-group\"><button class=\"btn btn-info btnFreeze\">验证凭证</button></div>";
				}
			}
		],
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
	
	$(document).on("click", ".btnFreeze", function() {
		$("#modalFreeze").removeClass("hide");
		
		var td = $(this).parent().parent().parent().find("td").eq(1);
		var accountName = td.text();
		var guid = td.prev().text();
		$("#guidConfirm").val(guid);
		$("#accountNameConfirm").text(accountName);
		return false;
	});
}
</script>