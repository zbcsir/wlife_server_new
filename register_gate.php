<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:43
 *
 * 用于网关首次启动时注册或者之后修改code
 * 参数:imei code dt
 * 描述:先判断是否有含有此imei的记录 没有则insert 有则update
 * 返回:成功返回 success() 失败返回相应错误码与描述 参见data.php
 */
//TODO