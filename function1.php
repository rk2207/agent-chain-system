<?php

function getSponsorData($con,$sponsor_code){
	$sql = "select * from agents where agent_code ='".$sponsor_code."'";
	$result = mysqli_query($con,$sql);
	$row = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
	return $row;
}
function getPairIds($con,$sponsor_code){
	$sql = "select Distinct(pair_id) from agents where sponsor_code = '".$sponsor_code."' ORDER BY pair_id";
	$result = mysqli_query($con,$sql);
	$rows = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		$rows[] =$row['pair_id'];
	}
	return $rows;
}

function getPairValues($con,$sponsor_code,$pair_id){

	$sql = "select * from agents where sponsor_code ='".$sponsor_code."' AND pair_id ='".$pair_id."'";
	$result = mysqli_query($con,$sql);
	$rows = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	return $row;
}
function getPairValues0($con,$sponsor_code,$pair_id){

	$sql = "select * from agents where sponsor_code ='".$sponsor_code."' AND pair_id ='".$pair_id."'";
	$result = mysqli_query($con,$sql);
	$rows = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		$rows[] =$row;
	}
	return $rows;
	return $row;
}

function checkChildDataExist($con,$sponsor_code){
	$sql = "select * from agents where sponsor_code ='".$sponsor_code."'";
	$result = mysqli_query($con,$sql);
	$row = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
	return count($row);
}

function createTree($con,$sponsor_code){
	$html = "<ul><li><a href=''>".$sponsor_code."</a>";
	$html .= renderTree($con,$sponsor_code,0,1);
	$html .="</li></ul>";
	return $html;
}
function renderTree($con,$sponsor_code,$i=0,$flag=0) {
	$checkChildExist = checkChildDataExist($con,$sponsor_code);
	$html = "";
	if(!$checkChildExist){ //child not exist
		$html .= "<a href=''>".$sponsor_code."</a><ul id='1'>";
	}elseif($i!= 0 && $i%2 == 0){ //child exist && even no. child
		$html .= "<a href=''>".$sponsor_code."</a><ul id='2'>";
	}elseif($i%2 != 0 && $i > 1){ //child exist && odd no. child but not 1st child
		$html .= "<ul><li><a href=''>".$sponsor_code."</a><ul id='2'>";
	}else{ //child exist && 1st child
		if(!$flag){
			$html = "<a href=''>".$sponsor_code."</a><ul id='3'>";
		}else{
			$html .= "<ul id='4'><li id='1'><ul>";
			$r = 1;
		}
	}
	$pair_ids = getPairIds($con,$sponsor_code);
	$pair_count = count($pair_ids);
	if( $pair_count > 0) {
		$i = 1;
		foreach($pair_ids as $k => $v) {
    		$pair_values = getPairValues($con,$sponsor_code,$v);
			if($i%2 != 0 && ($checkChildExist || $r)){ // odd pair_id and child exist
				$html .= "<li id='2'><ul id='4'>";
			}
			if($i%2 == 0 && $checkChildExist){ // even pair_id and child exist
				$html .= "<li><ul>";
			}
			$html .= "<li id='3'>".renderTree($con,$pair_values['agent_code'],$i)."</li>";
			
    		if($i%2 == 0 && (!$flag || $r)){
				$html .= "</ul></li>";
			}
			if($pair_count%2 != 0 && $i == $pair_count){// pair_id odd & on last loop
				$html .= "</ul></li>";
			}
			$checkChildExist = 0;
			$i++;
    	}
	} else {
	}
	$html .= "</ul>";
	return $html;
}
// function renderTree0($con,$sponsor_code) {
// 	$sponsorData = getSponsorData($con,$sponsor_code);
// 	$parentSponsor = $sponsorData['sponsor_code'];
// 	// $html .= "<li>";
// 	$html = "<ul><li><a href=''>".$sponsor_code."</a><ul>";
// 	$pair_ids = getPairIds($con,$sponsor_code);
// 	// print_r($pair_ids);die;
// 	$pair_count = count($pair_ids);
// 	if( $pair_count > 0) {
// 		for($i = 1; $i <= $pair_count;$i++) {
			
// 			if($i%2 != 0){
// 				$html .= "<li><ul><li><ul>";
// 			}
// 			$j = $i-1;
//     		$pair_values = getPairValues0($con,$sponsor_code,$pair_ids[$j]);
//     		foreach ($pair_values as $key => $value) {
// 				$html .= "<li>".renderTree0($con,$value['agent_code'])."</li>";
//     		}
//     		if($i%2 == 0){
// 				$html .= "</ul></li></ul></li>";
// 			}
//     	}
// 	} else {
// 	}
// 	$html .= "</ul></li></ul>";
// 	return $html;
// }

// function renderTree1($con,$sponsor_code) {
// 	$sponsorData = getSponsorData($con,$sponsor_code);
// 	$parentSponsor = $sponsorData['sponsor_code'];
// 	// $html .= "<li>";
// 	$html = "<a href=''>".$sponsor_code."</a><ul>";
// 	$pair_ids = getPairIds($con,$sponsor_code);
// 	$pair_count = count($pair_ids);
// 	if( $pair_count > 0) {
// 		for($i = $pair_count; $i >= 1;$i--) {
// 			if($i%2 != 0){
// 				$html .= "<li><ul>";
// 			}
			
//     		$pair_values = getPairValues0($con,$sponsor_code,$i);
//     		foreach ($pair_values as $key => $value) {
// 				$html .= "<li>".renderTree1($con,$value['agent_code'])."</li>";
//     		}
//     		if($i%2 == 0){
// 				$html .= "</ul></li>";
// 			}
//     	}
// 	} else {
// 	}
// 	$html .= "</ul>";
// 	return $html;
// }

?>
