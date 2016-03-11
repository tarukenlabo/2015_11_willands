<?php
	if ( !isset($_POST["submit"]) ) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせエラー</title>
</head>
<body>
	<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
		<article class="hadairo">

		<div class="form_box">
	<h1 class="">このページは直接アクセスできません。</h1>
	<p>お手数ですが<a href="./contact.php">お問い合わせ入力ページ</a>にお戻りください。</p>
		</div>
	</article>
	</div>
	
</body>
</html>
<?php
	exit;
	} else {
	// メールの送信準備
	ini_set('display_errors',0);
	mb_language("japanese");
	mb_internal_encoding("utf-8");
	$subject = "たるなびへのお問い合わせを承りました";
	$from = "From:".mb_encode_mimeheader($_POST["name"])."<".$_POST["email"].">";
	$to = "willands_student@yahoo.co.jp";
	$body = <<< EOD

以下のお問い合わせを受け付けました。

■お名前
　{$_POST["name"]}

■フリガナ
　{$_POST["kana"]}

■電話番号
　{$_POST["tel"]}

■メールアドレス
　{$_POST["email"]}

■お問い合わせ内容
　{$_POST["inquiry"]}

EOD;
	// メールの送信
	$sendMail = mb_send_mail( $to, $subject, $body, $from );
		//メール送信に失敗したら
		if ( !$sendMail ) {
			echo '<p>メールが送信できませんでした。<br><p>お手数ですが<a href="./contact.php">お問い合わせ入力ページ</a>にお戻りください。</p>';
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせ完了</title>
</head>
<body>

	<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
		<article class="hadairo">

		<div class="form_box align-c">
	<h1>お問い合わせ</h1>
	<p>
		送信完了しました♪<br>
		ありがとうございました。
	</p>
	<p>
		<a href="./index.php"><input type="button" name="totop" value=" トップページへ "></a>
	</p>
	
	</div>
	</article>
	</div>
</body>
</html>
