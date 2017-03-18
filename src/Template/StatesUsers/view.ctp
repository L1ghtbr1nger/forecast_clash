<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit States User'), ['action' => 'edit', $statesUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete States User'), ['action' => 'delete', $statesUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statesUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List States Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New States User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="statesUsers view large-9 medium-8 columns content">
    <h3><?= h($statesUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $statesUser->has('user') ? $this->Html->link($statesUser->user->id, ['controller' => 'Users', 'action' => 'view', $statesUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $statesUser->has('state') ? $this->Html->link($statesUser->state->id, ['controller' => 'States', 'action' => 'view', $statesUser->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($statesUser->id) ?></td>
        </tr>
    </table>
</div>
