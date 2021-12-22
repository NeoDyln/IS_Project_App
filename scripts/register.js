function showRegPage(){

      document.getElementById('registration').style.display = "block";
      hideCheck();
}

function hideCheck(){
  document.getElementById('uniChecker').style.display = "none";
}


function showteamPage(){

    document.getElementById('uniChecker').style.display = "block";
    hideReg();
}

function hideReg(){
  document.getElementById('registration').style.display = "none";
}
