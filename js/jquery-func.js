$(document).ready(function(){
	
	$(".movie-image").hover(function(){
		$(this).find(".play").show();

	},
	function()
	{
		$(this).find(".play").hide();
	});


	$(".blink").focus(function() {
            if(this.title==this.value) {
                this.value = '';
            }
        })
        .blur(function(){
            if(this.value=='') {
                this.value = this.title;                    
			}
		});
});

$(document).ready(function () {
    $('#slideshow-div').rsfSlideshow();
});

$('#slideshow-div').rsfSlideshow({
    interval: 3,
    transition: 500,
    effect: 'slideLeft'
});

var tabs=new ddtabcontent("photoTabs")
						tabs.setpersist(true)
						tabs.setselectedClassTarget("link") //"link" or "linkparent"
						tabs.init()

var top_img_over = new Image();
	top_img_over.src = 'http://entertainment.oneindia.in/popcorn/images/bt-curve.jpg';
	var top_img_out = new Image();
	top_img_out.src = 'http://entertainment.oneindia.in/popcorn/images/t-curve.jpg';
	var bottom_img_over = new Image();
	bottom_img_over.src = 'http://entertainment.oneindia.in/popcorn/images/bb-curve.jpg';
	var bottom_img_out = new Image();
	bottom_img_out.src = 'http://entertainment.oneindia.in/popcorn/images/b-curve.jpg';
	
	function mouseOver(divid)
	{	
		document.getElementById(divid).style.background='#0066cc';
		document.getElementById(divid).style.color='#FFFFFF';
		if(divid=='over_div')
		{
			document.getElementById('top-img').src = top_img_over.src;
		}
		if( divid=='last_div')
		{
			document.getElementById('bottom-img').src = bottom_img_over.src;
		}
	}
	
	function mouseOut(divid)
	{
		document.getElementById(divid).style.background='#FFFFFF';
		document.getElementById(divid).style.color='#0066cc';
		if(divid=='over_div')
		{
			document.getElementById('top-img').src = top_img_out.src;
		}
		if( divid=='last_div')
		{
			document.getElementById('bottom-img').src = bottom_img_out.src;
		}
	}	