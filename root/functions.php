<?php

	date_default_timezone_set('Asia/Tokyo');


	function h($v){
		return htmlspecialchars($v,ENT_QUOTES,'UTF-8');
	}

	//日付期間の文字列を返す
	function FormatPostDate($date){

		if (is_null($date)) {
			$fmt_date ="----/--/--";
		} else {
			
			$fmt_date = date('Y/m/d', strtotime($date));
		}

		return $fmt_date;

	}


