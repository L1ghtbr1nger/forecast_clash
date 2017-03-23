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
                    <form method="post" accept-charset="utf-8" id="profileForm" action="/forecast_clash/profiles/profile">
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
                            <button id="profile" class="btn btn-primary login" type="submit">Update</button>
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
                                            <input name="city" city="" textfield__label="City textfield__label" class="textfield__input" id="city" type="text">
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <fieldset>
                            <label for="state"><strong>State</strong></label>
                                <div class="textfield textfield--floatingLabel">
                                    <select name="state_id">
                                        <option value="">Choose State:</option>
                                        <option value="1">Alabama</option>
                                        <option value="2">Alaska</option>
                                        <option value="3">Arizona</option>
                                        <option value="4">Arkansas</option>
                                        <option value="5">California</option>
                                        <option value="6">Colorado</option>
                                        <option value="7">Connecticut</option>
                                        <option value="8">Delaware</option>
                                        <option value="9">Florida</option>
                                        <option value="10">Georgia</option>
                                        <option value="11">Hawaii</option>
                                        <option value="12">Idaho</option>
                                        <option value="13">Illinois</option>
                                        <option value="14">Indiana</option>
                                        <option value="15">Iowa</option>
                                        <option value="16">Kansas</option>
                                        <option value="17">Kentucky</option>
                                        <option value="18">Louisiana</option>
                                        <option value="19">Maine</option>
                                        <option value="20">Maryland</option>
                                        <option value="21">Massachusetts</option>
                                        <option value="22">Michagin</option>
                                        <option value="23">Minnesota</option>
                                        <option value="24">Mississippi</option>
                                        <option value="25">Missouri</option>
                                        <option value="26">Montana</option>
                                        <option value="27">Nebraksa</option>
                                        <option value="28">Nevada</option>
                                        <option value="29">New Hampshire</option>
                                        <option value="30">New Jersey</option>
                                        <option value="31">New Mexico</option>
                                        <option value="32">New York</option>
                                        <option value="33">North Carolina</option>
                                        <option value="34">North Dakota</option>
                                        <option value="35">Ohio</option>
                                        <option value="36">Oklahoma</option>
                                        <option value="37">Oregon</option>
                                        <option value="38">Pennsylvania</option>
                                        <option value="39">Rhode Island</option>
                                        <option value="40">South Carolina</option>
                                        <option value="41">South Dakota</option>
                                        <option value="42">Tennessee</option>
                                        <option value="43">Texas</option>
                                        <option value="44">Utah</option>
                                        <option value="45">Vermont</option>
                                        <option value="46">Virginia</option>
                                        <option value="47">Washington</option>
                                        <option value="48">West Virginia</option>
                                        <option value="49">Wisconsin</option>
                                        <option value="50">Wyoming</option>
                                    </select>
                                </div></fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="textfield textfield--floatingLabel">
                                <fieldset>
                                        <label for="education_level_id"><strong>Education</strong></label>
                                        <select name="education_level_id">
                                            <option value="">Level of Education:</option>
                                            <option value="1">Some High School</option>
                                            <option value="2">Some College</option>
                                            <option value="3">College Degree</option>
                                            <option value="4">Graduate Degree</option>
                                            <option value="5">Vocational/Technical School</option>
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <fieldset><label for="age_id"><strong>Age</strong></label>
                                    <select name="age_id">
                                        <option value="">Age Range:</option>
                                        <option value="1">Under 18</option>
                                        <option value="2">18 - 24</option>
                                        <option value="3">25 - 34</option>
                                        <option value="4">35 - 44</option>
                                        <option value="5">45 - 54</option>
                                        <option value="6">55 - 64</option>
                                        <option value="7">65+</option>
                                    </select>
                                </fieldset> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <fieldset>
                                    <label for="gender"><strong>Gender</strong></label>
                                    <input name="gender" value="" type="hidden">
                                    <label for="male">
                                        <input name="gender" value="1" id="male" type="radio">Male</label>
                                    <label for="female">
                                        <input name="gender" value="0" id="female" type="radio">Female</label>
                                </fieldset>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="profile" class="btn btn-primary login" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
