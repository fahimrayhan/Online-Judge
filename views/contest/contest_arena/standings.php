
<link rel="stylesheet" type="text/css" href="">

<style type="text/css">
	.table-standings thead tr th:nth-child(1),.table-standings tbody tr td:nth-child(1){
    width:48px;
    text-align:center
}
.table-standings thead tr th:nth-child(n+4),.table-standings tbody tr td:nth-child(n+4){
    width:64px;
    text-align:center
}
.table-standings tbody tr td .label{
    display:block
}
.table-standings tbody tr td .label:first-child{
    border-radius:.25em .25em 0 0
}
.table-standings tbody tr td .label:last-child{
    border-radius:0 0 .25em .25em
}
.table-standings td:nth-child(n+3) a{
    text-decoration:none
}
.table tbody tr td{
    vertical-align:middle
}
.label{
	min-width: 50px;
}


.label-success{
	background: #41C281;

}
.label-default{
	background: #2c3e50;
}

.label-info{
	background: #2980b9;
}

.label-warning{
	background: #E87F35;
}

.rankList{
	padding: 5px;
}

tr{
	border-color: #3742fa!important;
}

th{
	background: #ffffff;
}

.teamName{
	color: #297FB9!important;
    font-family: "Exo 2";
    font-weight: bold;
    font-size: 14px;
}

.teamNameSub{
    font-size: 13px;
    color: #706788;
    margin-top: -2px;
}

.contestStandingTable th{
    border-width: 0px!important;
    border-color: #eeeeee!important;
}

.contestStandingTable td{
    border-width: 1px!important;
    border-color: #F3F5F8!important;
}

.acLabel{
    background-color: #41C281!important;
}
.waLabel{
    background-color: #E35B5A!important;
}
</style>


<div class="row">
    <div class="col-md-12">
    	<div class="contestBox">
    	<div class="contestBoxHeader">Rank List</div>
        <div class="contestBoxBody contestStandingTable" style="padding: 0px">
            <div class="table-responsive">
                <table data-reload="no" class="table table-standings">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">#</th>
                            <th rowspan="2" style="vertical-align: middle;">Name</th>
                            <th rowspan="2" style="width: 64px;"></th>
                            <th rowspan="2" style="width: 24px;"></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/A">A</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/B">B</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/C">C</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/D">D</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/E">E</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/F">F</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/G">G</a></th>
                            <th style="width: 64px;"><a href="/contests/awf-19/problems/H">H</a></th>
                            
                        </tr>
                        <tr>
                            <th class="text-center">0/2</th>
                            <th class="text-center">52/53</th>
                            <th class="text-center">29/29</th>
                            <th class="text-center">50/52</th>
                            <th class="text-center">30/36</th>
                            <th class="text-center">0/0</th>
                            <th class="text-center">6/21</th>
                            <th class="text-center">52/52</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php for($i=5; $i<=20; $i++){ ?>
                        <tr data-id="5e1e73d227f0ba0400c43465">
                            <td>1</td>
                            <td style="min-width: 250px;">
                                <a href="/users/awf19_53">
                                    <div class="teamName">Sk. Amir Hamza</div>
                                </a>
                                <div class="teamNameSub">[EWU] [Spring 17]</div> 
                            </td>
                            <td>
                                <a  href="/contests/awf-19/submissions/for?user=awf19_53">
                                    <div class="label label-info">10</div>
                                    <div class="label label-default">1350</div>
                                </a>
                                <td style="width: 26px;"></td>
                            </td>
                           
                            <td>
                                 <?php 
                                if(rand()%3==1){

                                ?>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=B">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">1 (9)</div>
                                </a>
                                <?php } ?>
                            </td>
                            
                            <td>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=B">
                                    <div class="label waLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">1 (9)</div>
                                </a>
                            </td>
                            <td>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=C">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">1 (113)</div>
                                </a>
                            </td>
                            <td>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=D">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">2 (52)</div>
                                </a>
                            </td>
                            <td>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=E">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">2 (119)</div>
                                </a>
                            </td>
                            <td>
                                 <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=B">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">1 (9)</div>
                                </a>
                            </td>
                            <td>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=G">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">2 (281)</div>
                                </a>
                            </td>
                            <td>
                                <a href="/contests/awf-19/submissions/for?user=awf19_53&amp;problem=H">
                                    <div class="label acLabel">
                                        <div class="fa fa-check"></div>
                                    </div>
                                    <div class="label label-default">1 (22)</div>
                                </a>
                            </td>

                            
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
            	</div>
            	</div>
        	</div>
    	</div>