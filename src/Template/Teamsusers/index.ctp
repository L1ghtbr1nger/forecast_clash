<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teamsuser'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="teamsusers index large-9 medium-8 columns content">
    <h3><?= __('Teamsusers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('team_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teamsusers as $teamsuser): ?>
            <tr>
                <td><?= $this->Number->format($teamsuser->id) ?></td>
                <td><?= $teamsuser->has('user') ? $this->Html->link($teamsuser->user->id, ['controller' => 'Users', 'action' => 'view', $teamsuser->user->id]) : '' ?></td>
                <td><?= $teamsuser->has('team') ? $this->Html->link($teamsuser->team->id, ['controller' => 'Teams', 'action' => 'view', $teamsuser->team->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $teamsuser->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $teamsuser->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $teamsuser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamsuser->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
