<?= $this->element('header'); ?>
<?= $this->element('sidebar'); ?>
</br></br></br>
<?= $this->element('WeatherStatistics/stats_heatmap'); ?>
<?= $this->element('WeatherStatistics/stats_leaderboard'); ?>
<?= $this->Html->script('leaderboard'); ?>