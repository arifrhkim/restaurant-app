
<!DOCTYPE html>
<html class="full" lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Big Picture - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/app.css" rel="stylesheet">



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <a id="demo_button" href="#" class="btn btn-default">View Demo</a>

  <script type="text/javascript">
  function demo() {
    Push.create('Hello World!');
    // Push.create('Hello world!', {
    //     body: 'How\'s it hangin\'?',
    //     // icon: '/images/icon.png',
    //     link: '/#',
    //     timeout: 4000,
    //     onClick: function () {
    //         console.log("Fired!");
    //         window.focus();
    //         this.close();
    //     },
    //     vibrate: [200, 100, 200, 100, 200, 100, 200]
    // });
  }

  $(document).ready(function() {
    $("#demo_button").click(demo);
  });
  </script>

  <script src='https://www.gstatic.com/firebasejs/4.1.2/firebase-app.js' type="text/javascript"></script>

  <script src='https://www.gstatic.com/firebasejs/4.1.2/firebase-messaging.js' type="text/javascript"></script>

  <script src='/scripts/push.min.js' type="text/javascript"></script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="/js/app.js"></script>


</body>

</html>
