<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->element('header') ?>
        <title><?php echo isset($title) === true ? $title : "Is Admin"; ?></title>
    </head>
    <body>
        <?= $this->element('scripts') ?>

        <!-- Main navbar -->
        <?= $this->element('navbar_main') ?>
        <!-- /main navbar -->

        <!-- Second navbar -->
        <?= $this->element('navbar_sub') ?>
        <!-- /second navbar -->

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>

        <!-- Footer -->
        <?= $this->element('footer') ?>
        <!-- /footer -->
    </body>
</html>
