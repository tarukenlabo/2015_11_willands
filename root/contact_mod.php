<?php
	if ( !isset($_POST["confirm"]) ) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせエラー</title>
</head>
<body>
	<h1 class="">このページは直接アクセスできません。</h1>
	<p>お手数ですが<a href="./contact.php">お問い合わせ入力ページ</a>にお戻りください。</p>
</body>
</html>
<?php
	} else {
	require_once "./functions.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせの確認</title>
</head>
<body>
	<h1>お問い合わせ</h1>
	<p>たるナビに関するご意見、ご質問はこちらからお問い合わせください。</p>
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
	      <a href="./contact.php"><input type="button" name="return" value=" 編集に戻る "></a>
	      <input type="submit" name="submit" value=" 送 信 ">
	    </p>
	  </div>
	</form>
</body>
</html>
<?php
	}
?>
