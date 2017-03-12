<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Statistic'), ['action' => 'edit', $statistic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Statistic'), ['action' => 'delete', $statistic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statistic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Statistics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Statistic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="statistics view large-9 medium-8 columns content">
    <h3><?= h($statistic->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $statistic->has('user') ? $this->Html->link($statistic->user->id, ['controller' => 'Users', 'action' => 'view', $statistic->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($statistic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Streak') ?></th>
            <td><?= $this->Number->format($statistic->current_streak) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Highest Streak') ?></th>
            <td><?= $this->Number->format($statistic->highest_streak) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('States Visited') ?></th>
            <td><?= $this->Number->format($statistic->states_visited) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $statistic->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
