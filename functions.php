<?php
function getSponsors($con){
	$sql = "select agent_code from agents";
	$result = mysqli_query($con,$sql);
	$rows = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		$rows[] =$row['agent_code'];
	}
	return $rows;
}
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
function addAgent($con,$request_array){

	$sql = "INSERT INTO `agents` (`id`, `agent_code`, `sponsor_code`, `pair_id`, `leg`, `depth_level`) VALUES (NULL, '".$request_array['agent_code']."', '".$request_array['sponsor_code']."', '".$request_array['pair_id']."', '".$request_array['leg']."', '".$request_array['depth_level']."');";
	$result = mysqli_query($con,$sql);
	$last_inserted_id = mysqli_insert_id($con);
	if(!empty($last_inserted_id)){
		$sql = "select * from agents where id ='".$last_inserted_id."'";
		$result = mysqli_query($con,$sql);
		$row = array();
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	} else{
		return [];
	}
}
function pr($array){
	echo "<pre>";print_r($array);
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
	$r = 0;
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
			// if($pair_count%2 != 0 && $i == $pair_count){// pair_id odd & on last loop
				// $html .= "</ul></li>";
			// }
			$checkChildExist = 0;
			$i++;
    	}
	} else {
	}
	$html .= "</ul>";
	return $html;
}
?>
