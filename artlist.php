<?php
require('./lib/init.php');
if (!acc()) {
    header("Location: login.php");
}
$sql = "select art_id,title,pubtime,comm,catname from articles left join categories on articles.cat_id = categories.cat_id";
$arts = mGetAll($sql);

include(ROOT.'/view/admin/artlist.html');

 ?>