<div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6 attempts-pie-element stats-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Total Attempts</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" class="active all-tab"><a href="#attempts_all" aria-controls="attempts_all" role="tab" data-toggle="tab">All Players</a></li>
        </div>
        <div class="card-block">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active">
                    <div class="card-block">
                    <h4 class="attempts-filter-toggle">Filter&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
                    <form action="" class="search-filter-attempts collapse-me">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Experience</strong>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="amateur_attempts" class="exp_attempts" type="checkbox" checked>
                                    <label for="amateur_attempts">
                                        <div class="can-toggle__label-text">Enthusiasts</div>
                                        <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="mets_attempts" class="exp_attempts" type="checkbox" checked>
                                    <label for="mets_attempts">
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
                        <section class="example"> 
                            <div class="chart">
                            <div class="legend pull-right">
                                <div><span class="legend-square-a"></span>Valid Attempts</div>
                                <div><span class="legend-square-b"></span>Total Attempts</div>
                              </div>
                                <div class="pie-chart ct-chart">
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
$(document).ready(function(){

    var data = {
      series: [5, 3]
    };

    var sum = function(a, b) { return a + b };

    new Chartist.Pie('.pie-chart', data, {
      labelInterpolationFnc: function(value) {
        return Math.round(value / data.series.reduce(sum) * 100) + '%';
      }
    });

    $('.attempts-filter-toggle').click(function() {
        $('.search-filter-attempts').toggle('collapse-me');
        $('.attempts .fa-chevron-down').toggleClass('flip-me');
    });

})
</script>