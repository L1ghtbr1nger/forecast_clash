<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12 attempts-pie-element stats-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Charts</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" class="active guesses-tab"><a href="#guesses_all" aria-controls="guesses_all" role="tab" data-toggle="tab">All Players</a></li>
            </ul>
        </div>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" id="guesses_all" class="tab-pane active">
                <form action="" class="search-filter-attempts collapse-me">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Experience</strong>
                            <div class="cbox">
                                <input id="amateur_c" class="exp_c" type="checkbox" checked>
                                <label for="amateur_c">
                                    <div class="can-toggle__label-text">Enthusiasts</div>
                                    <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                </label>
                            </div>
                            <div class="cbox">
                                <input id="mets_c" class="exp_c" type="checkbox" checked>
                                <label for="mets_c">
                                    <div class="can-toggle__label-text">Meteorologists</div>
                                    <div class="can-toggle__switch mets-switch" data-checked="On" data-unchecked="Off"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="guesses_bar">
                            <?= $this->element('WeatherStatistics/stats_guesses_bar'); ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="attempts_pie">
                            <?= $this->element('WeatherStatistics/stats_attempts_pie'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>