<div id="content">
	<div id="content-header">
        <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="#" class="current">管理员管理</a> </div>
        <h1>管理员管理</h1>
  	</div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid" style="text-align:right;">
        	<button onclick="location.href='<?php echo site_url('administrators/add'); ?>'" class="btn btn-success">添加管理员</button>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>管理员列表</h5>
                  </div>
                  <div class="widget-content nopadding">
                    <table class="table table-bordered data-table" id="listTable">
                      <thead>
                        <tr>
                          <th>GUID</th>
                          <th>用户名</th>
                          <th>角色权限</th>
                          <th>帐号状态</th>
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
</div>
<link rel="stylesheet" href="<?php echo base_url('resources/css/select2.css'); ?>" />
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/jquery.ui.custom.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/select2.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/jquery.dataTables.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script> 
<script type="text/javascript">
$(function() {
	$('#listTable').dataTable({
		"bAutoWidth": false,
		"bJQueryUI": true,
		"bStateSave": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"H"lr>t<"F"fp>',
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "<?php echo site_url('administrators/lists'); ?>",
		"sServerMethod": "POST",
		"aoColumns": [
			{"mData": "GUID", "width": 300, "bSortable": false},
			{"mData": "user_name"},
			{"mData": "permission_name"},
			{
				"mData": "user_freezed",
				"fnRender": function(obj) {
					if(obj.aData.user_freezed == "1") {
						return "<span class=\"label label-important\">冻结</span>"
					} else {
						return "<span class=\"label label-success\">正常</span>"
					}
				}
			},
			{"mData": "user_fromwhere"},
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
	
	$('select').select2();
});
</script>