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
                ['action' => 'delete', $emailTemplate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $emailTemplate->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Email Templates'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="emailTemplates form large-9 medium-8 columns content">
    <?= $this->Form->create($emailTemplate) ?>
    <fieldset>
        <legend><?= __('Edit Email Template') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('content');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
