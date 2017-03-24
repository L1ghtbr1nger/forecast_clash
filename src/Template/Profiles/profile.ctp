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
                        <h4>Update Your Profile</h4>
                    </div>
                </div>
                <div class="card-block">
                    <form method="post" accept-charset="utf-8" id="updateForm" action="/forecast_clash/profiles/profile">
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset>
                                    <label for="first_name"><strong>First Name</strong></label>
                                    <input type="text" name="first_name">
                                </fieldset>
                            </div>
                             <div class="col-md-6">
                                <fieldset>
                                    <label for="last_name"><strong>Last Name</strong></label>
                                    <input type="text" name="last_name">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <label for="email"><strong>Email</strong></label>
                                    <input type="email" name="email">
                                </fieldset>
                            </div>
                        </div>
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
                        </div>
                        <div class="modal-footer">
                            <button id="profile" class="btn btn-primary" disabled type="submit">Update</button>
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
                                            <input name="city" city="" textfield__label="City textfield__label" class="textfield__input" id="city" type="text" <?= (isset($update) ? 'value="'.$update['city'].'"' : ''); ?> >
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <fieldset>
                                    <label for="state"><strong>State</strong></label>
                                    <div class="textfield textfield--floatingLabel">
                                        <?= $this->Form->select('state_id', $states, 
                                            (isset($update) ? ['value' => $update['state_id']] : ['empty' => 'Choose State:'])  
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
                                            (isset($update) ? ['value' => $update['education_level_id']] : ['empty' => 'Level of Education:'])
                                        ); ?>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <fieldset><label for="age_id"><strong>Age</strong></label>
                                    <?= $this->Form->select('age_id', $ages,
                                        (isset($update) ? ['value' => $update['age_id']] : ['empty' => 'Age Range:'])
                                    ); ?>
                                </fieldset> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <label for="gender"><strong>Gender</strong></label>
                                    <?= $this->Form->radio('gender', [
                                        ['value' => true, 'text' => 'Male'],
                                        ['value' => false, 'text' => 'Female']
                                    ],
                                    (isset($update) ? ['value' => $update['gender']] : [])                 
                                    ); ?>
                                </fieldset>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="profile" class="btn btn-primary login" type="submit"><?= (isset($update) ? 'Update' : 'Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
