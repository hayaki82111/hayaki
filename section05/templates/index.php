<?php
session_start();

if(isset($_SESSION['id'])&&$_SESSION['time']+3600>time()){//ログインボタンを押してidを受け取っている時と
  //ログインしたときの時間から１時間以内の時（１時間たつと自動でログアウト）
  $_SESSION['time']=time();

  $members=$db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member=$members->fetch();//ここまででログイン中の情報を引き出す
}else{//もしログインしていなかったらログインページへ
  header('Location:login.php');
  exit();
}


if(!empty($_POST)){
  if($_POST['messege']!==""){//空でメッセーじを送信するのを防ぐ
    $message=$db->prepare('INSERT INTO posts SET member_id=?,message=?,replay_message_id=?,created=NOW()');
    $message->execute(array(
      $member['id'],//せっしょんのidといっしょ
      $_POST['message'],
      $_POST['replay_post_id']
    ));
  
    header('Location:index.php');//postの値がなくなるため重複がなくなる//index.phpガスの状態で呼ばれる、、postを消すため
    exit();
  }
  $page=$_REQUEST['page'];
  if($page==''){
    $page=1;
  }
  $page=max($page,1);//pageが１以下にならない

  $counts=$db->query('SELECT COUNT(*) AS cnt FROM posts');
  $cnt=$counts->fetch();//メッセージの件数
  $maxpage=ceil($cnt['cnt']/5);
  $page=min($page,$maxpage);//どれだけ大きい数でもページ数分までに変換される


  $strat=($page-1)*5;

  $posts=$db->prepare('SELECT m.name , m.picture,p.* FROM members m ,posts p WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT ? , 5');
//キーの一致をさせている
$posts->bindParam(1,$strat,PDO::PARAM_INT);
$posts->execute();

  if(isset($_REQUEST['res'])){//Reがクリックされたとき
    //返信処理
    $respons=$db->prepare('SELECT m.name,m.picture,p.* FROM members m,posts p WHERE m.id=p.member_id AND p.id=?');
    $respons->execute(array($_REQUEST['res']));//返信用のid

    $table=$respons->fetch();
    $message='@'. $table['name'].' '.$table['mesaage'];//ここまででメッセージ取得

  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>

	<link rel="stylesheet" href="style.css" />
</head>

<body>
  <!--
    1.文章を投稿できる
    1-2メッセージ
    1-３館員情報

  　2.他の人の投稿に返信することができる
    2-1メッセージ
    2-2館員情報
    2-３返信先メッセージ

  　3.写真をアップロードできる
  　3-1写真のパス

  　4.館員登録できる
    4-1メアド
    4-2パスワード
  　5.ログインができる
  　5-1メアド
    5-2パスワード
  　6.ログアウトができる

  館員関係(members)
  　会員id
  　ニックネーム
  　メアド
  　パスワード
  　写真のパス

  created
  modfid

投稿関係(posts)
　メッセージid 
　メッセージ
　投稿者のid 
　返信先のメッセージid
-->
<div id="wrap">
  <div id="head">
    <h1>ひとこと掲示板</h1>
  </div>
  <div id="content">
  	<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
    <form action="" method="post">
      <dl>
        <dt><?php print(htmlspecialchars($member['name']),ENT_QUOTES) ?>さん、メッセージをどうぞ</dt>
        <dd>
          <textarea name="message" cols="50" rows="5">
            <?php print(htmlspecialchars($message,ENT_QUOTES))//返信ないよう?>
          </textarea>
          <input type="hidden" name="reply_post_id" value="<?php print(htmlspecialchars($_REQUEST['res'],ENT_QUOTES))?>" />
        </dd>
      </dl>
      <div>
        <p>
          <input type="submit" value="投稿する" />
        </p>
      </div>
    </form>

<?php foreach($posts as $post):?>
    <div class="msg">
    <img src="member_picture<?php print(htmlspecialchars($_POST['picture'],ENT_QUOTES);?>" width="48" height="48" alt="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES);?>" />
    <p><?php print(htmlspecialchars($_POST['messeage'],ENT_QUOTES));?>
    <span class="name">（<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES));?>）</span>[<a href="index.php?res=<?php print((htmlspecialchars($_POST['id']),ENT_QUOTES)?>">Re</a>]</p>
    <p class="day"><a href="view.php?id=<?php print(htmlspecialchars($post['id']));?>"><?php print(htmlspecialchars($_POST['created'],ENT_QUOTES);?></a>

    <?php if($post['reply_message_id'] > 0):?>
    <a href="view.php?id=<?php print(htmlspecialchars($post['reply_message_id']),ENT_QUOTES);?>">
    返信元のメッセージ</a>
    <?php endif;?>
    <?php if($_SESSION['id']==$post['id']): //自分のidと一致しているとき?>
[<a href="delete.php?id=<?php print(htmlspecialchars($post['id']));?>"
style="color: #F33;">削除</a>]
<?php endif?>
    </p>
    </div>
<?php endforeach;?>
<ul class="paging">
<?php if($page>1):?>
<li><a href="index.php?page=<?php print($page-1) ?>">前のページへ</a></li>
<?php else:?>
<li>前のページへ</li>
<?php endif;?>

<?php if($page<$maxpage): ?>
<li><a href="index.php?page=<?php print($page+1) ?>">次のページへ</a></li>
<?php else:?>
<li>次のページへ</li>
<?php endif;?>
</ul>
  </div>
</div>
</body>
</html>
