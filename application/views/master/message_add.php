<div id="content">
	<div id="content-header">
        <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="#" title="首页" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="#" class="current">定时公告管理</a> </div>
        <h1><?php if(empty($edit)): ?>添加<?php else: ?>修改<?php endif; ?>定时公告</h1>
  	</div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-align-justify"></i></span>
                	<h5>定时公告</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="<?php echo site_url('master/message/submit'); ?>" method="post" class="form-horizontal">
                    <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                    <div class="control-group">
                        <label class="control-label">选择服务器</label>
                        <div class="controls">
                            <select id="serverId" name="serverId">
                            <?php foreach($server_result as $server): ?>
                                <option value="<?php echo $server->account_server_id; ?>" <?php if($server->account_server_id == $value->server_id): ?>selected="selected"<?php endif; ?>><?php echo $server->server_name; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">消息内容</label>
                        <div class="controls">
                            <textarea name="messageContent" rows="10" class="span11" id="messageContent" ><?php echo $value->content; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="adminPass">定时规则</label>
                      <div class="controls">
						<input type="text" class="span2" id="minutes" name="minutes" placeholder="分" value="<?php echo $value->minutes; ?>" /> 分
                        <input type="text" class="span2" id="hour" name="hour" placeholder="时" <?php echo $value->hour; ?> /> 时
                        <input type="text" class="span2" id="date" name="date" placeholder="日" <?php echo $value->date; ?> /> 日
                      </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label class="control-label">开始时间(yyyy-mm-dd)</label>
                            <div class="controls">
                                <div data-date="<?php if(empty($value->starttime)) echo date('Y-m-d', $current_time); else echo date('Y-m-d', $value->starttime); ?>" class="input-append date datepicker">
                                    <input type="text" id="startTime" name="startTime" value="<?php if(empty($value->starttime)) echo date('Y-m-d', $current_time); else echo date('Y-m-d', $value->starttime); ?>"  data-date-format="yyyy-mm-dd" >
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <label class="control-label">结束时间(yyyy-mm-dd)</label>
                            <div class="controls">
                                <div data-date="<?php if(empty($value->endtime)) echo date('Y-m-d', $current_time + 7 * 86400); else echo date('Y-m-d', $value->endtime); ?>" class="input-append date datepicker">
                                    <input type="text" id="endTime" name="endTime" value="<?php if(empty($value->endtime)) echo date('Y-m-d', $current_time + 7 * 86400); else echo date('Y-m-d', $value->endtime); ?>"  data-date-format="yyyy-mm-dd" >
                                    <span class="add-on"><i class="icon-th"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-success">保存</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url('resources/css/datepicker.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/css/select2.css'); ?>" />
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.ui.custom.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/select2.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript">
$(function() {
	$("select").select2();
    $('.datepicker').datepicker();
});
</script>