var SocialMedia = {
    FB_APP_ID: '1667512626834805',
    FB_Scope: 'email,public_profile',
    webLoginDlgId: 'login-dialog',
    currentUrl: window.location.href,
    init: function (){
        this._fb_init();
    },
    _fb_init: function (){
        var _this = this;
        window.fbAsyncInit = function() {
            FB.init({
              appId      : _this.FB_APP_ID,
              cookie     : true,
              xfbml      : true,
              version    : 'v2.5'
            });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    },
    setFB_ID: function (id){
        this.FB_APP_ID = id;
    },
    setFB_Socpe: function (scope){
        this.FB_Scope = scope;
    },
    fbLogin: function (response){
        var _this = this;
        FB.login( function (response){
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                console.log('User is loggedin into facebook and app. Store user data');
                _this.fbGetMe(true);
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                console.log('Not logged into facebook or app. Should redirect to normal login page');
                _this.fbLoginFailed();
            }
        }, {scope: _this.FB_Scope});
    },
    fbGetLoginStatus: function (){
        var _this = this;
        FB.getLoginStatus(function(response) {
            _this.fbStatusChangeCallback(response);
        });
    },
    fbStatusChangeCallback: function(response){
        var _this = this;
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            _this.closeLoginOptDialog();
            _this.fbGetMe(true);
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            //document.getElementById('status').innerHTML = 'Please log into Facebook.';
            console.log('Please log into Facebook. Opening FB login dialog');
            _this.closeLoginOptDialog();
            console.log('Close internal login dialog options');
            _this.fbLogin(response);
        }
    },
    fbGetMe: function (save){
        var _this = this;
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
            if (save === true){
                _this.fbRedirectSaveUser(response);
            }
        });
    },
    fbRedirectSaveUser: function (response){
        console.log(JSON.stringify(response));
    },
    fbLoginFailed: function (){
        console.log('Login failed');
    },
    fbShare: function (link){
        FB.ui({
          method: 'share',
          href: link
        }, function(response){}); 
    },
    twShare: function(url,text){
        var tw_window = window.open('https://twitter.com/intent/tweet?url='+url+'&text='+text,'Twitter-Web-Intent');
        tw_window.focus();
    },
    closeLoginOptDialog: function(){
        $('#'+_this.webLoginDlgId).modal('hide');
    }
};

function facebookShare(url){
    SocialMedia.fbShare(url);
}
function twitterShare(url,text){
    SocialMedia.twShare(url,text);
}

function facebookLogin(){
    SocialMedia.fbGetLoginStatus();
}

SocialMedia.init();