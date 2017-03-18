<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $educationLevel->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $educationLevel->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Education Levels'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="educationLevels form large-9 medium-8 columns content">
    <?= $this->Form->create($educationLevel) ?>
    <fieldset>
        <legend><?= __('Edit Education Level') ?></legend>
        <?php
            echo $this->Form->input('education');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
