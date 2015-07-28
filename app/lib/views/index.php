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

    <nav class="nav_closed">
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
