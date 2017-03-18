<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Weather Event'), ['action' => 'edit', $weatherEvent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Weather Event'), ['action' => 'delete', $weatherEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherEvent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Weather Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forecasts'), ['controller' => 'Forecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forecast'), ['controller' => 'Forecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'HistoricalForecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'HistoricalForecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['controller' => 'WeatherStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['controller' => 'WeatherStatistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="weatherEvents view large-9 medium-8 columns content">
    <h3><?= h($weatherEvent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Weather') ?></th>
            <td><?= h($weatherEvent->weather) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($weatherEvent->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Forecasts') ?></h4>
        <?php if (!empty($weatherEvent->forecasts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Weather Event Id') ?></th>
                <th scope="col"><?= __('Submit Date') ?></th>
                <th scope="col"><?= __('Forecast Date') ?></th>
                <th scope="col"><?= __('Am Pm') ?></th>
                <th scope="col"><?= __('Radius') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($weatherEvent->forecasts as $forecasts): ?>
            <tr>
                <td><?= h($forecasts->id) ?></td>
                <td><?= h($forecasts->user_id) ?></td>
                <td><?= h($forecasts->weather_event_id) ?></td>
                <td><?= h($forecasts->submit_date) ?></td>
                <td><?= h($forecasts->forecast_date) ?></td>
                <td><?= h($forecasts->am_pm) ?></td>
                <td><?= h($forecasts->radius) ?></td>
                <td><?= h($forecasts->latitude) ?></td>
                <td><?= h($forecasts->longitude) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Forecasts', 'action' => 'view', $forecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Forecasts', 'action' => 'edit', $forecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Forecasts', 'action' => 'delete', $forecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Historical Forecasts') ?></h4>
        <?php if (!empty($weatherEvent->historical_forecasts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('Radius') ?></th>
                <th scope="col"><?= __('Weather Event Id') ?></th>
                <th scope="col"><?= __('Forecast Date') ?></th>
                <th scope="col"><?= __('Am Pm') ?></th>
                <th scope="col"><?= __('Forecast Length') ?></th>
                <th scope="col"><?= __('Admin Event Id') ?></th>
                <th scope="col"><?= __('Correct') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($weatherEvent->historical_forecasts as $historicalForecasts): ?>
            <tr>
                <td><?= h($historicalForecasts->id) ?></td>
                <td><?= h($historicalForecasts->user_id) ?></td>
                <td><?= h($historicalForecasts->latitude) ?></td>
                <td><?= h($historicalForecasts->longitude) ?></td>
                <td><?= h($historicalForecasts->radius) ?></td>
                <td><?= h($historicalForecasts->weather_event_id) ?></td>
                <td><?= h($historicalForecasts->forecast_date) ?></td>
                <td><?= h($historicalForecasts->am_pm) ?></td>
                <td><?= h($historicalForecasts->forecast_length) ?></td>
                <td><?= h($historicalForecasts->admin_event_id) ?></td>
                <td><?= h($historicalForecasts->correct) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'HistoricalForecasts', 'action' => 'view', $historicalForecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HistoricalForecasts', 'action' => 'edit', $historicalForecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HistoricalForecasts', 'action' => 'delete', $historicalForecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalForecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Weather Statistics') ?></h4>
        <?php if (!empty($weatherEvent->weather_statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Weather Event Id') ?></th>
                <th scope="col"><?= __('Valid Attempts') ?></th>
                <th scope="col"><?= __('Attempts') ?></th>
                <th scope="col"><?= __('Radius') ?></th>
                <th scope="col"><?= __('Forecast Length') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($weatherEvent->weather_statistics as $weatherStatistics): ?>
            <tr>
                <td><?= h($weatherStatistics->id) ?></td>
                <td><?= h($weatherStatistics->user_id) ?></td>
                <td><?= h($weatherStatistics->weather_event_id) ?></td>
                <td><?= h($weatherStatistics->valid_attempts) ?></td>
                <td><?= h($weatherStatistics->attempts) ?></td>
                <td><?= h($weatherStatistics->radius) ?></td>
                <td><?= h($weatherStatistics->forecast_length) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WeatherStatistics', 'action' => 'view', $weatherStatistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WeatherStatistics', 'action' => 'edit', $weatherStatistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WeatherStatistics', 'action' => 'delete', $weatherStatistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherStatistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
