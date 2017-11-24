<?php

function getSponsorData($con,$sponsor_code){
	$sql = "select * from agents where agent_code ='".$sponsor_code."'";
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

function getPairValues($con,$sponsor_code,$pair_id){

	$sql = "select * from agents where sponsor_code ='".$sponsor_code."' AND pair_id ='".$pair_id."'";
	$result = mysqli_query($con,$sql);
	$rows = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    

		$rows[] =$row;
	}
	return $rows;
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
