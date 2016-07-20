<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 2016/7/20
 * Time: 22:48
 *
 * 用于转让管理员权限
 * 参数: gate name pw new_name
 * 描述: 先验证密码再 update gate set master = new_name where gate
 * 返回: 成功返回 success() 失败返回相应错误码与描述 参见data.php
 */