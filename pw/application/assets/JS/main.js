
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#searchButton").click();  
    }
});

function submitSearch()
{
    var searchQuery = $("#searchBox").val();
    var searchInCB = $('input[name="searchIn[]"]');
    var searchIn = [];
    if($.trim(searchQuery)!=""){    
        for(var i=0;i<searchInCB.length;i++){
            if(searchInCB[i].value ==="Ebay" && searchInCB[i].checked ==true)
                searchEbay(searchQuery,'ebay');
            if(searchInCB[i].value ==="Amazon" && searchInCB[i].checked ==true)
                searchAmazon(searchQuery,'amazon');
        }
    }
    else
        alert("Enter a product to search");
    
}


function searchEbay(searchQuery,company){
    $("#ebayDiv").empty();
    $("#amazonDiv").empty();
    $(".productDiv").empty();
    $("#comparisonDiv").hide();
    $.ajax({
                type:'POST',
                url:'http://localhost:8080/PW/index.php/SearchController/searchEbayByKeyword',
                data:{'searchQuery':searchQuery},
                success:function(resp){
                    resultObj = JSON.parse(resp);
                    //console.log(resultObj[1].link);
                      
                    for(var i=0;i<resultObj.length;i++){
                      
                      displayProducts(resultObj,i,company);
                    
                    }
                    
                    $("#resultsDiv").show();
                    
                    //displayResult(resultObj);
                    
                    
                }
            });
    
}

function searchAmazon(searchQuery,company){
    $("#ebayDiv").empty();
    $("#amazonDiv").empty();
    $(".productDiv").empty();
    $("#comparisonDiv").hide();
    $.ajax({
                type:'POST',
                url:'http://localhost:8080/PW/index.php/SearchController/searchAmazonByKeyword',
                data:{'searchQuery':searchQuery},
                success:function(resp){
                    resultObj = JSON.parse(resp);
                    //console.log(resultObj[1].link);
                      
                    for(var i=0;i<resultObj.length;i++){
                      
                      displayProducts(resultObj,i,company);
                    
                    }
                    
                    $("#resultsDiv").show();
                    
                    //displayResult(resultObj);
                    
                    
                }
            });
}


function displayProducts(resultObj,i,company){
    
                      //console.log($("#"+company+"Div"));  
                      var siteDiv = $("#"+company+"Div");
                      var product = document.createElement('div');
                      product.className = "prodDisplay";
                      product.id = company+"product"+i;
                      siteDiv.append(product);
                      
                      var parentProd = $("#"+company+"product"+i);
                      
                      
                     
                      var image = document.createElement('div');
                      image.className = "prodImage";
                      //image.title = "Add to Compare";
                      image.id = "prodImage"+resultObj[i].productId[0];
                      image.style.background = "url("+resultObj[i].pic[0]+")no-repeat scroll center center #fff";
                      parentProd.append(image);
                      
                      var prodTitle = document.createElement('div');
                      prodTitle.className = 'prodTitle';
                      prodTitle.innerHTML = "<a href='"+resultObj[i].link[0]+"'>"+resultObj[i].productTitle[0]+"</a>";
                      parentProd.append(prodTitle);
                      
                      var prodPrice = document.createElement('div');
                      prodPrice.className = 'prodPrice';
                      prodPrice.innerHTML = resultObj[i].price[0];
                      parentProd.append(prodPrice);
                      
                      var comapreDiv = document.createElement('div');
                      comapreDiv.innerHTML = "<input type='checkbox' class='selectedItems' onchange='updateCompare();' name='"+resultObj[i].productId[0]+"' id='"+resultObj[i].productId[0]+"'>";
                      comapreDiv.className = 'selectedItems';
                      parentProd.append(comapreDiv);
    
                      var siteLogo = document.createElement('img');
                      siteLogo.src = "http://localhost:8080/PW/application/assets/img/"+company+"-logo.png";
                      siteLogo.className = 'siteLogo';
                      siteLogo.setAttribute("name", company);
                      parentProd.append(siteLogo);
                      
                      
    
    
    
    
}

function updateCompare(){
   var items = $(".selectedItems"); 
   var count = 0;
   for(var i=0;i<items.length;i++){
        if(items[i].checked ==true){
           count++;
        }
        
        
    }   
     if(count>1 && count<=3)
        $('#compareProductsButton').show();
    else
        $('#compareProductsButton').hide();
   
    
    
}

