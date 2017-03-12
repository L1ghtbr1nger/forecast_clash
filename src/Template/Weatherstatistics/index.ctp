<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Weatherstatistic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'Weatherevents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'Weatherevents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="weatherstatistics index large-9 medium-8 columns content">
    <h3><?= __('Weatherstatistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weather_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attempts') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_attempts') ?></th>
                <th scope="col"><?= $this->Paginator->sort('radius') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forecast_length') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($weatherstatistics as $weatherstatistic): ?>
            <tr>
                <td><?= $this->Number->format($weatherstatistic->id) ?></td>
                <td><?= $weatherstatistic->has('user') ? $this->Html->link($weatherstatistic->user->id, ['controller' => 'Users', 'action' => 'view', $weatherstatistic->user->id]) : '' ?></td>
                <td><?= $weatherstatistic->has('weather_event') ? $this->Html->link($weatherstatistic->weather_event->id, ['controller' => 'Weatherevents', 'action' => 'view', $weatherstatistic->weather_event->id]) : '' ?></td>
                <td><?= $this->Number->format($weatherstatistic->attempts) ?></td>
                <td><?= $this->Number->format($weatherstatistic->valid_attempts) ?></td>
                <td><?= $this->Number->format($weatherstatistic->radius) ?></td>
                <td><?= $this->Number->format($weatherstatistic->forecast_length) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $weatherstatistic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $weatherstatistic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $weatherstatistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherstatistic->id)]) ?>
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
