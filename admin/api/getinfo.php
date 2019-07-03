<?php
include '../../comm.php';
$pageSize = $_POST['pageSize'];
$pageNum = $_POST['pageNum'];
$start = ($pageSize-1)*$pageNum;
$sql = "SELECT p.title,p.created,p.slug,p.status,c.`name`,u.nickname,
(select count(*)  from comments WHERE post_id = p.id) AS comments 
FROM posts AS p
LEFT JOIN categories AS c 
ON p.category_id = c.id
LEFT JOIN users AS u 
ON p.user_id = u.id
WHERE c.id != 1
ORDER BY created desc
LIMIT {$start},{$pageSize}";
$res = mysqli_query($link,$sql);
$data = mysqli_fetch_all($res,1);
$arr = array(
    'code' => 0,
    'msg' => '操作失败',
);
if ($data) {
    $arr = array(
        'code' => 1,
        'msg' => '操作成功',
        'data' => $data
    );
};
echo json_encode($arr);

