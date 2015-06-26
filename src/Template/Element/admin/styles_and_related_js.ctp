
	<?php
		echo $this->Html->css('../backend/css/fonts');
		echo $this->Html->css('../backend/css/bootstrap');
		echo $this->Html->css('../backend/css/bootstrap-theme');
		echo $this->Html->css('../backend/css/utopia-white');
		echo $this->Html->css('../backend/css/utopia-responsive');
		echo $this->Html->css('../backend/css/datepicker');
		echo $this->Html->css('../backend/css/ui-lightness/jquery-ui');
		echo $this->Html->css('../backend/css/weather');
		echo $this->Html->css('../backend/css/gallery/modal');
		echo $this->Html->css('../backend/js/jqvd/css/validationEngine.jquery');
		echo $this->Html->css('../backend/css/chosen');
		echo $this->Html->css('../backend/css/ie');
		echo $this->Html->css('../backend/css/developer');
		
		echo $this->Html->script('../backend/js/jquery.min.js');
		//echo $this->Html->script('../backend/js/jquery.cookie.js');
		echo $this->Html->script('../backend/js/jqvd/jquery.validationEngine.js');
		echo $this->Html->script('../backend/js/jqvd/jquery.validationEngine-en.js');
	?>

    
    <script type="text/javascript">
	function reload()
	{
	    window.location.href=window.location;
	}
        
		$(document).ready(function() {
			$(".theme-changer a").live('click', function() {
				$('link[href*="utopia-white.css"]').attr("href",$(this).attr('rel'));
				$('link[href*="utopia-dark.css"]').attr("href",$(this).attr('rel'));
				$('link[href*="utopia-wooden.css"]').attr("href",$(this).attr('rel'));
				$.cookie("css",$(this).attr('rel'), {expires: 365, path: '/'});
				$('.user-info').removeClass('user-active');
				$('.user-dropbox').hide();
			});
		});
    </script>

    <!--[if IE 8]>
    <?php
    echo $this->Html->css('../backend/css/ie8');
    ?>
   
    <![endif]-->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <?php
    echo $this->Html->script('../backend/js/html5');
    ?>
    
    <![endif]-->

    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->