<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alan Jolly's Jollymagic.com</title>
    <link rel="stylesheet" type="text/css" href="/static/css/main.css">
</head>
<body>

    <div class="page-background" style="background-image: url('<?= $baseUrl.'/image/'.$content->backgroundImage ?>');">
        <div class="page-overlay">
        </div>
    </div>

    <button class="menu_button menu_open">
        <span class="menu_text menu_open_text">☰</span>
        <span class="menu_text menu_close_text">X</span>
    </button>

    <nav>
        <ul>
            <? foreach ($nav as $navItem): ?>
            <li>
                <a href="<?= $baseUrl.$navItem->url ?>"><?= $navItem->title ?></a>
            </li>
            <? endforeach; ?>
        </ul>
    </nav>

    <header>
        <img src="<?= $baseUrl ?>/image/mr_jolly.png">
    </header>

    <main>
        <h2 class="page-title"><?= $content->title ?></h2>
        <?= $content->body ?>
        <? foreach($content->components as $component): ?>
        <?= $component ?>
        <? endforeach; ?>
    </main>

    <footer>
        <p><span>Email Me: </span><a href="mailto:<?= $footer->email ?>"><?= $footer->email?></a></p>
        <p><span>Write To Me: </span><?= implode(" ● ", $footer->address) ?></p>
        <p><span>Call Me: </span>
            <?= trim(
                array_reduce(
                    $footer->telephone,
                    function($carry, $number){
                        return $carry . '<a href="tel:' . str_replace(' ', '', $number) . '">' . $number . '</a> ● ';
                    },
                    ''
                ),
                " ● "
            ) ?></p>
    </footer>

    <script src="/static/js/require.js"></script>
    <script src="/static/js/controller.js"></script>

    <script>
        require(["jollymagic/controller"], function(Controller) {
            var controller = new Controller(document);
            controller.init();
        });
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-67234756-1', 'auto');
        ga('send', 'pageview');

    </script>

</body>
</html>
