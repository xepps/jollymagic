<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $content->description ?>" />
    <title>Al Jolly's Jollymagic.com</title>
    <link rel="stylesheet" type="text/css" href="/static/css/main.css">
</head>
<body itemscope itemtype="http://schema.org/EntertainmentBusiness">

    <div class="page-background page-background--<?= strstr($content->backgroundImage, '.', true) ?>">
        <meta itemprop="photo" content="<?= $baseUrl.'/image/'.$content->backgroundImage ?>" />
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
        <img itemprop="logo" src="<?= $baseUrl ?>/image/mr_jolly.png" alt="Mr Jolly logo">
        <meta itemprop="name" content="Jollymagic" />
        <meta itemprop="description" content="<?= $content->description ?>" />
    </header>

    <main>
        <h1 class="page-title"><?= $content->title ?></h1>
        <?= $content->body ?>
        <? foreach($content->components as $component): ?>
        <?= $component ?>
        <? endforeach; ?>
    </main>

    <footer>
        <p><span>Like Me: </span><a href="https://www.facebook.com/jollymagic">facebook.com/jollymagic</a></p>
        <p><span>Email Me: </span><a class="email-address" itemprop="email"><?= $footer->email ?></a></p>
        <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span>Write To Me: </span>
            <?= implode(" ● ", $footer->address) ?>
            <meta itemprop="streetAddress" content="<?= $footer->address[1] ?>" />
            <meta itemprop="addressLocality" content="<?= $footer->address[2] ?>" />
            <meta itemprop="addressRegion" content="<?= $footer->address[3] ?>" />
            <meta itemprop="postalCode" content="<?= $footer->address[4] ?>" />
        </p>
        <meta itemprop="legalName" content="<?= $footer->address[0] ?>" />
        <p><span>Call Me: </span>
            <?= trim(
                array_reduce(
                    $footer->telephone,
                    function($carry, $number){
                        return $carry . '<a itemprop="telephone" href="tel:' . str_replace(' ', '', $number) . '">' . $number . '</a> ● ';
                    },
                    ''
                ),
                " ● "
            ) ?></p>
    </footer>

    <meta itemprop="paymentAccepted" content="cash, cheque, bank transfer" />

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
