<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AcoMaster[]|\Cake\Collection\CollectionInterface $acoMasters
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Aco Master'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="acoMasters index large-9 medium-8 columns content">
    <h3><?= __('Aco Masters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aco_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aco_description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sort_order') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('glyphicon') ?></th>
                <th scope="col"><?= $this->Paginator->sort('controller') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($acoMasters as $acoMaster): ?>
            <tr>
                <td><?= $this->Number->format($acoMaster->id) ?></td>
                <td><?= h($acoMaster->aco_title) ?></td>
                <td><?= h($acoMaster->aco_description) ?></td>
                <td><?= $acoMaster->has('parent_aco_master') ? $this->Html->link($acoMaster->parent_aco_master->id, ['controller' => 'AcoMasters', 'action' => 'view', $acoMaster->parent_aco_master->id]) : '' ?></td>
                <td><?= $this->Number->format($acoMaster->sort_order) ?></td>
                <td><?= $this->Number->format($acoMaster->menu_type) ?></td>
                <td><?= $this->Number->format($acoMaster->status) ?></td>
                <td><?= h($acoMaster->glyphicon) ?></td>
                <td><?= h($acoMaster->controller) ?></td>
                <td><?= h($acoMaster->action) ?></td>
                <td><?= $this->Number->format($acoMaster->type) ?></td>
                <td><?= h($acoMaster->modified) ?></td>
                <td><?= h($acoMaster->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $acoMaster->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $acoMaster->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $acoMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acoMaster->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
