<?php
require('./lib/init.php');
$art_id = $_GET['art_id'];
//判断地址栏传来的art_id是否合法
if (!is_numeric($art_id)) {
    header('Location: index.php');
}

//如果没有这篇文章，跳转到首页去
$sql = "select * from articles where art_id = $art_id";
if (!mGetRow($sql)) {
        header('Location: index.php');
}

//查询文章
$sql = "select title,content,pubtime,catname,comm,thumb from articles inner join categories on articles.cat_id = categories.cat_id where art_id = $art_id";
$art = mGetRow($sql);

//查询所有的留言
$sql = "select * from comments where art_id = $art_id";
$comms = mGetAll($sql);

//post 非空，代表有留言
if (!empty($_POST)) {
    $comm['nick'] = trim($_POST['nick']);
    $comm['email'] = trim($_POST['email']);
    $comm['content'] = htmlspecialchars(trim($_POST['content']));
    $comm['art_id'] = $art_id;
    $comm['pubtime'] = time();
    $comm['ip'] = sprintf('%u' , ip2long(getRealIp()));
    $rs = mExec('comments' , $comm);
    if ($rs) {
        //评论发布成功 将art表的comm+1
        $sql = "update articles set comm=comm+1 where art_id=$art_id";
        mQuery($sql);

        //跳转到上个页面
        $ref = $_SERVER['HTTP_REFERER'];
        header("Location: $ref");
    }
}

require(ROOT.'/view/front/art.html');
 ?>