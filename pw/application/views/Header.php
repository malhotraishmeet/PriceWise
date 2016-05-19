<?php

if(isset($_POST['submit'])) {
	$query = $_POST['search'];
	if(!empty($query)) {
			session_start();

			$_SESSION['search'] = $query;
	
		} //empty if ends
	} //isset if ends
?>        
<!-- Build the HTML page with values from the call response -->
<html>
	<head>
		<title>PriceWise</title>
		<!-- <style type="text/css">body { font-family: arial,sans-serif;} </style> -->
                <base href="<?php echo base_url(); ?>">
                <link href="assets/css/home.css" type="text/css" rel="stylesheet" />
                <script src="<?php echo base_url(); ?>/assets/js/jquery-1.12.1.js" type="text/javascript"></script>
                <script src="<?php echo base_url(); ?>/assets/js/main.js" type="text/javascript"></script>
	</head>