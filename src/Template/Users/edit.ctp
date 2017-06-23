<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('address');
            echo $this->Form->control('password');
            echo $this->Form->control('firstname');
            echo $this->Form->control('formername');
            echo $this->Form->control('lastname');
            echo $this->Form->control('headline');
            echo $this->Form->control('industry');
            echo $this->Form->control('summary');
            echo $this->Form->control('photo');
            echo $this->Form->control('group_id');
            echo $this->Form->control('is_deleted');
            echo $this->Form->control('is_admin_panel');
            echo $this->Form->control('forgot_token');
            echo $this->Form->control('access_token');
            echo $this->Form->control('last_login');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
