<?php
	// 共通ヘッダー要素を読み込み
	require 'header.php';

	// エラーの有無で表示させるボディ部分を分岐
	if ( !isset($_POST["submit"]) ) {  // 確認ページを経由しているかのチェック
?>
	<article class="hadairo">
		<div class="align-c">
			<h1 class="">このページは直接アクセスできません。</h1>
			<p>お手数ですが<a href="./contact.php">お問い合わせ入力ページ</a>にお戻りください。</p>
		</div>
	</article>
<?php
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
?>
	<article class="hadairo">
		<div class="form_box">
		<h1>お問い合わせ</h1>
			<p class="align-c">
				送信完了しました♪<br>
				ありがとうございました。
			</p>
			<p class="align-c">
				<a href="./index.php"><input  type="button" name="totop" value=" トップページへ "></a>
			</p>
		</div>
	</article>
<?php
	}
	// 共通フッター要素を読み込み
	require 'footer.php';
?>
