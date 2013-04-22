<div class="container-fluid">
<div class="row-fluid">
    <div class="span10">
      <!--Body content-->
      <div id="writeMsg">
  		<h4>Exprimez-vous</h4>
    		<form action="<?php echo RACINE.DS.'messages'.DS.'saveMessage' ?>" method="POST">
    			<input type="textarea" name="content" id="msgWall"><span class="add-on"><i class="icon-message"></i></span>
    			<button class="btn btn-primary" id="btn-send">send</button>
    		</form>
		  </div>
    <article id="ressources"> 

      <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">Messages</a></li>
          <li><a href="#tab2" data-toggle="tab">Events</a></li>
          <li><a href="#tab3" data-toggle="tab">Photos</a></li>
          <li><a href="#tab4" data-toggle="tab">Notifications</a></li>
        </ul>
        <div class="tab-content">

          <div class="tab-pane active" id="tab1">
            <p id="msg-content"></p>
          </div>

          <div class="tab-pane" id="tab2">
            <p id="event-content"></p>
          </div>

          <div class="tab-pane" id="tab3">
            <p id="photos-content"></p>
          </div>

          <div class="tab-pane" id="tab4">
            <p id="notifications-content"></p>
          </div>
        
        </div>
      </div>
		
    </article>
    
    </div>
    <div class="span2">
      <!--Sidebar content-->
      <aside class="search">
		<input type="text" id="search" placeholder="recherche"/>
		<span class="add-on"><i class="icon-search"></i></span>
		
		<div class="well sidebar-nav">
			<ul class="nav nav-list" id="searchResult">
      </ul>
      <ul class="nav nav-list">
        <li class="nav-header">Amis connecté</li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="nav-header">Amis</li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
      </ul>
    </div>
	
	</aside>
    </div>
  </div>
</div>
