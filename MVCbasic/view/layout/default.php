<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="fr" />
    
    
    <title>RezOProject</title>
    
    <link rel="stylesheet" href="<?php echo CSS_FOLDER.DS.'bootstrap.min.css'; ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo CSS_FOLDER.DS.'main.css'; ?>" type="text/css" media="screen" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
    <script type="text/javascript" src="<?php echo JS_FOLDER.DS.'main.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo JS_FOLDER.DS.'bootstrap.min.js'; ?>"></script>

</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php echo RACINE.DS.'users' ?>">RezOProject</a>
          <ul class="nav nav-pills pull-right">
            <li><a href="<?php echo RACINE.DS.'users'.DS.'profil' ?>"><?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 'Profil'; ?></a></li>
            <li><a href=""><?php echo isset($_SESSION['user']) ? 'signout' : 'signin'; ?></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <?php echo $this->Session->readMessage(); ?>
		<?php echo $content; ?>
    </div>
	<div id="footer">
      <div class="container">
        <p class="muted credit">Site fait par Memed et Arihy.</p>
      </div>
    </div>
</body>

</html>