@extends("pages.administration.contest.contest")
@section('title', 'Contest Overview')
@section('contest-sub-content')

@php
   // dd($tableColumn);

    $columnArray = json_decode($tableColumn);

@endphp

<script type="text/javascript">

    $(document).ready(function() {
    registrationTable = $('#registrationTable').DataTable({
        'processing': true,
        'responsive': true,
        'serverSide': true,
        'serverMethod': 'post',
        'scrollX': true,
        "order": [[ 1, "desc" ]],
        
        'ajax': {
            'url':'http://127.0.0.1:8000/administration/contests/4/registrations',
            'data': {
                'contestId': 4,
                'contestRegistrationList': 1,
                '_token' : app.token
             // etc..
            }
        },
        'columns': {!!$tableColumn!!}
   });
    
} );
  function checkAllRegistrationList(e){
    $("input[name='contestRegistrationList[]']").attr('checked', e.checked);
  }

</script>

<table id="registrationTable" style="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
        <tr>
                @foreach($columnArray as $key => $value)

                    <td class="contestTd1">{{$value->data}}</td>
                @endforeach
                    
                    
                </tr>
    </thead>
</table>

@stop
