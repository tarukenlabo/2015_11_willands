<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./style.css" type="text/css">
	<link rel="stylesheet" href="./style_oocss.css" type="text/css">
	<title>お問い合わせ</title>
</head>
<body>
		<div id="wrap" class="align-center orange">
			<?php require 'header.php' ; ?>

			<nav>
			</nav>
			
		<article class="hadairo">

		<div class="form_box align-c">

	

		<h1>お問い合わせ</h1>
		<p>たるナビに関するご意見、ご質問はこちらからお問い合わせください。</p>
		<form method="post" action="./contact_mod.php">
		  <input class="align-c " type="hidden" name="mode" value="query_confirm">
		  <table>
		    <tr>
		      <th class="">名前<br>必須</th>
		      <td><input class="box-line1" type="text" size="30" name="name" required></td>
		    </tr>
		    <tr>
		      <th class="">フリガナ<br>必須</th>
		      <td><input class="box-line1" type="text" size="30" name="kana" required></td>
		    </tr>
		    <tr>
		      <th class="">電話番号<br>必須</th>
		      <td><input class="box-line1" type="tel" size="30" name="tel" required></td>
		    </tr>
		    <tr>
		      <th class="">メールアドレス<br>必須</th>
		      <td><input class="box-line1" type="email" size="30" name="email" required></td>
		    </tr>
		    <tr>
		      <th class="">メールアドレス（確認）<br>必須</th>
		      <td><input class="box-line1" type="email" size="30" name="email_conf" required></td>
		    </tr>
		    <tr>
		      <th class="">ご質問</th>
		      <td><textarea  class="box-line1" name="inquiry" cols="40" rows="5" required></textarea></td>
		    </tr>
		  </table>
		  
	</div>
		 
		  
		  
		  <div>
		<h3>個人情報の取り扱いについて</h3>
		<p>ご記入いただいた個人情報は、お問い合わせ内容へのご回答、当社の商品・サービスに関する情報の提供のためにのみ利用させていただきます。株式会社ガイアックスでは、ご記入いただいた情報を適切に管理し、特段の事情がない限り本人に承認なく第三者に開示、提供することはありません。</p>
		<p>事前に「<a href="./privacypolicy.html" target="_blank">プライバシーポリシー</a>」をお読みいただき、同意いただきます。</p>
		<p><input type="checkbox" name="consent" value="1" required>必須　「個人情報の取り扱いについて」に同意する</p>
		  </div>
	  <div>
	    <p><input class="check_button" type="submit" name="confirm" value=" 内容確認ページへ "></p>
	  </div>
	  
	</form>
	</div>

	</article>
	</div>
</body>
</html>
