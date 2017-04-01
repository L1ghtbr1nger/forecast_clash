<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<style>
.col-md-3 {
    max-width: 200px;
}

.col-date {
    max-width: 350px !important;
}
</style>
<div class="content">
    <div class="row">
        <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-6 stats-col heatmap-element">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h4>Update Your Accounte</h4>
                    </div>
                </div>
                <div class="card-block">
                    <form method="post" accept-charset="utf-8" id="updateForm">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <label for="first_name"><strong>First Name</strong></label>
                                    <input type="text" name="first_name" <?= (isset($updateUser['first_name']) ? 'value="'.$updateUser['first_name'].'"' : ''); ?> >
                                </fieldset>
                            </div>
                             <div class="col-md-6">
                                <fieldset>
                                    <label for="last_name"><strong>Last Name</strong></label>
                                    <input type="text" name="last_name" <?= (isset($updateUser['last_name']) ? 'value="'.$updateUser['last_name'].'"' : ''); ?> >
                                </fieldset>
                            </div>
                            <div class="col-md-12">
                                <fieldset>
                                    <?= $this->Form->label('meteorologist', 'Experience Level'); ?>
                                    <?= $this->Form->radio('meteorologist', [
                                        ['value' => 1, 'text' => 'Meteorologist', 'name' => 'Experience', 'id' => 'meteorologist', (($updateUser['meteorologist']) ? 'checked="checked"' : '')],
                                        ['value' => 0, 'text' => 'Weather Enthusiast', 'name' => 'Experience', 'id' => 'weather_enthusiast', ((!$updateUser['meteorologist']) ? 'checked="checked"' : '')]
                                    ]); ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="userUpdate" class="btn btn-primary" disabled type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-6 stats-col heatmap-element">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h4>Update Your Password</h4>
                    </div>
                </div>
                <div class="card-block">
                    <form method="post" accept-charset="utf-8" id="passwordForm">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <label for="password"><strong>Password</strong></label>
                                    <input type="password" name="password">
                                </fieldset>
                            </div>
                             <div class="col-md-6">
                                <fieldset>
                                    <label for="password_confirmation"><strong>Password Confirmation</strong></label>
                                    <input type="password" name="password_confirmation">
                                </fieldset>
                            </div>
                            <div class="modal-footer">
                                <button id="passwordUpdate" class="btn btn-primary" disabled type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-6 stats-col heatmap-element">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h4>Tell Us More About Yourself</h4>
                    </div>
                    <!-- Nav tabs -->
                </div>
                <div class="card-block">
                    <form method="post" accept-charset="utf-8" id="profileForm" action="/forecast_clash/profiles/profile">
                        <div style="display:none;">
                            <input name="_method" value="POST" type="hidden">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="textfield textfield--floatingLabel">
                                    <div class="input text">
                                        <fieldset>
                                            <label for="city"><strong>City</strong></label>
                                            <input name="city" city="" textfield__label="City textfield__label" class="textfield__input" id="city" type="text" <?= (isset($updateProfile) ? 'value="'.$updateProfile['city'].'"' : ''); ?> >
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <label for="state"><strong>State</strong></label>
                                    <div class="textfield textfield--floatingLabel">
                                        <?= $this->Form->select('state_id', $states, 
                                            (isset($updateProfile) ? ['value' => $updateProfile['state_id']] : ['empty' => 'Choose State:'])  
                                        ); ?>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="textfield textfield--floatingLabel">
                                <fieldset>
                                        <label for="education_level_id"><strong>Education</strong></label>
                                        <?= $this->Form->select('education_level_id', $educationLevels,
                                            (isset($updateProfile) ? ['value' => $updateProfile['education_level_id']] : ['empty' => 'Level of Education:'])
                                        ); ?>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <fieldset><label for="age_id"><strong>Age</strong></label>
                                    <?= $this->Form->select('age_id', $ages,
                                        (isset($updateProfile) ? ['value' => $updateProfile['age_id']] : ['empty' => 'Age Range:'])
                                    ); ?>
                                </fieldset> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <label for="gender"><strong>Gender</strong></label>
                                    <?= $this->Form->radio('gender', [
                                        ['value' => 1, 'text' => 'Male'],
                                        ['value' => 0, 'text' => 'Female']
                                    ],
                                    (isset($updateProfile) ? ['value' => $updateProfile['gender']] : [])                 
                                    ); ?>
                                </fieldset>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="profile" class="btn btn-primary login" type="submit"><?= (isset($updateProfile) ? 'Update' : 'Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>