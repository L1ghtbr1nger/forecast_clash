
<style>
    .hide-me{
        display:none;
    }
    .app, .container-fluid{
        padding-left:0;
        padding-right:0;
    }
    .heatmap #map{
        height: 100vh;
    }
    .card-block{
        padding:1px;
    }
    .output-form{
        width: 100vw;
        background: rgba(255,255,255, .7);
    }
    .leaflet-right .leaflet-control{
        margin-right:0;
    }
    .leaflet-bottom .leaflet-control{
        margin-bottom:0;
    }
    input[type="text"]{
        padding: 4px;
    }
    .exp-filters strong{
        display:none;
    }
    .search-filter-heatmap{
        margin-left: 12px;
    }
    .leaflet-left{
        margin-left:18px;
    }
    .leaflet-right{
        margin-right: 24px;
    }
    .leaflet-bottom{
        margin-right: 0;
    }
    .return-link{
        margin:4px 0 8px 0;
        color: #333 !important;
        display: inline-block;
    }
    .return-link:hover, .return-link:focus, .return-link:active{
        text-decoration: none;
        font-weight: 600;
        transition: all .4s ease;
    }
    .return-link span{
        text-decoration: underline;
    }

</style>
<div class="row">
    <div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12 stats-col heatmap-element">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs pull-right hide-me" role="tablist">
            <li role="presentation" id="all_hm" class="active whom_hm current_hm"><a href="#all_players" aria-controls="all_players" role="tab" data-toggle="tab">All Players</a></li>
            <li role="presentation" id="self_hm" class="<?= ((isset($user)) ? 'whom_hm' : '' ) ?>"><a href="#self" aria-controls="self" role="tab" data-toggle="tab"><?= ((isset($user)) ? h($user['first_name']) : '<a href="/forecast_clash/users/login">Login</a>' ) ?></a>
            </li>
        </ul>
    </div>
    <div class="card-block">
        <?= $this->element('WeatherStatistics/stats_heatmap'); ?>
        <a class="return-link" href="/forecast_clash"><i class="fa fa-arrow-left" aria-hidden="true"></i> <span>Return to Game</span></a>
    </div>
</div>
<?= $this->Html->script('leaderboard'); ?>
<?= $this->Html->script('heat'); ?>



<script>

$(document).ready(function(){
    $('.stats-link').addClass('active');
    $('form.search-filter-heatmap').appendTo('.output-form');
    $('.return-link').prependTo('form.search-filter-heatmap');
});
</script>