<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
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
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('avatar_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('meteorologist') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date_created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password_reset_token') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hashval') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= $this->Number->format($user->avatar_id) ?></td>
                <td><?= h($user->meteorologist) ?></td>
                <td><?= h($user->date_created) ?></td>
                <td><?= h($user->password_reset_token) ?></td>
                <td><?= h($user->hashval) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
