<!--sidebar-menu-->
<?php
$permissionArray = explode(',', $admin->permission_list);
?>
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li<?php if($page_name == 'index'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('index'); ?>"><i class="icon icon-home"></i><span>总览</span></a></li>
    <?php if(in_array('permission', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'permission'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('permission'); ?>"><i class="icon icon-inbox"></i><span>权限设置</span></a> </li><?php endif; ?>
    <?php if(in_array('administrators', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'administrators'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('administrators'); ?>"><i class="icon icon-signal"></i><span>管理员设置</span></a></li><?php endif; ?>
    <!--<?php if(in_array('order/recharge', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'order/recharge'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('order/recharge'); ?>"><i class="icon icon-star"></i><span>充值记录</span></a></li><?php endif; ?>-->
    <li class="submenu"> <a href="#"><i class="icon icon-envelope"></i><span>游戏管理员</span><span class="label label-important"><i class="icon icon-arrow-down"></i></span></a>
      <ul>
        <?php if(in_array('master/grant_gold', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_gold'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_gold'); ?>">发放金币</a></li><?php endif; ?>
        <?php if(in_array('master/grant_special_gold', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_special_gold'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_special_gold'); ?>">发放绿钻</a></li><?php endif; ?>
        <?php if(in_array('master/grant_pack', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant_pack'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant_pack'); ?>">发放礼包</a></li><?php endif; ?>
        <?php if(in_array('master/account_manage', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/account_manage'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/account_manage'); ?>">帐号管理</a></li><?php endif; ?>
    	<!--
        <?php if(in_array('master/send_message', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/send_message'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/send_message'); ?>">发布游戏内公告</a></li><?php endif; ?>
        <?php if(in_array('master/send_article', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/send_article'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/send_article'); ?>">发布新闻公告</a></li><?php endif; ?>
        <?php if(in_array('master/grant', $permissionArray) || in_array('All', $permissionArray)): ?><li<?php if($page_name == 'master/grant'): ?> class="active"<?php endif; ?>><a href="<?php echo site_url('master/grant'); ?>">发放游戏道具</a></li><?php endif; ?>
        -->
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