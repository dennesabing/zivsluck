<?php
zbase_view_plugin_load('jquery');
zbase_view_plugin_load('bootstrap');
zbase_view_plugin_load('zbase');
//ob_start('zbase_view_compile');
?>
<!DOCTYPE html>
<html lang="en" zbase-package="<?php echo zbase_view_template_package() ?>">
	<head>
		{!! zbase_view_render_head() !!}
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="robots" content="INDEX,FOLLOW" />
		<meta name="HandheldFriendly" content="True" />
		<meta name="MobileOptimized" content="320" />
		<link href="/zbase/assets/zivsluck/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link href="/zbase/assets/zivsluck/css/zivsluck.css" rel="stylesheet" />

		<meta property="og:url" content="http://zivsluck.com" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Create your own necklace" />
		<meta property="og:site_name" content="Personalized Necklace by ZivsLuck" />
		<meta property="og:description" content="Personalized Necklaces by Zivsluck made from High Quality Stainless, Silver and Gold! Customized design, create now!" />
		<meta property="og:image" content="http://zivsluck.com/zbase/assets/zivsluck/img/zivsluckOg.png" />
		<meta property="fb:app_id" content="1020997414620227" />


		<?php if(empty(zbase_is_dev())): ?>
			<script>
				(function (i, s, o, g, r, a, m) {
					i['GoogleAnalyticsObject'] = r;
					i[r] = i[r] || function () {
						(i[r].q = i[r].q || []).push(arguments)
					}, i[r].l = 1 * new Date();
					a = s.createElement(o),
							m = s.getElementsByTagName(o)[0];
					a.async = 1;
					a.src = g;
					m.parentNode.insertBefore(a, m)
				})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

				ga('create', 'UA-73403094-1', 'auto');
				ga('send', 'pageview');
			</script>
		<?php endif; ?>
		@yield('head_bottom')
	</head>
	<body class="{{ implode(' ',zbase_view_placeholder('body_class')) }}">
		<div class="container-fluid">
			<div class="row headerContainer" style="padding-bottom:20px;">
				<div class="col-md-6">
					<a href="/" title="ZivsLuck" class="logo">ZivsLuck</a>
				</div>
			</div>
			{!! zbase_alerts_render() !!}
			@yield('content')
		</div>
		{!! zbase_view_render_body() !!}
		@yield('body_bottom')
		<div class="footer" style="text-align: center;width:100%;padding:20px 0px;border-top:2px solid #EBEBEB;">
			&copy; Copyright <?php echo date('Y') ?>. All Rights Reserved.<br />Website by <a href="http://claremontdesign.com" target="_blank">ClaremontDesign</a>
		</div>
	</body>
</html>
<?php
ob_flush();
?>