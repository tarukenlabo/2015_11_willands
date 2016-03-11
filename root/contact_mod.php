<?php
	// 共通ヘッダー要素を読み込み
	require 'header.php';

	// エラーの有無で表示させるボディ部分を分岐
	if ( !isset($_POST["confirm"]) ) { // お問い合わせフォームを経由しているかのチェック
		bodyDirectAccess ();
	} elseif ( $_POST["email"] !== $_POST["email_conf"] ) { // Emailの整合チェック
		bodyEmailError ();
	} else {
		bodyNormal (); // 上記のエラーが発生しなかった通常の場合
	}

	// 共通フッター要素を読み込み
	require 'footer.php';

	// 以下、関数に紐付けられた各ボディ部分
	function bodyDirectAccess () {
?>
	<article class="hadairo">
		<div class="form_box align-c">
			<h1 class="">このページは直接アクセスできません。</h1>
			<p>お手数ですが<a href="./contact.php">お問い合わせ入力ページ</a>にお戻りください。</p>
		</div>
	</article>
<?php
	}
	function bodyEmailError () {
?>
	<article class="hadairo">
		<div class="form_box align-c">
			<h1 class="">ご入力いただいたＥメールアドレスが一致しませんでした。</h1>
			<p>お手数ですがお問い合わせ入力ページにお戻りください。<br>
			<a href="javascript:history.back()"><input type="button" name="return" value=" 編集に戻る "></a></p>
		</div>
	</article>
<?php
	}
	function bodyNormal () {
	require_once "./functions.php";
?>
	<article class="hadairo">
		<div class="form_box align-c">
			<h1>お問い合わせ内容のご確認</h1>
			<p>下記の内容で承ってよろしいですか？どうぞご確認ください。</p>
			<form method="post" action="./contact_comp.php">
			  <input type="hidden" name="mode" value="send_query">
			  <input type="hidden" name="name" value="<?php echo h($_POST['name']); ?>">
			  <input type="hidden" name="kana" value="<?php echo h($_POST['kana']); ?>">
			  <input type="hidden" name="tel" value="<?php echo h($_POST['tel']); ?>">
			  <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
			  <input type="hidden" name="inquiry" value="<?php echo h($_POST['inquiry']); ?>">
			  <table>
			    <tr>
			      <td class="">名前<br>必須</td>
			      <td><b><?php echo h($_POST['name']); ?></b></td>
			    </tr>
			    <tr>
			      <td class="">フリガナ<br>必須</td>
			      <td><b><?php echo h($_POST['kana']); ?></b></td>
			    </tr>
			    <tr>
			      <td class="">電話番号<br>必須</td>
			      <td><b><?php echo h($_POST['tel']); ?></b></td>
			    </tr>
			    <tr>
			      <td class="">メールアドレス<br>必須</td>
			      <td><b><?php echo h($_POST['email']); ?></b></td>
			    </tr>
			    <tr>
			      <td class="">ご質問</td>
			      <td><b><?php echo nl2br( h($_POST['inquiry']) ); ?></b></td>
			    </tr>
			  </table>
			  <div>
			    <p>
			      <a href="javascript:history.back()"><input type="button" name="return" value=" 編集に戻る "></a>
			      <input type="submit" name="submit" value=" 送 信 ">
			    </p>
			  </div>
			</form>
		</div>
	</article>
<?php
	}
?>
