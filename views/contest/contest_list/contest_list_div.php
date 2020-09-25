<style type="text/css">
	contest-card{
        display: block;
        border-radius: 4px;
        color: #7a8e97;
        background: #fff;
        padding: 10px 12px 10px 12px;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-bottom: 5px;
        box-shadow: 0 0 2px 1px #eeeeee;
	}
	contest-card:hover{
		background-color: #f7f7f7;
	}
	contest-card > date-div{
        display: block;
        color: #ABABAB;
        padding-right:1rem;
        flex-shrink: 0;
        flex-grow: 0;
        float: left;
    }

    contest-card > date-div > .sm-date{
        display: block;
        font-size: 25px;
        text-transform: uppercase;
        font-weight: bold;
        line-height: 1;
        margin-bottom: 0;
    }

    contest-card > date-div > .sm-month{
        text-transform: uppercase;
        font-weight: normal;
        line-height: 1;
        margin-bottom: 0;
        font-size: 12px;
    }

    contest-card > date-div > .sm-time{
        text-transform: uppercase;
        font-weight: normal;
        line-height: 0;
        font-size: 11px;
    }

    contest-card > info-div{
        flex-shrink: 1;
        flex-grow: 1;
    }

    contest-card > info-div .sm-contest-title{
        color: #6B6B6B;
        line-height: 6px;
        font-size: 21px;
        margin-bottom: 15px;
    }

    contest-card > info-div .sm-contest-type{
        color:#fff;
        font-weight: normal;
    }

    contest-card > info-div .sm-contest-time{
        padding-left:1rem;
        font-size: 13px;
    }

    contest-card > info-div .sm-contest-scale{
        padding-left:1rem;
        font-size: .85rem;
    }

    a:hover{
    	text-decoration: none;
    }

    .visibilityFlag{
    	background-color: #69b3d3;
    }
    .contestTypeFlag{
    	background-color: #9D4FB1;
    }
</style>
<div class="box">
<div class="boxHeader">Past Contest</div>
<div class="boxBody">
<?php for($i=1;$i<=5; $i++){ ?>
<a href="contest.php?id=3">
<contest-card>
	<date-div>
        <p class="sm-date">27</p>
        <small class="sm-month">Nov, 2019</small><br/>
        <small class="sm-time">03:22 PM</small>
    </date-div>
    <info-div>
        <h5 class="sm-contest-title">
            EWU Programming Contest Contest
        </h5>
        <p class="sm-contest-info">
            <span class="badge badge-pill wemd-amber sm-contest-type visibilityFlag"><i class="MDI trophy"></i> ICPC</span>
            <span class="badge badge-pill wemd-amber sm-contest-type contestTypeFlag"><i class="MDI trophy"></i> Public</span>
            <span class="sm-contest-time"><i class="fa fa-clock-o" aria-hidden="true"></i> 5 Hours</span>
        </p>
    </info-div>
</contest-card>
</a>
<?php } ?>
</div>
</div>

