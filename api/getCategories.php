<?php 
//这个文件的主要作用 就是连接数据库 将相关数据读取出来  然后返回给请求的人员 
// 引入comm.php文件

include '../comm.php';

$sql = "select * from categories where id !=1";

$res = mysqli_query($link,$sql);

$data = mysqli_fetch_all($res,1);
// $data = getMoreData($link,$sql);

$arr = array(
    'code' => 0,
    'msg' => '操作失败'
);

if($data){
    $arr = array(
        'code' => 1,
        'msg' => '操作成功',
        'data' => $data
    );
}

echo json_encode($arr);