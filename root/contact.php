<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>お問い合わせ</title>
</head>
<body>
	<h1>お問い合わせ</h1>
	<p>たるナビに関するご意見、ご質問はこちらからお問い合わせください。</p>
	<form method="post" action="./contact_mod.php">
	  <input type="hidden" name="mode" value="query_confirm">
	  <table>
	    <tr>
	      <td class="">名前<br>必須</td>
	      <td><input type="text" size="30" name="name" required></td>
	    </tr>
	    <tr>
	      <td class="">フリガナ<br>必須</td>
	      <td><input type="text" size="30" name="kana" required></td>
	    </tr>
	    <tr>
	      <td class="">電話番号<br>必須</td>
	      <td><input type="tel" size="30" name="tel" required></td>
	    </tr>
	    <tr>
	      <td class="">メールアドレス<br>必須</td>
	      <td><input type="email" size="30" name="email" required></td>
	    </tr>
	    <tr>
	      <td class="">メールアドレス（確認）<br>必須</td>
	      <td><input type="email" size="30" name="email_conf" required></td>
	    </tr>
	    <tr>
	      <td class="">ご質問</td>
	      <td><textarea name="query_main" cols="40" rows="5" required></textarea></td>
	    </tr>
	  </table>
	  <div>
		<h3>個人情報の取り扱いについて</h3>
		<p>ご記入いただいた個人情報は、お問い合わせ内容へのご回答、当社の商品・サービスに関する情報の提供のためにのみ利用させていただきます。株式会社ガイアックスでは、ご記入いただいた情報を適切に管理し、特段の事情がない限り本人に承認なく第三者に開示、提供することはありません。</p>
		<p>事前に「<a href="./privacypolicy.html" target="_blank">プライバシーポリシー</a>」をお読みいただき、同意いただきます。</p>
		<p><input type="checkbox" name="consent" value="1" required>必須　「個人情報の取り扱いについて」に同意する</p>
	  </div>
	  <div>
	    <p><input type="submit" name="confirm" value=" 内容確認ページへ "></p>
	  </div>
	</form>
</body>
</html>
