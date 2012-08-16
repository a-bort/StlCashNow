$(function() {
    
    jQuery.ajax("read_affiliate.php", {
        success: processAffiliates,
        error: handleError
    });
    
    function processAffiliates(data){
        
        //console.log(data);
        var obj = $.parseJSON(data);
        if(obj.data){
            var dataAr = obj.data;
            for(var i = 0; i < dataAr.length; i++){
                var entry = dataAr[i];
                console.log(entry);
                $('.main').append('<div class="entry"><div class="screenshot"><a href="' + entry.affiliate_link + '"><img src="affiliates/pics/' + entry.affiliate_pic + '.jpg" /></a></div><div class="affiliate_entry">' + entry.affiliate_description + '</div></div>');
            }
        }
        else if(obj.error){
            console.log('Error Code A1');
            alert("Connection Error");
        }
    }
    
    function handleError(jqXHR, text, err){
        console.log('error' + text);
    }
});