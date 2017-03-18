<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Admin Event'), ['action' => 'edit', $adminEvent->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Admin Event'), ['action' => 'delete', $adminEvent->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminEvent->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Admin Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin Event'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'HistoricalForecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'HistoricalForecasts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="adminEvents view large-9 medium-8 columns content">
    <h3><?= h($adminEvent->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($adminEvent->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Multiplier') ?></th>
            <td><?= $this->Number->format($adminEvent->multiplier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($adminEvent->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($adminEvent->end_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Historical Forecasts') ?></h4>
        <?php if (!empty($adminEvent->historical_forecasts)): ?>
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
            <?php foreach ($adminEvent->historical_forecasts as $historicalForecasts): ?>
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
</div>
