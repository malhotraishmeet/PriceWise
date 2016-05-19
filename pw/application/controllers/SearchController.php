<?php

class SearchController extends CI_Controller{
    
    public function index(){
        
    
        
    }    
    
    
    
    
    public function searchEbayByKeyword(){
        
    // *******************************  EBAY *******************************  
        
        $this->load->model('Product'); 
        $query = $_POST['searchQuery'];
        
	// API request variables
	$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
	$version = '1.0.0';  // API version supported by your application
	$appid = 'Anmolpre-PriceWis-PRD-ad2d4c74b-db30d8ae';  // Replace with your own Production AppID
	$globalid = 'EBAY-ENCA';  // Global ID of the eBay site you want to search
	//$query = 'harry potter';  // You may want to supply your own query
	$safequery = urlencode($query);  // Make the query URL-friendly
	$i = '0';  // Initialize the item filter index to 0
	

	// Construct the findItemsByKeywords HTTP GET call
	$apicall = "$endpoint?";
	$apicall .= "OPERATION-NAME=findItemsByKeywords";
	$apicall .= "&SERVICE-VERSION=$version";
	$apicall .= "&SECURITY-APPNAME=$appid";
	$apicall .= "&GLOBAL-ID=$globalid";
	$apicall .= "&keywords=$safequery";
	$apicall .= "&paginationInput.entriesPerPage=10";
	//$apicall .= "$urlfilter";

	//Parsing API call response
	
	// Load the call and capture the document returned by eBay API
	$resp = simplexml_load_file($apicall);
        
        $results = [];
        
	// Check to see if the request was successful, else print an error
	if ($resp->ack == "Success") {
  		
  	// If the response was loaded, parse it and build links
  	for($i = 0; $i< sizeof($resp->searchResult->item);$i++) {
    	$pic   = $resp->searchResult->item[$i]->galleryURL;
    	$link  = $resp->searchResult->item[$i]->viewItemURL;
    	$title = $resp->searchResult->item[$i]->title;
        $price = $resp->searchResult->item[$i]->sellingStatus->currentPrice;
	$pid   = $resp->searchResult->item[$i]->itemId;
        $site  = "ebay";
        //$obj = new stdClass;
        //var_dump($pid);
        $Product = new Product();
        $obj = $Product->CreateProduct($title, $pid, $pic, $link, $price,$site);
        
        array_push($results, $obj);
        
        
        }
        
        echo json_encode($results);
        
        }
        
    }
    

    public function searchAmazonByKeyword(){
        
        $query = $_POST['searchQuery'];
        $this->load->model('Product');
        
        // ****************************** Amazon ***********************************

        // Your AWS Access Key ID, as taken from the AWS Your Account page
        $aws_access_key_id = "AKIAJDYWLCIAW32ROJQQ";

        // Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
        $aws_secret_key = "2mYoL5wU5+D6KA+Jk6HqgNaP4VCI6HtpTFdY9AqZ";

        // The region you are interested in
        $endpoint = "webservices.amazon.ca";

        $uri = "/onca/xml";

        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemSearch",
            "AWSAccessKeyId" => "AKIAJDYWLCIAW32ROJQQ",
            "AssociateTag" => "pricewise04-20",
            "SearchIndex" => "All",
            "ResponseGroup" => "Images,ItemAttributes,Offers",
            "Keywords" => $query,
            "Condition" => "New"
        );

        // Set current timestamp if not set
        if (!isset($params["Timestamp"])) {
            $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
        }

        // Sort the parameters by key
        ksort($params);

        $pairs = array();

        foreach ($params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $aws_secret_key, true));

        // Generate the signed URL
        $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

        //echo "Signed URL: \"".$request_url."\"";

        $response = simplexml_load_file($request_url);
        //var_dump($response->Items->Item);
        
        
        $results = [];
        // If the response was loaded, parse it and build links
  	for($i = 0; $i< sizeof($response->Items->Item);$i++) {
        $item = $response->Items->Item[$i];
    	$pic   = $item->MediumImage->URL;
    	$link  = $item->DetailPageURL;
    	$title = $item->ItemAttributes->Title;
        $amount = $item->OfferSummary->LowestNewPrice->Amount;
        $price = ['0'=>number_format((float) ($amount / 100), 2, '.', '')];
        $pid   = $item->ASIN;
        $site  = "amazon";
        //$obj = new stdClass;
        $Product = new Product();
        $obj = $Product->CreateProduct($title, $pid, $pic, $link, $price,$site);
        //var_dump($obj);
        array_push($results, $obj);
        
        
        }
        
        echo json_encode($results);
        
        
        

    }
    
    
    
    
    
    
    
}