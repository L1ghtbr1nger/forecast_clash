<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Social Profiles'), ['controller' => 'SocialProfiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Social Profile'), ['controller' => 'SocialProfiles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Badges Users'), ['controller' => 'Badgesusers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Badges User'), ['controller' => 'Badgesusers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forecasts'), ['controller' => 'Forecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forecast'), ['controller' => 'Forecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'Historicalforecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'Historicalforecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams Users'), ['controller' => 'Teamsusers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teams User'), ['controller' => 'Teamsusers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['controller' => 'Weatherstatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['controller' => 'Weatherstatistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password Reset Token') ?></th>
            <td><?= h($user->password_reset_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hashval') ?></th>
            <td><?= h($user->hashval) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Avatar Id') ?></th>
            <td><?= $this->Number->format($user->avatar_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($user->date_created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meteorologist') ?></th>
            <td><?= $user->meteorologist ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Social Profiles') ?></h4>
        <?php if (!empty($user->social_profiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Provider') ?></th>
                <th scope="col"><?= __('Identifier') ?></th>
                <th scope="col"><?= __('Profile Url') ?></th>
                <th scope="col"><?= __('Website Url') ?></th>
                <th scope="col"><?= __('Photo Url') ?></th>
                <th scope="col"><?= __('Display Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Language') ?></th>
                <th scope="col"><?= __('Age') ?></th>
                <th scope="col"><?= __('Birth Day') ?></th>
                <th scope="col"><?= __('Birth Month') ?></th>
                <th scope="col"><?= __('Birth Year') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Email Verified') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Country') ?></th>
                <th scope="col"><?= __('Region') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Zip') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->social_profiles as $socialProfiles): ?>
            <tr>
                <td><?= h($socialProfiles->id) ?></td>
                <td><?= h($socialProfiles->user_id) ?></td>
                <td><?= h($socialProfiles->provider) ?></td>
                <td><?= h($socialProfiles->identifier) ?></td>
                <td><?= h($socialProfiles->profile_url) ?></td>
                <td><?= h($socialProfiles->website_url) ?></td>
                <td><?= h($socialProfiles->photo_url) ?></td>
                <td><?= h($socialProfiles->display_name) ?></td>
                <td><?= h($socialProfiles->description) ?></td>
                <td><?= h($socialProfiles->first_name) ?></td>
                <td><?= h($socialProfiles->last_name) ?></td>
                <td><?= h($socialProfiles->gender) ?></td>
                <td><?= h($socialProfiles->language) ?></td>
                <td><?= h($socialProfiles->age) ?></td>
                <td><?= h($socialProfiles->birth_day) ?></td>
                <td><?= h($socialProfiles->birth_month) ?></td>
                <td><?= h($socialProfiles->birth_year) ?></td>
                <td><?= h($socialProfiles->email) ?></td>
                <td><?= h($socialProfiles->email_verified) ?></td>
                <td><?= h($socialProfiles->phone) ?></td>
                <td><?= h($socialProfiles->address) ?></td>
                <td><?= h($socialProfiles->country) ?></td>
                <td><?= h($socialProfiles->region) ?></td>
                <td><?= h($socialProfiles->city) ?></td>
                <td><?= h($socialProfiles->zip) ?></td>
                <td><?= h($socialProfiles->created) ?></td>
                <td><?= h($socialProfiles->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SocialProfiles', 'action' => 'view', $socialProfiles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SocialProfiles', 'action' => 'edit', $socialProfiles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SocialProfiles', 'action' => 'delete', $socialProfiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialProfiles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Badgesusers') ?></h4>
        <?php if (!empty($user->badges_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Badge Id') ?></th>
                <th scope="col"><?= __('Badge Count') ?></th>
                <th scope="col"><?= __('Silver') ?></th>
                <th scope="col"><?= __('Gold') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->badges_users as $badgesUsers): ?>
            <tr>
                <td><?= h($badgesUsers->id) ?></td>
                <td><?= h($badgesUsers->user_id) ?></td>
                <td><?= h($badgesUsers->badge_id) ?></td>
                <td><?= h($badgesUsers->badge_count) ?></td>
                <td><?= h($badgesUsers->silver) ?></td>
                <td><?= h($badgesUsers->gold) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Badgesusers', 'action' => 'view', $badgesUsers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Badgesusers', 'action' => 'edit', $badgesUsers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Badgesusers', 'action' => 'delete', $badgesUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $badgesUsers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Scores') ?></h4>
        <?php if (!empty($user->scores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Total Score') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->scores as $scores): ?>
            <tr>
                <td><?= h($scores->id) ?></td>
                <td><?= h($scores->user_id) ?></td>
                <td><?= h($scores->total_score) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Scores', 'action' => 'view', $scores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Scores', 'action' => 'edit', $scores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Scores', 'action' => 'delete', $scores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $scores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Forecasts') ?></h4>
        <?php if (!empty($user->forecasts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Weather Event Id') ?></th>
                <th scope="col"><?= __('Submit Date') ?></th>
                <th scope="col"><?= __('Forecast Date') ?></th>
                <th scope="col"><?= __('Am Pm') ?></th>
                <th scope="col"><?= __('Radius') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->forecasts as $forecasts): ?>
            <tr>
                <td><?= h($forecasts->id) ?></td>
                <td><?= h($forecasts->user_id) ?></td>
                <td><?= h($forecasts->weather_event_id) ?></td>
                <td><?= h($forecasts->submit_date) ?></td>
                <td><?= h($forecasts->forecast_date) ?></td>
                <td><?= h($forecasts->am_pm) ?></td>
                <td><?= h($forecasts->radius) ?></td>
                <td><?= h($forecasts->latitude) ?></td>
                <td><?= h($forecasts->longitude) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Forecasts', 'action' => 'view', $forecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Forecasts', 'action' => 'edit', $forecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Forecasts', 'action' => 'delete', $forecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $forecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Historicalforecasts') ?></h4>
        <?php if (!empty($user->historical_forecasts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('Radius') ?></th>
                <th scope="col"><?= __('Weather Event Id') ?></th>
                <th scope="col"><?= __('Forecast Date') ?></th>
                <th scope="col"><?= __('Am Pm') ?></th>
                <th scope="col"><?= __('Forecast Length') ?></th>
                <th scope="col"><?= __('Admin Event Id') ?></th>
                <th scope="col"><?= __('Correct') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->historical_forecasts as $historicalForecasts): ?>
            <tr>
                <td><?= h($historicalForecasts->id) ?></td>
                <td><?= h($historicalForecasts->user_id) ?></td>
                <td><?= h($historicalForecasts->latitude) ?></td>
                <td><?= h($historicalForecasts->longitude) ?></td>
                <td><?= h($historicalForecasts->radius) ?></td>
                <td><?= h($historicalForecasts->weather_event_id) ?></td>
                <td><?= h($historicalForecasts->forecast_date) ?></td>
                <td><?= h($historicalForecasts->am_pm) ?></td>
                <td><?= h($historicalForecasts->forecast_length) ?></td>
                <td><?= h($historicalForecasts->admin_event_id) ?></td>
                <td><?= h($historicalForecasts->correct) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Historicalforecasts', 'action' => 'view', $historicalForecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Historicalforecasts', 'action' => 'edit', $historicalForecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Historicalforecasts', 'action' => 'delete', $historicalForecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalForecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Profiles') ?></h4>
        <?php if (!empty($user->profiles)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Education Level Id') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('State Id') ?></th>
                <th scope="col"><?= __('Age Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->profiles as $profiles): ?>
            <tr>
                <td><?= h($profiles->id) ?></td>
                <td><?= h($profiles->user_id) ?></td>
                <td><?= h($profiles->education_level_id) ?></td>
                <td><?= h($profiles->gender) ?></td>
                <td><?= h($profiles->city) ?></td>
                <td><?= h($profiles->state_id) ?></td>
                <td><?= h($profiles->age_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Profiles', 'action' => 'view', $profiles->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Profiles', 'action' => 'edit', $profiles->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Profiles', 'action' => 'delete', $profiles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profiles->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Teamsusers') ?></h4>
        <?php if (!empty($user->teams_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Team Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->teams_users as $teamsUsers): ?>
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
    <div class="related">
        <h4><?= __('Related Weatherstatistics') ?></h4>
        <?php if (!empty($user->weather_statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Weather Event Id') ?></th>
                <th scope="col"><?= __('Valid Attempts') ?></th>
                <th scope="col"><?= __('Attempts') ?></th>
                <th scope="col"><?= __('Radius') ?></th>
                <th scope="col"><?= __('Forecast Length') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->weather_statistics as $weatherStatistics): ?>
            <tr>
                <td><?= h($weatherStatistics->id) ?></td>
                <td><?= h($weatherStatistics->user_id) ?></td>
                <td><?= h($weatherStatistics->weather_event_id) ?></td>
                <td><?= h($weatherStatistics->valid_attempts) ?></td>
                <td><?= h($weatherStatistics->attempts) ?></td>
                <td><?= h($weatherStatistics->radius) ?></td>
                <td><?= h($weatherStatistics->forecast_length) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Weatherstatistics', 'action' => 'view', $weatherStatistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Weatherstatistics', 'action' => 'edit', $weatherStatistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Weatherstatistics', 'action' => 'delete', $weatherStatistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherStatistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
