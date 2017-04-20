<?php $session = $this->request->session(); ?>
<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<?php 
if ($loggedIn) {
  echo '<style>  .social{margin-top:0px;}</style>';
    } else {
    echo '<style>#team_hm, #self_hm, #team_lb{position:relative;top:-23px;}</style>'; } ?>
?>

<div class="content">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Forecast Clash -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-0836559546833963"
                 data-ad-slot="4397637067"
                 data-ad-format="auto"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <div class="social pull-right">
            <h5>Share Forecast Clash</h5>
                <a class="share-social share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//forecastclash.com/forecast_clash/weather-statistics/stats"><i class="fa fa-facebook" aria-hidden="true"></i></a>

                <a class="share-social share-twitter" href="https://twitter.com/home?status=http%3A//forecastclash.com/forecast_clash/weather-statistics/stats"><i class="fa fa-twitter" aria-hidden="true"></i></a>

                <a class="share-social share-google" href="https://plus.google.com/share?url=http%3A//forecastclash.com/forecast_clash/weather-statistics/stats"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
<!--     <div class="row thumbnail-row">
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
    </div> -->
    <div class="row">
        <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12 stats-col heatmap-element">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Heatmaps</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" id="all_hm" class="active whom_hm current_hm"><a href="#all_players" aria-controls="all_players" role="tab" data-toggle="tab">All Players</a></li>
                <li role="presentation" id="team_hm" class="<?= (($teamResult) ? 'whom_hm' : '' ) ?>"><a href="#team_players" aria-controls="team_players" role="tab" data-toggle="tab"><?= (($teamResult) ? h($teamUser['teams'][0]['team_name']) : '<a href="/forecast_clash/teams/dugout">Join Team</a>' ) ?></a>
                </li>
                <li role="presentation" id="self_hm" class="<?= ((isset($user)) ? 'whom_hm' : '' ) ?>"><a href="#self" aria-controls="self" role="tab" data-toggle="tab"><?= ((isset($user)) ? h($user['first_name']) : '<a href="/forecast_clash/users/login">Login</a>' ) ?></a>
                </li>
            </ul>
        </div>
    <div class="card-block">
    <!-- Tab panes -->
        <div class="tab-content heatmap">
            <div role="tabpanel" class="tab-pane active">
            <?= $this->element('WeatherStatistics/stats_heatmap'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <div class="row">
        <span>
            <?= $this->element('WeatherStatistics/stats_leaderboard'); ?>
        </span>
    </div>
<!--     <div class="row">
        <span>
            $this->element('WeatherStatistics/stats_attempts_pie');
        </span>
        <span>
             $this->element('WeatherStatistics/stats_guesses_bar'); 
        </span>
    </div> -->
    <div class="row">
        <span>
            <?= $this->element('WeatherStatistics/charts'); ?>
        </span>
    </div></div>

<?= $this->Html->script('leaderboard'); ?>
<?= $this->Html->script('heat'); ?>
<?= $this->Html->script('chartist'); ?>
<?= $this->Html->css('chartist.min'); ?>

<style>
    .hide-me{
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

    // var heatmap_thumbnail = $('.heatmap-thumbnail'),
    //     leaderboard_thumbnail = $('.leaderboard-thumbnail'),
    //     attempts_pie_thumbnail = $('.attempts-pie-thumbnail'),
    //     guesses_bar_thumbnail = $('.guesses-bar-thumbnail');

    // $(heatmap_thumbnail).click(function(){
    //     $('.heatmap-element').toggleClass('hide-me');
    // });

    // $(leaderboard_thumbnail).click(function(){
    //     $('.leaderboard-element').toggleClass('hide-me');
    // });

    // $(attempts_pie_thumbnail).click(function(){
    //     $('.attempts-pie-element').toggleClass('hide-me');
    // });

    // $(guesses_bar_thumbnail).click(function(){
    //     $('.guesses-bar-element').toggleClass('hide-me');
    // });

    $('.stats-link').addClass('active');
});
</script>