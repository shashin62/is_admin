<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\EmailHashtag $emailHashtag
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Email Hashtag'), ['action' => 'edit', $emailHashtag->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Email Hashtag'), ['action' => 'delete', $emailHashtag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $emailHashtag->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Email Hashtags'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Email Hashtag'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="emailHashtags view large-9 medium-8 columns content">
    <h3><?= h($emailHashtag->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tag') ?></th>
            <td><?= h($emailHashtag->tag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($emailHashtag->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($emailHashtag->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($emailHashtag->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($emailHashtag->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($emailHashtag->created) ?></td>
        </tr>
    </table>
</div>
