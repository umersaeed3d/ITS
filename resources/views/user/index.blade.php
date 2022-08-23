@extends('layouts.dashboard_app')
@section('main')
<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>User Management</h3>
            <i id="modal-btn" class='bx bx-plus-circle' style="font-size: 30px; color: green;"></i>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Add User</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/users/" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="addInvBody">


                                <div class="invInputContainer">
                                    <input type="text" placeholder="&#xf49e; Full Name"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="full_name" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="text" placeholder="&#xf49e; User Name"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="user_name" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="email" placeholder="&#xf49e; Email"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="email" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="text" placeholder="&#xf49e; Password"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="password" />
                                </div>

                                <select name="role_id" id="lab" style="color: #696969; font-family: Roboto Slab, serif, 'Font Awesome 5 Free'; width: 100%;">
                                    <option value="none" selected disabled hidden>&#xf109; Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
								</select>



                            </div>
                            <div class="addButton">
                                <button type="submit">Add User</button>
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
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ ($user->created_at !== null) ? $user->created_at->format('d/m/Y') : 'NULL' }}</td>
                        <td><form action="/users/{{ $user->id }}" method="POST"> @csrf @method('delete') <button type="submit"><span class="status pending">Delete</span></button></form></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
<script type="text/javascript">


        $('#sidebar .side-menu.top li').removeClass('active');
        $('#users').addClass("active");


</script>
@endsection
