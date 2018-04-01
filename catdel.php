<?php
require('./lib/init.php');

$cat_id = $_GET['cat_id'];

//检测 栏目id 是否为数字
if (!is_numeric($cat_id)) {
    echo '栏目不合法';
    exit();
}

//检测栏目是否存在
$sql = "select count(*) from categories where cat_id = $cat_id";
$rs = mQuery($sql);
$row = $rs->fetch_row();
if ($row[0] == 0) {
    echo '栏目不存在';
    exit();
}

//检测栏目下是否有文章
$sql = "select count(*) from articles where cat_id = $cat_id";
$rs = mQuery($sql);
$row = $rs->fetch_row();
if ($row[0] != 0) {
    echo '栏目下有文章，不能删除';
    exit();
}

//检测完毕，删除栏目
sql = "delete from categories where cat_id = $cat_id";
$rs = mQuery($sql);
if (!$rs) {
    error('栏目删除失败') ;
} else {
    header('Location: catlist.php');
}

 ?>