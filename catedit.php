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
if ($rs->fetch_row()[0] == 0) {
    echo '栏目不存在';
    exit();
}

if (empty($_POST)) {
    $sql = "select catname from categories where cat_id = $cat_id";
    $rs = mQuery($sql);
    $cat = $rs->fetch_assoc()
    require(ROOT.'/view/admin/catedit.html');
} else {
    $sql = "update categories set catname = '$_POST[catname]' where cat_id = $cat_id";
    $rs = mQuery($sql);
    if (!$rs) {
        error('栏目修改失败') ;
    } else {
        succ('栏目修改成功');
    }
}

 ?>