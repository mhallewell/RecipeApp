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
var ingredientStorage = [];

function addIngredient(){
	form = document.getElementById('innerChatForm');
	for(var x = 0; x < numOfIngredients; x++) {
		var current = document.getElementById('F'+x);
		if(current != null)ingredientStorage.push(current.getElementsByTagName('input'));
	}
	form.innerHTML = '';
	for(var x = 0; x <= numOfIngredients; x++) {
		if(ingredientStorage[x] != null)
			form.innerHTML += '<div id="F' + x
					+ '"> <input type="text" name="ingredients[' + x
					+ '][quantity]" value="' 		     + ingredientStorage[x][0].value
					+ '"> <input type="text" name="ingredients[' + x
					+ '][name]" value="' 			     + ingredientStorage[x][1].value
					+ '"> <br> </div>';
		else
			form.innerHTML += '<div id="F' 								 + x
					+ '"> <input type="text" name="ingredients[' 				 + x
					+ '][quantity]" value="Quantity"> <input type="text" name="ingredients[' + x
					+ '][name]" value="Ingredient"> <br> </div>';

	}
	ingredientStorage = [];
	numOfIngredients+=1;
}

function removeIngredient(){
	numOfIngredients-=1;
	form = document.getElementById('innerChatForm');
	for(var x = 0; x < numOfIngredients; x++) {
		var current = document.getElementById('F'+x);
		if(current != null)ingredientStorage.push(current.getElementsByTagName('input'));
	}
	form.innerHTML = '';
	for(var x = 0; x <= numOfIngredients; x++) {
		if(ingredientStorage[x] != null)
			form.innerHTML += '<div id="F' + x
					+ '"> <input type="text" name="ingredients[' + x
					+ '][quantity]" value="' 		     + ingredientStorage[x][0].value
					+ '"> <input type="text" name="ingredients[' + x
					+ '][name]" value="' 			     + ingredientStorage[x][1].value
					+ '"> <br> </div>';
	}
	ingredientStorage = [];
}
