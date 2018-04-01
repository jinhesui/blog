<?php
require('./lib/init.php');
//查询所有的栏目
$sql = "select * from categories";
$cats = mGetAll($sql);

//判断地址栏是否有cat_id
if (isset($_GET['cat_id'])) {
    $where = " and articles.cat_id = $_GET[cat_id] ";
} else {
    $where = '';
}

//分页代码
$sql = "select count(*) from articles where 1 ". $where;
$num = mGetOne($sql);    //获取总文章数
$curr = isset($_GET['page']) ? $_GET['page'] : 1;    //当前页码数
$cnt = 2;    //每页显示条数
$page = getPage($num ,$curr ,$cnt);

//查询所有的文章
$sql = "select art_id,title,content,pubtime,comm,catname,arttag,thumb from articles inner join categories on articles.cat_id = categories.cat_id where 1 ". $where . ' order by  art_id desc limit ' . ($curr-1)*$cnt . ',' . $cnt;
$arts = mGetAll($sql);

//如果当前栏目下没有文章，跳转到首页去
require(ROOT.'/view/front/index.html');
 ?>