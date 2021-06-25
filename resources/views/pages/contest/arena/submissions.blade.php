@extends('layouts.contest_layout')
@section('title', 'Submissions')
@section('content')
<style type="text/css">
    .filterBox{
		background-color: #ffffff!important;
		height: 45px;
		margin-bottom: 5px;
	}
</style>
<div class="row">
    <div class="col-md-9">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Submission |
                <a href="contest_arena.php?id=3&submissions&user=1">
                    My
                </a>
            </div>
            <div class="" style="padding: 0px;">
                <div class="table-responsive">
                    <table width="100%">
                        <tr>
                            <td class="td1">
                                #
                            </td>
                            <td class="td1">
                                When
                            </td>
                            <td class="td1">
                                Who
                            </td>
                            <td class="td1">
                                Problem Name
                            </td>
                            <td class="td1">
                                Lang
                            </td>
                            <td class="td1">
                                Verdict
                            </td>
                            <td class="td1">
                                Time
                            </td>
                        </tr>
                    </table>
                </div>
                <center>
                    <nav aria-label="...">
                        <ul class="pagination">
                        </ul>
                    </nav>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="contestBox">
            <div class="contestBoxHeader">
                Filter
            </div>
            <div class="contestBoxBody">
                <input class="form-control filterBox" id="filterUser" name="" placeholder="User Id" type="number" value="">
                    <select class="form-control filterBox" id="filterProblem">
                        <option value="-1">
                            Any Problem
                        </option>
                        <option value="A">
                            A
                        </option>
                        <option value="B">
                            B
                        </option>
                        <option value="C">
                            C
                        </option>
                        <option value="D">
                            D
                        </option>
                        <option value="E">
                            E
                        </option>
                        <option value="F">
                            F
                        </option>
                    </select>
                    <select class="form-control filterBox" id="filterLanguage">
                        <option value="-1">
                            Any Language
                        </option>
                        <option value="1">
                            C
                        </option>
                        <option value="2">
                            C++
                        </option>
                        <option value="3">
                            C++11
                        </option>
                    </select>
                    <select class="form-control filterBox" id="filterVerdict">
                        <option value="-1">
                            Any Verdict
                        </option>
                        <option value="1">
                            In Queue
                        </option>
                        <option value="2">
                            Processing
                        </option>
                        <option value="3">
                            Accepted
                        </option>
                        <option value="4">
                            Wrong Answer
                        </option>
                        <option value="5">
                            Time Limit Exceeded
                        </option>
                        <option value="6">
                            Compilation Error
                        </option>
                        <option value="7">
                            Runtime Error (SIGSEGV)
                        </option>
                        <option value="8">
                            Runtime Error (SIGXFSZ)
                        </option>
                        <option value="9">
                            Runtime Error (SIGFPE)
                        </option>
                        <option value="10">
                            Runtime Error (SIGABRT)
                        </option>
                        <option value="11">
                            Runtime Error (NZEC)
                        </option>
                        <option value="12">
                            Runtime Error (Other)
                        </option>
                        <option value="13">
                            Internal Error
                        </option>
                        <option value="14">
                            Exec Format Error
                        </option>
                    </select>
                    <button class="btn btn-primary" style="margin-top: 10px; width: 100%">
                        Apply
                    </button>
                </input>
            </div>
        </div>
    </div>
</div>
@stop
