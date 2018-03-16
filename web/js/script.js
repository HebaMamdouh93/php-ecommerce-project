
$(function () {
	var rate=null;
	var rateEle=$(".rating").clone();
	
	//search for the product
	$("#searchInput").autocomplete({
        source: "../web/search.php",
        minLength: 2,
        select: function (event, ui) {
            window.location = "../web/viewproduct.php?productID=" + ui.item.value;
        }
    });
	//Add to Cart
    $('.addcart').click(function () {
		 
		var productID = $(this).attr("product-id");
		//console.log(productID);
		var cartBtn=$(this);
        $.ajax({
            url: '../web/addcart.php',
            type: 'post',
            data: {productId: productID},
            success: function (response) {
                console.log(response);
                if (response.success == true) {
					$("#"+productID).show(50,function(){
						
						cartBtn.attr("disabled","disabled");
					});
                    
                }
            }
        });


    });
	
	//delete from checkouts
	$('.deleteIcon').click(function () {
		 
		var productID = $(this).attr("product-id");
		var priceDelItem=$("#"+productID).find("h4").html();
		var delPrice=parseInt(priceDelItem);
		
		var totalPrice=parseInt($("#totalprice").html());
		var currTotPrice=totalPrice-delPrice;
		
		var cartBtn=$(this);
        $.ajax({
            url: '../web/deletecart.php',
            type: 'post',
            data: {productId: productID},
            success: function (response) {
                console.log(response);
                if (response.success == true) {
					
					$("#totalprice").html(currTotPrice+" LE");
					$("#"+productID).remove();
					
                    
                }
            }
        });


    });

//add review
$("input[type='radio']").click(function(){
	
	rate=$(this).val();
	
});
 $('#addreview').click(function () {
		    var reviewVal= $('#addreviewtext').val();
			var productID=$(this).attr("product_id");
			var userName=$(this).attr("user_name");
		
			 console.log(userName);
        $.ajax({
            url: '../web/addreview.php',
            type: 'post',
            data: {
				review: reviewVal,
				rateVal:rate,
				productId:productID
			},
            success: function (response) {

                if (response.success == true) {
                    var rate=response.rate;
                    console.log(rate);
                    $("#avgRate").html("Average Rate:"+rate);
                    $("#avgRate").css("color","red");
                     $('#addreview').attr("disabled","disabled");
					$(".rating").remove();
					$(".form").append(rateEle);
					$("input[type='radio']").val(0);
					$('#addreviewtext').val("");
                    $("#reviewResult").show();
					var ele=$("<div class='review'><h3>"+userName+"</h3><h5>"+reviewVal+"</h5><h6>"+response.createdAt+"</h6></div>");
					$("#review").before(ele);
                }
            }
        });


    });
 
});

