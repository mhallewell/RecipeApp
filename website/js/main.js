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
