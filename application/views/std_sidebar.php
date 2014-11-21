<!--sidebar-menu-->
<?php
$permissionArray = explode(',', $admin->permission_list);
?>
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li<?php if($page_name == 'index'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('index'); ?>"><i class="icon icon-home"></i><span>首页</span></a></li>
    <?php if(in_array('permission', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'permission'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('permission'); ?>"><i class="icon icon-inbox"></i><span>权限设置</span></a> </li><?php endif; ?>
    <?php if(in_array('administrators', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'administrators'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('administrators'); ?>"><i class="icon icon-signal"></i><span>管理员设置</span></a></li><?php endif; ?>
    <!--<?php if(in_array('order/recharge', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'order/recharge'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('order/recharge'); ?>"><i class="icon icon-star"></i><span>充值记录</span></a></li><?php endif; ?>-->
    <li class="submenu"> <a href="#"><i class="icon icon-envelope"></i><span>GM工具</span><span class="label label-important"><i class="icon icon-arrow-down"></i></span></a>
      <ul>
        <?php if(in_array('master/grant_gold', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_gold'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_gold'); ?>">发放金币</a></li><?php endif; ?>
        <?php if(in_array('master/grant_special_gold', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_special_gold'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_special_gold'); ?>">发放绿钻</a></li><?php endif; ?>
        <?php if(in_array('master/grant_item', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_item'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_item'); ?>">发送道具</a></li><?php endif; ?>
        <?php if(in_array('master/send_mail', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/send_mail'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/send_mail'); ?>">发送邮件</a></li><?php endif; ?>
        <?php if(in_array('master/grant_retinue', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_retinue'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_retinue'); ?>">添加随从</a></li><?php endif; ?>
        <?php if(in_array('master/account_manage', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/account_manage'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/account_manage'); ?>">帐号管理</a></li><?php endif; ?>
        <?php if(in_array('master/order_check', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/order_check'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/order_check'); ?>">订单查询</a></li><?php endif; ?>
        <?php if(in_array('master/get_device_id', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/get_device_id'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/get_device_id'); ?>">设备码查询</a></li><?php endif; ?>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-envelope"></i><span>公告管理</span><span class="label label-important"><i class="icon icon-arrow-down"></i></span></a>
      <ul>
<!--
        <?php if(in_array('master/articles', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/articles'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/articles'); ?>">新闻公告管理</a></li><?php endif; ?>
        <?php if(in_array('master/articles_add', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/articles_add'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/articles/add'); ?>">发布新闻公告</a></li><?php endif; ?>
-->
        <?php if(in_array('master/message', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/message'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/message'); ?>">定时公告管理</a></li><?php endif; ?>
        <?php if(in_array('master/message_add', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/message_add'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/message/add'); ?>">发布定时公告</a></li><?php endif; ?>

      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-envelope"></i><span>区服管理</span><span class="label label-important"><i class="icon icon-arrow-down"></i></span></a>
      <ul>
        <?php if(in_array('master/refresh_tcp_server', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/refresh_tcp_server'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/refresh_tcp_server'); ?>">手动刷新广播地址</a></li><?php endif; ?>
      </ul>
    </li>
    <li class="submenu"> <a href=""><i class="icon icon-envelope"></i><span>兑换码</span><span class="label label-important"><i class="icon icon-arrow-down"></i></span></a>
      <ul>
        <?php if(in_array('coupon/generate', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'coupon/generate'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('coupon/generate'); ?>">生成兑换码</a></li><?php endif; ?>
        <?php if(in_array('coupon/query', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'coupon/query'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('coupon/query'); ?>">查询兑换码</a></li><?php endif; ?>
      </ul>
    </li>
    <!--
    <li class="content"> <span>Monthly Bandwidth Transfer</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 77%;" class="bar"></div>
      </div>
      <span class="percent">77%</span>
      <div class="stat">21419.94 / 14000 MB</div>
    </li>
    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li>
    -->
  </ul>
</div>
<!--sidebar-menu-->