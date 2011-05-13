function select_bet(event,team,type){
    current_bets[event] = {Event: event, Team: team, Type:type};
    
    var amount = $("#bet_amount_"+event).val();
                
    if(type == "ml"){
        payout = 0;
        if(json[event][team]["ml"] > 0){
            odd = Math.abs(json[event][team]["ml"])/100;
            payout =  odd * amount;
        }else{
            odd = 100/Math.abs(json[event][team]["ml"]);
            payout =  odd * amount;
        }
        text = "  On ";
        text += json[event][team]["name"];
        text += " to win will pay ";
        text += Math.floor(payout);
    }
    $("#bet_"+event).html(text);
                
}