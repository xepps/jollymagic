<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alan Jolly's Jollymagic.com</title>
    <link rel="stylesheet" type="text/css" href="/static/css/main.css">
</head>
<body>

    <div class="page-background">
        <div class="page-overlay">
        </div>
    </div>

    <button class="menu_button menu_open">
        <span class="menu_text menu_open_text">☰</span>
        <span class="menu_text menu_close_text">X</span>
    </button>

    <nav class="nav_closed">
        <ul>
            <li>
                <a>Mr Jolly</a>
            </li>
            <li>
                <a>Safeguarding Children</a>
            </li>
            <li>
                <a>Close up Magic</a>
            </li>
            <li>
                <a>Balloon Modelling</a>
            </li>
            <li>
                <a>Casino Nights</a>
            </li>
            <li>
                <a>Booking Form</a>
            </li>
        </ul>
    </nav>

    <header>
        <img src="<?= $baseUrl ?>/image/mr_jolly.png">
    </header>

    <main>
        <h2 class="page-title">Hi, I'm Alan Jolly!</h2>
        <p>I have entertained children for over 25 years and I perform fun and colourful puppet and magic shows for children of all ages.</p>
        <p>I work hard to ensure the whole family is entertained. I can also provide party games with music and prizes.</p>
        <p>Please be assured I pass an annual P.N.C (Police National Computer) check, have all my electrical equipment P.A.T tested each year and hold extensive Public Liability Insurance for your peace of mind.</p>
    </main>

    <script src="/static/js/require.js"></script>
    <script src="/static/js/controller.js"></script>

    <script>
        require(["jollymagic/controller"], function(Controller) {
            var controller = new Controller(document);
            controller.init();
        });
    </script>

</body>
</html>
