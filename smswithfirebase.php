<!DOCTYPE html>
<html>
<head>

  <title>Firbase sms Test</title>
  <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/6.3.3/firebase-auth.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script type="text/javascript">
    function onSignInSubmit(argument) {
      //Just For Verifying
      console.log("Recaptcha Done");
    }
  </script>
</head>
<body>

<div id="recaptcha-container"></div>

<input type="text" id="fcode" placeholder="Enter code">
<button id="sign-in-button" class="sign-in-button">Submit Code</button>
<button id="fireSMS">Send Code</button>


<script type="text/javascript">

var firebaseConfig = {
    apiKey: "AIzaSyCwbHUcth4MmIjOvu9LKq18JlcdA_HSfY8",
    authDomain: "beyaside.firebaseapp.com",
    databaseURL: "https://beyaside.firebaseio.com",
    projectId: "beyaside",
    storageBucket: "beyaside.appspot.com",
    messagingSenderId: "543430902137",
    appId: "1:543430902137:web:fb113c4fec5e26fabdefa8",
    measurementId: "G-XJ9XL5TRWY"
  };

var defaultProject = firebase.initializeApp(firebaseConfig);

//Use invisible reCAPTCHA
window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
  'size': 'invisible',
  'callback': function(response) {
    // reCAPTCHA solved
  }
});

//Use the reCAPTCHA widget
//window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
// Pre-render the reCAPTCHA
//recaptchaVerifier.render().then(function(widgetId) {
//  window.recaptchaWidgetId = widgetId;
//});
//var recaptchaResponse = grecaptcha.getResponse(window.recaptchaWidgetId);

$(document).ready(function(){

  // Sending a verification code to the user's phone
  $("#fireSMS").click(function(){
    var phoneNumber = "+917383742776";
    var appVerifier = window.recaptchaVerifier;
    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        .then(function (confirmationResult) {
          // SMS sent. Prompt user to type the code from the message, then sign the
          // user in with confirmationResult.confirm(code).
          alert("Sent");
          window.confirmationResult = confirmationResult;
        }).catch(function (error) {
          // Error; SMS not sent
          alert("Not Sent");
        });  
  });

  //Verifying SMS Sent
  $("#sign-in-button").click(function(){
    //Sign in the user with the verification code
    var code = $("#fcode").val();
    confirmationResult.confirm(code).then(function (result) {
     var user = result.user;
     alert("Firebase 2FA Verification Done");
    }).catch(function (error) {
     // User couldn't sign in (bad verification code?)
     alert("Failed");
    });
  });


});


</script>
</body>
</html>