<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $statistic->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $statistic->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Statistics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statistics form large-9 medium-8 columns content">
    <?= $this->Form->create($statistic) ?>
    <fieldset>
        <legend><?= __('Edit Statistic') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('current_streak');
            echo $this->Form->input('highest_streak');
            echo $this->Form->input('states_visited');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
