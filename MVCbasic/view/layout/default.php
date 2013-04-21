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
    <script type="text/javascript">
      //lecture message
      function readMessage()
      {
        $.ajax({
          type : "GET",
          datatype : "json",
          url : "../messages/readMessage",
          success : function(server_response)
          {
            var count = server_response.length;
            var html = "";
            if(count != 0)
            {
              for (var i = 0; i < count; i++)
              {
                html = "<p class=\"oneMessage\"> <input type=\"hidden\" value=\""+server_response[i]["id"]+"\" /> Date: "+server_response[i]["date"]+"<br>";
                html += " "+server_response[i]["content"]+" </p>";
                $("#msg-content").append(html);
              }
            }
          }

        });
      }
    </script>

</head>

<body onload="readMessage()">
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="<?php echo RACINE.DS.'users' ?>">RezOProject</a>
          <ul class="nav nav-pills pull-right">
            <li>
              <?php 
                echo $this->Session->isLogged() ? 
                '<a href="'.RACINE.DS.'users'.DS.'profil">'.$this->Session->isLogged().'</a>' :
                '';
              ?>
            </li>

            <li>
              <?php 
                echo $this->Session->isLogged() ? 
                '<a href="'.RACINE.DS.'users'.DS.'signout">signout</a>' : 
                '<a href="'.RACINE.DS.'users'.DS.'signin">signin</a>';
              ?>
            </li>
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