<link rel="stylesheet" href="webroot/css/default.css">
<link rel="stylesheet" href="webroot/css/default.date.css">
<link rel="stylesheet" href="webroot/css/L.Control.Range.css">
<style>
.container-fluid {
    padding-left: 0;
    padding-right: 0;
}

.leaflet-right .leaflet-control{
    background-color: #333;
}

li > ul li{
    font-size: 14px;
}

.scoring-btn{
    margin: 0px 0 12px 0px;
}

.scoring-instructions-btn{
    margin: 22px 0 0 0;
}
</style>

<article class="play-container">
    <div id="play-sidebar">
        <div class="container-fluid sidebar-header">
            <h4>Welcome to Forecast Clash</h4>
        </div>
        <div class="sidebar-content">
            <div class="instructions">
                <div class="targeting">
                        <h5><strong>How to Set a Target</strong></h5>
                        <ul>
                            <li>Select the weather icon to the right that corresponds with the type of target pin to be placed </li>
                            <li>Choose the day to be targeted</li>
                            <li>Set target radius.</li>
                            <li>Click the map and set your target pin</li>
                        </ul>
                        <button class="btn btn-primary scoring-instructions-btn pull-right">How to Score Points</button>
                </div>
                <div class="scoring-instructions">
                    <h5><strong>How to Score Points</strong></h5>
                    <p>Points are scored based on accuracy and timing. There are three primary ways to score:</p>
                    <ul>
                        <li>Number of days a target is placed in advance of an event.
                             <ul>
                                 <li><small>Longer range forecasts = more points</small></li>
                             </ul> 
                         </li>
                        <li>Radius around the target pin.
                            <ul>
                                <li>Smaller radius = more points</li>
                            </ul>
                        </li>
                        <li>Targets can be updated as often as you choose 
                            <ul>
                                <li>Changes to a target as event day nears = point deduction</li>
                            </ul>
                        </li>
                    </ul>
                    <p>Press the <i class="fa fa-question" aria-hidden="true"></i> see these instructions again.</p>
                    <p><strong>You're all set!</strong></p>
                    <button class="btn btn-primary scoring-btn pull-right">To Forecast</button>
                </div>
            </div>
            <div class="scoring">
                <p>Click the icon to the right followed by a point on the map .</p>
                <i class="fa fa-question" aria-hidden="true"></i>
                <!-- Nav tabs -->
                <div>
                   
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tornado-control">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="#" class="search-filter forecast-tornado" id="forecastForm">
                                        <fieldset class="play-date">
                                            <label for="event_date"><strong>Date</strong></label>
                                            <input type="text" name="forecast_date" class="datepicker" id="event_date">
                                        </fieldset>
                                        <fieldset class="time">
                                            <strong>Time</strong><br>
                                            <input type="radio" name="am_pm" id="am" value="0">
                                            <label for="am">AM</label>
                                            <br>
                                            <input type="radio" name="am_pm" id="pm" value="1">
                                            <label for="pm">PM</label>
                                        </fieldset>
                                        <fieldset class="radius">
                                            <label for="radius"><strong>Radius</strong></label>
                                            <h4 id="output">40 miles</h5>
                                            <input type="range" name="radius" id="radius" value="50" min="50" max="100" step="5">

                                        </fieldset>
    
                                        <!-- hidden form fields -->
                                        <input id="latlng" name="location" type="text" class="hidden" value="">
                                        <input type="radio" class="hidden" name="weather_event_id" id="tornado-event" value="1">
                                        <input type="radio" class="hidden" name="weather_event_id" id="hail-event" value="2">
                                        <input type="radio" class="hidden" name="weather_event_id" id="wind-event" value="3">

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-footer">
            <?php if ($loggedIn) {
                echo '<input class="btn btn-primary forecast-btn login" type="submit" value="Make Your Forecast" id="forecast">';
             } else {
                echo '<a href="/forecast_clash/users/login"><input class="btn btn-primary forecast-btn forecast-link" type="submit" value="Please Login!"></a>';
            } ?>
        </div>
    </div>
    <div id="map"></div>
</article>
<?= $this->Html->script('play_map'); ?>
<?= $this->Html->script('picker'); ?>
<?= $this->Html->script('picker.date'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet-easybutton@2.0.0/src/easy-button.css">
<script src="https://unpkg.com/leaflet-easybutton@2.0.0/src/easy-button.js"></script>

<script>

// Get tomorrows date for min date
var tomorrow = new Date();
var dd_tomorrow = tomorrow.getDate() + 1;
var mm_tomorrow = tomorrow.getMonth() + 1; //January is 0!
var yyyy_tomorrow = tomorrow.getFullYear();

if (dd_tomorrow < 10) {
    dd_tomorrow = '0' + dd_tomorrow
}

if (mm_tomorrow < 10) {
    mm_tomorrow = '0' + mm_tomorrow
}

// Get 8 days out for max date
var event_week = new Date();
var dd_week = event_week.getDate() + 8;
var mm_week = event_week.getMonth() + 1; //January is 0!
var yyyy_week = event_week.getFullYear();

if (dd_week < 10) {
    dd_week = '0' + dd_week
}

if (mm_week < 10) {
    mm_week = '0' + mm_week
}

tomorrow = mm_tomorrow + '/' + dd_tomorrow + '/' + yyyy_tomorrow;
console.log('Tomorrow:' + tomorrow);
event_week = mm_week + '/' + dd_week + '/' + yyyy_week;
console.log('Week:' + event_week);

// Pickadate - http://amsul.ca/pickadate.js/date/

$('.datepicker').pickadate({
    min: new Date(tomorrow),
    max: new Date(event_week),
    format: 'mmmm d, yyyy',
    closeOnSelect: true
});


// Set active tab
$('.play-link').addClass('active');


$("#radius").mousemove(function () {
    $("#output").text($("#radius").val() + ' miles')
});

</script>


