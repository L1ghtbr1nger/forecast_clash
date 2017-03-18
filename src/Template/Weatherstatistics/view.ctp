<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Weather Statistic'), ['action' => 'edit', $weatherStatistic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Weather Statistic'), ['action' => 'delete', $weatherStatistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherStatistic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'WeatherEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'WeatherEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="weatherStatistics view large-9 medium-8 columns content">
    <h3><?= h($weatherStatistic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $weatherStatistic->has('user') ? $this->Html->link($weatherStatistic->user->id, ['controller' => 'Users', 'action' => 'view', $weatherStatistic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weather Event') ?></th>
            <td><?= $weatherStatistic->has('weather_event') ? $this->Html->link($weatherStatistic->weather_event->id, ['controller' => 'WeatherEvents', 'action' => 'view', $weatherStatistic->weather_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($weatherStatistic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid Attempts') ?></th>
            <td><?= $this->Number->format($weatherStatistic->valid_attempts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attempts') ?></th>
            <td><?= $this->Number->format($weatherStatistic->attempts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Radius') ?></th>
            <td><?= $this->Number->format($weatherStatistic->radius) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Length') ?></th>
            <td><?= $this->Number->format($weatherStatistic->forecast_length) ?></td>
        </tr>
    </table>
</div>
