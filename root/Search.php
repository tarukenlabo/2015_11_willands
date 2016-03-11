<?php
	require_once("./db_connect.php");
	
	class Search 
	{
		const MAP = "map";
		const CATE = "cate";
		const SEARCH_WORD = "search_word";
		
		public $searchText;
		private $keywordArray;
		
		//コンストラクト
		public function __construct( $array ){
			$this -> searchText = $array;
			echo aaa;
		}
		
		//DB接続
		private function db_connect(){
			//データベース接続
			$db = new cls_db();
			$dbh = $db->db_connect();
			$dbh -> query( "SET NAMES utf8" );
			
			return $dbh;

		}
		
		//SQL文分岐
		private function changeSql( $falg ){
			if( $this -> elementExists( self::MA ) ){
				$sql = "SELECT * FROM post AS p INNER JOIN (SELECT P_ID FROM post_check_in WHERE M_ID = ? GROUP BY P_ID) AS map_tb ON p.P_ID = map_tb.P_ID";
			}else if( $this -> elementExists( self::CATE ) ){
				$sql = "SELECT * FROM post WHERE P_CAT = ?";
			}else if( $this -> elementExists( self::SERACH_WORD )){
				$this -> keywordCreate();
				$sql = "SELECT pupc_tb.P_ID,pupc_tb.P_TITLE,pupc_tb.P_AWORD,pupc_tb.UP_COMMENT,pc.C_TITLE,pc.C_COMMENT FROM post_check_in AS pc RIGHT JOIN (SELECT p.P_ID,p.P_TITLE,p.P_AWORD,upc.UP_COMMENT FROM post AS p LEFT JOIN user_post_comment AS upc ON p.P_ID = upc.P_ID) AS pupc_tb ON pc.P_ID = pupc_tb.P_ID WHERE ";
				$sql = $this -> freewordCreate( $sql );
			}
			
		}
		
		//キーワード検索
		public function keywordCreate(){
			
			if( $this -> elementExists( self::SEARCH_WORD )){
				$search_word = $this -> searchText[self::SEARCH_WORD];
				$keywordText = str_replace( "　"," ",$search_word );
				$keywordArr = explode( " ", $keywordText  );
				foreach( $keywordArr as $val ){
					$keyword[] = "%".$val."%";
				}
				
				$this -> keywordArray = $keyword;
				
				
			}
		}
		
		//フリーワード条件作成
		private function freewordCreate( $sql ){
			$SQL .= " AND (";
			for( $i=0; i< count( $this -> keywordArray ); $i++ ){
				$SQL .= "concat(pupc_tb.P_ID,pupc_tb.P_TITLE,pupc_tb.P_AWORD LIKE,pupc_tb.UP_COMMENT LIKE,pc.C_TITLE LIKE,pupc_tb.UP_COMMENT,pc.C_TITLE,pc.C_COMMENT) LIKE ? AND ";
			}
			
			$SQL = rtrim( $SQL , " AND " );
			$SQL .= ")";
			
			return $SQL;
		}
		
		//要素の存在判定
		private function elementExists( $flag ){
			if( $flag === self::MAP ){
				return isset( $this -> searchText[self::MAP] );
			}
			
			if( $flag === self::CATE ){
				return isset( $this -> searchText[self::CATE] );
			}
			
			if( $flag === self::SEARCH_WORD ){
				return isset( $this -> searchText[self::SEARCH_WORD] );
			}
		}
		
	}