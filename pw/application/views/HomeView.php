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
	<body>
            <div id="navBar">
                <div id="PWtitle">
                    
                    <div id="PWname">
                        <span>Price</span><span>Wise</span>
                    
                        <div style="float:right;width: 100px;height:10px;">
                            <button id="compareProductsButton" onclick="compareProducts();" name="submit" class="submit">Compare</button>   
                        </div>
                    </div>
                    
                </div>
                <ul id="navul">
                    <li><a class="active" href="">Home</a></li>
                    <li><a href="">Deals</a></li>
                    <li><a href="">Wish List</a></li>
                    <li><a href="">About</a></li>
                    <li style="float:right;"><a href>Register</a></li>
                    <li style="float:right;margin-top:13px;margin-left:5px;margin-right:5px;">or</li>
                    <li style="float:right;"><a href="">Login</a></li>
                </ul>
                <div id="loginDiv" style="display:none;">
                    <input type="text" id="username" placeholder="Username" class="login">
                    <input type="password" id="password" placeholder="Password" class="login">
                
                </div>
            </div>
		<!-- <form id="searchForm" method="POST" action="SearchController"> -->
                <div id="searchDiv">
                <div id="searchForm">
                    <h2>Save big, Shop big <br/></h2>
                    <button onclick ="submitSearch();" name="submit" class="submit" id="searchButton">Search</button>
                    <input type="text" name="search" class="search" id="searchBox" value="" placeholder="Enter Product"/>
                    
		</div>
                <!-- </form>-->
            <div id="searchInDiv">
                <fieldset>
                    <legend>Search in?</legend>
                            <input id="ebay" type="checkbox" name="searchIn[]" value="Ebay" />Ebay 
                            <input type="checkbox" name="searchIn[]" value="Amazon" />Amazon
                </fieldset>
            </div>
                
                <div id="resultsDiv" style="display: none; width:900px;">
                   
                    
                    <div id="ebayDiv">
                        
                    </div>
                    
                    <div id="amazonDiv" >
                        
                    </div>
                     
                    </div> 
                </div>
                
                <div id="comparisonDiv" style="display: none;width:100%;">
                    <div style="float:right;width: 100%;margin-bottom: 10px;">
                            <button id="closeCompariosnButton" onclick="closeComparison();" name="submit" class="submit" style="display: block;width: 25px;padding: 2px;height: 25px;margin-right: 0px;font-size: 15px;" title="Close Comparison">X</button>   
                    </div>
                    
                    <table border='1' style="background-color: #f5f5f5;margin-left:auto;margin-right:auto;margin-:10px;">
                        <tr id="siteName">
                            <th>Site Name</th>
                        </tr>
                        <tr id="imageRow">
                            <th>Image</th>
                        </tr>
                        <tr id="titleRow">
                            <th>Title</th>
                        </tr>
                        <tr id="priceRow">
                            <th>Price</th>
                        </tr>
                        <tr id="reviewRow">
                            <th>Reviews</th>
                        </tr>
                    </table>
                </div>    
                
	</body>
</html>