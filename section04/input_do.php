<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
    <?php
    require('dbconnect.php');
//$statement = $db->exce('INSERT INTO memos SET memo="'.$_POST['memo'].'", created_at=NOW()');NOW()ー＞SQLデ実行できる
//上の奴は危険、POSTのままだから
    $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');//
    $statement->bindParam(1, $_POST['memo']);//１番目の？に$_POST['memo']を入れている
    $statement->execute();//$statement->execute(arraw( $_POST['memo']));と書くこともできる（このままだとtry。。。catchも必要）、?に入れたい値を指定できる
    echo 'メッセージが登録されました';
?>
</pre>
</main>
</body>    
</html>