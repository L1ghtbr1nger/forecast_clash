<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<?= $this->Html->script('teams'); ?>
<?= $this->Html->css('teams'); ?>
</br>
</br>
</br>
<div class="row">
    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h1>Profile</h1>
    </div>
</div>
<div class="row">
    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6 history-col leaderboard-element">
        <div class="card sameheight-item" data-exclude="xs">
            <div class="card-header card-header-sm bordered">
                <div class="header-block">
                    <h4>Update Profile</h4>
                </div>
            </div>
            <div class="card-block">
                <form action="">
                    <?= $this->Form->create('profile', ['id' => 'profileForm']); ?>
                    <div class="row">
                        <div class="col-sm-6">
                        <fieldset>
                            <?= $this->Form->input('password', [
                                    'label' => 'Update Password',
                                    'type' => 'password',
                                    'class' => 'form-control underlined'
                                ]); ?>
                                <i class="fa fa-question-circle-o" data-toggle="tooltip" data-placement="top" title="Password must may be between 8-50 characters, contain at least one uppercase, one lowercase, and one number, and may include these characters: !@#$%." aria-hidden="true"></i>
                            </fieldset>
                        </div>
                        <div class="col-sm-6">
                            <fieldset>
                                <?= $this->Form->input('confirm_password', [
                                        'label' => 'Confirm Update',
                                        'type' => 'password',
                                       'class' => 'form-control underlined'
                                    ]); ?>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset>
                            <label for="state">Update Email</label>
                                <div class="textfield textfield--floatingLabel">
                                    <input class="form-control underlined" type="email">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                        <fieldset>
                            <div class="textfield textfield--floatingLabel">
                            <label for="avatar">Avatar</label>
                                <input id="avatar" type="file">
                            </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?= $this->Form->button('Submit', [
                                'id' => 'profile',
                                'class' => 'btn btn-primary login',
                                'type' => 'submit'
                            ]); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                    <div class="clearB"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6 history-col leaderboard-element">
        <div class="card sameheight-item" data-exclude="xs">
            <div class="card-header card-header-sm bordered">
                <div class="header-block">
                    <h4>Tells Us About Yourself</h4>
                </div>
            </div>
            <div class="card-block">
                <form action="">
                    <?= $this->Form->create('profile', ['id' => 'profileForm']); ?>
                        <div class="row">
                            <div class="col-md-6">
                            <fieldset>
                                <div class="textfield textfield--floatingLabel">
                                    <?= $this->Form->input('city', [
                                        ['label' => 'City', 'class' => 'textfield textfield--floatingLabel'],
                                        'class' => ' underlined form-control'
                                    ]); ?>


                                </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                <label for="state">State</label>
                                    <div class="textfield textfield--floatingLabel">
                                        <?= $this->Form->select('state_id', $states,
                                            ['empty' => 'Choose State:']
                                        ); ?>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                <label for="education">Level of Education</label>
                                        <div class="textfield textfield--floatingLabel">
                                            <?= $this->Form->select('education_level_id', $educationLevels,
                                                ['empty' => 'Level of Education:']
                                            ); ?>
                                        </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <label for="age">Age</label>
                                    <?= $this->Form->select('age_id', $ages,
                                        ['empty' => 'Age Range:']
                                    ); ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <?= $this->Form->label('gender', 'Gender'); ?>
                                        <?= $this->Form->radio('gender', [
                                        ['value' => 1, 'text' => 'Male', 'name' => 'gender', 'id' => 'male'],
                                        ['value' => 0, 'text' => 'Female', 'name' => 'gender', 'id' => 'female']
                                    ]); ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?= $this->Form->button('Submit', [
                                    'id' => 'profile',
                                    'class' => 'btn btn-primary login',
                                    'type' => 'submit'
                                ]); ?>
                            <?= $this->Form->end(); ?>
                        </div>
                        <div class="clearB"></div>
           
            </form>
        </div>
    </div>
</div>
