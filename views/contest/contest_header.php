<style type="text/css">


.timer{
	width: 18px;
	padding: 5px;
	font-weight: bold;
	font-size: 18px;
	background-color: #E74C3C;
	border-color: #E74C3C;
	border-width: 1px;
	border-style: solid;
	border-radius: 5px;
}


.contest_head_menu{
	text-align: center;
	color: #ffffff;
	background-color: #2C3542;
	border-radius: 0px 0px 150px 150px;
    height: 110px;
 	padding-bottom: 3px;
 	margin-bottom: 25px;
 	margin-top: -25px;

}
.contestStatus{
	font-size: 20px;
	font-family: "Lucida Console", Monaco, monospace;
 	margin-top: 5px;
}

.contest_time{
	font-size: 15px;
}
.dashboard_left_panel_head{
	background-color: var(--menu_header);
	color: #ffffff;
	padding: 15px;
	font-size: 17px;
	font-weight: bold;

}

.contestNavBtn{
	background: #ffffff;
	padding: 20px 4px 20px 4px;
	text-align: center;
	font-size: 14px;
	font-weight: bold;
	border: 1px solid #F8F5F0;
	border-width: 0px 1px 0px 0px;
	color: #535c68;
	font-family: "Lucida Console", Monaco, monospace;
}
.contestNav{
	background: #ffffff;
	box-shadow: 2px 2px 2px 2px #888888;
	margin-top: -18px;
	
}

@media only screen and (min-width: 600px) {
  .contestNav{
  	position: -webkit-sticky;
  	position: sticky;
  	top: 60px;
  	z-index: 99999!important;
  }
}

.contestNavBtn:hover{
	background: var(--bg-color);
	color: #ffffff;
}
.contestNavBtnActive{
	background: var(--bg-color);
	color: #ffffff;
}

.contestTitleArea{
	margin : 30px 0px 30px 0px;
	text-align: center;
	padding: 0px 20px 0px 20px;
}
.contestTitle{
	font-size: 20px;
	color: #3E3F3A;

 	font-family: "Lucida Console", Monaco, monospace;
 	margin-bottom: 5px;
}
.contestTime{
	font-size: 18px;
	color: #52544e;
 	
 	font-family: "Lucida Console", Monaco, monospace;
}
</style>


<div class="row contestNav">
	<a href="contest.php?id=4&p=dashboard"><div class="col-md-3 col-sm-6 contestNavBtn contestNavBtnActive"><i class="fas fa-trophy"></i> DASHBOARD</div></a>
	<a href="daf"><div class="col-md-3 col-sm-6 contestNavBtn"><i class="fas fa-alert"></i> CL</div></a>
	<a href="contest.php?id=4&p=ranklist"><div class="col-md-3 col-sm-3 contestNavBtn"><i class="fas fa-trophy"></i> STAN</div></a>
	<a href="daf"><div class="col-md-3 col-sm-3 contestNavBtn" style="border-width: 0px"><i class="fas fa-list"></i> SUBM</div></a>
</div>
<div style="margin-bottom: 20px"></div>