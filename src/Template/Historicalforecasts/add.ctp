<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['action' => 'index']) ?></li>
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
<div class="historicalForecasts form large-9 medium-8 columns content">
    <?= $this->Form->create($historicalForecast) ?>
    <fieldset>
        <legend><?= __('Add Historical Forecast') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
            echo $this->Form->input('radius');
            echo $this->Form->input('weather_event_id', ['options' => $weatherEvents]);
            echo $this->Form->input('forecast_date_start');
            echo $this->Form->input('forecast_date_end');
            echo $this->Form->input('forecast_length');
            echo $this->Form->input('admin_event_id', ['options' => $adminEvents, 'empty' => true]);
            echo $this->Form->input('correct');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
