<?php
	class ErrorHandling
	{
		const FILE_MAX = 20971520; //20M
		const EXPLODE_VALUE = '.'; //カット指定文字
		
		private $white_list = array( 'jpg','jpeg','gif','png','bmp' );
		private $extend;
		
		//ファイルサイズ
		public function fileSizeDecision( $file_size ){
			if( self::FILE_MAX > $file_size ){
				return false;
			}
			return true;
		}
		
		//拡張子判定
		public function fileExtendDecision( $file_name ){
			$file_extend = $this -> cutExtend( $file_name );
			
			if(array_search( $file_extend,$this -> white_list ) !== false){
				return true;
			}
			return false;
		}
		
		//拡張子取得
		private function cutExtend( $file_name ){
			$cut_array = explode( self::EXPLODE_VALUE, $file_name );
			$last = end( $cut_array );
			return $last;
		}
	}