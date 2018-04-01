<?php
require('./lib/init.php');

if (empty($_POST)) {
    include(ROOT.'/view/admin/catadd.html');
} else {
    //检测栏目是否为空
    $cat['catname'] = trim($_POST['catname']);
    if (empty($cat['catname'])) {
        error('栏目不能为空');
        exit();
    }

    //检测栏目名是否已存在
    $sql = "select count(*) from categories where catname = '$cat[catname]'";
    $rs = mQuery($sql);

    if ($rs->fetch_row()[0] != 0) {
        echo '栏目名已经存在';
        exit();
    }

    //将栏目写入栏目表
    if (!mExec('categories' , $cat)) {
        error('栏目插入失败');
    } else {
        succ('栏目插入成功');
    }
}


 ?>