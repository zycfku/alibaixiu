<?php
include '../../comm.php';
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "select * from users where email='{$email}' and password='{$password}'";
$res = mysqli_query($link,$sql);
$data = mysqli_fetch_all($res,1);
$arr = array(
    'code' => 0,
    'msg' => '邮箱或者密码有误'
);
if($data) {
    session_start();
    $_SESSION['isLogin'] = 'yes';
    $_SESSION['nickname'] = $data[0]['nickname'];
    $_SESSION['avatar'] = $data[0]['avatar'];
      $arr = array(
          'code' => 1,
          'msg' => '登录成功'
      );
}
echo json_encode($arr);