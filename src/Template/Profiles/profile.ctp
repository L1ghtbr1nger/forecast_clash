<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<style>
.col-md-3 {
    max-width: 200px;
}

.col-date {
    max-width: 350px !important;
}
.content{
    top: 40px;
    position: relative;
}
</style>
<div class="content profile">
    <div class="row">
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
        <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-6 stats-col heatmap-element">
            <div class="card sameheight-item" data-exclude="xs">
                <div class="card-header card-header-sm bordered">
                    <div class="header-block">
                        <h4>Update Your Account</h4>
                    </div>
                </div>
                <div class="card-block user-update-container">
                    <form method="post" accept-charset="utf-8" id="userUpdateForm">
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
                            <button id="userUpdate" class="btn btn-primary login" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <form method="post" accept-charset="utf-8" id="passwordForm">
            <a id="passwordReset" class="btn login" type="submit">Reset Password</a>
        </form>
        <script>
            $('#passwordForm').appendTo('.user-update-container');
        </script>
        <div class="row">
            <div class="col col-xs-12 col-sm-6 col-md-6 col-lg-6 stats-col heatmap-element">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-header card-header-sm bordered">
                        <div class="header-block">
                            <h4>Choose an Avatar</h4>
                        </div>
                    </div>
                    <div class="card-block">
                        <form method="post" accept-charset="utf-8" id="avatarsForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset>
                                        <?= $this->Form->label('avatar_id', 'Avatars'); ?>
                                        <?php foreach($avatars as $avatar) {
                                            if ($avatar['id'] < 7) {
                                                echo '<label class="avatar-radio" for="'.$avatar['id'].'">';
                                                echo '<input type="radio" name="avatar_id" id="'.$avatar['id'].'" value="'.$avatar['id'].'"/>';
                                                echo $this->Html->image($avatar['avatar_img']);
                                                echo '</label>';
                                            } else {
                                                if ($avatar['id'] == 7 && isset($social[0]['photo_url'])) {
                                                    echo '<label class="avatar-radio" for="7">';
                                                    echo '<input type="radio" name="avatar_id" id="7" value="7"/>';
                                                    echo '<img src="'.$social[0]['photo_url'].'"/>';
                                                    echo '</label>';
                                                } else if ($avatar['id'] == 8 && isset($social[1]['photo_url'])) {
                                                    echo '<label class="avatar-radio" for="8">';
                                                    echo '<input type="radio" name="avatar_id" id="8" value="8"/>';
                                                    echo '<img src="'.$social[1]['photo_url'].'"/>';
                                                    echo '</label>';
                                                } else if ($avatar['id'] == 9 && isset($social[2]['photo_url'])) {
                                                    echo '<label class="avatar-radio" for="9">';
                                                    echo '<input type="radio" name="avatar_id" id="9" value="9"/>';
                                                    echo '<img src="'.$social[2]['photo_url'].'"/>';
                                                    echo '</label>';
                                                }
                                            }
                                        } ?>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="avatars" class="btn btn-primary login" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>