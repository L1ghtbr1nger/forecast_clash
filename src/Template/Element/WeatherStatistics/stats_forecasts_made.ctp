<div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6 attempt-pie-element stats-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Total Attempts</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" class="active all-tab"><a href="#heatmap_all" aria-controls="heatmap_all" role="tab" data-toggle="tab">All Players</a></li>
        </div>
        <div class="card-block">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-block">
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

    // Set sidebar height to height of app
    var app_height = $('#app').height();
    $('.sidebar-navigation').css('height', app_height);
})
</script>