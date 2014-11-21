MasterCenter
============

# POST /ser_create_items 发送道具
  # params:
  #   nkm: 昵称
  #   player_id: guid
  #   item_id: 道具id
  #   count: 数量
  # return:
  #   1: 成功 1502: 角色不存在 4040:道具不存在 1506:参数错误

  # POST /ser_get_items 获取道具列表

  # POST /ser_set_role_level设置角色等级
  # params:
  #   nkm: 昵称
  #   level: 等级
  # return:
  #	  success: 1

  # POST /ser_add_glory 增加荣耀
  # params:
  #   player_id: guid
  #   nkm: 昵称
  #   special_gold: 金币数量
  # return:
  #   1: 成功 1502: 角色不存在 1506: 参数错误

  # POST /ser_unlock_dungeons 解锁所有副本（除任务加锁副本）
  # params:
  #   nkm: 昵称
  # return:

# POST /ser_add_retinue 设置随从
  # params:
  #   nkm: 昵称
  #   retinues_ids: 随从常量id :分割

  # POST /ser_create_store_credentials 生成铁匠之证
  # params:
  #   nkm: 昵称

  # POST /ser_clear_missions 清理所有任务
  # params:
  #   nkm: 昵称

  # POST /ser_add_retinue_essence 添加随从精华
  # params:
  #   nkm: 昵称
  #   count: 添加随从精华

  # POST /ser_set_current_mission 设置当前主线任务
  # params:
  #   nkm: 昵称

  # POST /ser_complete_all_main_missions 完成所有主线任务
  # params:
  #   nkm: 昵称

  # POST /ser_all_retinue_keys 所有随从的key
  # params:
  #   nkm: 昵称