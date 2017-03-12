<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $weatherstatistic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $weatherstatistic->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Weatherstatistics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Events'), ['controller' => 'Weatherevents', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Event'), ['controller' => 'Weatherevents', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="weatherstatistics form large-9 medium-8 columns content">
    <?= $this->Form->create($weatherstatistic) ?>
    <fieldset>
        <legend><?= __('Edit Weatherstatistic') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('weather_event_id', ['options' => $weatherEvents]);
            echo $this->Form->input('attempts');
            echo $this->Form->input('valid_attempts');
            echo $this->Form->input('radius');
            echo $this->Form->input('forecast_length');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
