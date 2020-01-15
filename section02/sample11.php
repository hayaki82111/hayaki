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
3,000円のものから、100円値引きした場合は、<?php print(floor(100 / 3000 * 100)); //floor->少数切り捨て?>%引きです。

■ そのほかの計算
切り上げ(ceil) → <?php print(ceil(100 / 3000 * 100)); ?>

四捨五入(round) → <?php print(round(1.4567, 3));//引数１つ増える　少数第何位まで表示するか ?>
</pre>
</main>
</body>    
</html>