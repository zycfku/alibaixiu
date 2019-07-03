<?php
include '../../comm.php';
$name = $_POST['name'];
$slug = $_POST['slug'];
$classname = $_POST['classname'];
$sql = "insert into categories (name,slug,classname) values ('{$name}','{$slug}','{$classname}');";
$res = mysqli_query($link, $sql);
$arr = array(
    'code' => 0,
    'msg' => '添加失败'
);
if ($res) {
    $arr = array(
        'code' => 1,
        'msg' => '添加成功'
    );
};
echo json_encode($arr);
