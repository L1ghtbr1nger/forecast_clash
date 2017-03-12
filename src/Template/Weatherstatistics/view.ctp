<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Weatherstatistic'), ['action' => 'edit', $weatherstatistic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Weatherstatistic'), ['action' => 'delete', $weatherstatistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherstatistic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Weatherstatistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weatherstatistic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'Weatherevents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'Weatherevents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="weatherstatistics view large-9 medium-8 columns content">
    <h3><?= h($weatherstatistic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $weatherstatistic->has('user') ? $this->Html->link($weatherstatistic->user->id, ['controller' => 'Users', 'action' => 'view', $weatherstatistic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weather Event') ?></th>
            <td><?= $weatherstatistic->has('weather_event') ? $this->Html->link($weatherstatistic->weather_event->id, ['controller' => 'Weatherevents', 'action' => 'view', $weatherstatistic->weather_event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($weatherstatistic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attempts') ?></th>
            <td><?= $this->Number->format($weatherstatistic->attempts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid Attempts') ?></th>
            <td><?= $this->Number->format($weatherstatistic->valid_attempts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Radius') ?></th>
            <td><?= $this->Number->format($weatherstatistic->radius) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forecast Length') ?></th>
            <td><?= $this->Number->format($weatherstatistic->forecast_length) ?></td>
        </tr>
    </table>
</div>
