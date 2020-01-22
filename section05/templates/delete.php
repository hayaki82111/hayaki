<?php
session_start();
require('dbcontent');

if(isset($_SESSION['id'])){
    $id=$_REQUEST['id'];

    $message=$db->prepare('SELECT * FROM posts WHERE id=?');
    $message->execute(array($id));
    $message->fetch();

    if($message['member_id']==$_SESSION['id']){//dbから取得したidといまのidが一致しているとき
        $del = $db->prepare('DELETE FROM posts WHERE id=?');
        $del->execute(array($id));
    }

}
header('Location:index.php');
exit();


?>