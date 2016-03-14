<?php
	require_once("./db_connect.php");
	require "ErrorHandling.php";
	require "ImageObj.php";

	//セッション開始
	session_start();

	//初期処理
	$error = new ErrorHandling;
	$image_obj = new ImageObj;
	$e_message = 0;

	
	$_SESSION["user_data"] = $_POST;

	$name = $_POST["name"];
	$age = $_POST["age"];
	$sex = $_POST["sex"];
	$self = $_POST["self"];

	if (!is_null($_FILES["thumb"])){
		$thumb = ( $_FILES["thumb"] );
	}else {
		$thumb = $_POST["thumb_now"];
	}

	/////////////////
	//アイコン取込処理
	/////////////////
	
	//ファイルサイズ判定
	if( $error -> fileSizeDecision( (int)$_FILES["thumb"]["size"] ) ){
		$e_message[] = "アップロードできるファイルサイズの上限20Mを超えています。";
	}
	
	//ファイル拡張子判定
	if( $error -> fileExtendDecision( (int)$_FILES["thumb"]["name"] ) ){
		$e_message[] = "アップロードできるファイルの種類は画像のみです。";
	}
	
	//一つでもエラーがあればリダイレクト
	if( is_array( $e_message ) ){
		header( "Location: ./chek-in_map.php" );
	}
	
	//アップロード画像リネーム
	$image_name = $image_obj -> imageRenameForThumb( $_FILES["thumb"]["name"],$_SESSION["u_id"] );

	//TMPファイル移動
	$upload_file_path = $image_obj -> imageMoveForThumb( $_FILES["thumb"]["tmp_name"], $image_name );
	
	$_SESSION['thumb_path'] = $upload_file_path;

?>

<?php
	// 共通のヘッダー部分の読み込み
	require 'header.php';
?>
<!-- // navigation部分になる予定
			<nav>
			</nav>
-->

	<article class="hadairo">
		<div class="form_box">
			<h1 class="align-c">プロフィール</h1>
			<form action="./profile_comp.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="query_confirm">
				<table>
				  <tr>
				    <th class="">名前</th>
				    <td><b><?php echo $name; ?></b></td>
				  </tr>
				  <tr>
				    <th class="">年齢</th>
				    <td><b><?php echo $age; ?></b></td>
				  </tr>
				  <tr>
				    <th class="">性別</th>
				    <td><b>
						<?php
							if($sex == 1){
								echo '男性';
							} elseif($sex == 2){
								echo '女性';
							} ?>
					</b></td>
				  </tr>
				  <tr>
				    <th class="">自己紹介</th>
				    <td><b><?php echo $self; ?></b></td>
				  <tr>
				    <th class="">サムネイル</th>
				    <td><b><?php echo $thumb["name"]; ?></b></td>
				  </tr>
				  <tr>
				    <th class=""></th>
					<td><b><img src="<?php echo $upload_file_path; ?>"></b></td>
				  </tr>
				</table>
				<div>
					<p>
						<a href="javascript:history.back()"><input type="button" name="return" value=" 編集に戻る "></a>
						<input type="submit" value="これで登録"> 
					</p>
				</div>
			</form>
		</div>
	</article>

<?php
	// 共通のフッター部分の読み込み
	require 'footer.php';
?>
