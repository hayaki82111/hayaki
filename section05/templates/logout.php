<?php
session_start();

$_SESSION=array();//session情報削除
if(ini_set['session.use_cookies']){//決まり文句、sessionにcookieを使うかどうかの設定ファイル
    $params=session_get_cookie_params();//cookieの情報を削除するためのプログラムを書く
    setcookie(session_name().'',time()-42000,//強制的に期限を切らす
        $params['path'],$params['domain'],$params['secure'],$params['hrrponly']);//sessionのcookieが使っているオプションを設定
    //セッションで使ったクッキーを削除
    }
session_destroy();//強制的に破壊

setcookie('email,'',time()-3600');//有効期限を切る

header('Location:login.php');
exit();

?>