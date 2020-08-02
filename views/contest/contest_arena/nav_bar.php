
<style>
  .contestNavBody{
    background-color: #ffffff;
    border-width: 0px;
    box-shadow: 0 0 4px 1px #aaaaaa;
    padding: 1px 0px 1px 0px;
  }
  .contestNavBtn{
    background-color: #F3F3F3;
    border: 1px solid #BBBBBB;
    color: #555555;
    font-weight: bold;
    font-family: "Exo 2";
  }
  .contestNavBtn:hover{
    background-color: #565C66;
    color: #ffffff;
  }
  .contestNavBtnActive{
    background-color: #565C66;
    color: #ffffff;
    font-family: "Exo 2";
  }
  .contestNavBody a{
    text-decoration: none;
  }
</style>

<?php 
  $activeList = $pageList;
  $activeList[$actionPage=="problem"?"dashboard":$actionPage] = "contestNavBtnActive";

?>

<nav class="navbar navbar-inverse navbar-fixed-top contestNavBody">
  <div class="container">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="" href="index.php"><img src="http://coderoj.com/user_file/user_upload/2dd22fd594d515efd721e4918a52c1ee7605f979b446cdd58560b8d6d9dcf1b7.png" height="45px"></a>
    </div>
    <div class="pull-right">
        <a href="contest_arena.php?id=<?php echo $contestId; ?>&dashboard">
          <button class="btn navbar-btn contestNavBtn <?php echo $activeList['dashboard']; ?>"><i class="fa fa-dashboard"></i> Dashboard</button>
        </a>
        <a href="">
          <button class="btn contestNavBtn">Clarifications (4)</button>
        </a>
        
        <a href="contest_arena.php?id=<?php echo $contestId; ?>&standings">
          <button class="btn contestNavBtn <?php echo $activeList['standings']; ?>"><i class="fas fa-trophy"></i> Standings</button>
        </a>
        <a href="contest_arena.php?id=<?php echo $contestId; ?>&submissions">
          <button class="btn contestNavBtn <?php echo $activeList['submissions']; ?>"><i class="fas fa-list"></i> Submissions</button>
        </a>
        
        <button class="btn contestNavBtn" style="margin-left: 20px">amirhamza05</button>
        <button class="btn contestNavBtn">Logout</button>
    </div>
    
  </div>
  </div>
</nav>
