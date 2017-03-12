<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Forecast'), ['action' => 'edit', $forecast->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Forecast'), ['action' => 'delete', $forecast->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forecast->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Forecasts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forecast'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'Weatherevents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'Weatherevents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="forecasts view large-9 medium-8 columns content">
    <h3><?= h($forecast->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $forecast->has('user') ? $this->Html->link($forecast->user->id, ['controller' => 'Users', 'action' => 'view', $forecast->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weather Event') ?></th>
            <td><?= $forecast->has('weather_event') ? $this->Html->link($forecast->weather_event->id, ['controller' => 'Weatherevents', 'action' => 'view', $forecast->weather_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($forecast->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Radius') ?></th>
            <td><?= $this->Number->format($forecast->radius) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($forecast->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($forecast->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Submit Date') ?></th>
            <td><?= h($forecast->submit_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Date') ?></th>
            <td><?= h($forecast->forecast_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Am Pm') ?></th>
            <td><?= $forecast->am_pm ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
