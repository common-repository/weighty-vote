var vote_id = '';
var votes = [];
var categories = [];

jQuery(document).ready(function(){
    refreshInputs();
    getvotes(service_domain);
});

var refreshInputs = function(){
    if (!style){
        style = {};
    }
    
    style.borderWg 		= style.borderWg            || "#333333";
    style.borderSizeWg 		= style.borderSizeWg        || "1";
    style.shadowSize 		= style.shadowSize          || "10";
    style.shadowOpacity 	= style.shadowOpacity       || "0.5";

/*header*/
    style.bgHeader 		= style.bgHeader            || "#337AB7";
    style.colorHeader		= style.colorHeader         || "#FFFFFF";
    style.borderHeader 		= style.borderHeader        || "#337AB7";
    style.borderSizeHeader 	= style.borderSizeHeader    || "1";

/*body*/
    style.bgBody 		= style.bgBody              || "#FFFFFF";
    style.colorWg 		= style.colorWg             || "#333333";
    style.bgAnswerCount 	= style.bgAnswerCount 	    || "#777777";
    style.colorAnswerCount 	= style.colorAnswerCount    || "#FFFFFF";
    style.bgButton		= style.bgButton            || "#337AB7";
    style.colorButton		= style.colorButton         || "#FFFFFF";
    style.borderFooter 		= style.borderFooter        || "#c0c0c0";
    style.borderSizeFooter 	= style.borderSizeFooter    || "1";

/*footer*/
    style.bgFooter 		= style.bgFooter            || "#F5F5F5";
    style.colorFooter 		= style.colorFooter         || "#333333";
    style.bgCounter 		= style.bgCounter           || "#337AB7";
    style.colorCounter 		= style.colorCounter        || "#FFFFFF";
    style.colorLink 		= style.colorLink           || "#337AB7";
    
    for (var s in style){
        jQuery('[name='+s+']').val(style[s]);
    }
};

var refreshWidget = function(id){
    if (vote_id !== id){
        vote_id = id;
        jQuery('#vote-widget-preview').html('<div id="vote-widget-'+vote_id+'"><div>');
        jQuery('input[name=vote_id]').val(vote_id);
        paintwidget();
    }
};

var setCategoriesList = function(){
    var html = '';
    for (var id in categories){
        html += '<li><a href="#" onmousedown="setVotesList(\''+id+'\');">'+categories[id]+'</a></li>';
    }
    jQuery('#categorieslist').html(html);
    
};

var setVotesList = function(category_id){
    var html = "";
    var firstQuestion = '';
    
    for (var id in votes){
        if ((category_id*1) === (votes[id]['category_id']*1)){
            if (!firstQuestion){
                firstQuestion = votes[id]['question'];
                changeVoteId(id);
            }
            html = html+"<li><a href=\"#\" onmousedown=\"changeVoteId(\'"+id+"\');\">"+votes[id]['question']+"</a></li>";
        }
    }
    
    jQuery('#categorieslistbtn').html(categories[category_id]+' <span class="caret"></span>');
    jQuery('#voteslistbtn').html((firstQuestion ? firstQuestion : 'Select') + ' <span class="caret"></span>');
    jQuery('#voteslist').html(html);
    
};

var changeVoteId = function(id){
    refreshWidget(id);
    vote_id = id;
    if (votes[id*1]){
        jQuery('#voteslistbtn').html(votes[id*1]['question']+' <span class="caret"></span>');
    }   
};

var getvotes = function(url){
    var XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest;
    
    xhr = new XHR();
    xhr.open('GET', url+'/list.php', true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState !== 4){
            return;
        }
        
        if (xhr.status === 200) {
            var data = jQuery.parseJSON(xhr.responseText);

            categories = [];
            for (var i in data.categories){
                categories[data.categories[i]['id']] = data.categories[i]['title'];
            }
            
            setCategoriesList();
            
            votes = [];
            for (var i in data.votes){
                var vote = [];
                vote['id'] = data.votes[i]['id'];
                vote['category_id'] = data.votes[i]['category_id'];
                vote['question'] = data.votes[i]['question'];

                votes[data.votes[i]['id']] = vote;
            }
			
            setcurrvote(current_vote_id);
        }; 
    };
    
    xhr.send();
};

var setcurrvote = function(id){
    if (id < 0){
        return;
    }
    
    var c = 'Select';
    var v = 'Select';
    
    for (var i in votes){
        if ((i*1) === (id*1)){
            c = votes[i]['category_id']*1;
            v = votes[i]['question'];
        }
    }
    
    setVotesList(c);
	
    if (categories[c]){
        c = categories[c];
    }

    jQuery('#categorieslistbtn').html(c + ' <span class="caret"></span>');
    jQuery('#voteslistbtn').html(v + ' <span class="caret"></span>');
    changeVoteId(id);
};