<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Statistic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statistics index large-9 medium-8 columns content">
    <h3><?= __('Statistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('current_streak') ?></th>
                <th scope="col"><?= $this->Paginator->sort('highest_streak') ?></th>
                <th scope="col"><?= $this->Paginator->sort('states_visited') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statistics as $statistic): ?>
            <tr>
                <td><?= $this->Number->format($statistic->id) ?></td>
                <td><?= $statistic->has('user') ? $this->Html->link($statistic->user->id, ['controller' => 'Users', 'action' => 'view', $statistic->user->id]) : '' ?></td>
                <td><?= $this->Number->format($statistic->current_streak) ?></td>
                <td><?= $this->Number->format($statistic->highest_streak) ?></td>
                <td><?= $this->Number->format($statistic->states_visited) ?></td>
                <td><?= h($statistic->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $statistic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $statistic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $statistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statistic->id)]) ?>
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
