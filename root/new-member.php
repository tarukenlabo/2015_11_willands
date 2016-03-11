
			<?php require 'header.php' ; ?>

			<nav>
				<ul>
					<li class="l-float clear-text">(★地図で選ぶ)</li>
					<li class="l-float clear-text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear-text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>

			<article class="clearFix white">
				<h2 class="contents-title">会員情報登録フォーム</h2>
		
			<div class="box shadow">

				<form method="post" action="member_comp.php">
					<input type="hidden" name="mode" value="regist_confirm">
						
						<p class="other-title"><input type="button" value="必 須" class="p-button" disabled>メールアドレス</p>
						<?php if (isset($email)): print $email; else: ?><input type="text" size="30" name="input_mail"  class="box-line1"><?php endif; ?></p>

						<p class="other-title"><input type="button" value="必 須" class="p-button" disabled>パスワード</p>
						<input type="password" size="30" name="input_pass" value="<?php if (isset($input_pass)):print $input_pass; endif; ?>" class="box-line1">&nbsp;&nbsp;※ 6文字以上16文字以下

						<p class="other-title"><input type="button" value="必 須" class="p-button" disabled>パスワード（確認）</p>
						<input type="password" size="30" name="pass_conf" value="<?php if (isset($pass_conf)):print $pass_conf; endif; ?>" class="box-line1">&nbsp;&nbsp;※ 6文字以上16文字以下
						
						<div><input type="submit" name="submit" value=" ログイン " class="button"></div>
				</form>
			</div><!--.box shadow-->
			</article>

			<?php require 'footer.php' ; ?>
