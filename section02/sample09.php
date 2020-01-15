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
$fruits = [//連想配列　順番の概念がないとき連想配列
    'apple'=>'りんご',//"key"=>"value",
    'grape'=>'ぶどう',
    'lemon'=>'レモン',
    'tomato'=>'トマト',
    'peach'=>'もも'
];
print($fruits["lemon"])//レモンが出力される

foreach ($fruits as $english => $japanese) {//連想配列の取り出し　配列 as 変数で値だけ取り出せる
        //配列　as key => 値
    print ($english . ':' . $japanese . "\n");//apple:りんご　greap:ぶどう　。。。出力される
}
?>
</pre>
</main>
</body>    
</html>