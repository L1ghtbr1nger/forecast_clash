<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Education Levels'), ['controller' => 'EducationLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Education Level'), ['controller' => 'EducationLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ages'), ['controller' => 'Ages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Age'), ['controller' => 'Ages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="profiles form large-9 medium-8 columns content">
    <?= $this->Form->create($profile) ?>
    <fieldset>
        <legend><?= __('Add Profile') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('education_level_id', ['options' => $educationLevels]);
            echo $this->Form->input('gender');
            echo $this->Form->input('city');
            echo $this->Form->input('state_id', ['options' => $states]);
            echo $this->Form->input('age_id', ['options' => $ages]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
