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
h4 i{
    margin-right:12px;
}
</style>

<article class="play-container">
    <div id="play-sidebar">
        <div class="container-fluid sidebar-header">
            <h4><i style="color: #fff; font-size:20px" class="fa fa-bars" aria-hidden="true"></i>Set Your Forecast</h4>
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
                        <label for="radius"><strong>Radius</strong><span id="output">(50 miles)</span></label>

                        <input type="range" name="radius" id="radius" value="50" min="5" max="100" step="5">
                        
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
        <a id="modalTrigger" style="display: none" href="#modalTrigger">Instructions</a>
        <span id="modalTrigger" data-toggle="modal" data-target="#instructions-modal">
                Instructions
        </span>
            <?php if ($loggedIn) {
                echo '<input class="btn btn-primary forecast-btn login" type="submit" value="Set Your Forecast" id="forecast">';
             } else {
                echo '<a href="/forecast_clash/users/login"><input class="btn forecast-btn forecast-link" type="submit" value="Please Login!"></a>';
            } ?>
        </div>
    </div>
    <div id="map"></div>
</article>
<!-- Pending Forecasts hidden fields -->
<?= $this->Form->hidden('pendingLocations', [
    'value' => json_encode($pendingLocations),
    'id' => 'pendingLocations'
]) ?>
<?= $this->Form->hidden('pendingRadius', [
    'value' => json_encode($pendingRadius),
    'id' => 'pendingRadius'
]) ?>
<?= $this->Form->hidden('pendingEvents', [
    'value' => json_encode($pendingEvents),
    'id' => 'pendingEvents'
]) ?>
<?= $this->Form->hidden('pendingDates', [
    'value' => json_encode($pendingDates),
    'id' => 'pendingDates'
]) ?>
<?= $this->Form->hidden('activeLocations', [
    'value' => json_encode($activeLocations),
    'id' => 'activeLocations'
]) ?>
<?= $this->Form->hidden('activeRadius', [
    'value' => json_encode($activeRadius),
    'id' => 'activeRadius'
]) ?>
<?= $this->Form->hidden('activeEvents', [
    'value' => json_encode($activeEvents),
    'id' => 'activeEvents'
]) ?>
<?= $this->Form->hidden('activeDates', [
    'value' => json_encode($activeDates),
    'id' => 'activeDates'
]) ?>
<div class="modal fade" tabindex="-1" role="dialog" id="instructions-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Welcome to Forecast Clash</h4>
      </div>
      <div class="modal-body">
        <div class="instructions">
            <div class="scoring-instructions">
                 <p>The goal is to set a target for severe weather, including wind, hail, and tornadoes for any point in the future, out to 2-days. </p>
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
                    <li>Select a weather icon that corresponds with the type of target to be placed <div class="clearB"></div>
                        <div class="icon-container">
                            <svg version='1.1' class='instructions-icon tornado-instructions' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-tornado'><g class='climacon_componentWrap climacon_componentWrap-tornado'><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine'd='M68.997,36.459H31.002c-1.104,0-2-0.896-2-1.999c0-1.104,0.896-2,2-2h37.995c1.104,0,2,0.896,2,2C70.997,35.563,70.102,36.459,68.997,36.459z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M35.002,40.459h29.996c1.104,0,2,0.896,2,2s-0.896,1.999-2,1.999H35.002c-1.104,0-2-0.896-2-1.999C33.002,41.354,33.898,40.459,35.002,40.459z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M39.001,48.458h21.998c1.104,0,1.999,0.896,1.999,1.999c0,1.104-0.896,2-1.999,2H39.001c-1.104,0-1.999-0.896-1.999-2C37.002,49.354,37.897,48.458,39.001,48.458z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine' d='M47,64.456h5.999c1.104,0,2,0.896,2,1.999s-0.896,2-2,2H47c-1.104,0-2-0.896-2-2S45.896,64.456,47,64.456z'></path><path class='climacon_component climacon_component-stroke climacon_component-stroke_tornadoLine'd='M40.869,58.456c0-1.104,0.896-1.999,2-1.999h13.998c1.104,0,2,0.896,2,1.999c0,1.104-0.896,2-2,2H42.869C41.765,60.456,40.869,59.561,40.869,58.456z'></path></g></g></svg>
                            <h5>Tornado</h5>
                        </div>
                        <div class="icon-container">
                            <svg version='1.1' class='instructions-icon hail-instructions' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-cloudHailAlt'><g class='climacon_wrapperComponent climacon_wrapperComponent-hailAlt'><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left'><circle cx='42' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle'><circle cx='49.999' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right'><circle cx='57.998' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-left'><circle cx='42' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-middle'><circle cx='49.999' cy='65.498' r='2'></circle></g><g class='climacon_component climacon_component-stroke climacon_component-stroke_hailAlt climacon_component-stroke_hailAlt-right'><circle cx='57.998' cy='65.498' r='2'></circle></g></g><g class='climacon_wrapperComponent climacon_wrapperComponent-cloud'><path class='climacon_component climacon_component-stroke climacon_component-stroke_cloud' d='M63.999,64.941v-4.381c2.39-1.384,3.999-3.961,3.999-6.92c0-4.417-3.581-8-7.998-8c-1.602,0-3.084,0.48-4.334,1.291c-1.23-5.317-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,11.998c0,3.549,1.55,6.728,3.999,8.924v4.916c-4.776-2.768-7.998-7.922-7.998-13.84c0-8.835,7.162-15.997,15.997-15.997c6.004,0,11.229,3.311,13.966,8.203c0.663-0.113,1.336-0.205,2.033-0.205c6.626,0,11.998,5.372,11.998,12C71.998,58.863,68.656,63.293,63.999,64.941z'></path></g></g></svg>
                            <h5>Hail <br>(> .75")</h5>
                        </div>
                        <div class="icon-container">
                            <svg version='1.1' class='instructions-icon wind-instructions' viewBox='15 15 70 70'><g class='climacon_iconWrap climacon_iconWrap-wind'><g class='climacon_wrapperComponent climacon_componentWrap-wind'><path class='climacon_component climacon_component-stroke climacon_component-wind climacon_component-wind_curl' d='M65.999,52L65.999,52h-3c-1.104,0-2-0.895-2-1.999c0-1.104,0.896-2,2-2h3c1.104,0,2-0.896,2-1.999c0-1.105-0.896-2-2-2s-2-0.896-2-2s0.896-2,2-2c0.138,0,0.271,0.014,0.401,0.041c3.121,0.211,5.597,2.783,5.597,5.959C71.997,49.314,69.312,52,65.999,52z'></path><path class='climacon_component climacon_component-stroke climacon_component-wind' d='M55.999,48.001h-2h-6.998H34.002c-1.104,0-1.999,0.896-1.999,2c0,1.104,0.895,1.999,1.999,1.999h2h3.999h3h4h3h3.998h2c3.313,0,6,2.688,6,6c0,3.176-2.476,5.748-5.597,5.959C56.271,63.986,56.139,64,55.999,64c-1.104,0-2-0.896-2-2c0-1.105,0.896-2,2-2s2-0.896,2-2s-0.896-2-2-2h-2h-3.998h-3h-4h-3h-3.999h-2c-3.313,0-5.999-2.686-5.999-5.999c0-3.175,2.475-5.747,5.596-5.959c0.131-0.026,0.266-0.04,0.403-0.04l0,0h12.999h6.998h2c1.104,0,2-0.896,2-2s-0.896-2-2-2s-2-0.895-2-2c0-1.104,0.896-2,2-2c0.14,0,0.272,0.015,0.403,0.041c3.121,0.211,5.597,2.783,5.597,5.959C61.999,45.314,59.312,48.001,55.999,48.001z'></path></g></g></svg>
                            <h5>Wind <br>(> 58mph)</h5>
                        </div>
                    </li>
                    <li><div class="clearB"></div>Choose the day to be targeted. Forecasts are made in UTC.</li>
                    <li>Set target radius</li>
                    <li>Click the map and set your target </li>
                </ul>
                <p>Forecasts are pending until 12 hours before your event forecast time. They are then active forecasts and cannot be updated. Results notifications occur each day at noon, so be sure to come back and see how you did. <strong>Good Luck!</strong></p>

            </div>
        </div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary scoring-instructions-btn pull-right">How to Set a Target</button>
      <button class="btn btn-primary scoring-btn pull-right">Make Your Forecast</button>
            <button class="btn btn-primary skip-instructions pull-left">Dismiss Forever</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?= $this->Html->script('play_map'); ?>
<?= $this->Html->script('picker'); ?>
<?= $this->Html->script('picker.date'); ?>

<!-- timezones -->
<?= $this->Html->script('jstz.min'); ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet-easybutton@2.0.0/src/easy-button.css">
<script src="https://unpkg.com/leaflet-easybutton@2.0.0/src/easy-button.js"></script>


<script>

$('.play-link').addClass('active');

$("#radius").mousemove(function() {
    $("#output").text('(' + $("#radius").val() + ' miles)');
});

var minDate = new Date();
var maxDate = new Date();
var max = maxDate.getDay() + 1;
var hr = minDate.getUTCHours();

if (hr >= 11) {
    var tomorrow = true;
} else if (hr <= 11) {
    var today = new Date();
    var tomorrow = new Date(today.getTime() + (24 * 60 * 60 * 1000));
}

$('.datepicker').pickadate({
    min: tomorrow,
    max: max,
    format: 'mmmm d, yyyy',
    closeOnSelect: true,
    onRender: function() {
        $('.picker').appendTo('body');
    },
    onSet: function() {

        var today = this.get('min', 'yyyy/mm/dd');
        var chosen_date = this.get('highlight', 'yyyy/mm/dd');

        if (today === chosen_date) {
            $('#am').attr('disabled', true);
            $('#am').prop('checked', false);
            $('#pm').prop('checked', true);
        } else {
            $('#am').attr('disabled', false);
        }
    }
});

$(document).ready(function() {

    // check for 'clicked' in sessionStorage
    var clicked = sessionStorage.getItem('clicked');

    if (!clicked) {
        // show instructions
        $('#instructions-modal').modal('show');
    } else {
        // hide instructions
        $('#instructions-modal').modal('hide');
    }

    $('.skip-instructions').click(function() {
        // on "Dismiss Instructions" click, set 'clicked' to sessionStorage
        sessionStorage.setItem('clicked', 'true');

        $('#instructions-modal').modal('hide');
        $('.scoring-instructions').show();
        $('.scoring-instructions-btn').show();
        $('.scoring-btn').hide();
        $('.targeting').hide();
    });

    $('.scoring-btn').click(function() {
        $('#instructions-modal').modal('hide');
    });

    $('#modalTrigger').click(function() {
        $('#instructions-modal').modal('show');
        $('.scoring-instructions').show();
        $('.scoring-instructions-btn').show();
        $('.targeting').hide();
    });
});

</script>