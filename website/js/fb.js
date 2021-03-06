var accessToken = "null";
var userData;

window.fbAsyncInit = function() {
	FB.init({
		appId      : '224587191222975',
		xfbml      : true,
		version    : 'v2.5'
	});
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function login()
{
	FB.login(function(response)
	{
		if(response.status === 'connected')
		{
			console.log('Connected');
			accessToken = response.authResponse.accessToken;
			FB.api('/me', function(response) 
			{
				userData = response;
				FB.api(('/me/?fields=picture&type=large'), function(response) {
					userData.picture = response.picture.data.url;
					console.log(response);
					//document.getElementById('profile_picture').innerHTML = '<img src="' + response.picture.data.url +'"></img>';
				});

				dbLogin(userData.name,userData.id,userData.picture);
			});
		}
		else if (response.status === 'not_authorized')
		{
			console.log('Not Connected');
		}
		else
		{
			console.log('Not Connected!');
		}
	})
}

function FB_Logout(){
	$.ajax({
		url: 'logout.php',
		data: {},
		type: 'GET',
		success: function(output) {
			FB.logout(function(response){
			
			});
			window.location.href = "index.php";
		},
		failure: function(output) {
			FB.logout(function(response){
			
			});
			window.location.href = "index.php";
		}
	});
}
