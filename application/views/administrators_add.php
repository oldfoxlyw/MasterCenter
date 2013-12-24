<div id="content">
	<div id="content-header">
        <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="#" title="首页" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="#" class="current">管理员管理</a> </div>
        <h1><?php if(empty($edit)): ?>添加<?php else: ?>修改<?php endif; ?>管理员</h1>
  	</div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-align-justify"></i></span>
                	<h5>基本信息</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="<?php echo site_url('administrators/submit'); ?>" method="post" class="form-horizontal">
                    <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                    <input type="hidden" id="adminId" name="adminId" value="<?php echo $admin_id; ?>" />
                    <div class="control-group">
                      <label class="control-label" for="adminAccount">用户名</label>
                      <div class="controls">
                        <input type="text" class="span8" id="adminAccount" name="adminAccount" placeholder="用户名" value="<?php echo $value->user_name; ?>" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="adminPass">密码</label>
                      <div class="controls">
						<input type="password" class="span8" id="adminPass" name="adminPass" placeholder="密码" />
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="userPermission">管理员角色</label>
                        <div class="controls">
                            <select id="userPermission" name="userPermission" class="span5">
                            <?php foreach($permissions as $permission): ?>
                                <option value="<?php echo $permission->permission_id; ?>"<?php if($value->user_permission==$permission->permission_id): ?> selected="selected"<?php endif; ?>><?php echo $permission->permission_name; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="partnerKey">渠道商编码</label>
                      <div class="controls">
						<input type="text" class="span8" id="partnerKey" name="partnerKey" placeholder="渠道商编码" value="<?php echo $value->user_fromwhere; ?>" />
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
<link rel="stylesheet" href="<?php echo base_url('resources/css/select2.css'); ?>" />
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.ui.custom.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/select2.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script type="text/javascript">
$(function() {
	$("select").select2();
});
</script>