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
                <h4 class="attempts-filter-toggle">Filter&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
                <form action="" class="search-filter-attempts collapse-me">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Experience</strong>
                            <div class="can-toggle can-toggle--size-small">
                                <input id="amateur_c" class="exp_c" type="checkbox" checked>
                                <label for="amateur_c">
                                    <div class="can-toggle__label-text">Enthusiasts</div>
                                    <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                </label>
                            </div>
                            <div class="can-toggle can-toggle--size-small">
                                <input id="mets_c" class="exp_c" type="checkbox" checked>
                                <label for="mets_c">
                                    <div class="can-toggle__label-text">Meteorologists</div>
                                    <div class="can-toggle__switch mets-switch" data-checked="On" data-unchecked="Off"></div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <strong>Date</strong>
                            <label for="from_input_attempts">From</label>
                            <input type="text" id="input_from_attempts">
                            <label for="to_input_attempts">To</label>
                            <input type="text" id="input_to_attempts">
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
<script>
$(document).ready(function() {

    // Correct Guesses Chart
    var guesses_data = {
        labels: ['Tornado', 'Hail', 'Wind', 'Total'],
        series: [
            [3, 7, 4, 14],
            [24, 12, 18, 54]
        ]
    };

    new Chartist.Bar('.bar-chart', {
        labels: ['Tornado', 'Hail', 'Wind', 'Total'],
        series: [
            [3, 7, 4, 14],
            [24, 12, 18, 54]
        ]
    }, {


    }).on('draw', function(guesses_data) {
        if (guesses_data.type === 'bar') {
            guesses_data.element.attr({
                style: 'stroke-width: 30px'
            });
        }
    });

    $('.guesses-filter-toggle').click(function() {
        $('.search-filter-guesses').toggle('collapse-me');
        $('.guesses .fa-chevron-down').toggleClass('flip-me');
    });

    // Valid Attempts Pie 
    var attempts = {
        series: [5, 3]
    };

    var sum = function(a, b) {
        return a + b
    };

    new Chartist.Pie('.pie-chart', attempts, {
        labelInterpolationFnc: function(value) {
            return Math.round(value / attempts.series.reduce(sum) * 100) + '%';
        }
    });

    $('.attempts-filter-toggle').click(function() {
        $('.search-filter-attempts').toggle('collapse-me');
        $('.attempts .fa-chevron-down').toggleClass('flip-me');
    });

});
</script>
