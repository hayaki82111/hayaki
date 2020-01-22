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
<?php/*ここに動画のコンテンツのメモ
try {
    $db=new PDO("mysql:mydb=つなげたいデータベース名;host=127.0.0.1（サーバのアドレス）;charset=utf8（文字コード指定）"  //PDO->データベース接続用
    'root(ユーザー名)','pswoord');
}catch(PDOException $e　（PDOe...を$eで受け取る）){//エラー処理　これがないとエラーになったときプログラム強制終了、フェイタルエラーが発生してしまう、例外を発生させる
    echo 'db接続エラー：' . $e->getMessage();
}

//囲い方に気を付ける、データの影響を与えた行の数個数分返り値が返ってくる
$count=$db->exec('INSERT INTO my_items SET marker_id=1,item_name="もも",  //execー＞sqlの発行
price=210,keyword="缶詰、ピンク、甘い"');
)
echo $count .'件取得'

$records=$db->query('SELECT *FROM my_items');  //queryー＞パラメータにsqlをとる、select分の得られた値を取得
while($record=$recods->fetch()){  //fetch()ー＞得られたものの１行ずつを取り出す、行をすべて取り出すとfalseを返す
       print($recods['item_name']."\n")　　//連想配列で帰っているので[]で指定
}


作製　create
一覧　read
編集　update
削除　deleat



*/


require('dbconnect.php');
/*
$memos

*/ 

if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {//pageパラメーターがないとき１ページ目を表示
    $page = 1;
}
$start = 5 * ($page - 1);//スタートの場所を計算

$memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5（？から５件目まで）');//
$memos->bindParam(1, $start, PDO::PARAM_INT);//execute->型を指定できない、PDO::PARAM_INT->整数型
$memos->execute();
?>

<article>
    <?php while ($memo = $memos->fetch()): ?>
        <p><a href="memo.php?id=<?php print($memo['id']); //?>"><?php print(mb_substr($memo['memo'], 0, 50));
            //mb_substr->文字数の指定、これの場合０みじから５０もじめまで ?></a></p>
        <time><?php print($memo['created_at']); ?></time>
        <hr>
    <?php endwhile; ?>

    <?php if ($page >= 2): //２ページ目以上なら前のページへ戻る?>
        <a href="index.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
    <?php endif; ?>
     | 
    <?php
    $counts = $db->query('SELECT COUNT(*) as cnt FROM memos');//cnt->件数//件数が帰ってくる
    $count = $counts->fetch();
    $max_page = ceil($count['cnt'] / 5);
    if ($page < $max_page):
    ?>
        <a href="index.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
    <?php endif; ?>
</article>

</main>
</body>    
</html>