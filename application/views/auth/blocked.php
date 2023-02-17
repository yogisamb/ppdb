<!--
=========================================================
* System Develop By Yogisamb - v1.0.1
=========================================================

* Copyright 2022 Solo Bersimfoni (Sekolah Adipangastuti)
* Licensed under MIT

* Coded by "GAGE Design" (https://www.gagedesign.id)

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sekolah Adi Pangastuti</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="<?= base_url('assets/'); ?>images/logosolobersimfoni.png" />
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/blocked/') ?>css/style.css">
</head>

<body>
    <div id="container" class="container">
        <ul id="scene" class="scene">
            <li class="layer" data-depth="1.00"><img src="<?= base_url('assets/blocked/') ?>images/404-01.png"></li>
            <li class="layer" data-depth="0.60"><img src="<?= base_url('assets/blocked/') ?>images/shadows-01.png"></li>
            <li class="layer" data-depth="0.20"><img src="<?= base_url('assets/blocked/') ?>images/monster-01.png"></li>
            <li class="layer" data-depth="0.40"><img src="<?= base_url('assets/blocked/') ?>images/text-01.png"></li>
            <li class="layer" data-depth="0.10"><img src="<?= base_url('assets/blocked/') ?>images/monster-eyes-01.png"></li>
        </ul>
        <h1>Your access are Bocked!</h1>
        <a href="<?= base_url() ?>" class="btn">Back to home</a>
    </div>
    <!-- Scripts -->
    <script src="<?= base_url('assets/blocked/') ?>js\parallax.js"></script>
    <script>
        // Pretty simple huh?
        var scene = document.getElementById('scene');
        var parallax = new Parallax(scene);
    </script>

</body>

</html>