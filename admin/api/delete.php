<?php
include '../../comm.php';
$slug = $_POST['slug'];
$sql = "delete from categories where slug='{$slug}'";
$res = mysqli_query($link, $sql);
$arr = array(
    'code' => 0,
    'msg' => '删除失败'
);
if ($res) {
    $arr = array(
        'code' => 1,
        'msg' => '删除成功'
    );
};
echo json_encode($arr);
