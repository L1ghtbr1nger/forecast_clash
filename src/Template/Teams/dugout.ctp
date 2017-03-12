<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<?= $this->Html->script('teams'); ?>
<?= $this->Html->css('teams'); ?>
</br></br></br></br>
<?php if($hasTeam) {
    //send invitations via email and social media, general invitation link to copy/paste
    //leave team, if captain leaves, new captain is player with longest current streak, longest longest streak breaks tie, random if still tied
    if ($captain) {
        //add/edit team_logo, name?
        //manage roster
    } ?>
    <h1><?= h($data['team']['team_name']); ?></h1>
    <!-- total Team Score -->
    <?php
    $logo = $data['team']['team_logo'];
    if (!is_null($logo)) { ?>
        <div><?= $this->Html->image('teams/users/'.$logo); ?></div>
    <?php } else { ?>
        <div></div>
    <?php } ?>

<?php } else { ?>
    <div class="auth">
        <div class="auth-container">
            <a href="#" class="logo"><img src="../webroot/img/logo-white.png" alt=""> </a>
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


