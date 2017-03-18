<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Avatars'), ['controller' => 'Avatars', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Avatar'), ['controller' => 'Avatars', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forecasts'), ['controller' => 'Forecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forecast'), ['controller' => 'Forecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historical Forecasts'), ['controller' => 'HistoricalForecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historical Forecast'), ['controller' => 'HistoricalForecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Scores'), ['controller' => 'Scores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Score'), ['controller' => 'Scores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Social Profiles'), ['controller' => 'SocialProfiles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Social Profile'), ['controller' => 'SocialProfiles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statistics'), ['controller' => 'Statistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Statistic'), ['controller' => 'Statistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weather Statistics'), ['controller' => 'WeatherStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weather Statistic'), ['controller' => 'WeatherStatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekly Contest Forecasts'), ['controller' => 'WeeklyContestForecasts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekly Contest Forecast'), ['controller' => 'WeeklyContestForecasts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Badges'), ['controller' => 'Badges', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Badge'), ['controller' => 'Badges', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
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
            <th scope="row"><?= __('Avatar') ?></th>
            <td><?= $user->has('avatar') ? $this->Html->link($user->avatar->id, ['controller' => 'Avatars', 'action' => 'view', $user->avatar->id]) : '' ?></td>
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
            <th scope="row"><?= __('Date Created') ?></th>
            <td><?= h($user->date_created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Meteorologist') ?></th>
            <td><?= $user->meteorologist ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
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
        <h4><?= __('Related Historical Forecasts') ?></h4>
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
                    <?= $this->Html->link(__('View'), ['controller' => 'HistoricalForecasts', 'action' => 'view', $historicalForecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'HistoricalForecasts', 'action' => 'edit', $historicalForecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'HistoricalForecasts', 'action' => 'delete', $historicalForecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historicalForecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Notifications') ?></h4>
        <?php if (!empty($user->notifications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Notification') ?></th>
                <th scope="col"><?= __('Unread') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->notifications as $notifications): ?>
            <tr>
                <td><?= h($notifications->id) ?></td>
                <td><?= h($notifications->user_id) ?></td>
                <td><?= h($notifications->notification) ?></td>
                <td><?= h($notifications->unread) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' => 'view', $notifications->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'action' => 'edit', $notifications->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'action' => 'delete', $notifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notifications->id)]) ?>
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
        <h4><?= __('Related Statistics') ?></h4>
        <?php if (!empty($user->statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Current Streak') ?></th>
                <th scope="col"><?= __('Highest Streak') ?></th>
                <th scope="col"><?= __('States Visited') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->statistics as $statistics): ?>
            <tr>
                <td><?= h($statistics->id) ?></td>
                <td><?= h($statistics->user_id) ?></td>
                <td><?= h($statistics->current_streak) ?></td>
                <td><?= h($statistics->highest_streak) ?></td>
                <td><?= h($statistics->states_visited) ?></td>
                <td><?= h($statistics->active) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Statistics', 'action' => 'view', $statistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Statistics', 'action' => 'edit', $statistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Statistics', 'action' => 'delete', $statistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Weather Statistics') ?></h4>
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
                    <?= $this->Html->link(__('View'), ['controller' => 'WeatherStatistics', 'action' => 'view', $weatherStatistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WeatherStatistics', 'action' => 'edit', $weatherStatistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WeatherStatistics', 'action' => 'delete', $weatherStatistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weatherStatistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Weekly Contest Forecasts') ?></h4>
        <?php if (!empty($user->weekly_contest_forecasts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Weekly Contest Id') ?></th>
                <th scope="col"><?= __('High') ?></th>
                <th scope="col"><?= __('Low') ?></th>
                <th scope="col"><?= __('Precip') ?></th>
                <th scope="col"><?= __('Points Scored') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->weekly_contest_forecasts as $weeklyContestForecasts): ?>
            <tr>
                <td><?= h($weeklyContestForecasts->id) ?></td>
                <td><?= h($weeklyContestForecasts->user_id) ?></td>
                <td><?= h($weeklyContestForecasts->weekly_contest_id) ?></td>
                <td><?= h($weeklyContestForecasts->high) ?></td>
                <td><?= h($weeklyContestForecasts->low) ?></td>
                <td><?= h($weeklyContestForecasts->precip) ?></td>
                <td><?= h($weeklyContestForecasts->points_scored) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WeeklyContestForecasts', 'action' => 'view', $weeklyContestForecasts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WeeklyContestForecasts', 'action' => 'edit', $weeklyContestForecasts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WeeklyContestForecasts', 'action' => 'delete', $weeklyContestForecasts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weeklyContestForecasts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Teams') ?></h4>
        <?php if (!empty($user->teams)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Team Name') ?></th>
                <th scope="col"><?= __('Team Logo') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Privacy') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->teams as $teams): ?>
            <tr>
                <td><?= h($teams->id) ?></td>
                <td><?= h($teams->team_name) ?></td>
                <td><?= h($teams->team_logo) ?></td>
                <td><?= h($teams->user_id) ?></td>
                <td><?= h($teams->privacy) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Teams', 'action' => 'view', $teams->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Teams', 'action' => 'edit', $teams->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Teams', 'action' => 'delete', $teams->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teams->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Badges') ?></h4>
        <?php if (!empty($user->badges)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Badge Name') ?></th>
                <th scope="col"><?= __('Badge Desc') ?></th>
                <th scope="col"><?= __('Badge Img') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->badges as $badges): ?>
            <tr>
                <td><?= h($badges->id) ?></td>
                <td><?= h($badges->badge_name) ?></td>
                <td><?= h($badges->badge_desc) ?></td>
                <td><?= h($badges->badge_img) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Badges', 'action' => 'view', $badges->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Badges', 'action' => 'edit', $badges->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Badges', 'action' => 'delete', $badges->id], ['confirm' => __('Are you sure you want to delete # {0}?', $badges->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related States') ?></h4>
        <?php if (!empty($user->states)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('State Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->states as $states): ?>
            <tr>
                <td><?= h($states->id) ?></td>
                <td><?= h($states->state_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'States', 'action' => 'view', $states->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'States', 'action' => 'edit', $states->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'States', 'action' => 'delete', $states->id], ['confirm' => __('Are you sure you want to delete # {0}?', $states->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
