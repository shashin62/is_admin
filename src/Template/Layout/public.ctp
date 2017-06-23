<!DOCTYPE html>
<html lang="en">

    <head>
        <?= $this->element('Public/header') ?>
        <title><?= $title ?></title>
    </head>

    <body class="login-container">
        <!-- ================================================
        Scripts
        ================================================ -->
        <?= $this->element('Public/scripts') ?>

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>


        <?= $this->element('Public/footer') ?>
    </body>

</html>