<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>定时公告管理</h1>
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
            <h5>公告列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="listTable">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>适用服务器</th>
                  <th>内容概要</th>
                  <th>定时规则<br />（分 时 日）</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeA">
                  <td colspan="6"></td>
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
		$.post("<?php echo site_url('master/message/lists'); ?>", {
			"serverId": $("#serverId").val()
		}, onData);
	});
});

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
			{"mData": "id"},
			{"mData": "server_id"},
			{
				"mData": "content",
				"fnRender": function(obj) {
					return obj.aData.content.substr(0, 20);
				}
			},
			{
				"mData": null,
				"fnRender": function(obj) {
					return obj.aData.minutes + " " + obj.aData.hour + " " + obj.aData.date
				}
			},
			{"mData": "starttime"},
			{"mData": "endtime"},
			{
				"mData": null,
				"fnRender": function(obj) {
					return "<div class=\"btn-group\"><button onclick=\"location.href='<?php echo site_url('master/message/edit') ?>/" + obj.aData.id + "';\" class=\"btn btn-info\">编辑</button><button url=\"<?php echo site_url('master/message/delete') ?>/" + obj.aData.id + "\" class=\"btn btn-info btnDelete\">删除</button></div>";
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
	
	$(document).on("click", ".btnDelete", function() {
		var url = $(this).attr("url");
		if(confirm("确定要删除这条公告吗？注意，该操作不可逆！")) {
			location.href=url;
		}
		return false;
	});
}
</script>