<div id="content">
	<div id="content-header">
        <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="#" class="current">权限设置</a> </div>
        <h1>权限设置</h1>
  	</div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid" style="text-align:right;">
        	<button onclick="location.href='<?php echo site_url('permission/add'); ?>'" class="btn btn-success">添加权限</button>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>权限列表</h5>
                  </div>
                  <div class="widget-content nopadding">
                    <table class="table table-bordered data-table" id="listTable">
                      <thead>
                        <tr>
                          <th>权限等级</th>
                          <th>权限名称</th>
                          <th>-</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="gradeA">
                          <td colspan="3">载入中...</td>
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
		"sAjaxSource": "<?php echo site_url('permission/lists'); ?>",
		"sServerMethod": "POST",
		"aoColumns": [
			{"mData": "permission_id", "width": 100},
			{"mData": "permission_name"},
			{
				"mData": null,
				"fnRender": function(obj) {
					return "<div class=\"btn-group\"><button onclick=\"location.href='<?php echo site_url('permission/edit') ?>/" + obj.aData.permission_id + "'\" class=\"btn btn-info\">编辑</button><button data-toggle=\"dropdown\" class=\"btn btn-info dropdown-toggle\"><span class=\"caret\"></span></button><ul class=\"dropdown-menu\"><li><a href=\"<?php echo site_url('permission/delete') ?>/" + obj.aData.permission_id + "\">删除</a></li></ul></div>";
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