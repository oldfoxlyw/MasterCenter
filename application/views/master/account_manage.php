<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>帐号管理</h1>
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
            <h5>账号列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="listTable">
              <thead>
                <tr>
                  <th>GUID</th>
                  <th>用户名</th>
                  <th>帐号状态</th>
                  <th>服务器编号</th>
                  <th>渠道编号</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeA">
                  <td colspan="6"></td>
                </tr>
              </tbody>
            </table>
            <div class="modal hide" id="modalFreeze">
                <div class="modal-header">
                  <button type="button" id="modalFreezeClose" class="close" data-dismiss="modal">×</button>
                  <h3>封停帐号</h3>
                </div>
                <div class="modal-body">
                	<form action="" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">帐号名称</label>
                            <div class="controls">
                            	<input type="hidden" id="guidConfirm" name="guidConfirm" />
                            	<span id="accountNameConfirm"></span>
                            	<span class="help-block"><strong>请确认封停的帐号正确无误</strong></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">封停时限</label>
                            <div class="controls">
                                <input name="closureEndTime" type="radio" value="3" checked="checked" />三天
                                <input name="closureEndTime" type="radio" value="7" />七天
                                <input name="closureEndTime" type="radio" value="30" />一个月
                                <input name="closureEndTime" type="radio" value="9999" />永久封停
                                <span class="help-block"><strong>到期自动解封，无需再手动操作</strong></span>
                            </div>
                        </div>
                      </form>
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
		$.post("<?php echo site_url('master/account_manage/lists'); ?>", {
			"serverId": $("#serverId").val(),
			"guid": $("#guid").val(),
			"accountName": $("#accountName").val()
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
		$.post("<?php echo site_url('master/account_manage/freeze') ?>", parameter, onFreezeCallback);
	});
});

function onFreezeCallback(data) {
	$("#modalFreeze").addClass("hide");
	
	if(data) {
		var td = $("#listTable > tbody > tr > td:contains('" + data.guid + "')");
		var tr = td.parent();
		tr.find("td").eq(2).text("封停");
		
		var a = tr.find("td").eq(5).find(".btnFreeze");
		a.after("<a class=\"btnUnfreeze\" href=\"#\">解封</a>");
		a.remove();
	}
}

function onUnfreezeCallback(data) {
	if(data) {
		var td = $("#listTable > tbody > tr > td:contains('" + data.guid + "')");
		var tr = td.parent();
		tr.find("td").eq(2).text("正常");
		
		var a = tr.find("td").eq(5).find(".btnUnfreeze");
		a.after("<a class=\"btnFreeze\" href=\"#\">封停</a>");
		a.remove();
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
			{"mData": "GUID"},
			{"mData": "account_name"},
			{"mData": "account_status"},
			{"mData": "server_id"},
			{"mData": "partner_key"},
			{
				"mData": null,
				"fnRender": function(obj) {
					var freezed = "";
					if(obj.aData.account_status == '1') {
						freezed = "<button class=\"btnFreeze\" href=\"#\" class=\"btn btn-info\">封停</button>";
					} else {
						freezed = "<button class=\"btnUnfreeze\" href=\"#\" class=\"btn btn-info\">解封</button>";
					}
					return "<div class=\"btn-group\"><button onclick=\"alert('暂未开放');\" class=\"btn btn-info\">编辑</button>" + freezed + "<button onclick=\"location.href='<?php echo site_url('master/account_manage/delete') ?>/" + obj.aData.GUID + "'\" class=\"btn btn-info\">删除</button></div>";
					//return "<div class=\"btn-group\"><button onclick=\"location.href='<?php echo site_url('master/account_manage/reset_password') ?>/" + obj.aData.GUID + "'\" class=\"btn btn-info\">重置密码</button><button onclick=\"location.href='<?php echo site_url('master/account_manage/edit') ?>/" + obj.aData.GUID + "'\" class=\"btn btn-info\">编辑</button><button data-toggle=\"dropdown\" class=\"btn btn-info dropdown-toggle\"><span class=\"caret\"></span></button><ul class=\"dropdown-menu\">" + freezed + "<li class=\"divider\"></li><li><a href=\"<?php echo site_url('master/account_manage/delete') ?>/" + obj.aData.GUID + "\">删除</a></li></ul></div>";
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
		
		var td = $(this).parent().parent().parent().parent().parent().find("td").eq(1);
		var accountName = td.text();
		var guid = td.prev().text();
		$("#guidConfirm").val(guid);
		$("#accountNameConfirm").text(accountName);
		return false;
	});
	
	$(document).on("click", ".btnUnfreeze", function() {
		var guid = $(this).parent().parent().parent().parent().parent().find("td").eq(0).text();
		var parameter = {
			"guid": guid
		};
		$.post("<?php echo site_url('master/account_manage/unfreeze') ?>", parameter, onUnfreezeCallback);
		return false;
	});
}
</script>