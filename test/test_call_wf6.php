<?php
    session_start();

	$_SESSION['u_id'] = 2;

?>

<html>
<head><title>PHP TEST</title></head>
<body>

<?php

    if (!isset($_COOKIE["PHPSESSID"])){
        print('初回の訪問です。セッションを開始します。');
    }else{
        print('セッションは開始しています。<br>');
        print('セッションIDは '.$_COOKIE["PHPSESSID"].' です。');
        print('U_IDは '.$_SESSION["u_id"].' です。');
    }

?>

</body>
</html>