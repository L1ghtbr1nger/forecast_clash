<style>
.col-md-3 {
max-width: 200px;
}

.col-date {
max-width: 350px !important;
}
</style>

<form action="" class="search-filter-heatmap">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-4">
            <div class="exp-filters">
                <strong>Experience</strong>
                <div class="cbox">
                    <input id="amateur_hm" class="exp_hm" type="checkbox" checked>
                    <label for="amateur_hm">
                        <div class="can-toggle__label-text">Enthusiasts</div>
                        <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
                <div class="cbox">
                    <input id="mets_hm" class="exp_hm" type="checkbox" checked>
                    <label for="mets_hm">
                        <div class="can-toggle__label-text">Meteorologists</div>
                        <div class="can-toggle__switch mets-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-4">
            <div class="exp-filters">
                <strong>Forecast</strong>
                <div class="cbox">
                    <input id="correct_hm" class="forecast_hm" type="checkbox" checked>
                    <label for="correct_hm">
                        <div class="can-toggle__label-text">Correct</div>
                        <div class="can-toggle__switch correct-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
                <div class="cbox">
                    <input id="incorrect_hm" class="forecast_hm" type="checkbox" checked>
                    <label for="incorrect_hm">
                        <div class="can-toggle__label-text">Incorrect</div>
                        <div class="can-toggle__switch incorrect-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-4">
            <div class="exp-filters">
                <strong>Event</strong>
                <div class="cbox">
                    <input id="tornado_hm" class="event_hm" type="checkbox" checked>
                    <label for="tornado_hm">
                        <div class="can-toggle__label-text">Tornado</div>
                        <div class="can-toggle__switch tornado-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
                <div class="cbox">
                    <input id="hail_hm" class="event_hm" type="checkbox">
                    <label for="hail_hm">
                        <div class="can-toggle__label-text">Hail</div>
                        <div class="can-toggle__switch hail-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
                <div class="cbox">
                    <input id="wind_hm" class="event_hm" type="checkbox">
                    <label for="wind_hm">
                        <div class="can-toggle__label-text">Wind</div>
                        <div class="can-toggle__switch wind-switch" data-checked="On" data-unchecked="Off"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-date">
            <div class="exp-filters">
                <strong>Date</strong>
                <label for="from_input_heatmap">From</label>
                <input type="text" id="input_from_heatmap">
                <label for="to_input_heatmap">To</label>
                <input type="text" id="input_to_heatmap">
            </div>
        </div>
    </div>
</form>
<article class="heatmap">
    <div id="map"></div>
</article>


<link rel="stylesheet" href="/forecast_clash/webroot/css/default.css">
<link rel="stylesheet" href="/forecast_clash/webroot/css/default.date.css">

<?= $this->Html->script('picker'); ?>
<?= $this->Html->script('picker.date'); ?>
<script>

// toggles filters
var to_value = null;
var from_value = null;
    
var from_input_heatmap = $('#input_from_heatmap').pickadate({
        format: 'mmmm d, yyyy',
        closeOnSelect: true,
        onClose: function() {
            // gets to value
            from_value = this.get('select', 'yyyy-mm-dd');
            dateHM();
        }
    }),

    from_picker_heatmap = from_input_heatmap.pickadate('picker');

var to_input_heatmap = $('#input_to_heatmap').pickadate({
        format: 'mmmm d, yyyy',
        closeOnSelect: true,
        onClose: function() {
            // gets to value
            to_value = this.get('select', 'yyyy-mm-dd');
            dateHM();
        }
    }),
    to_picker_heatmap = to_input_heatmap.pickadate('picker');

// Check if there’s a “from” or “to” date to start with.
if (from_picker_heatmap.get('value')) {
    to_picker_heatmap.set('min', from_picker_heatmap.get('select'));
}

if (to_picker_heatmap.get('value')) {
    from_picker_heatmap.set('max', to_picker_heatmap.get('select'));
}

// When something is selected, update the “from” and “to” limits.
from_picker_heatmap.on('set', function(event) {
    if (event.select) {
        to_picker_heatmap.set('min', from_picker_heatmap.get('select'));

    } else if ('clear' in event) {
        to_picker_heatmap.set('min', false);
    }
});

to_picker_heatmap.on('set', function(event) {
    if (event.select) {
        from_picker_heatmap.set('max', to_picker_heatmap.get('select'));

    } else if ('clear' in event) {
        from_picker_heatmap.set('max', false);
    }
});

</script>
