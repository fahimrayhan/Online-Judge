<style type="text/css">
	.contest-dashboard-card-box{
		margin-bottom: 24px;
		box-shadow: 1px 1px 3px #DADADA;
		border: 1px solid #F1F1F1;
		border-radius: 5px;
	}
	.contest-dashboard-card{
		padding: 0px;
		height: 90px;
    	overflow: hidden;
    	background-color: #ffffff;
    	border-radius: 5px;
  }

  .dashboardIcon{
    font-size: 5.9em;
    margin-left: -10px;
    margin-top: 15px;
    color: #646060;
    opacity: 0.1;
  }
  .contest-dashboard-card .count-numbers{
    position: absolute;
    right: 35px;
    top: 25px;
    font-size: 27px;
    font-weight: bold;
    color: #606060;
    display: block;
  }

  .contest-dashboard-card .count-name{
    position: absolute;
    right: 35px;
    top: 53px;
    font-style: normal;
    opacity: 1;
    display: block;
    font-weight: bold;
    font-size: 13px;
    color: #606060;
  }
  .box{
  	box-shadow: 2px 2px 10px #DADADA!important;
  }
  .col-md-4,.col-md-12{
  	padding-left: 13px;
  	padding-right: 13px;
  }
  .seeAllCard{
  	background-color: #F6F6F6;
  	color: #606060;
  	padding: 2px 5px 2px 5px;
  }
   .seeAllCard:hover{
    
   	cursor: pointer;
   	color: #000000;
  }
  .contestDashboardBtn{
  	border: 1px solid #eeeeee;
    background-color: #ffffff;
  	color: #606060;
  	font-weight: bold;
  	margin-bottom: 5px;
  }
  .contestDashboardBtn:hover{
  	background-color: #eeeeee;
    border: 1px solid #aaaaaa;
  	color: #000000;
  }
  .contestTitle{
  	color: #606060;
  	margin-bottom: 15px;
  }
  a:hover{
    text-decoration: none;
    font-size: 14px;
  }
  .cardBoxHeader{
  	font-size: 16px;
  	font-weight: bold;
  	margin-bottom: 10px;
  	padding-bottom: 5px;
  	border: 1px solid #f5f5f5;
  	border-width: 0px 0px 1px 0px;
  }

  .contestTd1{
    border: 1px solid #eeeeee;
    background-color: #f8f8f8;
    padding: 8px 3px 8px 3px;
    font-weight: bold;
  }
  .contestTd2{
    border: 1px solid #eeeeee;
    padding: 3px;
    text-align: center;
  }
  .sidebarBtn{
    width: 100%;
    text-align: left;
  }
</style>

<?php 
	$contestId = 3;
	include "views/contest/contest_admin_panel/page_list.php";
	$getPage = "dashboard";

	foreach ($contestPageList as $key => $value) {
		if(isset($_GET[$key]))$getPage = $key;
	}

	$contestPageData = $contestPageList[$getPage];
	$contestInfo = $Contest->getContestInfo($contestId);
?>
<script type="text/javascript">
  var contestId = <?php echo $contestId; ?>;
</script>


<div class="row">
	<div class="col-md-3">
		<?php include "views/contest/contest_admin_panel/page/sidebar.php" ?>
	</div>
	<div class="col-md-9">
		<div class="contestTitle">
			<a>Contest</a>  
			> <a href="contest_dashboard.php"><?php echo $contestInfo['contestName']; ?> </a>  
			> <?php echo $contestPageData['title']; ?>
		</div>
		<?php 
      if($getPage == "dashboard")include "views/contest/contest_admin_panel/page/$getPage.php";
      else include "views/contest/contest_admin_panel/get_page.php";
    ?>
	</div>
</div>
<script type="text/javascript" src="views/contest/contest_admin_panel/js/contest_dashboard.js"></script>