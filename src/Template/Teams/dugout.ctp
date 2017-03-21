<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<?= $this->Html->script('teams'); ?>
<?= $this->Html->script('clipboard.min'); ?>
<?= $this->Html->css('teams'); ?>
<?php if($hasTeam) {
    echo '<div class="header-spacer"></div>';
    echo $this->Form->input('', [
        'value' => $url,
        'id' => 'teamClip'
    ]); 
    //send invitations via email and social media, general invitation link to copy/paste
    //leave team, if captain leaves, new captain is player with longest current streak, longest longest streak breaks tie, random if still tied
    if ($captain) {
        //add/edit team_logo, name?
        //manage roster
    } ?>
    <div id="linker">
        <p class="clipLabel">Recruit teammates:</p>
        <p class="clipDisplay"><?= $url; ?></p>
        <button class="clp-btn" data-clipboard-target="#teamClip"><?= $this->Html->image('clippy.svg', ['alt' => 'Copy to clipboard']); ?></button>
    </div>
    <div class="headings">
        <h1><?= h($data['teams'][0]['team_name']); ?></h1>
        <h3>Team Score: <?= $total ?></h3>
    </div>
    <?php
    $logo = $data['teams'][0]['team_logo'];
    if (!is_null($logo)) { ?>
        <div id="teamLogo"><?= $this->Html->image('teams/users/'.$logo); ?></div>
    <?php } else { ?>
        <div></div>
    <?php } ?>

    <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-7 history-col">
        <div class="card sameheight-item" data-exclude="xs">
            <div class="card-header card-header-sm bordered">
                <div class="header-block">
                    <h4>Team Roster</h4>
                </div>
            </div>
            <div class="card-block">
                <table class="table table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header">
                        <tr>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Experience</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($teammates as $teammate) {
                            foreach ($teammate['users'] as $user) {
                                $count++;
                                echo '<tr class="'.(($count & 1) ? 'odd gradeX' : 'even gradeC').' '.(($data['id'] === $user['id']) ? 'userTeam' : '').'">';
                                echo '<td>'.h($user['first_name']).' '.h($user['last_name']).'</td>';
                                echo '<td>'.intval($user['total_score']).'</td>';
                                echo '<td>'.(($user['meteorologist']) ? 'Professional' : 'Enthusiast' ).'</td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-7 history-col">
        <div class="card sameheight-item" data-exclude="xs">
            <div class="card-header card-header-sm bordered">
                <div class="header-block">
                    <h4>Team Rankings</h4>
                </div>
            </div>
            <div class="card-block">
                <table class="table table-striped table-bordered table-hover flip-content">
                    <thead class="flip-header">
                        <tr>
                            <th>Rank</th>
                            <th>Team Name</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($rankResult) {
                            $count = 0;
                            foreach ($rankings as $rank) {
                                $count++;
                                echo '<tr class="'.(($count & 1) ? 'odd gradeX' : 'even gradeC').' '.(($data['teams'][0]['id'] === $rank['team_id']) ? 'userTeam' : '').'">';
                                echo '<td>'.$rank['rank'].'</td>';
                                echo '<td>'.h($rank['team_name']).'</td>';
                                echo '<td>'.intval($rank['team_score']).'</td></tr>';
                            }
                        } else {
                            echo 'NO TEAMS ON THE BOARD YET!';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-7 history-col">
        <div class="card sameheight-item" data-exclude="xs">
            <div class="card-header card-header-sm bordered">
                <div class="header-block">
                    <h4>Locker Room</h4>
                </div>
            </div>
            <div class="card-block">
                <div id="chatWindow"></div>
                <?= $this->Form->create(); ?>
                <div class="form-group">
                    <?= $this->Form->input('message', [
                        'label' => 'Huddle up with the team:',
                        'class' => 'form-control underlined',
                        'autocomplete' => 'off'
                    ]); ?>
                    <?= $this->Form->button('Post Message', [
                        'id' => 'chatButton',
                        'class' => 'btn btn-block btn-primary chatter',
                        'type' => 'submit'
                    ]); ?>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div class="auth">
        <div class="auth-container">
            <a href="#" class="logo"><img src="../webroot/img/logo-light-blue.png" alt="Forecast Clash Logo"> </a>
            <div class="card">
                <div class="auth-content">
                    <p class="text-xs-center">It appears you are not yet part of a team.</p>
                    <?= $this->Form->create(); ?>
                        <div class="form-group" id="createOrJoin">
                            <?= $this->Form->button('Join Team', [
                                'id' => 'joinButton',
                                'class' => 'btn btn-block btn-primary draft',
                                'type' => 'submit'
                            ]); ?>
                            <?= $this->Form->button('Create Team', [
                                'id' => 'createButton',
                                'class' => 'btn btn-block btn-primary draft',
                                'type' => 'submit'
                            ]); ?>
                        </div>
                    <?= $this->Form->end(); ?>
                    <?= $this->Form->create('Teams', [
                        'type' => 'file',
                        'id' => 'teamForm',
                        'url' => ['action' => 'creator']
                    ]); ?>
                        <div class="form-group" id="creator">
                            <?= $this->Form->input('team_name', [
                                'label' => 'Team Name',
                                'class' => 'form-control underlined'
                            ]); ?>
                            <label for="logo" class="teamLogo">Team Logo <small>(optional)</small></label>
                            <?= $this->Form->input('team_logo', ['label' => false, 'type' => 'file', 'id' => 'logo']); ?>
                            <?= $this->Form->label('privacy', 'Create private or public team?'); ?>
                            <?= $this->Form->radio('privacy', [
                                ['value' => 1, 'text' => 'Private', 'name' => 'privacy', 'id' => 'private'],
                                ['value' => 0, 'text' => 'Public', 'name' => 'privacy', 'id' => 'public', 'checked' => 'checked']
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->button('Create Team', [
                                'id' => 'createSubmit',
                                'class' => 'btn btn-block btn-primary disabled',
                                'type' => 'submit'
                            ]); ?>
                        </div>
                    <?= $this->Form->end(); ?>
                    <?= $this->Form->create('TeamsUsers'); ?>
                        <div class="form-group" id="joiner">
                            <?= $this->Form->input('team_name', [
                                'label' => 'Search For A Team',
                                'class' => 'form-control underlined',
                                'id' => 'typer',
                                'autocomplete' => 'off'
                            ]); ?>
                            <div id="liveSearch"></div>
                            <p id="legend"><?= $this->Html->image('teams/key.png') ?> = Private Team</p>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->button('Join Team', [
                                'id' => 'joinSubmit',
                                'class' => 'btn btn-block btn-primary disabled',
                                'type' => 'submit'
                            ]); ?>
                        </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
        <div class="text-xs-center">
            <a href="/forecast_clash/" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to dashboard </a>
        </div>
    </div>
<?php } ?>