function toggleAddToCompare(id){
   // console.log($("#"+id));
}


function compareProducts(){
    var items = $(".selectedItems");
    $("#resultsDiv").hide();
    
    $(".productDiv").remove();
    $(".comparisonTD").remove();
    for(var i=0;i<items.length;i++){
        if(items[i].checked ==true){
         var cb = $("#"+items[i].id).parent();
         var product = cb.parent();
         var ID = product.attr('id'); 
         
         var pic = $("#"+ID+" .prodImage");
         var title = $("#"+ID+" .prodTitle");
         var price = $("#"+ID+" .prodPrice");
         var website = $("#"+ID+" .siteLogo");
         
         var SiteName = $("#siteName");
         var siteImageTD = document.createElement('td');
         siteImageTD.id = "siteImageTD"+i;
         siteImageTD.className = "comparisonTD";
         SiteName.append(siteImageTD);
        
         
         var siteImageTD = $("#siteImageTD"+i);
        
         var siteLogo = document.createElement('img');
         siteLogo.src = website.attr('src');
         siteLogo.style.height = '30px';
         siteImageTD.append(siteLogo);
         
         //image of product
         var prodImage = $("#imageRow")
         var prodImageTD = document.createElement('td');
         prodImageTD.className = "comparisonTD";
         prodImageTD.id = "prodImageTD"+i;
         prodImage.append(prodImageTD);
         
         var prodImageTD  = $("#prodImageTD"+i);
         var prodImage = document.createElement('div');
         prodImage.style.background = pic.css('background');
         prodImage.className= 'prodImage';
         prodImageTD.append(prodImage);
         
         var prodTitle = $("#titleRow")
         var prodTitleTD = document.createElement('td');
         prodTitleTD.className = "comparisonTD";
         prodTitleTD.id = "prodTitleTD"+i;
         prodTitle.append(prodTitleTD);
         
         var prodTitleTD  = $("#prodTitleTD"+i);
         var prodTitle = document.createElement('div');
         prodTitle.innerHTML = title.html();
         prodTitle.className= 'prodTitle';
         prodTitleTD.append(prodTitle);
         
         var prodPrice = $("#priceRow")
         var prodPriceTD = document.createElement('td');
         prodPriceTD.className = "comparisonTD";
         prodPriceTD.id = "prodPriceTD"+i;
         prodPrice.append(prodPriceTD);
         
         var prodPriceTD  = $("#prodPriceTD"+i);
         var prodPrice = document.createElement('div');
         prodPrice.innerHTML = "$"+price.html();
         prodPriceTD.append(prodPrice);
         
         
         //get reviews from respective site and display
         
         var website = $("#"+ID+" .siteLogo").attr('name');
         //console.log(website);
         
         if(website == "amazon"){
             var amazonReview = getReviewsFromAmazon(items[i].id,i);
             //console.log(amazonReview);   
         }
         else if (website == "ebay"){
                    var prodReview = $("#reviewRow");
                    var prodReviewTD = document.createElement('td');
                    prodReviewTD.className = "comparisonTD";
                    prodReviewTD.id = "prodReviewTD"+i;
                    prodReview.append(prodReviewTD);
         }
         
         
      }
    }
    $("#comparisonDiv").show();
    
    
}

function getReviewsFromAmazon(ID,i){
    
    console.log(ID);
    
    
    $.ajax({
                type:'POST',
                url:'http://localhost:8080/PW/index.php/ReviewsController/getAmazonReviews',
                data:{'prodId':ID},
                success:function(resp){
                    resultObj = JSON.parse(resp);
                    
                    
                    amazonReview = resultObj[0];
                    //console.log(amazonReview);
                    var prodReview = $("#reviewRow");
                    var prodReviewTD = document.createElement('td');
                    prodReviewTD.className = "comparisonTD";
                    prodReviewTD.id = "prodReviewTD"+i;
                    prodReview.append(prodReviewTD);

                    prodReviewTD = $("#prodReviewTD"+i);
                    var review = document.createElement('iframe');
                    review.src = amazonReview;
                    prodReviewTD.append(review); 
                    
                    
                    //$("#resultsDiv").show();
                    
                    //displayResult(resultObj);
                    
                    
                }
            });
            
            
}


function closeComparison(){
    $("#ebayDiv").empty();
    $("#amazonDiv").empty();
    $(".productDiv").empty();
    $("#comparisonDiv").hide();
    $('#compareProductsButton').hide();
    
}