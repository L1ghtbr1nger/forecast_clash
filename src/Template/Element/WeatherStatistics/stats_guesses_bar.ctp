<div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6 guesses-bar-element stats-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Correct Guesses</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" class="active all-tab"><a href="#guesses_all" aria-controls="guesses_all" role="tab" data-toggle="tab">All Players</a></li>
        </div>
        <div class="card-block">
        <h4 class="guesses-filter-toggle">Filter&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
                    <form action="" class="search-filter-guesses collapse-me">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Experience</strong>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="amateur_guesses" class="exp_guesses" type="checkbox" checked>
                                    <label for="amateur_guesses">
                                        <div class="can-toggle__label-text">Enthusiasts</div>
                                        <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="mets_guesses" class="exp_guesses" type="checkbox" checked>
                                    <label for="mets_guesses">
                                        <div class="can-toggle__label-text">Meteorologists</div>
                                        <div class="can-toggle__switch mets-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                            </div>
                             <div class="col-md-6 col-sm-6">
                                  <strong>Date</strong>
                                  <label for="from_input_guesses">From</label>
                                  <input type="text" id="input_from_guesses">
                                  <label for="to_input_guesses">To</label>
                                  <input type="text" id="input_to_guesses">
                              </div>
                        </div>
                    </form>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active">
                    <div class="card-block">
                        <section class="example">
                            <div class="chart">
                                <div class="legend pull-right">
                                    <div><span class="legend-square-a"></span>Guesses</div>
                                    <div><span class="legend-square-b"></span>Corrrect</div>
                                </div>
                                <div class="bar-chart ct-chart">
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {

    // Correct Guesses Chart
    var data = {
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


    }).on('draw', function(data) {
        if (data.type === 'bar') {
            data.element.attr({
                style: 'stroke-width: 30px'
            });
        }
    });

      $('.guesses-filter-toggle').click(function() {
        $('.search-filter-guesses').toggle('collapse-me');
        $('.guesses .fa-chevron-down').toggleClass('flip-me');
    });


    // Set sidebar height to height of app
    var app_height = $('#app').height();
    $('.sidebar-navigation').css('height', app_height);

});
</script>
