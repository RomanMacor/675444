
//adds item to basket
function addToBasket(id){
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
		
	}
	updateBasketButton();
	
}
//edit basket button to display number of items in basket
function updateBasketButton(){
	//update count in basket menu
	
	
	var basketString = sessionStorage.getItem("basket");
	var basketObj = JSON.parse(basketString);
	if(basketObj){
		var count = basketObj.length;
		document.getElementById("basketButton").innerHTML = "Go to basket (" + count + ")";
	}
}

//ajax search
function search(searchString){
	console.log("ajax search");
	var xmlHttp;
	
	 xmlhttp = new XMLHttpRequest();


	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	    document.getElementById("productList").innerHTML=xmlhttp.responseText;
	    // console.log("Onready state function fired");
	    }
	  }
	xmlhttp.open("GET","search.php?searchString=" + searchString,true);
	xmlhttp.send();
}
//removes item from basket
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
	
}
//redirect to basket
function goToBasket(){
	var basketString = sessionStorage.getItem("basket");
	window.location.href="basket.php?basketString=" + basketString;
	
}
//redirect to checkout
function goToCheckout(){
	var basketString = sessionStorage.getItem("basket");
	window.location.href="checkout.php?basketString=" + basketString;
	
}
//display form for customer
function displayCustomerForm(){
	document.getElementById("cDetails").style.display = "block";
	document.getElementById("displayFormButton").disabled = "true";
}
//checkout and erase basket
function checkout(id){
	var basketString = sessionStorage.getItem("basket");
	document.getElementById(id).setAttribute("value",basketString);
	//erase basket
	sessionStorage.removeItem("basket");
}
/*
Changes quantity of item with AJAX and displays new quantity right away
*/
function changeQuantity(id){

	var xmlHttp;
	
	 xmlhttp = new XMLHttpRequest();

	var newQuantity = document.getElementById("newQuantity" + id).value;

	document.getElementById("quantity" + id).innerHTML = newQuantity;

	xmlhttp.open("POST","changeQuantity.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id=" + id + "&quantity=" + newQuantity);
}
// sets value to warning limit input field
function populateWarningLimit(){
	var warningLimit = localStorage.getItem("warningLimit");
	if(warningLimit === null || isNaN(warningLimit)){
		//setting default value, if no value is set or set value is invalid
		warningLimit = 10;
	}

	document.getElementById("warningLimit").value = warningLimit;	
	
}
//set warning limit when textbox looses focus
function setWarningLimit(){
	var warningLimit = document.getElementById("warningLimit").value;
	if( warningLimit != null && !isNaN(warningLimit) ){
		localStorage.setItem("warningLimit",warningLimit);
	
	}
	
}
//return warning limit stored
function getWarningLimit(){
	var warningLimit = localStorage.getItem("warningLimit");
	if(warningLimit === null || isNaN(warningLimit) ){
		//setting default value, if no value is set or set value is invalid
		warningLimit = 10;
	}
	return warningLimit;	
}
//marks item as distributed
function distribute(id){
	
	var warningLimit = getWarningLimit();

	var xmlHttp;
	
	 xmlhttp = new XMLHttpRequest();


	xmlhttp.onreadystatechange=function(){
	
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
	  	var response = xmlhttp.responseText;
	  	if(response != ""){
	  		document.getElementById("warning").innerHTML=response;
	  	}  	
	   }
	  }
	xmlhttp.open("POST","distribute.php","true");
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("id=" + id + "&warningLimit=" + warningLimit);
	
	document.getElementById(id).style.display = 'none';
}
//pop up to get confirmation of action
function eraseAllData(){
	
	var userAnswer=confirm("You are about to delete all data in database. Press OK to continue or Cancel to stop the action");
	
	if (userAnswer === true){
		return true;
	}else{
		return false;
	}
}
//ajax function that sorts items when sort by value changes
function sortBy()
{

	var selectMenu = document.getElementById("sortMenu");
	var orderBy = selectMenu.options[selectMenu.selectedIndex].value;
	
	var xmlHttp;
	
	xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		var response = xmlhttp.responseText;
		if (response && response !="") document.getElementById("productList").innerHTML=response;
	    // console.log("Onready state function fired");
	    }
	  }
	 //sending the select menu alongside order by
	var uri = window.location.href;
	uri = uri.split("?");

	if(uri[1] != null)
	{
		var param  = "?" + uri[1] + "&orderBy=" + orderBy;
	}else
	{
		var param =  "?orderBy=" + orderBy;
	}
	xmlhttp.open("GET","sort.php"+ param, true);
	xmlhttp.send();
}
