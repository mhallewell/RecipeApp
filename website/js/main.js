function dbLogin(userName, userID) {
	console.log(userName, userID);

	$.ajax({
		url: 'login.php',
		data: {
		   userId: userID,
		   username: userName,

		
		},
		type: 'post',
		success: function(output) {
			alert(output);
		}
	});
}
