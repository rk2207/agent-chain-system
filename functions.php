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
function getMaxPair($con,$sponsor_code){
	echo $sql = "select max(pair_id) as max_pair_no from agents where sponsor_code ='".$sponsor_code."'";
	$result = mysqli_query($con,$sql);
	$row = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
	if($row['max_pair_no'] == null){
		return 0;
	} else {
		return $row['max_pair_no'];
	}
	
}
function checkMaxPairIsEmpty($con,$sponsor_code,$max_nos_pair){

	$sql = "select count(*) as max_pair_no from agents where sponsor_code ='".$sponsor_code."' AND pair_id = '".$max_nos_pair."'";
	$result = mysqli_query($con,$sql);
	$row = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
	if($row['max_pair_no'] == '1'){
		return 'Yes';
	} else{
		return 'No';
	}
}
function addAgent($con,$request_array){

	$sql = "INSERT INTO `agents` (`id`, `agent_code`, `sponsor_code`, `pair_id`, `leg`, `depth_level`) VALUES (NULL, '".$request_array['agent_code']."', '".$request_array['sponsor_code']."', '".$request_array['pair_id']."', '".$request_array['leg']."', '".$request_array['depth_level']."');";
	$result = mysqli_query($con,$sql);
	$last_inserted_id = mysqli_insert_id($con);

	$sql = "select * from agents where id ='".$last_inserted_id."'";
	$result = mysqli_query($con,$sql);
	$row = array();
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
	return $row;

}
function getPairIds($con,$sponsor_code){
	$sql = "select Distinct(pair_id) from agents where sponsor_code = '".$sponsor_code."'";
	$result = mysqli_query($con,$sql);
	$rows = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		$rows[] =$row['pair_id'];
	}
	return $rows;
}

function getTrees($con,$sponsor_code){
	$pairs = array();
	$pairs = getPairIds($con,$sponsor_code);
	$str = '';
	$str .='<table>';
	$str .='<tr><td><table>';
			$str .='<tr>';
			$str .='<td align="middle">'.$sponsor_code.'</td>';
			$str .='</tr>';
			$str .='</table></td></tr>';
	$str .='<tr>';
	if(!empty($pairs)){
		foreach ($pairs as $key => $pair) {
			$pair_values = getPairValues($con,$sponsor_code,$pair);
			//echo "<pre>";print_r($pair_values);
			$str .='<td><table>';
			$str .='<tr>';
			foreach ($pair_values as $key => $value) {
				 $str .='<td>'.getTrees($con,$value['agent_code']).'</td>';
				 
			}
			$str .='</tr>';
			$str .='</table></td>';

		}
	}
	$str .='</tr>';
	$str .='</table>';
	return $str;
}

function getPairValues($con,$sponsor_code,$pair_id){

	$sql = "select * from agents where sponsor_code ='".$sponsor_code."' AND pair_id ='".$pair_id."'";
	$result = mysqli_query($con,$sql);
	$rows = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		$rows[] =$row;
	}
	return $rows;
}

function checkChildExistOrNot($con,$sponsor_code){

	$sql = "select * from agents where sponsor_code ='".$sponsor_code."'";
	$result = mysqli_query($con,$sql);
	$rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(count($rows) > 0){
		return true;
	}else{
		return false;
	}
}

function renderTree($con,$sponsor_code) {
	$sponsorData = getSponsorData($con,$sponsor_code);
	$parentSponsor = $sponsorData['sponsor_code'];
	// $html .= "<li>";
	$html = "<a href=''>".$sponsor_code."</a><ul>";
	$pair_ids = getPairIds($con,$sponsor_code);
	$pair_count = count($pair_ids);
	if( $pair_count > 0) {
		for($i = $pair_count; $i >= 1;$i--) {
    		$pair_values = getPairValues($con,$sponsor_code,$i);
    		foreach ($pair_values as $key => $value) {
				$html .= "<li>".renderTree($con,$value['agent_code'])."</li>";
    		}
    	}
	} else {
	}
	$html .= "</ul>";
	return $html;
}

?>