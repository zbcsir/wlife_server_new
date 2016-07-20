<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于删除家庭成员 实际上就是变相的解绑网关 所以参考unbind_gate.php
 * 参数: gate name
 * 描述: update account set gate = null where name
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */