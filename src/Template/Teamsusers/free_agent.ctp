<?= $this->Html->script('teams'); ?>
<?= $this->Html->css('teams'); ?>
<div class="auth">
    <div class="auth-container">
        <a href="#" class="logo"><?= $this->Html->image('logo-white.png', ['alt' => 'Forecast Clash Logo']) ?></a>
        <div class="card">
            <div class="auth-content">
                <p class="text-xs-center"><?= $first.' '.$last.' has requested to join '.$teamName.'.</br>Will you sign '.$first.'?' ?></p>
                <?= $this->Form->create('teamsusers', ['id' => 'freeAgentForm']); ?>
                    <div class="form-group">
                        <?= $this->Form->hidden('team_id', ['value' => $teamID]); ?>
                        <?= $this->Form->hidden('user_id', ['value' => $userID]); ?>
                        <?= $this->Form->hidden('first_name', ['value' => $first]); ?>
                        <?= $this->Form->hidden('team_name', ['value' => $teamName]); ?>
                        <?= $this->Form->button('Add '.$first.' to my roster!', [
                            'id' => 'sign',
                            'value' => 1,
                            'class' => 'btn btn-block btn-primary freeAgent',
                            'type' => 'submit'
                        ]); ?>
                        <?= $this->Form->button($first.' didn\'t make the cut.', [
                            'id' => 'cut',
                            'value' => 0,
                            'class' => 'btn btn-block btn-primary freeAgent',
                            'type' => 'submit'
                        ]); ?>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>