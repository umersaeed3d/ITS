@extends('layouts.dashboard_app')

@section('main')
<ul class="box-info">
    <li>
        <i class='bx bxs-package'></i>
        <span class="text">
            <h3>{{ $inventoryCount }}</h3>
            <p>Total Inventory</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-group'></i>
        <span class="text">
            <h3>{{ $userCount }}</h3>
            <p>Total Users</p>
        </span>
    </li>
    <li>
        <i class='bx bxs-card'></i>
        <span class="text">
            <h3>{{ $labCount }}</h3>
            <p>Total Labs</p>
        </span>
    </li>
</ul>


<div class="table-data">

    <div class="order">
        <div class="head">
            <h3>Recent Transfers</h3>
            <!-- <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i> -->
        </div>
        <table>
            <thead>

                <tr>
                    <th>Inventory</th>
                    <th>Initial Lab</th>
                    <th>Final Lab</th>
                    <th>Alloted To</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $iH)
                <tr>
                    <td>
                        <p>{{ $iH->inventory->name }}</p>
                    </td>
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
    @if(in_array('inventory_transfer',Session::get('permissions')))
    <div class="transfer">
        <div class="head">
            <h3>Transfer</h3>
            {{-- <i style="padding:5px; font-size: 30px;" class='bx bx-barcode-reader'></i> --}}
        </div>
        <form action="/inventories/transfer" method="post">
            @csrf
            <div class="transferBody">
                <div style="margin-top: 10px;">
                    <i class='bx bxs-package' style="font-size: 15px;"></i>
                    <label style="font-size: 20px;">Inventory:</label>

                    <select name="inventory" id="inventory">
                        <option value="none" selected disabled hidden>Select Inventory</option>
                        @foreach ($inventories as $inventory)
                            <option value="{{ $inventory->id }}">{{ $inventory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-top: 10px;">
                    <i class='bx bxs-group' style="font-size: 15px;"></i>
                    <label style="font-size: 20px;">User:</label>

                    <select name="user" id="user">
                        <option value="none" selected disabled hidden>Select User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                        @endforeach

                    </select>
                </div>

                <div style="margin-top: 10px;">
                    <i class='bx bxs-card' style="font-size: 15px;"></i>
                    <label style="font-size: 20px;">Lab:</label>

                    <select name="lab" id="lab">
                        <option value="none" selected disabled hidden>Select Lab</option>
                        @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->name }} - {{ $lab->code }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="transferButton">
                <button type="submit">Transfer</button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection
