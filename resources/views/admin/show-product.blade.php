<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">
                <div id="flash_message">
                    @include('flash::message')
                </div>
                <div class="container">
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>price</th>
                                <th>Discount Price</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_data as $pdt_data)
                                <tr>
                                    <td>{{ $pdt_data->id }}</td>
                                    <td>{{ $pdt_data->title }}</td>
                                    <td>{{ $pdt_data->description }}</td>
                                    <td>{{ $pdt_data->quantity }}</td>
                                    <td>{{ $pdt_data->category }}</td>
                                    <td>{{ $pdt_data->price }}</td>
                                    <td>{{ $pdt_data->discount_price }}</td>
                                    <td>
                                        <img src="product/{{ $pdt_data->image }}" alt="" class="image_size">
                                    </td>
                                    <td>
                                        <a href="{{url('edit-product')}}/{{ $pdt_data->id }}" class="btn btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{url('delete-product')}}/{{ $pdt_data->id }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
        </footer> -->
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>
