<?php
$permissionArray = explode(',', $admin->permission_list);
?>
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb">
        <span id="btnSwitchSidebar" class="badge margin-left-5 pointer" title="Close Sidebar"><i class="icon-chevron-left"></i><span> 关闭侧边栏</span></span>
    	<a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a>
    </div>
  </div>
  
  <div class="container-fluid">
  	<h3>操作指南</h3>
    <hr />
    <div class="accordion" id="collapse-group">
      <?php if(in_array('permission', $permissionArray) || in_array('All', $permissionArray)): ?>
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>权限设置</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGOne">
          <div class="widget-content">
          	<h4>列表</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109111143.jpg'); ?>" />
            <ol>
            	<li>权限列表，可点击功能按钮进行操作（编辑/删除）。<span class="label label-important">注意：只能查看当前登录管理员权限等级相同或更低的权限</span></li>
                <li>添加权限按钮</li>
            </ol>
            <hr />
            <h4>添加/修改</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109111222.jpg'); ?>" />
            <ol>
            	<li>定义权限等级<span class="label label-important">注意：只能定义比自己权限等级更低的等级(1000以内纯数字)</span></li>
                <li>定义权限的名称</li>
                <li>勾选要赋予的权限</li>
            </ol>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if(in_array('administrators', $permissionArray) || in_array('All', $permissionArray)): ?>
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>管理员设置</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGTwo">
          <div class="widget-content">
          	<h4>列表</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109114702.jpg'); ?>" />
            <ol>
            	<li>管理员列表，可点击功能按钮进行操作（编辑/删除）。<span class="label label-important">注意：只能查看当前登录管理员权限等级相同或更低的管理员帐号</span></li>
                <li>添加管理员按钮</li>
            </ol>
            <hr />
            <h4>添加/修改</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109114710.jpg'); ?>" />
            <ol>
            	<li>管理员用户名</li>
                <li>管理员密码，<span class="label label-important">注意：当处于编辑状态时，密码留空表示不修改密码</span></li>
                <li>选择管理员的权限</li>
                <li>保存按钮</li>
            </ol>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if(in_array('master/grant_gold', $permissionArray) || in_array('All', $permissionArray)): ?>
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>GM工具/发放金币</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGThree">
          <div class="widget-content">
            <img src="<?php echo base_url('resources/img/guide/20140109115805.jpg'); ?>" />
            <ol>
            	<li>选择服务器</li>
                <li>角色昵称，<span class="label label-important">注意：区分半角全角中文字符，角色昵称必须与游戏中完全一致</span></li>
            	<li>金币变化量，<span class="label label-important">注意：目前只支持正数，即增加量</span></li>
            </ol>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if(in_array('master/grant_special_gold', $permissionArray) || in_array('All', $permissionArray)): ?>
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>GM工具/发放绿钻</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGFour">
          <div class="widget-content">
            <img src="<?php echo base_url('resources/img/guide/20140109115827.jpg'); ?>" />
            <ol>
            	<li>选择服务器</li>
                <li>角色昵称，<span class="label label-important">注意：区分半角全角中文字符，角色昵称必须与游戏中完全一致</span></li>
            	<li>绿钻变化量，<span class="label label-important">注意：目前只支持正数，即增加量</span></li>
            </ol>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if(in_array('master/grant_pack', $permissionArray) || in_array('All', $permissionArray)): ?>
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGFive" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>GM工具/发放礼包</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGFive">
          <div class="widget-content">
          	<h4>发放礼包</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109115837.jpg'); ?>" />
            <ol>
            	<li>选择服务器</li>
                <li>角色昵称，<span class="label label-important">注意：区分半角全角中文字符，角色昵称必须与游戏中完全一致</span></li>
            	<li>礼包ID，<span class="label label-important">注意：点击“礼包列表”查看现有的礼包ID</span></li>
                <li>获取礼包列表</li>
                <li>发放礼包的数量，单位个</li>
            </ol>
            <hr />
          	<h4>获取礼包列表</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109115850.jpg'); ?>" />
            <ol>
            	<li>对应礼包的ID，填入“发放礼包”界面的“礼包ID”栏内</li>
            </ol>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php if(in_array('master/account_manage', $permissionArray) || in_array('All', $permissionArray)): ?>
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGSix" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>GM工具/帐号管理</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGSix">
          <div class="widget-content">
          	<h4>列表</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109115914.jpg'); ?>" />
            <ol>
            	<li>筛选条件</li>
                <li>帐号列表，可进行编辑（暂未开放）、封停、删除操作</li>
            </ol>
            <hr />
          	<h4>封停</h4>
            <img src="<?php echo base_url('resources/img/guide/20140109122638.jpg'); ?>" />
            <ol>
            	<li>请认真核实帐户名是否正确</li>
            	<li>封停时限，到期之后会自动解封</li>
            </ol>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  	<h3>更新记录</h3>
    <hr />
    <div class="widget-box">
      <div class="widget-title bg_lo"  data-toggle="collapse" href="#collapseG3" > <span class="icon"> <i class="icon-chevron-down"></i> </span>
        <h5>更新记录</h5>
      </div>
      <div class="widget-content nopadding updates collapse in" id="collapseG3">
        <div class="new-update clearfix"><i class="icon-ok-sign"></i>
          <div class="update-done"><a title="" href="#"><strong>更新首页指南</strong></a> <span>更新首页用户指南，添加更新记录</span> </div>
          <div class="update-date"><span class="update-day">9</span>一月</div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>