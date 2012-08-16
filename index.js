$(function() {

});

resizeToolbar = function(){
    //setup even spaced toolbar items
    $(".toolbar-item").each(function(){
        $(this).css("width", (($(this).parent().width() - 200) / $(".toolbar-item").length) + "px");
    })
    
    $(".toolbar-item").hover(
        function(){
            $(this).css("border-color", "#EE4605");
        },
        function(){
            $(this).css("border-color", "#FFA300");
        }
    );
}

tabClick = function(eventObj){
    var clickedIndex = $(eventObj.target).attr('index'),
        currentItem = $('.inner-panel:visible'),
        currentIndex = currentItem.attr('index');
    
    if(clickedIndex != currentIndex){
        currentItem.hide();
        $('.inner-panel[index=' + clickedIndex + ']').show();
    }
}