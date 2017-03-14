<div class="auth">
    <div class="auth-container">
        <a href="#" class="logo"><img src="../webroot/img/logo-light-blue.png" alt="Forecast Clash Logo"> </a>
        <div class="card">
            <div class="auth-content">
                <p class="text-xs-center">What is your level of experience?</p>
                <?= $this->Form->create(); ?>
                    <div class="form-group" id="experience">
                        <?= $this->Form->button('Weather Enthusiast', [
                            'id' => 'enthusiast',
                            'class' => 'btn btn-block btn-primary experience',
                            'type' => 'submit',
                            'value' => 0
                        ]); ?>
                        <?= $this->Form->button('Professional Meteorologist', [
                            'id' => 'meteorologist',
                            'class' => 'btn btn-block btn-primary experience',
                            'type' => 'submit',
                            'value' => 1
                        ]); ?>
                    </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>