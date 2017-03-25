<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $forecast->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $forecast->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Forecasts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'WeatherEvents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'WeatherEvents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="forecasts form large-9 medium-8 columns content">
    <?= $this->Form->create($forecast) ?>
    <fieldset>
        <legend><?= __('Edit Forecast') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('weather_event_id', ['options' => $weatherEvents]);
            echo $this->Form->input('submit_date');
            echo $this->Form->input('forecast_date_start');
            echo $this->Form->input('forecast_date_end');
            echo $this->Form->input('radius');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
