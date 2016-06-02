<?php /*** @var \Electrode\VS\VS $this */ ?>
<?php $this->inherited(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'layout.php') ?>


<?php $this->section('title') ?>Index<?php $this->endSection('title') ?>

<?php $this->section('body') ?>
Hello <?= $this->parameters['name'] ?>
<?php $this->endSection('body') ?>

<?php $this->section('footer') ?>
Le footer
<?php $this->endSection('footer') ?>
