function logIn(){

  if (document.getElementById('Uni_Login_Form').style.display = "block") {
    document.getElementById('Uni_Reset_Form').style.display = "none";
    document.getElementById('Uni_Create_Form').style.display = "none";


  }
  else {
    document.getElementById('Uni_Login_Form').style.display = "none";
    document.getElementById('Uni_Reset_Form').style.display = "none";
    document.getElementById('Uni_Create_Form').style.display = "none";
  }

}

function signUp(){

  if (document.getElementById('Uni_Create_Form').style.display = "block") {
    document.getElementById('Uni_Reset_Form').style.display = "none";
    document.getElementById('Uni_Login_Form').style.display = "none";


  }
  else {
    document.getElementById('Uni_Login_Form').style.display = "none";
    document.getElementById('Uni_Reset_Form').style.display = "none";
    document.getElementById('Uni_Create_Form').style.display = "none";
  }

}

function resetPass(){

  if (document.getElementById('Uni_Reset_Form').style.display = "block") {
    document.getElementById('Uni_Login_Form').style.display = "none";
    document.getElementById('Uni_Create_Form').style.display = "none";


  }
  else {
    document.getElementById('Uni_Login_Form').style.display = "none";
    document.getElementById('Uni_Reset_Form').style.display = "none";
    document.getElementById('Uni_Create_Form').style.display = "none";
  }

}
