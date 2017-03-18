<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $weatherEvent->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $weatherEvent->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Weather Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Forecasts'), ['controller' => 'Forecasts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forecast'), ['controller' => 'Forecasts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'HistoricalForecasts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'HistoricalForecasts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['controller' => 'WeatherStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['controller' => 'WeatherStatistics', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="weatherEvents form large-9 medium-8 columns content">
    <?= $this->Form->create($weatherEvent) ?>
    <fieldset>
        <legend><?= __('Edit Weather Event') ?></legend>
        <?php
            echo $this->Form->input('weather');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
