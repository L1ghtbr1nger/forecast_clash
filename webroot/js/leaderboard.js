$(document).ready(function(){
    var params = {};
    function callAjax(datum){
        $.ajax({ //ajax call to get DB data for the leaderboard
            type: "POST",
            url: "/forecast_clash/weatherstatistics/stats.json",
            dataType: 'json',
            data: datum,
            success : function(response){
                var count = 0;
                var result = response['result'];
                if(result){ //if any DB rows were found
                    var inserted = '';
                    $('#leaders').html('');
                    var leaders = response['leaderboard']; //separate DB data and save to leaders
                    $.each(leaders, function(key, index) { //take DB data and manipulate each row as var index
                        count++; //count for odd/even class names
                        inserted += '<tr class="'+((count & 1) ? 'odd gradeX' : 'even gradeC')+' '+((index['user_id'] === response['user_id']) ? 'activeUser' : '')+'">'+
                            '<td>'+index['rank']+'</td>'+
                            '<td>'+index['first_name']+' '+index['last_name']+'</td>'+
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
                    var inserted = 'NO RESULTS FOUND FOR GIVEN FILTERS';
                }
                $('#leaders').html(inserted); 
            },
            error : function(){   
            }
        });
    };
        
    experience(); //run experience with default filters
    tabs(); //run tabs with default tab
    callAjax(params);
    
    function experience(){ //which experience toggles are checked
        if($('#amateur_lb').prop('checked')){
            if($('#mets_lb').prop('checked')){
                params.experience = 2; //experience to be sent for if else in controller to determine meteorologist filter
            } else {
                params.experience = 0;
            } 
        } else {
            if($('#mets_lb').prop('checked')){
                params.experience = 1;
            } else {
                params.experience = 3;
            }
        }
    };
    function tabs(){ //which tab is active
        var tab = $('.current_lb').attr('id');
        if(tab === 'all_lb'){
            params.players = 1; //all players
        } else if(tab === 'team_lb') {
            params.players = 0; //players on user's team
        } 
    };
    
    $('.exp_lb').change(function(){ //run experience when filters are adjusted
        experience();
        callAjax(params);
    });
    $('.whom_lb').click(function(){ //run tabs when tab is selected
        $('.whom_lb').toggleClass('current_lb');
        tabs();
        callAjax(params);
    });
});

