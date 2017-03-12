<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Social Profiles'), ['controller' => 'SocialProfiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Social Profile'), ['controller' => 'SocialProfiles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Badges Users'), ['controller' => 'Badgesusers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Badges User'), ['controller' => 'Badgesusers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forecasts'), ['controller' => 'Forecasts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forecast'), ['controller' => 'Forecasts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'Historicalforecasts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'Historicalforecasts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams Users'), ['controller' => 'Teamsusers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Teams User'), ['controller' => 'Teamsusers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['controller' => 'Weatherstatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['controller' => 'Weatherstatistics', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('first_name');
            echo $this->Form->input('last_name');
            echo $this->Form->input('avatar_id');
            echo $this->Form->input('meteorologist');
            echo $this->Form->input('date_created');
            echo $this->Form->input('password_reset_token');
            echo $this->Form->input('hashval');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
