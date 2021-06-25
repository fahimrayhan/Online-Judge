@extends("pages.administration.contest.contest")
@section('title', 'Contest Overview')
@section('contest-sub-content')

<style type="text/css">
    .contstFormBlock{
        font-size: 15px;
        font-weight: bold;
    }

fieldset {
  background-color: #f9f9f9;
  border: 1px solid #eeeeee;
  padding: 5px;
  border-radius: 5px;
  margin-top: 15px;
}

legend {
  background-color: gray;
  color: white;
  width: 180px;
  font-size: 15px;
  padding: 2px;
  margin-left: 15px;
  border-radius: 5px;
  font-weight: bold;
}

.labelHint{
    font-size: 12px;
    color: #aaaaaa;
    margin-top: 2px;
}

.footerSave{
    background-color: transparent;
    height: 15px;
    width: 100%;
    border: 0px solid #C2C7D0;
    border-width: 0px 0px 0px 0px;
    padding: 5px 10px 45px 55px;
    text-align: right;
}
</style>
<div class="form-horizontal">
    <form action="" id="updateContestForm" method="post">
        <fieldset>
            <legend>
                <center>
                    Contest Info
                </center>
            </legend>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Contest Name ">
                    Contest Name:
                </label>
                <div class="col-sm-9">
                    <input class="form-control" name="name" placeholder="Contest Name" required="" value="{{$contest->name}}">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Contest Format ">
                    Contest Format:
                </label>
                <div class="col-sm-9">
                    <select class="form-control" name="format">
                        <option value="ioi" {{$contest->format == "ioi" ? "selected" : ""}}>
                            IOI
                        </option>
                        <option value="icpc" {{$contest->format == "icpc" ? "selected" : ""}}>
                            ICPC
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Start Time ">
                    Start Time: 
                </label>
                <div class="col-sm-9">
                    <input class="form-control" name="start" placeholder="Start Time" type="datetime-local" value="{{$contest->start->format('Y-m-d')."T".$contest->start->format('H:i')}}">
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Duration ">
                    Duration:
                </label>
                <div class="col-sm-9">
                    <input class="form-control" min="1" name="duration" placeholder="Duration" required="" type="number" value="{{$contest->duration}}">
                        <small class="form-text text-muted">
                            Contest duration in minutes
                        </small>
                        <br/>
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Contest Publish ">
                    Contest Publish:
                </label>
                <div class="col-sm-9">
                    <input {{$contest->publish ? "checked" : ""}} style="margin-top: 10px;" name="publish" type="checkbox" value="true">
                    </input>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                <center>
                    Contest Description
                </center>
            </legend>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Contest Banner ">
                    Contest Banner:
                </label>
                <div class="col-sm-9">
                    <input class="form-control" name="banner" onkeyup="contestBannerImgPreview(this)" placeholder="Contest Banner" value="user_file/user_upload/c84124fa083ca884f1319e64a96b6c69ce0670f00ce0a80cfbbe060e1c108b89.png">
                        <small class="form-text text-muted">
                            You can upload banner using CoderOJ
                            <a href="javascript:viewFileManager();">
                                file manager
                            </a>
                        </small>
                        <br/>
                        <img class="img-thumbnail" id="contestBannerPreview" src="user_file/user_upload/c84124fa083ca884f1319e64a96b6c69ce0670f00ce0a80cfbbe060e1c108b89.png" style="height: 150px;margin-top: 10px"/>
                    </input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Contest Description ">
                    Contest Description:
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="description" name="contestDescription" placeholder="Contest Description">
                        <p>
                            Hello bangladesh
                        </p>
                    </textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>
                <center>
                    Contest Privacy
                </center>
            </legend>
            <div class="form-group">
                <label class="control-label col-sm-3" for=" Contest Visibility ">
                    Contest Visibility:
                </label>
                <div class="col-sm-9">
                    <select class="form-control" name="contestVisibility" onchange="selectContestVisibility(this)">
                        <option value="public">
                            Public - any one can registration and participate
                        </option>
                        <option value="protected">
                            Protected - any one can registration and participate but before registration need password
                        </option>
                        <option value="private">
                            Private - only invited user can participate
                        </option>
                    </select>
                </div>
            </div>
            <div id="contestRegistraionFormInputArea" style="display: block">
                <div id="contestPassword" style="display: none">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for=" Contest Password ">
                            Contest Password:
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" name="contestPassword" placeholder="Contest Password" value="123">
                                <small class="form-text text-muted">
                                    User need this password before registration
                                </small>
                                <br/>
                            </input>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for=" Registration Close ">
                        Registration Close:
                    </label>
                    <div class="col-sm-9">
                        <input class="form-control" name="registrationClose" placeholder="Registration Close" type="datetime-local" value="2021-03-24T09:20">
                            <small class="form-text text-muted">
                                After this time user can not registration this contest.
                            </small>
                            <br/>
                        </input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for=" Registration Auto Accept ">
                        Registration Auto Accept:
                    </label>
                    <div class="col-sm-9">
                        <input checked="" style="margin-top: 10px" name="registrationAutoAccept" type="checkbox" value="true">
                        </input>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="footer navbar-fixed-bottom footerSave">
            <button id="saveContestDataBtn" type="submit">
                Save Changes
            </button>
        </div>
    </form>
</div>
@stop
