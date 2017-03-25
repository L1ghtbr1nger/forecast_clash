<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'WeatherEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'WeatherEvents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Admin Events'), ['controller' => 'AdminEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Admin Event'), ['controller' => 'AdminEvents', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams Users'), ['controller' => 'TeamsUsers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teams User'), ['controller' => 'TeamsUsers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="historicalForecasts index large-9 medium-8 columns content">
    <h3><?= __('Historical Forecasts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('radius') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weather_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forecast_date_start') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forecast_date_end') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forecast_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('admin_event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('correct') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historicalForecasts as $historicalForecast): ?>
            <tr>
                <td><?= $this->Number->format($historicalForecast->id) ?></td>
                <td><?= $historicalForecast->has('user') ? $this->Html->link($historicalForecast->user->id, ['controller' => 'Users', 'action' => 'view', $historicalForecast->user->id]) : '' ?></td>
                <td><?= $this->Number->format($historicalForecast->latitude) ?></td>
                <td><?= $this->Number->format($historicalForecast->longitude) ?></td>
                <td><?= $this->Number->format($historicalForecast->radius) ?></td>
                <td><?= $historicalForecast->has('weather_event') ? $this->Html->link($historicalForecast->weather_event->id, ['controller' => 'WeatherEvents', 'action' => 'view', $historicalForecast->weather_event->id]) : '' ?></td>
                <td><?= h($historicalForecast->forecast_date_start) ?></td>
                <td><?= h($historicalForecast->forecast_date_end) ?></td>
                <td><?= $this->Number->format($historicalForecast->forecast_length) ?></td>
                <td><?= $historicalForecast->has('admin_event') ? $this->Html->link($historicalForecast->admin_event->id, ['controller' => 'AdminEvents', 'action' => 'view', $historicalForecast->admin_event->id]) : '' ?></td>
                <td><?= h($historicalForecast->correct) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $historicalForecast->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $historicalForecast->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $historicalForecast->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalForecast->id)]) ?>
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
