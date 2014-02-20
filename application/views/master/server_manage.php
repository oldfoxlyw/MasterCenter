<div id="content">
<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
    <h1>区服管理</h1>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
<!--End-Action boxes-->
    <div class="row-fluid">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>区服列表</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="listTable">
              <thead>
                <tr>
                  <th>排序</th>
                  <th>Server ID</th>
                  <th>服务器名</th>
                  <th>Web服务器地址</th>
                  <th>C++服务器地址</th>
                  <th>渠道编号</th>
                  <th>状态</th>
                  <th>推荐</th>
                  <th>调试</th>
                  <th>需要激活码</th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeA">
                  <td colspan="11"></td>
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
<script src="<?php echo base_url('resources/js/jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript">
var dataTableHandler;

$(function() {
	$.post("<?php echo site_url('master/server_manage/lists'); ?>", {}, onData);
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
			{"mData": "server_sort"},
			{"mData": "account_server_id"},
			{"mData": "server_name"},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.server_ip != "") {
						var json = eval("(" + obj.aData.server_ip + ")");
						var row = json[0];
						return "电信：" + row.ip + "<br>联通：" + row.ip2 + "<br>内网：" + row.lan + "<br>端口：" + row.port;
					}
				}
			},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.server_game_ip != "") {
						var json = eval("(" + obj.aData.server_game_ip + ")");
						var row = json[0];
						return "电信：" + row.ip + "<br>联通：" + row.ip2 + "<br>端口：" + row.port;
					}
				}
			},
			{"mData": "partner"},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.server_status == '1') {
						return "正常";
					} else if(obj.aData.server_status == '2') {
						return "繁忙";
					} else if(obj.aData.server_status == '3') {
						return "拥挤";
					} else if(obj.aData.server_status == '9') {
						return "隐藏";
					}
				}
			},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.server_recommend == '1') {
						return "<button class=\"btn btn-success btnDebugOn\" href=\"#\">是</button>";
					} else {
						return "<button class=\"btn btn-danger btnDebugOff\" href=\"#\">设为推荐服</button>";
					}
				}
			},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.server_debug == '1') {
						return "<button class=\"btn btn-success btnDebugOn\" href=\"#\">是</button>";
					} else {
						return "<button class=\"btn btn-danger btnDebugOff\" href=\"#\">否</button>";
					}
				}
			},
			{
				"mData": null,
				"fnRender": function(obj) {
					if(obj.aData.need_activate == '1') {
						return "<button class=\"btn btn-success btnDebugOn\" href=\"#\">是</button>";
					} else {
						return "<button class=\"btn btn-danger btnDebugOff\" href=\"#\">否</button>";
					}
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
	
	$(document).on("click", ".btnDebugOff", function() {
		var td = $(this).parent().parent().parent().find("td").eq(0);
		var id = td.prev().text();
		
		return false;
	});
}
</script>