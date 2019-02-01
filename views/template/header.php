<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/public/lib/bootstrap/js/bootstrap.min.js"></script>

<style>
	body {
  		padding-top: 5rem;
	}
	.starter-template {
		  padding: 40px 15px;
		  text-align: center;
	}

.sub-header {
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}

/*
 *  * Top navigation
 *   * Hide default border to remove 1px line.
 *    */
.navbar-fixed-top {
  border: 0;
}

/*
 *  * Sidebar
 *   */

/* Hide for mobile, show later */
.sidebar {
  display: none;
}
@media (min-width: 768px) {
  .sidebar {
    position: fixed;
    top: 51px;
    bottom: 0;
    left: 0;
    z-index: 1000;
    display: block;
    padding: 20px;
    overflow-x: hidden;
    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
    background-color: #f5f5f5;
    border-right: 1px solid #eee;
  }
}

/* Sidebar navigation */
.nav-sidebar {
  margin-right: -21px; /* 20px padding + 1px border */
  margin-bottom: 20px;
  margin-left: -20px;
}
.nav-sidebar > li > a {
  padding-right: 20px;
  padding-left: 20px;
}
.nav-sidebar > .active > a,
.nav-sidebar > .active > a:hover,
.nav-sidebar > .active > a:focus {
  color: #fff;
  background-color: #428bca;
}


/*
 *  * Main content
 *   */

.main {
  padding: 20px;
}
@media (min-width: 768px) {
  .main {
    padding-right: 40px;
    padding-left: 40px;
  }
}
.main .page-header {
  margin-top: 0;
} 
	
</style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#timecard_navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
<a class="navbar-brand" href="/home/mainpage">TimeCard System</a>
</div>
<div id="timecard_navbar" class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="/home/mainpage">Home</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="clk_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Timecard</a>
<ul class="dropdown-menu" aria-labelledby="clk_dropdown">
<li><a class="dropdown-item" href="/clock">My Timecard</a></li>
<li><a class="dropdown-item" href="/clock/clk_check">Clock In/Out</a></li>
</ul>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="member_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
<ul class="dropdown-menu" aria-labelledby="member_dropdown">
<li><a class="dropdown-item" href="/member">Member List</a></li>
<li><a class="dropdown-item" href="/member/reg_member">Create Member</a></li>
<li><a class="dropdown-item" href="/member/utd_member">Update & Delete Member</a></li>
<li><a class="dropdown-item" href="/clock/clk_mgr">Timecard Manager</a></li>
</ul>
</div>
</li>
</ul>
</div>
</div>
</nav>
<div class="container">
<div class="starter-template">

