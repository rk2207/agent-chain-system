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
	// while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		// $rows[] =$row;
	// }
	// return $rows;
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
function prx($array){
	echo "<pre>";print_r($array);die;
}
function pr($array){
	echo "<pre>";print_r($array);
}
function createTree($con,$sponsor_code){
	$html = "<ul><li><a href=''>".$sponsor_code."</a>";
	$html = renderTree($con,$sponsor_code,1);
	$html .="</li></ul>";
	return $html;
}
function renderTree($con,$sponsor_code,$flag=0) {
	$checkChildExist = checkChildDataExist($con,$sponsor_code);
	$html = "";
	if(!$checkChildExist){ //child not exist
		$html .= "<a href=''>".$sponsor_code."</a><ul id='1'>";
	}else{ //child exist
		if(!$flag)
			$html = "<ul id='2'><li id='1'><a href=''>".$sponsor_code."</a><ul id='3'>";
		else
			$html .= "<ul>";
	}
	$pair_ids = getPairIds($con,$sponsor_code);
	$pair_count = count($pair_ids);
	if( $pair_count > 0) {		
		// for($i = 1; $i <= $pair_count;$i++) {
		$i = 1;
		foreach($pair_ids as $k => $v) {			
			if($i%2 != 0 && $checkChildExist){ // odd pair_id and child exist
				$html .= "<li id='2'><ul id='4'>";
			}
    		$pair_values = getPairValues($con,$sponsor_code,$v);
			echo $i."<br>".pr($pair_values);
			$html .= "<li id='3'>".$i ." ".renderTree($con,$pair_values['agent_code'])."</li>";
    		if($i%2 == 0){
				$html .= "</ul></li>";
			}
			if($pair_count%2 != 0 && $i == $pair_count){// pair count odd & on last loop
				$html .= "</ul></li>";
			}
			$checkChildExist = 0;
			$i++;
    	}
	} else {
	}
	$html .= "</ul>";
	// $html .= "</ul></li></ul>";
	return $html;
}
function renderTree0($con,$sponsor_code) {
	$sponsorData = getSponsorData($con,$sponsor_code);
	$parentSponsor = $sponsorData['sponsor_code'];
	// $html .= "<li>";
	$html = "<ul><li><a href=''>".$sponsor_code."</a><ul>";
	$pair_ids = getPairIds($con,$sponsor_code);
	// print_r($pair_ids);die;
	$pair_count = count($pair_ids);
	if( $pair_count > 0) {
		for($i = 1; $i <= $pair_count;$i++) {
			
			if($i%2 != 0){
				$html .= "<li><ul><li><ul>";
			}
			$j = $i-1;
    		$pair_values = getPairValues0($con,$sponsor_code,$pair_ids[$j]);
    		foreach ($pair_values as $key => $value) {
				$html .= "<li>".renderTree0($con,$value['agent_code'])."</li>";
    		}
    		if($i%2 == 0){
				$html .= "</ul></li></ul></li>";
			}
    	}
	} else {
	}
	$html .= "</ul></li></ul>";
	return $html;
}

function renderTree1($con,$sponsor_code) {
	$sponsorData = getSponsorData($con,$sponsor_code);
	$parentSponsor = $sponsorData['sponsor_code'];
	// $html .= "<li>";
	$html = "<a href=''>".$sponsor_code."</a><ul>";
	$pair_ids = getPairIds($con,$sponsor_code);
	$pair_count = count($pair_ids);
	if( $pair_count > 0) {
		for($i = $pair_count; $i >= 1;$i--) {
			if($i%2 != 0){
				$html .= "<li><ul>";
			}
			
    		$pair_values = getPairValues0($con,$sponsor_code,$i);
    		foreach ($pair_values as $key => $value) {
				$html .= "<li>".renderTree1($con,$value['agent_code'])."</li>";
    		}
    		if($i%2 == 0){
				$html .= "</ul></li>";
			}
    	}
	} else {
	}
	$html .= "</ul>";
	return $html;
}

?>
