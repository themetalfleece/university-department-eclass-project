<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('fa/css/font-awesome.min') ?>

    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <title>
        <?php $this->Title->set(__('Πρόβλημα')); ?>
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->fetch('topScript') ?>
</head>
<body>
    <div id="container" style="margin-top: 10%">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>