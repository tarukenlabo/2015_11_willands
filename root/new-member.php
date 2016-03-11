<!DOCTYPE html>
<html lang="ja">

	<head>
		<meta charset="UTF=8">
		<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
		<title>会員登録</title>
	</head>
	
	<body>
		<div id="wrap" class="arlign_center">
			<header>
				<p>(★ヘッダーです)</p>
			</header>
			
			<nav>
				<ul>
					<li class="l-float clear_text">(★地図で選ぶ)</li>
					<li class="l-float clear_text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear_text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>

			<article class="clearFix align_center">
				<div class="box shadow">
				<form method="post" action="regist.php">
					<input type="hidden" name="mode" value="regist_confirm">
						<table>
							<caption class="contents-title">会員情報登録フォーム</caption>
						<tr>
							<td class="article-title">メールアドレス</td>
							<td class="text-box-1line"><?php if (isset($email)): print $email; else: ?><input type="text" size="30" name="input_mail"><?php endif; ?></td>
						</tr>
						<tr>
							<td class="article-title">パスワード</td>
							<td class="text-box-1line"><input type="password" size="30" name="input_pass" value="<?php if (isset($input_pass)):print $input_pass; endif; ?>">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
						</tr>
						<tr>
							<td class="article-title">パスワード（確認）</td>
							<td class="text-box-1line"><input type="password" size="30" name="pass_conf" value="<?php if (isset($pass_conf)):print $pass_conf; endif; ?>">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
						</tr>
						</table>
						<div><input type="submit" name="submit" value=" ログイン "></div>
				</form>
				</div>
			</article>

		
		<footer>
			<p>(★フッターです)</p>
		</footer>
		</div><!--#wrap-->
	</body>
</html>
