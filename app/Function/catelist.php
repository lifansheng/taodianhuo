<?php

	function lists($pid){
		if($pid == '0'){
			return '顶级分类';
		}else{

			//根据pid查询
			$rs = DB::table('cate')->where('id',$pid)->first();

			return $rs->title;
		}
	}


?>