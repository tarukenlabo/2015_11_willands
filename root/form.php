<!DOCTYPE html>
<html>
<head></head>
<body>
	<form method="post" action="regist.php">
	  <input type="hidden" name="mode" value="regist_confirm">
	  <input type="hidden" name="pre_userid" value="">
	  <table>
	    <caption>会員情報登録フォーム</caption>
<!--    <tr>
	      <td class="item">ユーザー名：</td>
	      <td><input type="text" size="30" name="input_" value="<?php if (isset($input_userid)):print $input_userid; endif; ?>"></td>
	    </tr> -->
	    <tr>
	      <td class="item">アカウント：</td>
	      <td><input type="text" size="30" name="input_name" value="<?php if (isset($input_name)):print $input_name; endif; ?>"></td>
	    </tr>
	    <tr>
	      <td class="item">E-mail：</td>
	      <td><?php if (isset($email)): print $email; else: ?><input type="text" size="30" name="input_mail"><?php endif; ?></td>
	    </tr>
	    <tr>
	      <td class="item">パスワード：</td>
	      <td><input type="text" size="30" name="input_pass" value="<?php if (isset($input_password)):print $input_password; endif; ?>">&nbsp;&nbsp;※ 6文字以上16文字以下</td>
	    </tr>
	  </table>
	  <div><input type="submit" value=" 送 信 "></div>
	</form>
</body>
</html>
