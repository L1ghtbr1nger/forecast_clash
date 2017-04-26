<div class="col col-xs-12 col-sm-12 col-md-12 col-lg-12 history-col leaderboard-element">
    <div class="card sameheight-item" data-exclude="xs">
        <div class="card-header card-header-sm bordered">
            <div class="header-block">
                <h4>Leaderboards</h4>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs pull-right" role="tablist">
                <li role="presentation" id="all_lb" class="active whom_lb current_lb"><a href="#all_players" aria-controls="all_players" role="tab" data-toggle="tab">All Players</a></li>
                <li role="presentation" id="team_lb" class="<?= (($teamResult) ? 'whom_lb' : '' ) ?>"><a href="#team_players" aria-controls="top_players" role="tab" data-toggle="tab"><?= (($teamResult) ? h($teamUser['teams'][0]['team_name']) : '<a href="/forecast_clash/teams/dugout">Join Team</a>' ) ?></a></li>
            </ul>
        </div>
        <div class="card-block overflow-x">
            <!-- Tab panes -->
            <div class="tab-content leaderboard">
                <div role="tabpanel" class="tab-pane active" id="all_players">
                    <form action="" class="search-filter-leaderboard">
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Experience</strong>
                                <div class="cbox">
                                    <input id="amateur_lb" class="exp_lb" type="checkbox" checked>
                                    <label for="amateur_lb">
                                        <div class="can-toggle__label-text">Enthusiasts</div>
                                        <div class="can-toggle__switch enthusiasts-switch" data-checked="On" data-unchecked="Off"></div>
                                    </label>
                                </div>
                                <div class="cbox">
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
                                <th>Hail Rate (>1in)</th>
                                <th>Wind Rate (>58mph)</th>
                                <th>Total Rate</th>
                            </tr>
                        </thead>
                        <tbody id="leaders"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>