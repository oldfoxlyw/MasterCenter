<div id="content">
	<div id="content-header">
        <div id="breadcrumb"> <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span><a href="#" title="首页" class="tip-bottom"><i class="icon-home"></i> 首页</a> <a href="#" class="current">权限设置</a> </div>
        <h1><?php if(empty($edit)): ?>添加<?php else: ?>修改<?php endif; ?>权限</h1>
  	</div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
			<form action="<?php echo site_url('permission/submit'); ?>" method="post" class="form-horizontal">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>基本信息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                        <input type="hidden" id="oldPermissionId" name="oldPermissionId" value="<?php echo $old_permission_id; ?>" />
                        <div class="control-group">
                          <label class="control-label" for="permissionId">权限等级</label>
                          <div class="controls">
                            <input type="text" class="span8" id="permissionId" name="permissionId" placeholder="权限等级，纯数字，不可重复" value="<?php echo $value->permission_level; ?>" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="permissionName">权限名称</label>
                          <div class="controls">
                            <input type="text" class="span8" id="permissionName" name="permissionName" placeholder="权限名称" value="<?php echo $value->permission_name; ?>" />
                          </div>
                        </div>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><input type="checkbox" id="title-checkbox" name="title-checkbox" /></span>
                        <h5>选择权限</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped with-check">
                          <tbody>
                            <tr>
                              <td><input id="global_config" name="global_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>系统权限</strong></td>
                              <td width="20%"><input id="permission" name="permission" value="permission" type="checkbox"<?php if(in_array('permission', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />查看权限</td>
                              <td width="20%"><input id="permission_add" name="permission_add" value="permission_add" type="checkbox"<?php if(in_array('permission_add', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />添加/修改权限</td>
                              <td width="20%"><input id="administrators" name="administrators" value="administrators" type="checkbox"<?php if(in_array('administrators', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />查看管理员</td>
                              <td width="20%"><input id="administrators_add" name="administrators_add" value="administrators_add" type="checkbox"<?php if(in_array('administrators_add', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />添加/编辑管理员</td>
                            </tr>
                            <tr>
                              <td><input id="master_config" name="master_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>游戏管理员</strong></td>
                              <td width="20%"><input id="master_grant_gold" name="master_grant_gold" value="master/grant_gold" type="checkbox"<?php if(in_array('master/grant_gold', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发放金币</td>
                              <td width="20%"><input id="master_grant_special_gold" name="master_grant_special_gold" value="master/grant_special_gold" type="checkbox"<?php if(in_array('master/grant_special_gold', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发放绿钻</td>
                              <td width="20%"><input id="master_grant_pack" name="master_grant_pack" value="master/grant_pack" type="checkbox"<?php if(in_array('master/grant_pack', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发放礼包</td>
                              <td width="20%"><input id="master_account_manage" name="master_account_manage" value="master/account_manage" type="checkbox"<?php if(in_array('master/account_manage', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />帐号管理</td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="form-actions">
                          <button type="submit" class="btn btn-success">保存</button>
                      </div>
                  </div>
                </div>
			</form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url('resources/css/select2.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('resources/css/uniform.css'); ?>" />
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.ui.custom.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/jquery.uniform.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/select2.min.js'); ?>"></script> 
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>
<script type="text/javascript">
$(function() {
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$("select").select2();
	
	$("#title-checkbox").click(function() {
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('input:checkbox');		
		checkbox.each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.checker > span').addClass('checked');
			}
		});
	});
	
	$("input.header_checkbox").click(function() {
		var td = $(this).parent().parent().parent();
		var rowSpan = td.attr("rowspan");
		var checkedStatus = this.checked;
		var tr = td.parent();
		if(!rowSpan) {
			tr.find("input[type=checkbox]").each(function() {
				this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
				}
			});
		} else {
			rowSpan = parseInt(rowSpan);
			for(var i = 0; i<rowSpan; i++) {
				tr.find("input[type=checkbox]").each(function() {
					this.checked = checkedStatus;
					if (checkedStatus == this.checked) {
						$(this).closest('.checker > span').removeClass('checked');
					}
					if (this.checked) {
						$(this).closest('.checker > span').addClass('checked');
					}
				});
				tr = tr.next();
			}
		}
	});
});
</script>