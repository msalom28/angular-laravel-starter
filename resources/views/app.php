<!DOCTYPE html>
<html class="no-js" lang="en" ng-app="UnitConnection">
<head>
	<meta charset="UTF-8">
	<title>Unit Connection</title>
		<link rel="stylesheet" href="css/app.css">
		<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">	          
	          <a class="navbar-brand" href="#">Unit Connection</a>
	        </div>
	        <div ng-if="authenticated" class="collapse navbar-collapse">
	        <ul class="nav navbar-nav navbar-right">	    
	            <li><a href="#/locations">Locations</a></li>
	            <li><a href="#/units">Units</a></li>
	            <li><a href="#/tennants">Tennants</a></li>
	            <li><a href="#/logout">Logout</a></li>
	           <li class="dropdown" dropdown>
			    <a href="" class="dropdown-toggle" dropdown-toggle>
			        {{ currentUser.name }} <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu" dropdown-menu>
			      <li> 
			        <a ng-click="">Action1</a>
			      </li>
			      <li>
			        <a ng-click="">Action2</a>
			      </li>
			      <li>
			        <a ng-click="">Action3</a>
			      </li>
			      <li>
			        <a ng-click="">Action4</a>
			      </li>
			      <li>
			        <a ng-click="logout()">Logout</a>
			      </li>
			    </ul>
			    </li>

             </ul>

	        </div>	        
	      </div>
	    </nav>	
</head>
<body>
	<div class="container">		
		<div ui-view></div>
	</div>
</body>
<script src="js/all.js"></script>
</html>