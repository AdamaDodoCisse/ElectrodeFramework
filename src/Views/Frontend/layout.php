<?php /*** @var \Electrode\VS\VS $this */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page - <?php $this->section('title') ?>accueil<?php $this->endSection('title') ?></title>
    <style>
        footer {
            color: white;
            background: black;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $this->section('body') ?><?php $this->endSection('body') ?>
        </div>
    </div>
</div>

<footer>
    <?php $this->section('footer') ?>
    <?php $this->endSection('footer') ?>
</footer>
</body>
</html>