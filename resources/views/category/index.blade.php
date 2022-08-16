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
                        <form action="/categories/" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="addInvBody">

                                <div style="float: right;">
                                    <i style="padding:5px; font-size: 40px;" class='bx bx-barcode-reader'></i>
                                </div>
                                <div class="invInputContainer">
                                    <input type="text" placeholder="&#xf49e; Category Name"
                                        style="font-family: Roboto Slab, serif, 'Font Awesome 5 Free';" name="name" />
                                </div>
                                <div class="invInputContainer">
                                    <input type="file" placeholder="&#xf49e; Upload Image"
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

            <li>
                <a class="menuBtn">
                    <i class='bx bx-minus-circle' style="font-size: 30px; color: red;"></i>
                </a>
            </li>
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
                        <td>{{ $category->created_at->format('d/m/Y') }}</td>
                        <td><form action="/categories/{{ $category->id }}" method="POST"> @csrf @method('delete') <button type="submit"><span class="status pending">Delete</span></button></form></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

</div>
@endsection
