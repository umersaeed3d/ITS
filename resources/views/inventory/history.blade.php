@extends('layouts.dashboard_app')
@section('main')
<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Inventory History</h3>

        </div>

        <table>
            <thead>
                <tr>

                    <th>Name</th>
                    <th>Initial Lab</th>
                    <th>Final Lab</th>
                    <th>Allocated To</th>
                    <th>Issue Date</th>
                    <th>Transfer Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $iH)
                    <tr>
                        <td>{{ $iH->inventory->name }}</td>
                        <td>{{ $iH->initialLab->name }}</td>
                        <td>@if($iH->final_lab_id !== null){{ $iH->finalLab->name }}@else NULL @endif</td>
                        <td>{{ $iH->username }}</td>
                        <td>{{ $iH->issue_date }}</td>
                        <td>{{ ($iH->receive_date !== null) ? $iH->receive_date : 'NULL'  }}</td>
                        <td>
                            @if($iH->receive_date == null)
                            <span class="status pending">Pending</span>
                            @else
                            <span class="status completed">Completed</span>
                            @endif
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
<script type="text/javascript">


        $('#sidebar .side-menu.top li').removeClass('active');
        $('#inventories').addClass("active");


</script>
@endsection
