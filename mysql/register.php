<?php
/**
 * 注册接口
 */
header("Content-Type: text/html; charset=UTF-8");
include_once 'mysql.php';
include_once 'util.php';

$username        = util::extractVal($_POST, 'username', '');
$password        = util::extractVal($_POST, 'password', '');
$account         = util::extractVal($_POST, 'account', '');
$password_repeat = util::extractVal($_POST, 'password_repeat', '');

if (empty($account)) {
    util::response(301, '账号不能为空');
}

if (empty($password) || empty($password_repeat)) {
    util::response(301, '密码不能为空');
}

if ($password != $password_repeat) {
    util::response(301, '两次输入的密码不一致');
}

util::checkPwd($password);

$con    = new mysql();
$sql    = "SELECT * FROM user WHERE account='{$account}'";
$result = $con->get_result($sql);
$user   = mysqli_fetch_assoc($result);
if ($user) {
    util::response(301, '账号已经存在');
}

$sql = "INSERT INTO user(account,password,username) VALUES ('{$account}','{$password}','{$username}')";
$res = $con->excute_dml($sql);
if ($res != 1) {
    util::response(500, '注册失败，请重试');
}

util::response(200, '注册成功，去登陆');