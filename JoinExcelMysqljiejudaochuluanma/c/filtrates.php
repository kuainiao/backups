<?php 

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('PRC');

require_once '../config/db.php';

$sql = 'update indent set status = 3 where tel in (select tel from (select tel from indent group by receiver, tel, address having count(receiver) > 1 and count(tel) > 1 and count(address) > 1 ) as tmp) and status = 1';

 // and status = 1

// var_dump($sql);

$res = mysql_query($sql);

if(mysql_affected_rows()){

    echo '<center><img src = "../image/1.png" /><br/>成功<br/><img src = "../image/2.png" /><img src = "../image/1.png" /><br/>';
    echo "<a href = '../view/index.html'>返回首页</a><br/>";
    echo '<br/>请仔细阅读信息，避免不必要的错误订单信息插入<br/>如有问题请联系工作人员，联系电话138-3838-3838<br/></center>';
    exit();

}else{

    echo '<center><img src = "../image/1.png" /><br/>成功<br/><img src = "../image/2.png" /><img src = "../image/1.png" /><br/>';
    echo "<a href = '../view/index.html'>返回首页</a><br/>";
    echo '<br/>请仔细阅读信息，避免不必要的错误订单信息插入<br/>如有问题请联系工作人员，联系电话138-3838-3838<br/></center>';
    exit();

}
