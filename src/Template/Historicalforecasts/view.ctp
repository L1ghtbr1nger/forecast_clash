<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Historical Forecast'), ['action' => 'edit', $historicalForecast->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Historical Forecast'), ['action' => 'delete', $historicalForecast->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalForecast->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'WeatherEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'WeatherEvents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Admin Events'), ['controller' => 'AdminEvents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin Event'), ['controller' => 'AdminEvents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="historicalForecasts view large-9 medium-8 columns content">
    <h3><?= h($historicalForecast->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $historicalForecast->has('user') ? $this->Html->link($historicalForecast->user->id, ['controller' => 'Users', 'action' => 'view', $historicalForecast->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weather Event') ?></th>
            <td><?= $historicalForecast->has('weather_event') ? $this->Html->link($historicalForecast->weather_event->id, ['controller' => 'WeatherEvents', 'action' => 'view', $historicalForecast->weather_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Event') ?></th>
            <td><?= $historicalForecast->has('admin_event') ? $this->Html->link($historicalForecast->admin_event->id, ['controller' => 'AdminEvents', 'action' => 'view', $historicalForecast->admin_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($historicalForecast->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($historicalForecast->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($historicalForecast->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Radius') ?></th>
            <td><?= $this->Number->format($historicalForecast->radius) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Length') ?></th>
            <td><?= $this->Number->format($historicalForecast->forecast_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Date') ?></th>
            <td><?= h($historicalForecast->forecast_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Am Pm') ?></th>
            <td><?= $historicalForecast->am_pm ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correct') ?></th>
            <td><?= $historicalForecast->correct ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
