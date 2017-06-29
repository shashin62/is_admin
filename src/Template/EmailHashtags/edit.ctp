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
                ['action' => 'delete', $emailHashtag->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $emailHashtag->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Email Hashtags'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="emailHashtags form large-9 medium-8 columns content">
    <?= $this->Form->create($emailHashtag) ?>
    <fieldset>
        <legend><?= __('Edit Email Hashtag') ?></legend>
        <?php
            echo $this->Form->control('tag');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
