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
<?php//if ->選択
// if (date('G') < 9) {　//今の時間が９時以前ならば
//     print('※ 現在受付時間外です');
// } else {　//それ以外
//     print('ようこそ');
// }

//""->からもじ
//＄ｘ＝”” 空文字はfalse　もじがあればtrue

$x = 1; // 0=false, 0以外=true
if ($x === 0) {//!->否定　０＝true ０以外＝false
    print('xは0です');
}
?>
</pre>
</main>
</body>    
</html>