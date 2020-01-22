<?php
ssession_start();
require('../dbcontent.php');

if(!empty($_POST)){//フォームが送信されたかどうかを判定、$_POSTが空じゃないとき
	if($_POST['name']===""){
		$error['name']='brank';
	}
	if($_POST['email']===""){
		$error['email']='brank';
	}
	if(strlen($_POST['password'])<4){
		$error['password']='length';
	}
	if($_POST['password']===""){
		$error['password']='brank';
	}
	$fileName=$_FILE['image']['name'];//name=imageの名前
	if(!empty($fileName)){
		$ext=substr($fileName,-3);//フィルの後ろ三文字、拡張し
		if($ext!='jpg'&&$ext!=='gif'$ext!=='png'){
			$error['image']='type'
		}
	}

	//アカウント重複チェック
	if(empty($error)){
		$member=$db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');//一致する個数を数える
		$member->execute(array($_POST['email']));
		$record=$member->fetch();//メアドのメンバーがいれば1,いなければ０
		if($record['cnt']>0){
			$error['email']='duplicate'
		}
	}

	if(empty($error)){//配列が空ならture,エラーがなかったら入力確認画面にいく
	$image=date('YmdHis') . $_FILES['image']['name'];//201811123151617myface.png,$_FILESははいれつになっている,(ファイル名
	more_upload_files($_FILES['image']['tmp_name'](一時的にアップロードされている場所、今ある場所),'../member_picture/' . $image（保存先のパス、移動先）);
	$_SESSION['join']=$_POST//はいれつの中にはいれつが入っている
	$_SESSION['join']['image']=$image;//ファイルの名前が入っている
	header('Location:check.php');
	exit();
	}
}

if($_RECUEST['action']=='rewrite'){
	$_POST=$_SESSION['join']
}

?>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="../style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>会員登録</h1>
</div>

<div id="content">
<p>次のフォームに必要事項をご記入ください。</p>
<form action="" method="post" enctype="multipart/form-data"><!--enctype->ファイルのアップロードをするとき必ずつける-->
	<dl>
		<dt>ニックネーム<span class="required">必須</span></dt>
		<dd>
			<input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'],ENT_QUOTES))?>" />
			<?php if($error['name']==='brank'):?>
				<p class="error">入力してください</p>
			<?php endif;?>
		</dd>
		<dt>メールアドレス<span class="required">必須</span></dt>
		<dd>
			<input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'],ENT_QUOTES))?>" />
			<?php if($error['email']==='brank'):?>
				<p class="error">入力してください</p>
			<?php endif;?>
			<?php if($error['email']==='duplicate'):?>
				<p class="error">すでに登録されています</p>
			<?php endif;?>
		<dt>パスワード<span class="required">必須</span></dt>
		<dd>
			<input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'],ENT_QUOTES))?>" />
			<?php if($error['password']==='brank'):?>
				<p class="error">入力してください</p>
			<?php endif;?>
			<?php if($error['password']==='length'):?>
				<p class="error">パスワードは４文字以上で入力してください</p>
			<?php endif;?>
        </dd>
		<dt>写真など</dt>
		<dd>
			<input type="file" name="image" size="35" value="test"  />
			<?php if($error['image']==='type'):?>
				<p class="error">入力してください</p>
			<?php endif;?>
			<?php if(!empty($error)):?>
				<p class="error">もう一度改めて指定してください</p>
			<?php endif;?>
        </dd>
	</dl>
	<div><input type="submit" value="入力内容を確認する" /></div>
</form>
</div>
</body>
</html>
