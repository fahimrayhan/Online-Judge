<div class="testCaseDetailBodyArea">
                                <div class="testCaseDetailHeader" style="border-radius: 2px 2px 0px 0px">Input</div>
                                <div class="testCaseDetailBody" id="submission_test_case_input_{{$testCase->id}}">
                                    {!!nl2br($testCase->input)!!}
                                </div>
                            </div>
                            <div class="testCaseDetailBodyArea">
                                <div class="testCaseDetailHeader">Output</div>
                                <div class="testCaseDetailBody" id="submission_test_case_output_{{$testCase->id}}">
                                    {!!nl2br($testCase->output)!!}
                                </div>
                            </div>
                            <div class="testCaseDetailBodyArea">
                                <div class="testCaseDetailHeader">Answer</div>
                                <div class="testCaseDetailBody" id="submission_test_case_expected_output_{{$testCase->id}}">
                                    {!!nl2br($testCase->expected_output)!!}
                                </div>
                            </div>
                            @if(($testCase->verdict->id != 6 && $testCase->verdict->id != 7) || ($testCase->verdict->id<3))
                            <div class="testCaseDetailBodyArea" id="submission_test_case_checker_log_area_{{$testCase->id}}">
                                <div class="testCaseDetailHeader"><i class="fa fa-gavel"></i> Checker Log</div>
                                <div class="testCaseDetailBody" id="submission_test_case_checker_log_{{$testCase->id}}">
                                    {!!nl2br($testCase->checker_log)!!}

                                </div>
                            </div>
                            @endif
                            @if(($testCase->verdict->id == 6 || $testCase->verdict->id == 7) || ($testCase->verdict->id<3))
                            <div class="testCaseDetailBodyArea" id="submission_test_case_compiler_log_area_{{$testCase->id}}">
                                <div class="testCaseDetailHeader"><i class="fa fa-bug"></i> Compiler Log</div>
                                <div class="testCaseDetailBody" id="submission_test_case_compiler_log_{{$testCase->id}}">
                                    {!!nl2br($testCase->compiler_log)!!}
                                </div>
                            </div>
                            @endif
