var paramsLB = {};
var paramsHM = {};
var paramsC = {};
var locations = [];
var heatmap;

function callAjaxHM(filters){
    $.ajax({ //ajax call to get DB data for the leaderboard
        type: "POST",
        url: "/forecast_clash/historical-forecasts/heat.json",
        dataType: 'json',
        data: filters,
        success : function(response){
            locations = response['heatmap'];
            // Heatmap Layers
            if(typeof heatmap !== 'undefined'){
                map.removeLayer(heatmap); 
            }
            heatmap = L.heatLayer(locations, { radius: 25 }).addTo(map);
        },
        error : function(){   

        }
    });
};
function dateHM(){
    if(from_value == null && to_value == null) {
        paramsHM.range = [];
    } else {
        if(from_value !== null) {
            paramsHM.range[0] = from_value;
        }
        if(to_value !== null) {
            paramsHM.range[1] = to_value;
        }
    }
    callAjaxHM(paramsHM);
}

$(document).ready(function(){
    //
    //Leaderboard
    function callAjaxLB(filters){
        $.ajax({ //ajax call to get DB data for the leaderboard
            type: "POST",
            url: "/forecast_clash/weather-statistics/stats.json",
            dataType: 'json',
            data: filters,
            success : function(response){
                var count = 0;
                var result = response['result'];
                if(result){ //if any DB rows were found
                    var inserted = '';
                    $('#leaders').html('');
                    var leaders = response['leaderboard']; //separate DB data and save to leaders
                    $.each(leaders, function(key, index) { //take DB data and manipulate each row as var index
                        count++; //count for odd/even class names
                        if(index['avatar_id']<7){
                            var filler = '/forecast_clash/webroot/img/';
                        } else {
                            var filler = '';
                        }
                        filler += index['pic'];
                        inserted += '<tr class="'+((count & 1) ? 'odd gradeX' : 'even gradeC')+' '+((index['user_id'] === response['user_id']) ? 'activeUser' : '')+'">'+
                            '<td>'+index['rank']+'</td>'+
                            '<td><img src="'+filler+'"/>'+index['first_name']+' '+index['last_name']+'</td>'+
                            '<td>'+index['score']+'</td>'; //set the rank, name and score rows and alternate class names for rows
                        if(index.hasOwnProperty('Tornado')) { //if user has made any tornado forecasts
                            var tornado = index['Tornado']; //add tornado data if applicable
                            inserted += '<td>'+((tornado < 100) ? tornado.toFixed(2) : tornado.toFixed(0))+'%</td>'; // if not 100% take to 2 decimals
                        } else {
                            inserted += '<td>N/A</td>';
                        }
                        if(index.hasOwnProperty('Hail')) { //if user has made any hail forecasts
                            var hail = index['Hail'];
                            inserted += '<td>'+((hail < 100) ? hail.toFixed(2) : hail.toFixed(0))+'%</td>';
                        } else {
                            inserted += '<td>N/A</td>';
                        }
                        if(index.hasOwnProperty('Wind')) { //if user has made any wind forecasts
                            var wind = index['Wind'];
                            inserted += '<td>'+((wind < 100) ? wind.toFixed(2) : wind.toFixed(0))+'%</td>';
                        } else {
                            inserted += '<td>N/A</td>';
                        }
                        var total = index['total'];
                        inserted += '<td>'+((total < 100) ? total.toFixed(2) : total.toFixed(0))+'%</td></tr>';
                    });
                } else {
                    var inserted = '<p class="no-results">No results found for the given filters.</p>';
                }
                $('#leaders').html(inserted); 
            },
            error : function(){   
            }
        });
    };
    
    function experienceLB(){ //which experience toggles are checked
        if($('#amateur_lb').prop('checked')){
            if($('#mets_lb').prop('checked')){
                paramsLB.experience = 2; //amateur: checked, meteorologist: checked
            } else {
                paramsLB.experience = 0; //amateur: checked, meteorologist: unchecked
            } 
        } else {
            if($('#mets_lb').prop('checked')){
                paramsLB.experience = 1; //amateur: unchecked, meteorologist: checked
            } else {
                paramsLB.experience = 3; //amateur: unchecked, meteorologist: unchecked
            }
        }
    };
    function tabsLB(){ //which tab is active
        var tab = $('.current_lb').attr('id');
        if(tab === 'all_lb'){
            paramsLB.players = 1; //all players
        } else if(tab === 'team_lb') {
            paramsLB.players = 0; //players on user's team
        } 
    };
    
    $('.exp_lb').change(function(){ //run experience when filters are adjusted
        experienceLB();
        callAjaxLB(paramsLB);
    });
    $('.whom_lb').click(function(){ //run tabs when tab is selected
        if(!$(this).hasClass('current_lb')) {
            $('.whom_lb').toggleClass('current_lb');
            tabsLB();
            callAjaxLB(paramsLB);
        }
    });
    
    tabsLB(); //run tabs with default tab
    experienceLB(); //run experience with default filters
    callAjaxLB(paramsLB);
    
    //
    //Heatmap    
    function tabsHM(){ //which tab is active
        var tab = $('.current_hm').attr('id');
        if(tab === 'all_hm'){
            paramsHM.players = 2; //all players
        } else if(tab === 'team_hm') {
            paramsHM.players = 1; //players on user's team
        } else if(tab === 'self_hm') {
            paramsHM.players = 0; //only user
        } 
    };
    function experienceHM(){ //which experience toggles are checked
        if($('#amateur_hm').prop('checked') && $('#mets_hm').prop('checked')){
            paramsHM.experience = 2; //amateur: checked, meteorologist: checked
        } else if($('#mets_hm').prop('checked')){
            paramsHM.experience = 1; //amateur: unchecked, meteorologist: checked
        } else if($('#amateur_hm').prop('checked')) {
            paramsHM.experience = 0; //amateur: checked, meteorologist: unchecked
        } else {
            paramsHM.experience = 3; //amateur: unchecked, meteorologist: unchecked
        }
    };
    function forecastHM(){ //which experience toggles are checked
        if($('#correct_hm').prop('checked') && $('#incorrect_hm').prop('checked')){
            paramsHM.correct = 2; //amateur: checked, meteorologist: checked
        } else if($('#correct_hm').prop('checked')){
            paramsHM.correct = 1; //amateur: unchecked, meteorologist: checked
        } else if($('#incorrect_hm').prop('checked')) {
            paramsHM.correct = 0; //amateur: checked, meteorologist: unchecked
        } else {
            paramsHM.correct = 3; //amateur: unchecked, meteorologist: unchecked
        }
    };
    function weatherHM(){ //which experience toggles are checked
        temp = [-1];
        if($('#tornado_hm').prop('checked')){
            temp.push(1); //tornado: checked
        }
        if($('#hail_hm').prop('checked')){
            temp.push(2); //hail: checked
        }
        if($('#wind_hm').prop('checked')){
            temp.push(3); //wind: checked
        }
        paramsHM.events = temp;
    };

    $('.whom_hm').click(function(){ //run tabs when tab is selected
        if(!$(this).hasClass('current_hm')) {
            $('.current_hm').toggleClass('current_hm');
            $(this).addClass('current_hm');
            tabsHM();
            callAjaxHM(paramsHM);
        }
    });
    $('.exp_hm').change(function(){ //run experience when experience filters are adjusted
        experienceHM();
        callAjaxHM(paramsHM);
    });
    $('.forecast_hm').change(function(){ //run forecastHM when correct/incorrect filters are adjusted
        forecastHM();
        callAjaxHM(paramsHM);
    });
    $('.event_hm').change(function(){ //run weatherHM when weather event filters are adjusted
        weatherHM();
        callAjaxHM(paramsHM);
    });
 
    tabsHM(); //run tabs with default tab
    experienceHM(); //run experience with default filters
    forecastHM(); //run filter for correct or incorrect
    weatherHM(); //run weather events filter
    dateHM();
    callAjaxHM(paramsHM);
    
    function callAjaxC(filters){
        $.ajax({ //ajax call to get DB data for the leaderboard
            type: "POST",
            url: "/forecast_clash/historical-forecasts/charts.json",
            dataType: 'json',
            data: filters,
            success : function(response){ 
                var axis = [];
                var correct = [];
                var attempts = [];
                var rCorrect = response['correct'];
                var rAttempts = response['attempts'];
                $.each(rAttempts, function(index, value) {
                    axis.push(index);
                    attempts.push(value);
                    if(typeof rCorrect[index] !== 'undefined'){
                        correct.push(rCorrect[index]);
                    }
                });
                // Correct Forecasts Bar Chart
                new Chartist.Bar('.bar-chart', {
                    labels: axis,
                    series: [correct, attempts]
                });
                
                var eventAttempts = {
                    series: attempts.slice(0,3)
                };
                var sum = function(a, b) {
                    return a + b
                };

                new Chartist.Pie('#pie-chart-events', eventAttempts, {
                    labelInterpolationFnc: function(value) {
                        return Math.round(value / eventAttempts.series.reduce(sum) * 100) + '%';
                    }
                });
            },
            error : function(){   

            }
        });
    };
    
    function experienceC(){ //which experience toggles are checked
        if($('#amateur_c').prop('checked') && $('#mets_c').prop('checked')){
            paramsC.experience = 2; //amateur: checked, meteorologist: checked
        } else if($('#mets_c').prop('checked')){
            paramsC.experience = 1; //amateur: unchecked, meteorologist: checked
        } else if($('#amateur_c').prop('checked')) {
            paramsC.experience = 0; //amateur: checked, meteorologist: unchecked
        } else {
            paramsC.experience = 3; //amateur: unchecked, meteorologist: unchecked
        }
    };
    
    $('.exp_c').change(function(){ //run experience when filters are adjusted
        experienceC();
        callAjaxC(paramsC);
    });
    
    experienceC();
    callAjaxC(paramsC);
});

