<?php

// 引入comm.php这个文件  node 100%需要操作数据库 
include '../comm.php';

// 获取 传递过来的cid 
$cid = $_POST['cid'];

// 构建sql语句 
$sql = "SELECT p.title,p.created,p.content,p.feature,p.views,p.likes,p.slug,c.`name`,u.nickname,
(select count(*)  from comments WHERE post_id = p.id) AS comments 
FROM posts AS p
LEFT JOIN categories AS c 
ON p.category_id = c.id
LEFT JOIN users AS u 
ON p.user_id = u.id
WHERE c.id = {$cid}
ORDER BY created desc
LIMIT 0,10";

// 执行sql语句  查询语句 得到是一个结果集 
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

// 将$arr转换为json格式的字符串 
echo json_encode($arr);