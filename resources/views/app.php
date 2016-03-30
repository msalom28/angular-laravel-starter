<!DOCTYPE html>
<html class="no-js" lang="en" ng-app="MyApp">
<head>
	<meta charset="UTF-8">
	<title>My App</title>
		<link rel="stylesheet" href="css/app.css">
		<nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">	          
	          <a class="navbar-brand" href="#">My App</a>
	        </div>
	        <div ng-if="authenticated" class="collapse navbar-collapse">
	        <ul class="nav navbar-nav navbar-right">	           
	           <li class="dropdown" dropdown>
			    <a href="" class="dropdown-toggle" dropdown-toggle>
			        {{ currentUser.name }} <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu" dropdown-menu>			      
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