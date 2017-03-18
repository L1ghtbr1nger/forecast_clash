<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Admin Event'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'HistoricalForecasts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'HistoricalForecasts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="adminEvents index large-9 medium-8 columns content">
    <h3><?= __('Admin Events') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('multiplier') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adminEvents as $adminEvent): ?>
            <tr>
                <td><?= $this->Number->format($adminEvent->id) ?></td>
                <td><?= h($adminEvent->start_date) ?></td>
                <td><?= h($adminEvent->end_date) ?></td>
                <td><?= $this->Number->format($adminEvent->multiplier) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $adminEvent->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $adminEvent->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $adminEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminEvent->id)]) ?>
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
