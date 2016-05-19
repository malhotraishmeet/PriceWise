
<h1>Search Results for </h1>
			
  				<div id="displayPane">
    				  <?php
                                  
                                  $results = json_decode($results);
                                  foreach ($results as $result){
                                      var_dump($result->pic->{'0'});
                                      $pic = $result->pic->{'0'};
                                      $link = $result->link->{'0'};
                                      $title = $result->productTitle->{'0'};
                                      $price = $result->price->{'0'};
                                      //$pid = $result->productId->{'0'};
                                      
                                      
                                        var_dump("<div class=\"prodDisplay\"><div class=\"prodImage\"><img src=\"$pic\"></div><div class=\"prodTitle\"><a href=\"$link\">$title</a></div><div class=\"prodPrice\">$$price</div><div class=\"prodId\"></div><div><input type=\"checkbox\" class=\"selectedItems\" name=\"\" value=\"$title\"></div></div>");
                                  }
                                    //var_dump($results)
                                  ?>
  				</div>
