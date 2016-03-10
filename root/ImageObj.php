<?php
	class ImageObj {
		//ファイル名生成
		public function imageRename( $image_name,$user_id,$post_id ){
			$rename = time()."_". $user_id. $post_id."_".$image_name;
			
			return $rename;
		}
		
		//ファイル移動
		public function imageMove( $upload_image,$image_name ){
			move_uploaded_file( $upload_image, './photo/'.$image_name );
			return './photo/'.$image_name;
		}


		//ファイル名生成（サムネイル画像）
		public function imageRenameForThumb( $image_name,$user_id){
			$rename = time()."_". $user_id . "_".$image_name;
			
			return $rename;
		}
		
		//ファイル移動（サムネイル画像）
		public function imageMoveForThumb( $upload_image,$image_name ){
			move_uploaded_file( $upload_image, './thumb/'.$image_name );
			return './thumb/'.$image_name;
		}

	}
	
	