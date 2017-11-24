<?php 
include("config.php");
include("functions.php");
$rows = getSponsors($con);
//echo "<pre>";print_r($rows);

?>
<style type="text/css">
.container{
	margin:0 auto;
	width: 20%;
	border: 1px solid #000;
	padding: 5%;
}
.row{
	width: 100%;
	float: left;
	text-align: center;
	height: 20px;
	margin: 10px;
}

</style>
<div class="container">
	<a href="/agent-tree/view.php">Tree View</a>
</div>