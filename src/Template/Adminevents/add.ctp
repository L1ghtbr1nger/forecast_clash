<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Admin Events'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'HistoricalForecasts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'HistoricalForecasts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="adminEvents form large-9 medium-8 columns content">
    <?= $this->Form->create($adminEvent) ?>
    <fieldset>
        <legend><?= __('Add Admin Event') ?></legend>
        <?php
            echo $this->Form->input('start_date');
            echo $this->Form->input('end_date');
            echo $this->Form->input('multiplier');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
