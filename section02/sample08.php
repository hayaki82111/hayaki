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
$week_name = ['日', '月', '火', '水', '木', '金', '土'];//arrayは古い
//print(配列)はエラー、indexも使ってかく
print($week_name[0]);//日曜日が表示される
print ($week_name[date('w')]);//date('w')は４が出力　
?>
</pre>
</main>
</body>    
</html>