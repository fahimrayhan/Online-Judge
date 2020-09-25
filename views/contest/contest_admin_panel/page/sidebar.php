<div class="row">
    <div class="col-md-12">
      <div class="contest-dashboard-card-box">
      <div class="contest-dashboard-card">
        <i class="fa fa-clock dashboardIcon"></i>
        <span class="count-numbers">04:04:15</span>
        <span class="count-name">Running</span>
      </div>
  </div>
    </div>
    <div class="col-md-12">
      	<div class="contest-dashboard-card-box">
      		<div class="contest-dashboard-card" style="padding: 10px;height: auto;">
      			<button class="contestDashboardBtn sidebarBtn">
              <i class="fa fa-sign-in"></i> Areana
            </button>
      			<button class="contestDashboardBtn sidebarBtn">
              <i class="fa fa-trophy"></i> Standing
            </button>
      		</div>
  		</div>
    </div>
    <div class="col-md-12">
      	<div class="contest-dashboard-card-box">
      		<div class="contest-dashboard-card" style="padding: 10px;height: auto;">
            <a href="contest_dashboard.php?id=<?php echo $contestId; ?>">
              <button class="contestDashboardBtn sidebarBtn">
                <i class="fa fa-tachometer"></i> Dashboard
              </button>
            </a>
            <a href="contest_dashboard.php?id=<?php echo $contestId; ?>&edit">
              <button class="contestDashboardBtn sidebarBtn">
                <i class="fa fa-pencil"></i> Edit
              </button>
            </a>
            <a href="contest_dashboard.php?id=<?php echo $contestId; ?>&problems">
              <button class="contestDashboardBtn sidebarBtn">Problems</button>
            </a>
      			<button class="contestDashboardBtn sidebarBtn">Announcement</button>
      			<button class="contestDashboardBtn sidebarBtn">Clearifications</button>
      		</div>
  		</div>
    </div>

    <div class="col-md-12">
        <div class="contest-dashboard-card-box">
          <div class="contest-dashboard-card" style="padding: 10px;height: auto;">
            <a href="contest_dashboard.php?id=<?php echo $contestId; ?>&generate_user">
              <button class="contestDashboardBtn sidebarBtn">Generate User</button>
            </a>
            <a href="contest_dashboard.php?id=<?php echo $contestId; ?>&registration">
              <button class="contestDashboardBtn sidebarBtn">Registration List</button>
            </a>
            <a href="contest_dashboard.php?id=<?php echo $contestId; ?>&form">
              <button class="contestDashboardBtn sidebarBtn">Form</button>
            </a>
          </div>
      </div>
    </div>
</div>