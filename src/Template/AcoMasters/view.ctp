<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\AcoMaster $acoMaster
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Aco Master'), ['action' => 'edit', $acoMaster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Aco Master'), ['action' => 'delete', $acoMaster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $acoMaster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Aco Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Aco Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Aco Masters'), ['controller' => 'AcoMasters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Aco Master'), ['controller' => 'AcoMasters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="acoMasters view large-9 medium-8 columns content">
    <h3><?= h($acoMaster->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Aco Title') ?></th>
            <td><?= h($acoMaster->aco_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Aco Description') ?></th>
            <td><?= h($acoMaster->aco_description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Aco Master') ?></th>
            <td><?= $acoMaster->has('parent_aco_master') ? $this->Html->link($acoMaster->parent_aco_master->id, ['controller' => 'AcoMasters', 'action' => 'view', $acoMaster->parent_aco_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Glyphicon') ?></th>
            <td><?= h($acoMaster->glyphicon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Controller') ?></th>
            <td><?= h($acoMaster->controller) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= h($acoMaster->action) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($acoMaster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($acoMaster->sort_order) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu Type') ?></th>
            <td><?= $this->Number->format($acoMaster->menu_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($acoMaster->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $this->Number->format($acoMaster->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($acoMaster->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($acoMaster->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Aco Masters') ?></h4>
        <?php if (!empty($acoMaster->child_aco_masters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Aco Title') ?></th>
                <th scope="col"><?= __('Aco Description') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Sort Order') ?></th>
                <th scope="col"><?= __('Menu Type') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Glyphicon') ?></th>
                <th scope="col"><?= __('Controller') ?></th>
                <th scope="col"><?= __('Action') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($acoMaster->child_aco_masters as $childAcoMasters): ?>
            <tr>
                <td><?= h($childAcoMasters->id) ?></td>
                <td><?= h($childAcoMasters->aco_title) ?></td>
                <td><?= h($childAcoMasters->aco_description) ?></td>
                <td><?= h($childAcoMasters->parent_id) ?></td>
                <td><?= h($childAcoMasters->sort_order) ?></td>
                <td><?= h($childAcoMasters->menu_type) ?></td>
                <td><?= h($childAcoMasters->status) ?></td>
                <td><?= h($childAcoMasters->glyphicon) ?></td>
                <td><?= h($childAcoMasters->controller) ?></td>
                <td><?= h($childAcoMasters->action) ?></td>
                <td><?= h($childAcoMasters->type) ?></td>
                <td><?= h($childAcoMasters->modified) ?></td>
                <td><?= h($childAcoMasters->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AcoMasters', 'action' => 'view', $childAcoMasters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AcoMasters', 'action' => 'edit', $childAcoMasters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AcoMasters', 'action' => 'delete', $childAcoMasters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childAcoMasters->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
