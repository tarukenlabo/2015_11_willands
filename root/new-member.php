<!DOCTYPE html>
<html>
<head></head>
<body>
	<form method="post" action="./member_comp.php">
	  <input type="hidden" name="mode" value="regist_confirm">
	  <table>
	    <caption>会員情報登録フォーム</caption>
	    <tr>
	      <td class="item">E-mail：</td>
	      <td><?php if (isset($email)): print $email; else: ?><input type="text" size="30" name="input_mail"><?php endif; ?></td>
	    </tr>
	    <tr>
	      <td class="item">パスワード：</td>
	      <td><input type="password" size="30" name="input_pass" value="<?php if (isset($input_pass)):print $input_pass; endif; ?>">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
	    </tr>
	    <tr>
	      <td class="item">パスワード（確認）：</td>
	      <td><input type="password" size="30" name="pass_conf" value="<?php if (isset($pass_conf)):print $pass_conf; endif; ?>">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
	    </tr>
	  </table>
	  <div><input type="submit" name="submit" value=" 送 信 "></div>
	</form>
</body>
</html>
