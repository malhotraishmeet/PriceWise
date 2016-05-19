<?php

class Product extends CI_Model{
    
    public $productTitle;
    public $productId;
    public $pic;
    public $link;
    public $price;
    public $site;
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    }
    
    
    function CreateProduct($productTitle,$productId,$pic,$link,$price,$site){
        $this->link = $link;
        $this->price = $price;
        $this->pic = $pic;
        $this->productId = $productId;
        $this->productTitle = $productTitle;
        $this->site = $site;
        
        return $this;
    }
    
}
