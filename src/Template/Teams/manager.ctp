<?= $this->Html->script('teams'); ?>
<div class="auth">
    <div class="auth-container">
        <a href="#" class="logo"><img src="../webroot/img/logo-light-blue.png" alt="Forecast Clash Logo"> </a>
        <div class="card">
            <div class="auth-content">
                <?= $this->Form->create('Teams', [
                    'type' => 'file',
                    'id' => 'teamForm',
                    'url' => ['action' => 'creator']
                ]); ?>
                    <div class="form-group" id="creator">
                        <?= $this->Form->input('team_name', [
                            'label' => 'Team Name',
                            'value' => $team_name
                        ]); ?>
                        <fieldset>
                            <label for="logo" class="teamLogo">Team Logo <small>(optional)</small></label>
                            <?php if (!empty($team_logo)) {
                                echo '<div style="width: 100px; float: right; clear: none">';
                                echo $this->Html->image('teams/users/'.$team_logo, [
                                    'style' => 'width: 100%'
                                ]);
                                echo '</div>';
                            } ?>
                            <?= $this->Form->input('team_logo', [
                                'label' => (!empty($team_logo)) ? $team_logo : false,
                                'type' => 'file',
                                'id' => 'logo'
                            ]); ?>
                        </fieldset>
                        <?= $this->Form->label('privacy', 'Create private or public team?'); ?>
                        <?= $this->Form->radio('privacy', [
                            ['value' => 1, 'text' => 'Private', 'name' => 'privacy', 'id' => 'private', 'checked' => ($privacy) ? 'checked' : 'unchecked'],
                            ['value' => 0, 'text' => 'Public', 'name' => 'privacy', 'id' => 'public', 'checked' => (!$privacy) ? 'checked' : 'unchecked']
                        ]); ?>
                    </div>
                    <div class="modal-footer">
                        <?= $this->Form->button('Update Team', [
                            'id' => 'createSubmit',
                            'class' => 'btn btn-primary',
                            'type' => 'submit'
                        ]); ?>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
        <div class="card">
            <?= $this->Form->create('Teams', ['id' => 'rosterForm']); ?>
            <table class="table table-striped table-bordered table-hover flip-content">
                <thead class="flip-header">
                    <tr>
                        <th>Name</th>
                        <th>Score</th>
                        <th>Experience</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    foreach ($teammates as $teammate) {
                        foreach ($teammate['users'] as $user) {
                            $count++;
                            echo '<tr class="'.(($count & 1) ? 'odd gradeX' : 'even gradeC').' '.(($user_id === $user['id']) ? 'userTeam' : '').'">';
                            echo '<td>'.h($user['first_name']).' '.h($user['last_name']).'</td>';
                            echo '<td>'.((isset($user['scores'][0]['total_score']) && !empty($user['scores'][0]['total_score'])) ? intval($user['scores'][0]['total_score']) : '0').'</td>';
                            echo '<td>'.(($user['meteorologist']) ? 'Professional' : 'Enthusiast' ).'</td>';
                            echo '<td>'.$this->Form->checkbox($user['id'],['value' => $user['id']]).'</td></tr>';
                        }
                    } ?>
                </tbody>
            </table>
            <div class="modal-footer">
                <?= $this->Form->button('Remove Selected', [
                    'id' => 'rosterSubmit',
                    'class' => 'btn btn-primary',
                    'type' => 'submit',
                    'disabled' => true
                ]); ?>
            </div>
            <?= $this->Form->end(); ?>
        </div>
        <div class="text-xs-center">
            <a href="/forecast_clash/" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to dashboard </a>
        </div>
    </div>
</div>