<link rel="stylesheet" href="<?=base_url(); ?>css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?=base_url(); ?>css/jquery.ui.all.css">
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->
<!--  jquery core -->
<script src="<?=base_url(); ?>js/jquery-1.7.1.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>js/jquery.ui.core.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>js/jquery.ui.widget.js"></script>
<script src="<?=base_url(); ?>js/jquery.ui.datepicker.js"></script>
<script src="<?=base_url(); ?>js/jquery.validate.js" type="text/javascript"></script>


<link rel="stylesheet" href="<?=base_url(); ?>css/demos.css">


<!--  styled file upload script -->
<script src="<?=base_url(); ?>js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(function() {
	$("input.file_1").filestyle({ 
	image: "<?=base_url(); ?>images/forms/upload_file.gif",
	imageheight : 29,
	imagewidth : 78,
	width : 300
	});
});
</script>
<!-- Tooltips -->
<script src="<?=base_url(); ?>js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script>
<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="<?=base_url(); ?>js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
<script src="<?=base_url(); ?>js/jquery/jquery.query-2.1.7.js" type="text/javascript"></script>
<script src="<?=base_url();?>js/jquery.tablesorter.min.js" type="text/javascript"></script>	