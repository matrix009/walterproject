<?php
include_once 'ViewDescriptor.php';

if(!$vd->isJson())
{
    ?>
    <!DOCTYPE html>

    <html>

        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
            <title><?= $vd->getTitolo() ?></title>
            <meta name="keywords" content="Progetto AMM"/>
            <meta name="description" content="Sito per l'acquisto di hardware"/>
            <link href="../css/index.css" rel="stylesheet" type="text/css" media="screen"/>
            <link href="../css/login.css" rel="stylesheet" type="text/css" media="screen"/>
            <?php
            foreach ($vd->getScripts() as $script) 
            {
                ?>
                <script type="text/javascript" src="<?= $script ?>"></script> 
                <?php
            }
            ?>
        </head>

        <body>
            <div id="page">
                <header>
                    <div id="header">
                        <div id="menu_logo">
                            <?php
                                $menu_logo = $vd->getMenuLogoFile();
                                require "$menu_logo";
                            ?>
                        </div>
                    </div>
                </header>

                <!-- Colonna destra e sinistra -->
                <div id="colonna_s">
                    <?php
                        $colonna_s = $vd->getColonnaSFile();
                        require "$colonna_s";
                    ?>
                </div>

                <div id="colonna_d">
                    <?php
                        $colonna_d = $vd->getColonnaDFile();
                        require "$colonna_d";
                    ?>
                </div>
                <!-- Fine Colonna destra e sinistra -->

                <content>
                    <div id="content">
                            <?php
                                $box_login = $vd->getContentFile();
                                require "$box_login";
                            ?>
                    </div>
                </content>

                <div class="clear">
                </div>

                <footer>
                    <div id="footer">
                        <?php
                            $footer = $vd->getFooterFile();
                            require "$footer";
                        ?>
                    </div>
                </footer>
            </div>
        </body>

    </html>
    <?php
}
else 
{
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Corrent-type: application/json');
    
    $content = $vd->geContentFile();
    require "$content";
}
?>