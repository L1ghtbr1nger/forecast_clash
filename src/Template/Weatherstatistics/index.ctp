<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'WeatherEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'WeatherEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="weatherStatistics index large-9 medium-8 columns content">
    <h3><?= __('Weather Statistics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weather_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid_attempts') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attempts') ?></th>
                <th scope="col"><?= $this->Paginator->sort('radius') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forecast_length') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($weatherStatistics as $weatherStatistic): ?>
            <tr>
                <td><?= $this->Number->format($weatherStatistic->id) ?></td>
                <td><?= $weatherStatistic->has('user') ? $this->Html->link($weatherStatistic->user->id, ['controller' => 'Users', 'action' => 'view', $weatherStatistic->user->id]) : '' ?></td>
                <td><?= $weatherStatistic->has('weather_event') ? $this->Html->link($weatherStatistic->weather_event->id, ['controller' => 'WeatherEvents', 'action' => 'view', $weatherStatistic->weather_event->id]) : '' ?></td>
                <td><?= $this->Number->format($weatherStatistic->valid_attempts) ?></td>
                <td><?= $this->Number->format($weatherStatistic->attempts) ?></td>
                <td><?= $this->Number->format($weatherStatistic->radius) ?></td>
                <td><?= $this->Number->format($weatherStatistic->forecast_length) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $weatherStatistic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $weatherStatistic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $weatherStatistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherStatistic->id)]) ?>
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
