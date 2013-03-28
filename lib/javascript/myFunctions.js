
function addToBasket(id){
	//setting default 
	//if (quantity === undefined ) quantity = 1;
	//getting quantity
	var quantity = document.getElementById(id).value;
	
	//validation
	if (isNaN(quantity ) || quantity < 1){
		quantity = 1;
	}
	var item = {
			'id': id,
			'quantity': quantity
	};

	var basketString = sessionStorage.getItem("basket");

	if(basketString === null){
		
		var basket = new Array(item);
		
		basketString = JSON.stringify(basket);
		sessionStorage.setItem("basket",basketString);	
	}else{
		
		var basketObj = JSON.parse(basketString);

		//checks if id is already in basket
		var isItemInBasket = false;
		for(var i in basketObj){
			//checks if id is already in basket
			//if the item is already in the basket, quantity gets modiffied
			if(basketObj[i].id === id){
			// console.log("Type of obj: " + typeof(parseInt(basketObj[i].quantity )));
			// console.log("Type of arg: " + typeof(quantity));
				basketObj[i].quantity = parseInt(basketObj[i].quantity);
				quantity = parseInt(quantity);

				basketObj[i].quantity += parseInt(quantity);
				isItemInBasket = true;
			}
		}
		if (!isItemInBasket){
			basketObj.push(item);	
		}
		
		basketString = JSON.stringify(basketObj);
		sessionStorage.setItem("basket",basketString);

		//document.getElementById("basketString").setAttribute("value",basketString);
		
	}
	//TODO: update count in basket menu
	
}
/*
//TODO: refactor
function getBasket(){

	var xmlHttp;
	
	 xmlhttp = new XMLHttpRequest();
			  
	var basketString = sessionStorage.getItem("basket");
	xmlhttp.open("POST","updateBasket.php",false);
	
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("basketString=" + basketString);
	console.log("getBasket has finished");
}*/
/*function checkout(){

	var xmlHttp;
	
	 xmlhttp = new XMLHttpRequest();
		
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	    //document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	    console.log(xmlhttp.responseText);
	    }
	  }
	var basketString = sessionStorage.getItem("basket");
	xmlhttp.open("POST","checkout.php",true);
	
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("basket=" + basketString);
}
*/
function removeItem(id){
	var basketString = sessionStorage.getItem("basket");

	var basketObj = JSON.parse(basketString);

	for(var i = 0; i < basketObj.length; i++){
		if(basketObj[i].id === id){
			basketObj.splice(i,1);
		}
	}
	basketString = JSON.stringify(basketObj);
	sessionStorage.setItem("basket",basketString); 
	window.location.href="basket.php?basketString=" + basketString;
	//window.navigate("basket.php?basketString=" + basketString);

	//getBasket();
}
function goToBasket(){
	var basketString = sessionStorage.getItem("basket");
	window.location.href="basket.php?basketString=" + basketString;
	
}
function goToCheckout(){
	var basketString = sessionStorage.getItem("basket");
	window.location.href="checkout.php?basketString=" + basketString;
	
}
function displayCustomerForm(){
	document.getElementById("cDetails").style.display = "block";
	document.getElementById("displayFormButton").disabled = "true";
}
function checkout(id){
	var basketString = sessionStorage.getItem("basket");
	document.getElementById(id).setAttribute("value",basketString);
	//erase basket
	sessionStorage.removeItem("basket");
}