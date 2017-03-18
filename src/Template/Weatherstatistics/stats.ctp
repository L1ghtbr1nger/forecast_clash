<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>

<div class="content dashboard-page">
<div class="row">
       <div class="col-md-12">
           <h1>Statistics</h1>
       </div>
   </div>   
    <div class="row thumbnail-row">
        <div class="col-md-3">
            <div class="stats-thumbnail heatmap-thumbnail">
                <h3>Heatmaps</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-thumbnail leaderboard-thumbnail">
                <h3>Leaderboards</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-thumbnail attempts-pie-thumbnail">
                <h3>Total Attempts</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-thumbnail guesses-bar-thumbnail">
                <h3>Correct Guesses</h3>
            </div>
        </div>
    </div>
    <div class="row sameheight-container">
        <span id="heatmap">
            <?= $this->element('WeatherStatistics/stats_heatmap'); ?>
        </span>
    </div>
    <div class="row sameheight-container">
        <span id="leaderboard">
            <?= $this->element('WeatherStatistics/stats_leaderboard'); ?>
        </span>
    </div>
    <div class="row sameheight-container">
        <span id="attempts">
            <?= $this->element('WeatherStatistics/stats_attempts_pie'); ?>
        </span>
        <span id="guesses">
            <?= $this->element('WeatherStatistics/stats_guesses_bar'); ?>
        </span>
    </div>
</div>

<?= $this->Html->script('leaderboard'); ?>
<?= $this->Html->script('heatmaps'); ?>
<?= $this->Html->script('chartist'); ?>
<style>
    .hide-me, .thumbnail-row{
        display:none;
    }
    .thumbnail-row{
        margin-bottom: 24px;
    }
    .stats-thumbnail{
        height: 150px;
        cursor: pointer;
    }
    .stats-thumbnail h3{
        color: #fff;
        text-align: center;
        text-transform: uppercase;
        background: rgba(0,0,0,.6);
        height:100%;
        margin:0;
        padding-top: 18px;
        text-decoration: underline;

    }
    .heatmap-thumbnail{
        background: url('../webroot/img/heatmap.png') no-repeat center center;
        background-size: cover;

    }
    .leaderboard-thumbnail{
        background: url('../webroot/img/leaderboard.png') no-repeat ;
        background-size: cover;
    }

    .attempts-pie-thumbnail{
        background: url('../webroot/img/pie.png') no-repeat ;
        background-size: cover;
    }
    .guesses-bar-thumbnail{
        background: url('../webroot/img/correct_guesses.png') no-repeat ;
        background-size: cover;
    }
    .leaderboard-thumbnail h3, .attempts-pie-thumbnail h3, .guesses-bar-thumbnail h3{
        background: rgba(0,0,0,.8);
    }
</style>
<script>

$(document).ready(function(){

    var heatmap_thumbnail = $('.heatmap-thumbnail'),
        leaderboard_thumbnail = $('.leaderboard-thumbnail'),
        attempts_pie_thumbnail = $('.attempts-pie-thumbnail'),
        guesses_bar_thumbnail = $('.guesses-bar-thumbnail');

    $(heatmap_thumbnail).click(function(){
        $('.heatmap-element').toggleClass('hide-me');
    });

    $(leaderboard_thumbnail).click(function(){
        $('.leaderboard-element').toggleClass('hide-me');
    });

    $(attempts_pie_thumbnail).click(function(){
        $('.attempts-pie-element').toggleClass('hide-me');
    });

    $(guesses_bar_thumbnail).click(function(){
        $('.guesses-bar-element').toggleClass('hide-me');
    });
});
</script>