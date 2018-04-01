<?php
require('./lib/init.php');

$sql = "select * from categories";
$rs = mQuery($sql);
$cat = array();
while ($row = $rs->fetch_assoc()) {
    $cat[] = $row;
}

require(ROOT.'/view/admin/catlist.html');
 ?>