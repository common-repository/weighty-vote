jQuery(window).on('load', function(){
    var votes = [];
    
    jQuery('.vote-widget-place').each(function(i, el) {
        var id = 0;
        var style = {};
        var childs = jQuery(el).children();
        
        for (var c=0; c<childs.length; c++){
            if (childs[c].nodeName === 'INPUT'){
                if (childs[c].name === 'vote_id'){
                    id=childs[c].value;
                }
                if (childs[c].name === 'style'){
                    style=childs[c].value;
                }
            }
        }
        votes[id] = jQuery.parseJSON(style);
        jQuery(this).html('<div id="vote-widget-'+id+'"></div>');
    });
    for (var v in votes){
        new VoteWidget(v, votes[v]);
    }
});