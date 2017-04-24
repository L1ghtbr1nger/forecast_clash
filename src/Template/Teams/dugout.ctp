<?= $this->Html->script('teams'); ?>
<?= $this->Html->script('clipboard.min'); ?>
<?= $this->Html->css('teams'); ?>
<?php if($hasTeam) {
    echo $this->element('header');
    echo $this->element('sidebar');


    echo $this->Form->input('', [
        'value' => $url,
        'id' => 'teamClip'
    ]);  
    //send invitations via email and social media, general invitation link to copy/paste
    //leave team, if captain leaves, new captain is player with longest current streak, longest longest streak breaks tie, random if still tied
?>
<div class="content">
    <?php if ($captain) { 
        //add/edit team_logo, name?
        //manage roster
    } ?>
    <div class="row">
        <div class="col-md-12">
        <br>
            <div id="linker" class="pull-right">
                <span class="clipLabel">Copy to Recruit Teammates</span>
                <span class="clipDisplay"><?= $url; ?></span>
                <button class="clp-btn" data-clipboard-target="#teamClip"><?= $this->Html->image('clippy.svg', ['alt' => 'Copy to clipboard']); ?></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8">
                    <div class="headings">
                        <h1><?= h($data['teams'][0]['team_name']); ?></h1>
                        <h3>Team Score: <?= $total ?></h3>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                <?php
                $logo = $data['teams'][0]['team_logo'];
                    if (!is_null($logo)) { ?>
                        <div id="teamLogo"><?= $this->Html->image('teams/users/'.$logo); ?></div>
                <?php } else { ?>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-6 team-roster">
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
                                    echo '<td>'.((isset($user['scores'][0]['total_score']) && !empty($user['scores'][0]['total_score'])) ? intval($user['scores'][0]['total_score']) : '0').'</td>';
                                    echo '<td>'.(($user['meteorologist']) ? 'Professional' : 'Enthusiast' ).'</td></tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-6 rankings pull-right">
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
                                <th><?= $this->Html->image('teams/roster.png'); ?></th>
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
                                    echo '<td><sup>'.$rank['roster'].'</sup> &frasl; <sub>50</sub></td>';
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
        <?php } else { ?>
        <div class="auth">
            <div class="auth-container dugout">
                <a href="#" class="logo"><img src="../webroot/img/logo-light-blue.png" alt="Forecast Clash Logo"> </a>
                <div class="card">
                    <div class="auth-content">
                        <p class="text-xs-center teams-intro"><!-- It appears you are not yet part of a team. -->
                            The “team” option allows targeting and scoring to occur within smaller subsets of users. Teams are perfect for contests, organizational or classroom applications.
                        </p>
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
                                    'label' => 'Team Name'
                                ]); ?>
                                <fieldset>
                                    <label for="logo" class="teamLogo">Team Logo <small>(optional)</small></label>
                                    <?= $this->Form->input('team_logo', ['label' => false, 'type' => 'file', 'id' => 'logo']); ?>
                                </fieldset>
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
                <div class="text-xs-center">
                    <a href="/forecast_clash/" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to dashboard </a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<script>

$(document).ready(function(){

    $('#creator').prepend('<h3>Create Your Team</h3>');

    $('#joinButton').click(function(){
        $('.teams-intro').css('display', 'none');
    });

    $('#createButton').click(function(){
        $('.teams-intro').css('display', 'none');
    });

    $('#liveSearch p').click(function(){
        $('#joinSubmit').attr('disabled', 'false');
    });
});

var clipboard = new Clipboard('.clp-btn');
</script>