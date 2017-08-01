<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Demo: The Easiest Way To Show Browser Notifications</title>

    <link rel="manifest" href="/manifest.json">

    <style>
        body {
            font-family: sans-serif;
            color: #333435;
            line-height: 1.5;
            text-align: center;
            padding: 50px;
        }
        h1 {
            max-width: 400px;
            line-height: 1.4;
            margin: 0 auto 40px;
            text-align: center;
            color: #21629b;
            font-size: 29px;
        }
        p {
            font-size: 16px;
            margin: 15px auto;
            text-align: center;
            max-width: 430px;
        }
        a, a:visited, a:hover {
            text-decoration: none;
            color: #267ac3;
        }
        #demo-btn {
            padding: 18px;
            color: #fff;
            background-color: #1E88E5;
            outline: 0;
            border: 0;
            font-size: 16px;
            text-transform: uppercase;
            cursor: pointer;
            opacity: 0.9;
            border-radius: 4px;
            margin: 45px auto;
            display: block;
            font-weight: bold;
        }
        #demo-btn:hover {
            opacity: 1;
        }
        p.footer {
            color: #889098;
            font-size: 15px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>The Easiest Way To Show Browser Notifications</h1>
        <p>This simple demo aims to show you the easiest possible way to display web notifications using <a href="https://github.com/Nickersoft/push.js" target="_blank">Push.js</a>.</p>

        <button id="demo-btn">Show notification</button>

        <p class="footer">To read the full article go to <a href="http://tutorialzine.com/2017/01/the-easiest-way-to-show-browser-notifications">tutorialzine.com</a></p>
        <p class="footer">The source code for this demo is available on <a href="https://github.com/tutorialzine/web-notifications-demo">GitHub</a></p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
    <script>

        Push.Permission.request();

        document.getElementById('demo-btn').onclick = function () {
            Push.create('Hi there!', {
                body: 'This is a notification.',
                icon: 'icon.png',
                timeout: 8000,                  // Timeout before notification closes automatically.
                vibrate: [100, 100, 100],       // An array of vibration pulses for mobile devices.
                onClick: function() {
                    // Callback for when the notification is clicked.
                    console.log(this);
                }
            });
        };

    </script>

</body>

</html>
