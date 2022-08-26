@extends('layouts.dashboard_app')
@section('main')
<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Inventory Management</h3>
            <i id="modal-btn" class='bx bx-plus-circle' style="font-size: 30px; color: green;"></i>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Add Inventory</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/inventories" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="addInvBody">

                                <div style="float: right;">
                                    {{-- <i style="padding:5px; font-size: 40px;" class='bx bx-barcode-reader'></i> --}}
                                </div>
                                <div class="invInputContainer">
                                    <input type="text" placeholder="Inventory Name"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="name" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="number" placeholder="Inventory Price"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="price" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="text" placeholder="Inventory Desc"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="desc" />
                                </div>

                                <select name="category_id" id="lab" style="color: #696969; font-family: Roboto Slab, serif, 'Font Awesome 5 Free'; width: 100%;">
                                    <option value="none" selected disabled hidden>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
								</select>
                                <select name="user_id" id="lab" style="color: #696969; font-family: Roboto Slab, serif, 'Font Awesome 5 Free'; width: 100%;">
                                    <option value="none" selected disabled hidden>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }} - {{ $user->user_name }}</option>
                                    @endforeach
								</select>
                                <select name="lab_id" id="lab" style="color: #696969; font-family: Roboto Slab, serif, 'Font Awesome 5 Free'; width: 100%;">
                                    <option value="none" selected disabled hidden>Select lab</option>
                                    @foreach ($labs as $lab)
                                        <option value="{{ $lab->id }}">{{ $lab->name }} - {{ $lab->code }}</option>
                                    @endforeach
								</select>



                            </div>
                            <div class="addButton">
                                <button type="submit">Add Inventory</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>


        </div>

        <table>
            <thead>
                <tr>

                    <th>Name</th>
                    {{-- <th>Desc</th>
                    <th>Price</th> --}}
                    <th>Category</th>
                    <th>Status</th>
                    <th>Issue Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->name }}</td>
                        {{-- <td>{{ $inventory->desc }}</td>
                        <td>{{ $inventory->price }}</td> --}}
                        <td>{{ $inventory->category->name }}</td>
                        <td>
                            @if($inventory->is_active == 0)
                            <span class="status pending">Disabled</span>
                            @else
                            <span class="status completed">Active</span>
                            @endif
                        </td>
                        <td>{{ ($inventory->created_at !== null) ? $inventory->created_at->format('d/m/Y') : 'null' }}</td>
                        <td><form action="/inventory/{{ $inventory->id }}" method="POST"> @csrf @method('delete') <button type="submit"><span class="status pending">Delete</span></button></form><br><a href="/inventories/history/{{ $inventory->id }}"><span class="status pending">History</span></a></td>
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
