<!DOCTYPE html>
<html lang="en" zbase-package="<?php echo zbase_view_template_package() ?>">
	<head>
		{!! zbase_view_render_head() !!}
		<link href="/zbase/assets/zivsluck/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link href="/zbase/assets/zivsluck/css/zivsluck.css" rel="stylesheet" />
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-73403094-1', 'auto');
		  ga('send', 'pageview');
		</script>
		 @yield('head_bottom')
	</head>
	<body class="{{ implode(' ',zbase_view_placeholder('body_class')) }}">

		<div class="container-fluid">
			<div class="row" style="padding:20px;">
				{!! zbase_alerts_render() !!}
				@yield('content')
			</div>
		</div>
		{!! zbase_view_render_body() !!}
		 @yield('body_bottom')
		 <div class="footer" style="text-align: center;width:100%;padding:20px 0px;border-top:2px solid #EBEBEB;">
			 &copy; Copyright <?php echo date('Y')?>. All Rights Reserved. Website by <a href="http://claremontdesign.com" target="_blank">ClaremontDesign</a>
		 </div>
	</body>
</html>
