<?php
	require_once("./db_connect.php");
	
	class Search 
	{
		const MAP = "map";
		const CATE = "cate";
		const SEARCH_WORD = "search_text";
		
		public $searchText;
		private $keywordArray;
		
		//コンストラクト
		public function __construct( $array ){
			$this -> searchText = $array;
		}
		
		//DB接続
		private function db_connect(){
			//データベース接続
			$db = new cls_db();
			$dbh = $db->db_connect();
			$dbh -> query( "SET NAMES utf8" );
			
			return $dbh;

		}
		
		//SQL文実行
		public function selectSql( $sql ){
			$dbh = $this -> db_connect();
			$stmt = $dbh -> prepare( $sql );
			
			$array_val = array_values( $this -> searchText );
			$a = $stmt -> execute( $array_val );
			return $stmt;
		}
		
		//SQL文分岐
		public function changeSql(){
			if( array_key_exists( "cate",$this -> searchText ) && array_key_exists( "map",$this -> searchText ) && array_key_exists( "search_text",$this -> searchText ) ){
				//map,cate,search_text SELECT SQL
				$sql = "SELECT pupc_tb.P_ID, pupc_tb.P_TITLE, pupc_tb.P_AWORD, pupc_tb.UP_COMMENT, pc.C_TITLE, pc.C_COMMENT FROM post_check_in AS pc RIGHT JOIN ( SELECT p.P_ID, p.P_CAT, p.P_TITLE, p.P_AWORD, upc.UP_COMMENT FROM post AS p LEFT JOIN user_post_comment AS upc ON p.P_ID = upc.P_ID) AS pupc_tb ON pc.P_ID = pupc_tb.P_ID WHERE pupc_tb.P_CAT =8 AND pc.M_ID =34 AND ";
				$this -> keywordCreate();
				$sql = $this -> freewordCreate( $sql );

			}else if( array_key_exists( "cate",$this -> searchText ) && array_key_exists( "search_text",$this -> searchText ) ){
				//cate,search_text SELECT SQL
				$sql = "SELECT pupc_tb.P_ID, pupc_tb.P_TITLE, pupc_tb.P_AWORD, pupc_tb.UP_COMMENT, pc.C_TITLE, pc.C_COMMENT FROM post_check_in AS pc RIGHT JOIN ( SELECT p.P_ID, p.P_CAT, p.P_TITLE, p.P_AWORD, upc.UP_COMMENT FROM post AS p LEFT JOIN user_post_comment AS upc ON p.P_ID = upc.P_ID) AS pupc_tb ON pc.P_ID = pupc_tb.P_ID WHERE pupc_tb.P_CAT =8 AND ";
				$this -> keywordCreate();
				$sql = $this -> freewordCreate( $sql );
				
			}else if( array_key_exists( "map",$this -> searchText ) && array_key_exists( "search_text",$this -> searchText ) ){
				//map,search_text SELECT SQL
				$sql = "SELECT pupc_tb.P_ID, pupc_tb.P_TITLE, pupc_tb.P_AWORD, pupc_tb.UP_COMMENT, pc.C_TITLE, pc.C_COMMENT FROM post_check_in AS pc RIGHT JOIN ( SELECT p.P_ID, p.P_CAT, p.P_TITLE, p.P_AWORD, upc.UP_COMMENT FROM post AS p LEFT JOIN user_post_comment AS upc ON p.P_ID = upc.P_ID) AS pupc_tb ON pc.P_ID = pupc_tb.P_ID WHERE pc.M_ID =34 AND ";
				$this -> keywordCreate();
				$sql = $this -> freewordCreate( $sql );
				
			}else if( array_key_exists( "map",$this -> searchText ) && array_key_exists( "cate",$this -> searchText ) ){
				//map,cate SELECT SQL
				$sql = "SELECT pupc_tb.P_ID, pupc_tb.P_TITLE, pupc_tb.P_AWORD, pupc_tb.UP_COMMENT, pc.C_TITLE, pc.C_COMMENT FROM post_check_in AS pc RIGHT JOIN ( SELECT p.P_ID, p.P_CAT, p.P_TITLE, p.P_AWORD, upc.UP_COMMENT FROM post AS p LEFT JOIN user_post_comment AS upc ON p.P_ID = upc.P_ID) AS pupc_tb ON pc.P_ID = pupc_tb.P_ID WHERE pc.M_ID =34 AND pupc_tb.P_CAT =8";

			
			}else if( array_key_exists( "map",$this -> searchText ) ){
				//map SELECT SQL
				$sql = "SELECT * FROM post AS p INNER JOIN (SELECT P_ID FROM post_check_in WHERE M_ID = ? GROUP BY P_ID) AS map_tb ON p.P_ID = map_tb.P_ID";
			
			}else if( array_key_exists( "cate",$this -> searchText ) ){
				//cate SELECT SQL
				$sql = "SELECT * FROM post WHERE P_CAT = ?";
		
			}else if( array_key_exists( "search_text",$this -> searchText ) ){
				//search_text SELECT SQL
				$this -> keywordCreate();
				$sql = "SELECT pupc_tb.P_ID,pupc_tb.P_TITLE,pupc_tb.P_AWORD,pupc_tb.UP_COMMENT,pc.C_TITLE,pc.C_COMMENT FROM post_check_in AS pc RIGHT JOIN (SELECT p.P_ID,p.P_TITLE,p.P_AWORD,upc.UP_COMMENT FROM post AS p LEFT JOIN user_post_comment AS upc ON p.P_ID = upc.P_ID) AS pupc_tb ON pc.P_ID = pupc_tb.P_ID WHERE";
				$sql = $this -> freewordCreate( $sql );
			
			}
			
			return $sql;
			
		}
		
		//キーワード検索
		public function keywordCreate(){
			
			if( $this -> elementExists( self::SEARCH_WORD )){
				$search_text = $this -> searchText[self::SEARCH_WORD];
				$keywordText = str_replace( "　"," ",$search_text );
				$keywordArr = explode( " ", $keywordText  );
				
				foreach( $keywordArr as $val ){
					$keyword[] = "%".$val."%";
				}
		
				$this -> keywordArray = $keyword;
			}
		}
		
		//フリーワード条件作成
		public function freewordCreate( $sql ){
			$sql .= " CONCAT( pupc_tb.P_ID, pupc_tb.P_TITLE, pupc_tb.P_AWORD ) LIKE ?";
			for( $i=1; $i< count( $this -> keywordArray ); $i++ ){
				$sql .= " AND CONCAT( pupc_tb.P_ID, pupc_tb.P_TITLE, pupc_tb.P_AWORD ) LIKE ? ";
			}
			return $sql;
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
		
		//配列のキー取得
		public function getKeyArray(){
			$array_key = array_keys( $this -> searchText );
			return $array_key;
		}
	}