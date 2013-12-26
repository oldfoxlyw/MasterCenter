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
                              <td><input id="online_config" name="online_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>用户在线数据</strong></td>
                              <td><input id="account_current_online" name="account_current_online" value="account/current_online" type="checkbox"<?php if(in_array('account/current_online', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />即时在线数据</td>
                              <td><input id="account_max_online" name="account_max_online" value="account/max_online" type="checkbox"<?php if(in_array('account/max_online', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />最高在线数据</td>
                              <td><input id="account_avg_online" name="account_avg_online" value="account/avg_online" type="checkbox"<?php if(in_array('account/avg_online', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />平均在线数据</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td rowspan="3"><input id="user_config" name="user_config" class="header_checkbox" type="checkbox" /></td>
                              <td rowspan="3"><strong>用户数据</strong></td>
                              <td><input id="account_register_account" name="account_register_account" value="account/register_account" type="checkbox"<?php if(in_array('account/register_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />服务器注册用户数</td>
                              <td><input id="account_modify_account" name="account_modify_account" value="account/modify_account" type="checkbox"<?php if(in_array('account/modify_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />改名用户数</td>
                              <td><input id="account_register_new_account" name="account_register_new_account" value="account/register_new_account" type="checkbox"<?php if(in_array('account/register_new_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />新增注册用户</td>
                              <td><input id="account_modify_new_account" name="account_modify_new_account" value="account/modify_new_account" type="checkbox"<?php if(in_array('account/modify_new_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />新改名用户数</td>
                            </tr>
                            <tr>
                              <td><input id="account_active_account" name="account_active_account" class="header_checkbox" value="account/active_account" type="checkbox"<?php if(in_array('account/active_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />服务器活跃用户数</td>
                              <td><input id="account_pay_account" name="account_pay_account" value="account/pay_account" type="checkbox"<?php if(in_array('account/pay_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />服务器付费用户数</td>
                              <td><input id="account_flowover_account" name="account_flowover_account" value="account/flowover_account" type="checkbox"<?php if(in_array('account/flowover_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />服务器流失用户数</td>
                              <td><input id="account_reflow_account" name="account_reflow_account" value="account/reflow_account" type="checkbox"<?php if(in_array('account/reflow_account', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />服务器回流用户数</td>
                            </tr>
                            <tr>
                              <td><input id="account_flowover_account_detail" name="account_flowover_account_detail" value="account/flowover_account_detail" type="checkbox"<?php if(in_array('account/flowover_account_detail', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />服务器流失用户详情</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td rowspan="2"><input id="order_config" name="order_config" class="header_checkbox" type="checkbox" /></td>
                              <td rowspan="2"><strong>消费数据</strong></td>
                              <td width="20%"><input id="order_recharge" name="order_recharge" value="order/recharge" type="checkbox"<?php if(in_array('order/recharge', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />充值记录</td>
                              <td width="20%"><input id="order_consume" name="order_consume" value="order/consume" type="checkbox"<?php if(in_array('order/consume', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />
                              消费总体统计</td>
                              <td width="20%"><input id="order_recharge_daily" name="order_recharge_daily" value="order/recharge_daily" type="checkbox"<?php if(in_array('order/recharge_daily', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />每日充值概况</td>
                              <td width="20%"><input id="order_buy_equipment" name="order_buy_equipment" value="order/buy_equipment" type="checkbox"<?php if(in_array('order/buy_equipment', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />购买装备消费统计</td>
                            </tr>
                            <tr>
                              <td><input id="order_equipment_sales" name="order_equipment_sales" value="order/equipment_sales" type="checkbox"<?php if(in_array('order/equipment_sales', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />装备销量统计</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><input id="behavior_config" name="behavior_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>游戏行为监控</strong></td>
                              <td width="20%"><input id="behavior_job" name="behavior_job" value="behavior/job" type="checkbox"<?php if(in_array('behavior/job', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />职业数量分布</td>
                              <td width="20%"><input id="behavior_level" name="behavior_level" value="behavior/level" type="checkbox"<?php if(in_array('behavior/level', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />等级分布</td>
                              <td width="20%"><input id="behavior_progress" name="behavior_progress" value="behavior/progress" type="checkbox"<?php if(in_array('behavior/progress', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />角色游戏进度</td>
                              <td width="20%">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><input id="master_config" name="master_config" class="header_checkbox" type="checkbox" /></td>
                              <td><strong>游戏管理员</strong></td>
                              <td width="20%"><input id="master_send_message" name="master_send_message" value="master/send_message" type="checkbox"<?php if(in_array('master/send_message', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发布游戏公告</td>
                              <td width="20%"><input id="master_send_article" name="master_send_article" value="master/send_article" type="checkbox"<?php if(in_array('master/send_article', $permission_check) || in_array('All', $permission_check)): ?> checked="checked"<?php endif; ?> />发布新闻公告</td>
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