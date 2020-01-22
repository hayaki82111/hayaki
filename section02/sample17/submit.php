<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre><!--htmlspecialchars(入れるもの,基本固定ENT_QUTOTES)攻撃を防ぐ-->
<!--method=getの時_POSTはできない　urlは送信されない
　　　$_REQUESTはpostもgetも受け取れる　getかpostわかっているときはそれに合わせる
-->
    お名前： <?php print(htmlspecialchars($_REQUEST['my_name'], ENT_QUOTES)); //name属性が入る?>
</pre>
</main>
</body>    
</html>