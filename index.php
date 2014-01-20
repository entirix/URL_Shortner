<?php 

//include database connection details
include('db.php');

//redirect to real link if URL is set
if (!empty($_GET['url'])) {
	$redirect = mysql_fetch_assoc(mysql_query("SELECT url_link FROM urls WHERE url_short = '".addslashes($_GET['url'])."'"));
	$redirect = "http://".str_replace("http://","",$redirect[url_link]);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
}
//

//insert new url
if ($_POST['url']) {

//get random string for URL and add http:// if not already there
$short = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);

mysql_query("INSERT INTO urls (url_link, url_short, url_ip, url_date) VALUES

	(
	'".addslashes($_POST['url'])."',
	'".$short."',
	'".$_SERVER['REMOTE_ADDR']."',
	'".time()."'
	)

");

$redirect = "?s=$short";
header('Location: '.$redirect); die;

}
//

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Entirix's URL shrinker</title>
<!-- Developed by Entirix -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.responsive.min.css">
<link rel="stylesheet" type="text/css" href="css/custom.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
<style>	
body {
  padding-top: 10px;
  padding-bottom: 0px;
  background-color: #eee;
}
</style>	
</head>
<body>
	<div class="container">
		<!--Github Ribbon-->
		<a href="https://github.com/you"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>

		<!--Heading and other stuff-->
		<div class="jumbotron">
			<div class="page-header">
				<h2><strong>Entirix's URL Shortner</strong></h2>
				<p class="lead">Basic URL Shortner made in PHP</p>
			</div>

			<form class="form-signin" id="form1" name="form1" method="post" action="">
			  <label><h3>URL to shrink</h3></label>
			  <input name="url" class="form-control" type="text" id="url" value="http://" size="75" required autofocus />
			  <br>
			  <button class="btn btn-lg btn-primary btn-block" type="submit" name="Submit" value="Go">Shrink</button>
			</form>

			<!--if form was just posted-->
			<?php if (!empty($_GET['s'])) { ?>
			<br />
			<h2>Here's the short URL: <br>
			<a href="<?php echo $server_name; ?><?php echo $_GET['s']; ?>" target="_blank"><?php echo $server_name; ?><?php echo $_GET['s']; ?></a></h2>
			<?php } ?>
			<!---->
			<!--Footer-->
			<div class="footer">
				<p>&copy; <a href="http://entirix.net/">Entirix</a> 2014</p>
			</div>
		</div>
	</div>
</body>
</html>