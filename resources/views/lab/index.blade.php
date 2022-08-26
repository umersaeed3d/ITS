@extends('layouts.dashboard_app')
@section('main')
<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Lab Management</h3>
            <i id="modal-btn" class='bx bx-plus-circle' style="font-size: 30px; color: green;"></i>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Add Lab</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/labs" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="addInvBody">


                                <div class="invInputContainer">
                                    <input type="text" placeholder="Lab Name"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="name" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="text" placeholder="Lab Code"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="code" />
                                </div>

                                <select name="incharge_id" id="lab" style="color: #696969; font-family: Roboto Slab, serif, 'Font Awesome 5 Free'; width: 100%;">
                                    <option value="none" selected disabled hidden>Select Lab Incharge</option>
                                    @foreach ($labIncharge as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }} - {{ $user->user_name }}</option>
                                    @endforeach
								</select>



                            </div>
                            <div class="addButton">
                                <button type="submit">Add Lab</button>
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
                    <th>Code</th>
                    <th>Lab Incharge Name</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $lab)
                    <tr>
                        <td>{{ $lab->name }}</td>
                        <td>{{ $lab->code }}</td>
                        <td>{{ $lab->incharge->full_name }}</td>
                        <td>{{ $lab->created_at->format('d/m/Y') }}</td>
                        <td><form action="/labs/{{ $lab->id }}" method="POST"> @csrf @method('delete') <button type="submit"><span class="status pending">Delete</span></button></form></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
<script type="text/javascript">


        $('#sidebar .side-menu.top li').removeClass('active');
        $('#labs').addClass("active");


</script>
@endsection
