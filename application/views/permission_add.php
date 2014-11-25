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
                              <td rowspan="3"><input id="master_config" name="master_config" class="header_checkbox" type="checkbox" /></td>
                              <td rowspan="3"><strong>GM工具</strong></td>
                              <td width="20%"><input id="master_grant_gold" name="master_grant_gold" value="master/grant_gold" type="checkbox"<?php if(in_array('master/grant_gold', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发放金币</td>
                              <td width="20%"><input id="master_grant_special_gold" name="master_grant_special_gold" value="master/grant_special_gold" type="checkbox"<?php if(in_array('master/grant_special_gold', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发放绿钻</td>
                              <td width="20%"><input id="master_grant_item" name="master_grant_item" value="master/grant_item" type="checkbox"<?php if(in_array('master/grant_item', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              发放道具</td>
                              <td width="20%"><input id="master_send_mail" name="master_send_mail" value="master/send_mail" type="checkbox"<?php if(in_array('master/send_mail', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              发送邮件</td>
                            </tr>
                            <tr>
                              <td><input id="master_grant_retinue" name="master_grant_retinue" value="master/grant_retinue" type="checkbox"<?php if(in_array('master/grant_retinue', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              添加随从</td>
                              <td><input id="master_set_honor" name="master_set_honor" value="master/set_honor" type="checkbox"<?php if(in_array('master/set_honor', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                                增加角色荣耀</td>
                              <td><input id="master_set_level" name="master_set_level" value="master/set_level" type="checkbox"<?php if(in_array('master/set_level', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                                设置角色等级</td>
                              <td><input id="master_account_manage" name="master_account_manage" value="master/account_manage" type="checkbox"<?php if(in_array('master/account_manage', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                                帐号管理</td>
                            </tr>
                            <tr>
                              <td><input id="master_order_check" name="master_order_check" value="master/order_check" type="checkbox"<?php if(in_array('master/order_check', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              订单查询</td>
                              <td><input id="master_get_device_id" name="master_get_device_id" value="master/get_device_id" type="checkbox"<?php if(in_array('master/get_device_id', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                                设备码查询</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><input id="master_config" name="master_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>公告管理</strong></td>
                              <td width="20%"><input id="master_message" name="master_message" value="master/message" type="checkbox"<?php if(in_array('master/message', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />定时公告管理</td>
                              <td width="20%"><input id="master_message_add" name="master_message_add" value="master/message_add" type="checkbox"<?php if(in_array('master/message_add', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发布定时公告</td>
                              <td width="20%">&nbsp;</td>
                              <td width="20%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><input id="master_config" name="master_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>兑换码</strong></td>
                              <td width="20%"><input id="coupon_generate" name="coupon_generate" value="coupon/generate" type="checkbox"<?php if(in_array('coupon/generate', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              生成兑换码</td>
                              <td width="20%"><input id="coupon_query" name="coupon_query" value="coupon/query" type="checkbox"<?php if(in_array('coupon/query', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              查询兑换码</td>
                              <td width="20%">&nbsp;</td>
                              <td width="20%">&nbsp;</td>
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