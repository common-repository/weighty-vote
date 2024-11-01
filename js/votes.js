var setNames = function(votes){
    for (var id in votes){
        jQuery('.voteid'+votes[id]['id']).html(votes[id]['category']+' / ' + votes[id]['question']);
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
        
        if (xhr.status !== 200) {
            
        } else {
            var data = jQuery.parseJSON(xhr.responseText);

            var categories = [];
            for (var i in data.categories){
                categories[data.categories[i]['id']] = data.categories[i]['title'];
            }
            var votes = [];
            for (var i in data.votes){
                var vote = [];
                vote['id'] = data.votes[i]['id'];
                vote['category'] = categories[data.votes[i]['category_id']];
                vote['question'] = data.votes[i]['question'];

                votes[data.votes[i]['id']] = vote;
            }
            setNames(votes);
        }; 
    };
    
    xhr.send();
};

jQuery(document).ready(function(){
    getvotes(service_domain);
});