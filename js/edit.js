var votes = [];
var categories = [];

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
    vote_id = id;
    jQuery('#vote-widget-place').html('<div id="vote-widget-'+vote_id+'"><div>');
    jQuery('#voteslistbtn').html(votes[vote_id*1]['question']+' <span class="caret"></span>');
    jQuery('input[name=vote_id]').val(vote_id);
};

var getvotes = function(url){
    var XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest;
    
    xhr = new XHR();
    xhr.open('GET', url+'/list.php', true);
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState !== 4){
            return;
        }
        
        if (xhr.status !== 200) {
            
        } else {
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

jQuery(document).ready(function(){
    getvotes(service_domain);
});