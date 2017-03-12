<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Team'), ['action' => 'edit', $team->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Team'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams Users'), ['controller' => 'Teamsusers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teams User'), ['controller' => 'Teamsusers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teams view large-9 medium-8 columns content">
    <h3><?= h($team->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Team Name') ?></th>
            <td><?= h($team->team_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Team Logo') ?></th>
            <td><?= h($team->team_logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($team->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($team->user_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Teamsusers') ?></h4>
        <?php if (!empty($team->teams_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Team Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($team->teams_users as $teamsUsers): ?>
            <tr>
                <td><?= h($teamsUsers->id) ?></td>
                <td><?= h($teamsUsers->user_id) ?></td>
                <td><?= h($teamsUsers->team_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teamsusers', 'action' => 'view', $teamsUsers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teamsusers', 'action' => 'edit', $teamsUsers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teamsusers', 'action' => 'delete', $teamsUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamsUsers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
