<div class="auth">
    <div class="auth-container">
        <a href="#" class="logo"><img src="../webroot/img/logo-light-blue.png" alt="Forecast Clash Logo"> </a>
        <div class="card">
            <div class="auth-content">
                <?= $this->Form->create('users', ['id' => 'loginForm']); ?>
                    <div class="form-group">
                        <?= $this->Form->input('email', [
                                'label' => 'Email',
                                'class' => ''
                            ]); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->input('password', [
                                    'label' => 'Password',
                                    'type' => 'password',
                                    'class' => ''
                                ]); ?>
                    </div>
                    <div class="form-group">
                        <a href="forgot_password" class="forgot-btn pull-right">Forgot password?</a> </div>
                    <div class="form-group">
                        <?= $this->Form->button('Login', [
                        'id' => 'login',
                        'class' => 'btn btn-block btn-primary login',
                        'type' => 'submit'
                    ]); ?>
                        <hr>
                        <?= $this->Html->link('Login with Facebook', [
                            'controller' => 'Users',
                            'action' => 'login',
                            '?' => ['provider' => 'Facebook']]
                        ); ?>
                        <?= $this->Html->link('Login with Google', [
                            'controller' => 'Users',
                            'action' => 'login',
                            '?' => ['provider' => 'google']]
                        ); ?>
                        <?= $this->Html->link('Login with Twitter', [
                            'controller' => 'Users',
                            'action' => 'login',
                            '?' => ['provider' => 'Twitter']]
                        ); ?>
                            <?= $this->Form->end(); ?>
                    </div>
                    <hr>
                    <div class="form-group">
                        <p class="text-center">Do not have an account?</p>
                        <a class="register" href="register">Sign Up!</a>
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

