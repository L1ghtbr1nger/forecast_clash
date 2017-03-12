<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Historicalforecast'), ['action' => 'edit', $historicalforecast->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Historicalforecast'), ['action' => 'delete', $historicalforecast->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalforecast->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Historicalforecasts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historicalforecast'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'Weatherevents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'Weatherevents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Admin Events'), ['controller' => 'Adminevents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin Event'), ['controller' => 'Adminevents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="historicalforecasts view large-9 medium-8 columns content">
    <h3><?= h($historicalforecast->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $historicalforecast->has('user') ? $this->Html->link($historicalforecast->user->id, ['controller' => 'Users', 'action' => 'view', $historicalforecast->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weather Event') ?></th>
            <td><?= $historicalforecast->has('weather_event') ? $this->Html->link($historicalforecast->weather_event->id, ['controller' => 'Weatherevents', 'action' => 'view', $historicalforecast->weather_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Admin Event') ?></th>
            <td><?= $historicalforecast->has('admin_event') ? $this->Html->link($historicalforecast->admin_event->id, ['controller' => 'Adminevents', 'action' => 'view', $historicalforecast->admin_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($historicalforecast->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($historicalforecast->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($historicalforecast->longitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Radius') ?></th>
            <td><?= $this->Number->format($historicalforecast->radius) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Length') ?></th>
            <td><?= $this->Number->format($historicalforecast->forecast_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Date') ?></th>
            <td><?= h($historicalforecast->forecast_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Am Pm') ?></th>
            <td><?= $historicalforecast->am_pm ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correct') ?></th>
            <td><?= $historicalforecast->correct ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
