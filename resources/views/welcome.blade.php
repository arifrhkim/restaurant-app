<!DOCTYPE html>
<html>
<head>
  <title>Restaurant-app</title>
  <link rel="manifest" href="/manifest.json">
</head>
<body>

<a href="#" onclick="myFunction()">tes</a>

<script src="https://www.gstatic.com/firebasejs/4.1.5/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCt46FNfV-FXAiJPRzIGUMAPoJCSwRPFrU",
    authDomain: "restaurant-748ae.firebaseapp.com",
    databaseURL: "https://restaurant-748ae.firebaseio.com",
    projectId: "restaurant-748ae",
    storageBucket: "restaurant-748ae.appspot.com",
    messagingSenderId: "248503638694"
  };
  firebase.initializeApp(config);

  const messaging = firebase.messaging();

  messaging.requestPermission()
  .then(function() {
    console.log('Notification permission granted.');
    return messaging.getToken();
  })
  .then(function(token){
    console.log(token);
  })
  .catch(function(err) {
    console.log('Unable to get permission to notify.', err);
  });

  messaging.onMessage(function(payload) {
    console.log('onMessage: ', payload)
  });

</script>

</body>
</html>
