<?php
/**
 * 登录接口
 */
header("Content-Type: text/html; charset=UTF-8");
include_once 'mysql.php';
include_once 'util.php';

$account  = util::extractVal($_POST, 'account', '');
$password = util::extractVal($_POST, 'password', '');
if (empty($account) || empty($password)) {
    util::response(301, '账号或密码不能为空');
}

$verification = util::extractVal($_POST, 'verification', '');
if (strtolower($_SESSION['verification']) != strtolower($verification)) {
    util::response(301, '请输入正确验证码');
}

$con      = new mysql();
$account  = util::filterParams($account);
$password = util::filterParams($password);
$sql      = "SELECT * FROM user WHERE account='{$account}' && password='{$password}'";
$result   = $con->get_result($sql);
$user     = mysqli_fetch_assoc($result);
$con->for_close();
if (!$user) {
    util::response(301, '账号或密码不正确');
}

setcookie('account', $account, time() + 10, '/');
setcookie('username', $user['username'], time() + 10, '/');

util::response(200, '登陆成功', $user);