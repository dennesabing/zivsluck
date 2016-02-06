<!DOCTYPE html>
<html lang="en" zbase-package="<?php echo zbase_view_template_package() ?>">
	<head>
		{!! zbase_view_render_head() !!}
	</head>
	<body class="{{ implode(' ',zbase_view_placeholder('body_class')) }}">
		{!! zbase_alerts_render() !!}
		@yield('content')
		{!! zbase_view_render_body() !!}
	</body>
</html>
