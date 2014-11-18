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
                    <label class="control-label">兑换码</label>
                    <div class="controls">
                    	<input type="text" class="span8" id="coupon" name="coupon" placeholder="兑换码" />
                  	</div>
                </div>
                <div class="form-actions">
                  <button id="btnSubmit" type="button" class="btn btn-success">查询</button>
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
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="listTable">
              <thead>
                <tr>
                  <th>兑换码</th>
                  <th>分类/渠道</th>
                  <th>是否使用</th>
                </tr>
              </thead>
              <tbody>
                <tr class="gradeA">
                  <td colspan="3"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/masked.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.dataTables.min.js'); ?>"></script>

<script type="text/javascript">
var dataTableHandler;
$(function() {
    $("#btnSubmit").click(function() {
		if($("#coupon").val() == "") {
			alert("请填写兑换码");
			return false;
		}
    if(dataTableHandler) {
      dataTableHandler.fnDestroy();
    }
    $(this).attr("disabled", "disabled");
		$.post("<?php echo site_url('coupon/query/lists'); ?>", {
      "coupon": $("#coupon").val()
		}, onData);
	});
});

function onData(data) {
	if(!data) {
		return;
	}
  var json = eval('(' + data + ')');
  $("#btnSubmit").attr("disabled", false);
  dataTableHandler = $('#listTable').dataTable({
    "bAutoWidth": false,
    "bJQueryUI": true,
    "bStateSave": true,
    "sPaginationType": "full_numbers",
    "sDom": '<"H"lr>t<"F"fp>',
    "aaData": json,
    "aoColumns": [
      {"mData": "code"},
      {"mData": "comment"},
      {
        "mData": null,
        "fnRender": function(obj) {
          var status = "";
          if(obj.aData.disabled == '1') {
            status = "<span class=\"label label-important\" href=\"#\">已使用</span>";
          } else {
            status = "<span class=\"label label-success\" href=\"#\">未使用</span>";
          }
          return status;
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