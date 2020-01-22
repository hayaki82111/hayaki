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
    <?php//正規表現について
    $zip = 'abcabc123-4567';

    $zip = mb_convert_kana($zip, 'a', 'UTF-8');//はんかくに変換
    //　\d{3}->dは数字　それを三回　[-]->ハイフン　\A->先頭　\z->最後　この二つがないと最初と最後に変なのがついても認識されてしまう
    if (preg_match("/\A\d{3}[-]\d{4}\z/", $zip)) {//preg_match→正規表現用　マッチするかどうか
        print('郵便番号：〒' . $zip);
    } else {
        print('※ 郵便番号を 123-4567の形式でご記入ください');
    }
    ?>
</pre>
</main>
</body>    
</html>