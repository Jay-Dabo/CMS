<!DOCTYPE html>
<html>
    <head>
        <title>Bootstrap 101 Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <?php print Asset::css($basecss); ?>
        <?php print Asset::css($css); ?>
    </head>
    <body>
        
        <?php print $content; ?>
        
        <!-- Base Javascript -->
        <?php print Asset::js($basejs); ?>
        <?php print Asset::js($js); ?>
    </body>
</html>