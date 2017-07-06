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
                ['action' => 'delete', $acoMaster->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $acoMaster->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Aco Masters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Aco Masters'), ['controller' => 'AcoMasters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Aco Master'), ['controller' => 'AcoMasters', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acoMasters form large-9 medium-8 columns content">
    <?= $this->Form->create($acoMaster) ?>
    <fieldset>
        <legend><?= __('Edit Aco Master') ?></legend>
        <?php
            echo $this->Form->control('aco_title');
            echo $this->Form->control('aco_description');
            echo $this->Form->control('parent_id', ['options' => $parentAcoMasters]);
            echo $this->Form->control('sort_order');
            echo $this->Form->control('menu_type');
            echo $this->Form->control('status');
            echo $this->Form->control('glyphicon');
            echo $this->Form->control('controller');
            echo $this->Form->control('action');
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
