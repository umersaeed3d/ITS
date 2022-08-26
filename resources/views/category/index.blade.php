@extends('layouts.dashboard_app')
@section('main')
<div class="table-data">
    <div class="order">
        <div class="head">
            <h3>Category Management</h3>
            <i id="modal-btn" class='bx bx-plus-circle' style="font-size: 30px; color: green;"></i>
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Add Category</h2>
                    </div>
                    <div class="modal-body">
                        <form action="/categories" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="addInvBody">

                                <div class="invInputContainer">
                                    <input type="text" placeholder="Category Name"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="name" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="file" placeholder="Upload Image"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="image" />
                                </div>



                            </div>
                            <div class="addButton">
                                <button type="submit">Add Category</button>
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
                    <th>Image</th>
                    <th>Status</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td><img src="{{ $category->image }}" alt="image"></td>
                        <td>
                            @if($category->is_active == 0)
                            <span class="status pending">Disabled</span>
                            @else
                            <span class="status completed">Active</span>
                            @endif
                        </td>
                        <td>{{ ($category->created_at !== null) ? $category->created_at->format('d/m/Y') : 'NULL' }}</td>
                        <td><form action="/categories/{{ $category->id }}" method="POST"> @csrf @method('delete') <button type="submit"><span class="status pending">Delete</span></button></form></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" type="text/javascript"></script>
<script type="text/javascript">


        $('#sidebar .side-menu.top li').removeClass('active');
        $('#categories').addClass("active");


</script>
@endsection
