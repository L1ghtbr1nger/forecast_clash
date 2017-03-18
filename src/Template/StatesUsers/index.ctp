<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New States User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statesUsers index large-9 medium-8 columns content">
    <h3><?= __('States Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statesUsers as $statesUser): ?>
            <tr>
                <td><?= $this->Number->format($statesUser->id) ?></td>
                <td><?= $statesUser->has('user') ? $this->Html->link($statesUser->user->id, ['controller' => 'Users', 'action' => 'view', $statesUser->user->id]) : '' ?></td>
                <td><?= $statesUser->has('state') ? $this->Html->link($statesUser->state->id, ['controller' => 'States', 'action' => 'view', $statesUser->state->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $statesUser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $statesUser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $statesUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statesUser->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
