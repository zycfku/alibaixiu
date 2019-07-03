<?php
include '../comm.php';

$slug = $_POST['slug'];
$sql = "SELECT p.title,p.created,p.content,p.feature,p.views,p.likes,p.slug,c.`name`,u.nickname,
(select count(*)  from comments WHERE post_id = p.id) AS comments 
FROM posts AS p
LEFT JOIN categories AS c 
ON p.category_id = c.id
LEFT JOIN users AS u 
ON p.user_id = u.id
WHERE p.slug='{$slug}'";
$res = mysqli_query($link,$sql);

$data = mysqli_fetch_all($res,1);

$arr = array(
    'code' => 0,
    'msg' => '操作失败'
);
if($data) {
    $arr = array(
        'code' => 1,
        'msg' => '操作成功',
        'data' => $data
    );
}
echo json_encode($arr);