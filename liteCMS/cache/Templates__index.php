<!DOCTYPE html>
<html>
    <head>
        <title>
<?php echo $title ?>
</title>
        <link rel = "stylesheet" href = "static/css/theme.css">
    </head>
    <body>
        <section>
        </section id = "head">

        <section id = "content">
        </section>

        <section id = "foot">
        </section>



        
<h1>This is what I did</h1>

<?php foreach ($colors as $color): ?>
<h2><?php echo $color ?></h2>
<?php endforeach; ?>

<a href = "download.php?item=song1.mp3">Download Song</a>


    </body>
</html>



