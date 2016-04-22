function dbLogin(userName, userID,userPic) {
	console.log(userName, userID);

	$.ajax({
		url: 'login.php',
		data: {
		   'userId': userID,
		   'username': userName,
		   'picture': userPic,
		},
		type: 'post',
		success: function(output) {
			window.location.href = "index.php";
		}
	});
}

var numOfIngredients = 1;
function addIngredient(){
	numOfIngredients += 1;
	document.getElementById('Add').innerHTML = '';
	for(var x = 0; x < numOfIngredients-1; x++) {
		document.getElementById('Add').innerHTML += '<input type="text" name="ingredients['+x+'][quantity]" value="Quantity"> <input type="text" name="ingredients['+x+'][name]" value="Ingredient"><br>';
	}
	document.getElementById("Amount").innerHTML = '<input type="hidden" id="numRecipes" value="'+numOfIngredients+'">';
}

function removeIngredient(){
	numOfIngredients -= 2;
	addIngredient();
	if(numOfIngredients < 1)
		numOfIngredients = 1;
}
