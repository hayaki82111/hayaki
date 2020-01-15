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
date_default_timezone_get("Asia/Tokyo");//timezone変更
print(date('s'));//秒 
print('現在は' . date('G時 i分 s秒') . 'です');//時間が表示される　リファレンスも見てみる
//docker.iniをつかってみる
//dateは画面に表示する機能はない
//.で文字列連結
?>
</pre>
</main>
</body>    
</html>