<?php 
include '../../comm.php';
$name = $_POST['name'];
$slug = $_POST['slug'];
$classname = $_POST['classname'];
$slugnew = $_POST['slugnew'];
$sql = "update  categories set name='{$name}',slug='{$slugnew}',classname='{$classname}' where slug='{$slug}'";
$res = mysqli_query($link,$sql);
$arr = array(
    'code' => 0,
    'msg' => '编辑失败'
);
if($res) {
    $arr = array(
    'code' => 1,
    'msg' => '编辑成功'
    );
};
echo json_encode($arr);
