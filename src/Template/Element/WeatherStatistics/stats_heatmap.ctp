<div class="col col-xs-12 col-sm-12 col-md-6 col-xl-5 stats-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Heatmaps</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" class="active"><a href="#all_players" aria-controls="all_players" role="tab" data-toggle="tab">All Players</a></li>
                <li role="presentation"><a href="#top_players" aria-controls="top_players" role="tab" data-toggle="tab">Top Players</a></li>
                <li role="presentation"><a href="#all_teams" aria-controls="all_teams" role="tab" data-toggle="tab">All Teams</a></li>
                <li role="presentation"><a href="#top_teams" aria-controls="top_teams" role="tab" data-toggle="tab">Top Teams</a></li>
            </ul>
        </div>
        <div class="card-block">
            <!-- Tab panes -->
            <div class="tab-content heatmap">
                <div role="tabpanel" class="tab-pane active">
                    <h4 class="heatmap-filter-toggle">Filter&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
                    <form action="" class="search-filter-heatmap collapse-me">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <strong>Date</strong>
                                <label for="from_input_heatmap">From</label>
                                <fieldset>
                                    <input type="text" id="input_from_heatmap">
                                </fieldset>
                                <label for="to_input_heatmap">To</label>
                                <fieldset>
                                    <input type="text" id="input_to_heatmap">
                                </fieldset>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <strong>Event</strong>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="tornado" type="checkbox">
                                    <label for="tornado">
                                        <div class="can-toggle__label-text">Tornado</div>
                                        <div class="can-toggle__switch tornado-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="hail" type="checkbox">
                                    <label for="hail">
                                        <div class="can-toggle__label-text">Hail</div>
                                        <div class="can-toggle__switch hail-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="wind" type="checkbox">
                                    <label for="wind">
                                        <div class="can-toggle__label-text">Wind</div>
                                        <div class="can-toggle__switch wind-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="exp-filters">
                                    <p><strong>Experience</strong></p>
                                    <div class="can-toggle can-toggle--size-small">
                                        <input id="amateur-heatmap" type="checkbox">
                                        <label for="amateur-heatmap">
                                            <div class="can-toggle__label-text">Enthusiasts</div>
                                            <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                        </label>
                                    </div>
                                    <div class="can-toggle can-toggle--size-small">
                                        <input id="mets-heatmap" type="checkbox">
                                        <label for="mets-heatmap">
                                            <div class="can-toggle__label-text">Meteorologists</div>
                                            <div class="can-toggle__switch mets-switch" data-checked="On" data-unchecked="Off"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <article class="heatmap">
                        <div id="map"></div>
                    </article>
                </div>
                <!-- <div role="tabpanel" class="tab-pane" id="heatmap_team">
                        <div id="map_team"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="heatmap_user">
                         <div id="map_user"></div>
                    </div> -->
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="../webroot/css/default.css">
<link rel="stylesheet" href="../webroot/css/default.date.css">
<?= $this->Html->script('picker'); ?>
<?= $this->Html->script('picker.date'); ?>
<script>

// toggles filters
$('.heatmap-filter-toggle').click(function(){
    $('.search-filter-heatmap').toggle('collapse-me');
    $('.heatmap .fa-chevron-down').toggleClass('flip-me');
})
   var from_input_heatmap = $('#input_from_heatmap').pickadate(),
        from_picker_heatmap = from_input_heatmap.pickadate('picker')

    var to_input_heatmap = $('#input_to_heatmap').pickadate(),
        to_picker_heatmap = to_input_heatmap.pickadate('picker')
        console.log(to_input_heatmap);
    // Check if there’s a “from” or “to” date to start with.
    if (from_picker_heatmap.get('value')) {
        to_picker_heatmap.set('min', from_picker_heatmap.get('select'))
    }
    if (to_picker_heatmap.get('value')) {
        from_picker_heatmap.set('max', to_picker_heatmap.get('select'))
    }

    // When something is selected, update the “from” and “to” limits.
    from_picker_heatmap.on('set', function(event) {
        if (event.select) {
            to_picker_heatmap.set('min', from_picker_heatmap.get('select'))
        } else if ('clear' in event) {
            to_picker_heatmap.set('min', false)
        }
    })

    to_picker_heatmap.on('set', function(event) {
            if (event.select) {
                from_picker_heatmap.set('max', to_picker_heatmap.get('select'))
            } else if ('clear' in event) {
                from_picker_heatmap.set('max', false)
            }
        })
</script>