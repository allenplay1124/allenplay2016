$(function(){
	$('.post-container').imagesLoaded(function(){
        $('.post-container').masonry({        
            itemSelector: '.article-content',
            columnWidth: 410,
            singleMode: false,
            animate:true
        });
	});
});