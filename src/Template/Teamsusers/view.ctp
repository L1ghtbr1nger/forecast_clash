<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teams User'), ['action' => 'edit', $teamsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teams User'), ['action' => 'delete', $teamsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teams Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teams User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['controller' => 'Weatherstatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['controller' => 'Weatherstatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'Historicalforecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'Historicalforecasts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teamsUsers view large-9 medium-8 columns content">
    <h3><?= h($teamsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $teamsUser->has('user') ? $this->Html->link($teamsUser->user->id, ['controller' => 'Users', 'action' => 'view', $teamsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team') ?></th>
            <td><?= $teamsUser->has('team') ? $this->Html->link($teamsUser->team->id, ['controller' => 'Teams', 'action' => 'view', $teamsUser->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score') ?></th>
            <td><?= $teamsUser->has('score') ? $this->Html->link($teamsUser->score->id, ['controller' => 'Scores', 'action' => 'view', $teamsUser->score->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($teamsUser->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Weatherstatistics') ?></h4>
        <?php if (!empty($teamsUser->weather_statistics)): ?>
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
            <?php foreach ($teamsUser->weather_statistics as $weatherStatistics): ?>
            <tr>
                <td><?= h($weatherStatistics->id) ?></td>
                <td><?= h($weatherStatistics->user_id) ?></td>
                <td><?= h($weatherStatistics->weather_event_id) ?></td>
                <td><?= h($weatherStatistics->valid_attempts) ?></td>
                <td><?= h($weatherStatistics->attempts) ?></td>
                <td><?= h($weatherStatistics->radius) ?></td>
                <td><?= h($weatherStatistics->forecast_length) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Weatherstatistics', 'action' => 'view', $weatherStatistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Weatherstatistics', 'action' => 'edit', $weatherStatistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Weatherstatistics', 'action' => 'delete', $weatherStatistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherStatistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Historicalforecasts') ?></h4>
        <?php if (!empty($teamsUser->historical_forecasts)): ?>
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
            <?php foreach ($teamsUser->historical_forecasts as $historicalForecasts): ?>
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
                    <?= $this->Html->link(__('View'), ['controller' => 'Historicalforecasts', 'action' => 'view', $historicalForecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Historicalforecasts', 'action' => 'edit', $historicalForecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Historicalforecasts', 'action' => 'delete', $historicalForecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalForecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
