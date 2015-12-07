(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function share_fb(link){

    FB.ui({
      method: 'share',
      href: link
    }, function(response){}); 

    return false;
}
function share_tw(encoded_url,text){
    var tw_window = window.open('https://twitter.com/intent/tweet?url='+encoded_url+'&text='+text,'Twitter-Web-Intent');
    tw_window.focus();
}