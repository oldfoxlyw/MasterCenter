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
        <div class="alert alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
          <h4 class="alert-heading">注意</h4>
          <ol>
          <li>所有标注为“有效”的订单均为已成功到账的并且玩家已成功收到绿钻的订单。</li>
          <li>该功能上线时间为2014-02-26 11:30:00，故在此之前产生的订单不能完全判断其有效性，仅能做参考。</li>
          </ol>
        </div>
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
                  <th>唯一标识</th>
                  <th>时间</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeA">
                  <td colspan="9"></td>
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
var productList = ["binghuo_gems_pack6", "binghuo_gems_pack30", "binghuo_gems_pack45", "binghuo_gems_pack98", "binghuo_gems_pack138", "binghuo_gems_pack198", "binghuo_gems_pack318", "binghuo_gems_pack618", "hd_binghuo_gems_pack6", "hd_binghuo_gems_pack30", "hd_binghuo_gems_pack45", "hd_binghuo_gems_pack98", "hd_binghuo_gems_pack138", "hd_binghuo_gems_pack198", "hd_binghuo_gems_pack318", "hd_binghuo_gems_pack618"];

Array.prototype.contains = function (element) {
	for (var i = 0; i < this.length; i++) {
		if (this[i] == element) {
			return true;
		}
	}
	return false;
}

$(function() {
	$("#serverId").select2();
    $("#btnSubmit").click(function() {
		if($("#guid").val() == "" && $("#accountName").val() == "" && $("#nickname").val() == "") {
			alert("请至少填写一个条件");
			return false;
		}
		$(this).attr("disabled", "disabled");
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
	
	$(document).on("click", ".btnFreeze", function() {
		//$("#modalFreeze").removeClass("hide");
		$(this).attr("disabled", "disabled");
		$(this).text("验证中...");
		var td = $(this).parent().parent().parent().find("td").eq(5);
		var receipt = td.find(".receipt").text();
		
		var parameter = {
			"receipt": receipt
		};
		$.post("<?php echo site_url('master/order_check/check_receipt') ?>", parameter, onReceiptCheck);
		
		return false;
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
	$("#btnSubmit").removeAttr("disabled");
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
			{
				"mData": null,
				"fnRender": function(obj) {
					return obj.aData.funds_amount / 100;
				}
			},
			{"mData": "funds_item_amount"},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.appstore_status == '0') {
						return "<span class=\"label label-success\">有效</span><span class=\"receipt\" style=\"display:none;\">" + obj.aData.receipt_data + "</span>";
					} else {
						return "<span class=\"label label-important\">无效(" + obj.aData.appstore_status + ")</span><span class=\"receipt\" style=\"display:none;\">" + obj.aData.receipt_data + "</span>";
					}
				}
			},
			{"mData": "appstore_device_id"},
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
}

function onReceiptCheck(data) {
	$(".btnFreeze").removeAttr("disabled");
	$(".btnFreeze").text("验证凭证");
	
	if(data) {
		if(data.status == "0") {
			var product = data.receipt.product_id;
			if(productList.contains(product)) {
				alert("凭证有效");
			} else {
				alert("凭证无效");
			}
			return;
		}
		alert("凭证无效");
	}
}
</script>