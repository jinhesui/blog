<?php
require('./lib/init.php');

$sql = "select * from comments order by comment_id desc";
$comms = mGetAll($sql);

require(ROOT.'/view/admin/commlist.html');
 ?>