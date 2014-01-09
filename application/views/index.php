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
      <div class="accordion-group widget-box">
        <div class="accordion-heading">
          <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse"> <span class="icon"><i class="icon-magnet"></i></span>
            <h5>GM工具/发放金币</h5>
            </a>
          </div>
        </div>
        <div class="collapse accordion-body" id="collapseGThree">
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
    </div>
  	<h3>更新记录</h3>
    <hr />
    <div class="widget-box">
      <div class="widget-title bg_lo"  data-toggle="collapse" href="#collapseG3" > <span class="icon"> <i class="icon-chevron-down"></i> </span>
        <h5>News updates</h5>
      </div>
      <div class="widget-content nopadding updates collapse in" id="collapseG3">
        <div class="new-update clearfix"><i class="icon-ok-sign"></i>
          <div class="update-done"><a title="" href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a> <span>dolor sit amet, consectetur adipiscing eli</span> </div>
          <div class="update-date"><span class="update-day">20</span>jan</div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url('resources/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('resources/js/matrix.js'); ?>"></script>