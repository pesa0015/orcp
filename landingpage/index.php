<?php
	$backgrounds = array(
		'blue',
		'black',
		'white',
		'gray',
	);

	$random_background = $backgrounds[ array_rand( $backgrounds ) ];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>O.R.C.P</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="wp-content/themes/orcp/landingpage/style.css">
		<link rel="favicon" href="wp-content/themes/orcp/landingpage/images/favicon.ico">
	</head>

	<body class="bg-<?php echo $random_background; ?>">

		<div id="wrapper">

			<div id="inner">

				<header class="logo">
					<img src="wp-content/themes/orcp/landingpage/images/orcp-logo-on-<?php echo $random_background; ?>.png" alt="O.R.C.P">
				</header>

				<p class="intro"><?php _e( 'only available on desktop', 'orcp' ); ?></p>

			</div>

		</div>

	</body>
</html>