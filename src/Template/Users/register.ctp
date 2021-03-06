<div class="auth">
    <div class="auth-container">
        <a href="#" class="logo"><img src="../webroot/img/logo-light-blue.png" alt="Forecast Clash Logo"> </a>
        <div class="card">
            <div class="auth-content">
                <p class="text-xs-center">SIGNUP TO PLAY</p>
                <?= $this->Form->create('users', ['id' => 'registerForm']); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $this->Form->input('first_name', [
                                        'label' => 'First Name',
                                        'class' => ''
                                    ]); ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $this->Form->input('last_name', [
                                        'label' => 'Last Name',
                                        'class' => ''
                                    ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('email', [
                                'label' => 'Email',
                                'class' => ''
                            ]); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $this->Form->input('password', [
                                        'label' => 'Password',
                                        'type' => 'password',
                                        'class' => ''
                                    ]); ?>
                                    <i class="fa fa-question-circle-o" data-toggle="tooltip" data-placement="top" title="Password must may be between 8-50 characters, contain at least one uppercase, one lowercase, and one number, and may include these characters: !@#$%." aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-6">
                                <?= $this->Form->input('confirm_password', [
                                        'label' => 'Confirm Password',
                                        'type' => 'password',
                                       'class' => ''
                                    ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $this->Form->label('meteorologist', 'What is your experience?'); ?>
                                <?= $this->Form->radio('meteorologist', [
                                ['value' => 1, 'text' => 'Meteorologist', 'name' => 'Experience', 'id' => 'meteorologist'],
                                ['value' => 0, 'text' => 'Weather Enthusiast', 'name' => 'Experience', 'id' => 'weather_enthusiast']
                            ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->button('Sign Up', [
                        'id' => 'register',
                        'class' => 'btn btn-block btn-primary login',
                        'type' => 'submit'
                        ]); ?>
                        <?= $this->Form->end(); ?>
                    </div>
                    <hr>
                        <?= $this->Html->link('Register with Facebook', [
                            'controller' => 'Users',
                            'action' => 'login',
                            '?' => ['provider' => 'Facebook']]
                        ); ?>
                        <?= $this->Html->link('Register with Google', [
                            'controller' => 'Users',
                            'action' => 'login',
                            '?' => ['provider' => 'google']]
                        ); ?>
                        <?= $this->Html->link('Register with Twitter', [
                            'controller' => 'Users',
                            'action' => 'login',
                            '?' => ['provider' => 'Twitter']]
                        ); ?>
                    <div class="form-group">
                        <p class="text-muted text-xs-center">Already have an account? <a href="login">Login!</a></p>
                    </div>
            </div>
        </div>
        <div class="text-xs-center">
            <a href="/forecast_clash/" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Back to dashboard </a>
        </div>
    </div>
</div>

<script>
    $("<i class='fa fa-facebook-official' aria-hidden='true'></i>").prependTo("a[href='/forecast_clash/users/login?provider=Facebook'");
    $("<i class='fa fa-google-plus-square' aria-hidden='true'></i>").prependTo("a[href='/forecast_clash/users/login?provider=google'");
    $("<i class='fa fa-twitter-square' aria-hidden='true'></i>").prependTo("a[href='/forecast_clash/users/login?provider=Twitter'");
</script>

