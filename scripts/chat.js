function endLogOn(){
  window.location.replace("../index.html");
}


function hideChat(){
  var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

  if (w<425.1){
    if (document.getElementById('mainChatBox').style.display = "block" ) {
      document.getElementById('mainChatBox').style.display = "none";
      document.getElementById('header').style.display = "block";
      document.getElementById('chatSelectBox').style.display = "block";
    }

  } else {
    if (document.getElementById('mainChatBox').style.display = "block" ) {
      document.getElementById('chatSelectBox').style.display = "block";
    }
  }


}

function showChat(){

  var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

  if (w < 425.1){
    if (document.getElementById('mainChatBox').style.display = "none" ) {
      document.getElementById('mainChatBox').style.display = "block";
      document.getElementById('chatSelectBox').style.display = "none";
    }

  }
  else {
    if (document.getElementById('chatSelectBox').style.display = "block") {
      document.getElementById('mainChatBox').style.display = "block";
    }
  }

}
