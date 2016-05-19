<?php

class ReviewsController extends CI_Controller{
    
    public function index(){
        
    }
    
    public function getAmazonReviews(){
        
        $prodId = $_POST['prodId'];
        
        $aws_access_key_id = "AKIAJDYWLCIAW32ROJQQ";

        // Your AWS Secret Key corresponding to the above ID, as taken from the AWS Your Account page
        $aws_secret_key = "2mYoL5wU5+D6KA+Jk6HqgNaP4VCI6HtpTFdY9AqZ";

        // The region you are interested in
        $endpoint = "webservices.amazon.ca";

        $uri = "/onca/xml";

        $params = array(
            "Service" => "AWSECommerceService",
            "Operation" => "ItemLookup",
            "AWSAccessKeyId" => "AKIAJDYWLCIAW32ROJQQ",
            "AssociateTag" => "pricewise04-20",
            "ItemId" => "B00OTXHQM4",
            "ResponseGroup" => "Reviews,Small",
            "TruncateReviewsAt" => "256",
            "IncludeReviewsSummary" => "true"
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
        //var_dump($response);
        $results;
        foreach ($response->Items->Item as $item)
      {
      	$topSeller = $item->CustomerReviews->IFrameURL;
      	
      	//$results .= "<iframe src=\"$topSeller\" />";
        
      }
        
      echo json_encode($topSeller);
        
        
    } 
    
    
    
    
}

