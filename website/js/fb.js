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
			//document.getElementById('status').innerHTML = 'Connected';
			accessToken = response.authResponse.accessToken;
			FB.api('/me', function(response) 
			{
				userData = response;
				//document.getElementById('token').innerHTML = JSON.stringify(userData, null, 4);
				FB.api(('/me/' + userData.id + '?fields=cover'), function(response) {
					userCover = response.cover;
					document.createElement('img').appendChild += JSON.stringify(userCover, null, 4);
				});
				dbLogin(userData.name,userData.id);
			});
		}
		else if (response.status === 'not_authorized')
		{
			document.getElementById('status').innerHTML = 'not connected';
		}
		else
		{
			document.getElementById('status').innerHTML = 'not connected at all';
		}
	})
}
