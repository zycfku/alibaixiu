<?php

// 引入comm.php这个文件  node 100%需要操作数据库 
include '../comm.php';

// 获取 传递过来的cid 
$cid = $_POST['cid'];
// 获取点击的次数 
$count = $_POST['count'];
// 当我们点击第一次的时候 10
// 当我们点击第二次的时候 20
$pageSize = 10; // 每一次返回多少条数据 
$offset = ($count - 1) * $pageSize; // 从哪个下标开始

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
LIMIT {$offset},{$pageSize}";

// 执行sql语句  查询语句 得到是一个结果集 
$res = mysqli_query($link,$sql);

$data = mysqli_fetch_all($res,1);
// $data = getMoreData($link,$sql);


// $oneSql 
$oneSql = "select count(*) AS c from posts where category_id ={$cid}";

$result = mysqli_query($link,$oneSql);
$oneData = mysqli_fetch_assoc($result);

$arr = array(
    'code' => 0,
    'msg' => '操作失败'
);

if($data){
    $arr = array(
        'code' => 1,
        'msg' => '操作成功',
        'data' => $data,
        'oneData' => $oneData['c']  // 告诉前端开发人员 这个分类id下面总共多少条记录
    );
}

// 将$arr转换为json格式的字符串 
echo json_encode($arr);