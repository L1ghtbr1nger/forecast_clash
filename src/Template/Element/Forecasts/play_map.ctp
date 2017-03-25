<link rel="stylesheet" href="webroot/css/default.css">
<link rel="stylesheet" href="webroot/css/default.date.css">
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

</style>

<article class="play-container">
    <div id="play-sidebar">
        <div class="container-fluid sidebar-header">
            <h4>Welcome to Forecast Clash</h4>
        </div>
        <div class="sidebar-content">
            <div class="instructions">

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

<div class="modal fade" tabindex="-1" role="dialog" id="instructions-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Make Your Forecast</h4>
      </div>
      <div class="modal-body">
        <div class="instructions">
            <div class="scoring-instructions">
                 <p>The goal is to set a target for severe weather, including wind, hail, and tornadoes for any point in the future, out to 8-days.</p>
                <h5><strong>How to Score Points</strong></h5>
                <p>Points are scored based on accuracy and timing. There are three primary ways to score:</p>
                <ul>
                    <li>Number of days a target is placed in advance of an event
                         <ul>
                             <li>Longer range forecasts = more points</li>
                         </ul> 
                     </li>
                    <li>Target radius
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
            </div>
            <div class="targeting">
                <h5><strong>How to Set a Target</strong></h5>
                <ul>
                    <li>Select a weather icon that corresponds with the type of target to be placed 
                    </li>
                    <li>Choose the day to be targeted</li>
                    <li>Set target radius</li>
                    <li>Click the map and set your target </li>
                </ul>
                <p>Forecasts notifications will be sent out every 12 hours so be sure to come back and see how you did. <strong>Good Luck!</strong></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary scoring-instructions-btn pull-right">How to Set a Target</button>
      <button class="btn btn-primary scoring-btn pull-right">Make Your Forecast</button>
            <button class="btn btn-primary skip-instructions pull-left">Skip Instructions</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?= $this->Html->script('play_map'); ?>
<?= $this->Html->script('picker'); ?>
<?= $this->Html->script('picker.date'); ?>

<!-- timezones -->
<?= $this->Html->script('jstz.min'); ?>
<?= $this->Html->script('moment'); ?>
<?= $this->Html->script('moment-timezone'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet-easybutton@2.0.0/src/easy-button.css">
<script src="https://unpkg.com/leaflet-easybutton@2.0.0/src/easy-button.js"></script>


<script>

// Set active tab
$('.play-link').addClass('active');

$("#radius").mousemove(function () {
    $("#output").text($("#radius").val() + ' miles')
});

// Get tomorrows date for min date
var tomorrow = new Date(); 
var newdate = new Date();
newdate.setDate(tomorrow.getDate() + 1);

// Get next 8 days
var newdate_week = new Date();
newdate_week.setDate(tomorrow.getDate() + 8);

// Pickadate - http://amsul.ca/pickadate.js/date/

$('.datepicker').pickadate({
    min: new Date(newdate),
    max: new Date(newdate_week),
    format: 'mmmm d, yyyy',
    closeOnSelect: true
});

// if (!sessionStorage.getItem('timezone')) {
//   var tz = jstz.determine() || 'UTC';
//   sessionStorage.setItem('timezone', tz.name());
// }
// var currTZ = sessionStorage.getItem('timezone');
// console.log(currTZ);

// var today = new Date();
// var date = moment(today).format("YYYY-MM-DD");
// console.log(date)
// var stamp = date + "T" + 11 + "Z";
// var momentTime = moment(stamp);
// var tzTime = momentTime.tz(currTZ);
// var formattedTime = tzTime.format('h:mm A');

// console.log(currTZ + formattedTime)

$(document).ready(function(){
    $('#instructions-modal').modal('show');

        $('.skip-instructions').click(function(){
            $('#instructions-modal').modal('hide');
        });

        $('.scoring-btn').click(function(){
            $('#instructions-modal').modal('hide');
        });
});




</script>