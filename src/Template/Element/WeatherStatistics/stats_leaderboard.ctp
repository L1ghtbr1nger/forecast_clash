<div class="col col-xs-12 col-sm-12 col-md-6 col-xl-7 history-col">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Leaderboards</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" id="all_lb" class="active whom_lb current_lb"><a href="#all_players" aria-controls="all_players" role="tab" data-toggle="tab">All Players</a></li>
                <li role="presentation" id="team_lb" class="whom_lb"><a href="#team_players" aria-controls="top_players" role="tab" data-toggle="tab"><?= (($teamResult) ? h($teamUser['team']['team_name']) : '<a href="/forecast_clash/teams/dugout">Join Team</a>' ) ?></a></li>
            </ul>
        </div>
        <div class="card-block">
            <!-- Tab panes -->
            <div class="tab-content leaderboard">
                <div role="tabpanel" class="tab-pane active" id="all_players">
                    <h4 class="leaderboard-filter-toggle">Filter&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i></h4>
                    <form action="" class="search-filter-leaderboard collapse-me">
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Experience</strong>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="amateur_lb" class="exp_lb" type="checkbox" checked>
                                    <label for="amateur_lb">
                                        <div class="can-toggle__label-text">Enthusiasts</div>
                                        <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                                <div class="can-toggle can-toggle--size-small">
                                    <input id="mets_lb" class="exp_lb" type="checkbox" checked>
                                    <label for="mets_lb">
                                        <div class="can-toggle__label-text">Meteorologists</div>
                                        <div class="can-toggle__switch mets-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover flip-content">
                        <thead class="flip-header">
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Score</th>
                                <th>Tornado Rate</th>
                                <th>Wind Rate</th>
                                <th>Hail Rate</th>
                                <th>Total Rate</th>
                            </tr>
                        </thead>
                        <tbody id="leaders">
                            <?php
                            $count = 0;
                            foreach($leaderboard as $leader) {
                                $count++;
                                echo '<tr class="'.(($count & 1) ? 'odd gradeX' : 'even gradeC').' '.(($user['id'] === $leader['user_id']) ? 'activeUser' : '').'">';
                                echo '<td>'.$leader['rank'].'</td>';
                                echo '<td>'.h($leader['first_name']).' '.h($leader['last_name']).'</td>';
                                echo '<td>'.$leader['score'].'</td>';
                                if(isset($leader['Tornado'])) {
                                    echo '<td>'.number_format((float)$leader['Tornado'],2,'.', '').'%</td>';
                                } else {
                                    echo '<td>N/A</td>';
                                }
                                if(isset($leader['Hail'])) {
                                    echo '<td>'.number_format((float)$leader['Hail'],2,'.', '').'%</td>';
                                } else {
                                    echo '<td>N/A</td>';
                                }
                                if(isset($leader['Wind'])) {
                                    echo '<td>'.number_format((float)$leader['Wind'],2,'.', '').'%</td>';
                                } else {
                                    echo '<td>N/A</td>';
                                }
                                echo '<td>'.number_format((float)$leader['total'],2,'.', '').'%</td></tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Search Filter */

.collapse-me,
.heatmap-filter,
.leaderboard-filter {
    display: none;
    margin-bottom: 18px;
}

.fa-chevron-down {
    transform: rotateX(0deg);
    transition: transform .5s ease;
}

.flip-me {
    transform: rotateX(180deg);
    transition: transform .5s ease;
}

.heatmap-filter-toggle,
.leaderboard-filter-toggle {
    cursor: pointer;
}
</style>

<link rel="stylesheet" href="../webroot/css/default.css">
<link rel="stylesheet" href="../webroot/css/default.date.css">
<?= $this->Html->script('picker'); ?>
<?= $this->Html->script('picker.date'); ?>
<script>
$(document).ready(function() {

    $('.leaderboard-filter-toggle').click(function() {
        $('.search-filter-leaderboard').toggle('collapse-me');
        $('.leaderboard .fa-chevron-down').toggleClass('flip-me');
    });
    
})
</script>
