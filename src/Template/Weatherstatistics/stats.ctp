<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
<div class="content">
    <div class="row">
        <?= $this->element('WeatherStatistics/stats_heatmap'); ?>
        <?= $this->element('WeatherStatistics/stats_leaderboard'); ?>
    </div>
</div>
<?= $this->Html->script('leaderboard'); ?>
<?= $this->Html->script('heatmaps'); ?>