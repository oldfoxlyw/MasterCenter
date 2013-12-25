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
                  <td colspan="6">载入中...</td>
                </tr>
              </tbody>
            </table>
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

<script type="text/javascript">
var dataTableHandler;

$(function() {
	$("#serverId").select2();
    $("#btnSubmit").click(function() {
		dataTableHandler.fnDestroy();
		$.post("<?php echo site_url('master/account_manage/send'); ?>", {
			"serverIp": $("#serverIp").val(),
			"nickname": $("#nickname").val(),
			"goldCount": $("#goldCount").val()
		}, onData);
	});
});

function onData(data) {
	
	dataTableHandler = $('#listTable').dataTable({
		"bAutoWidth": false,
		"bJQueryUI": true,
		"bStateSave": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"lr>t<"F"fp>',
		"aoColumns": [
			{"mData": null},
			{"mData": null},
			{"mData": null},
			{"mData": null},
			{
				"mData": null,
				"fnRender": function(obj) {
					return "<div class=\"btn-group\"><button onclick=\"location.href='<?php echo site_url('administrators/edit') ?>/" + obj.aData.GUID + "'\" class=\"btn btn-info\">编辑</button><button data-toggle=\"dropdown\" class=\"btn btn-info dropdown-toggle\"><span class=\"caret\"></span></button><ul class=\"dropdown-menu\"><!--<li><a href=\"<?php echo site_url('administrators/freeze') ?>/" + obj.aData.GUID + "\">冻结</a></li><li class=\"divider\"></li>--><li><a href=\"<?php echo site_url('administrators/delete') ?>/" + obj.aData.GUID + "\">删除</a></li></ul></div>";
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
}
</script>