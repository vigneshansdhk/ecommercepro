<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        table,
        th,
        td {
            border: 1px solid white;
        }
    </style>
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
                <div class="container-fluid">
                    <table class=" mt-5" border="1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Image</th>
                                <th>Delivered</th>
                                <th>Print PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->product_title }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->delivery_status }}</td>
                                    <td>
                                        <img src="product/{{ $order->image }}" alt="" class="image_size">
                                    </td>
                                    <td>
                                        @if ($order->delivery_status == 'processing')
                                            <a href="{{ url('delivered') }}/{{ $order->id }}"
                                                class="btn btn-primary">Delivered</a>
                                        @else
                                            <p class="text-success">Delivered</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('print-pdf') }}/{{ $order->id }}"
                                            class="btn btn-secondary">Print PDF</a>
                                    </td>
                                    {{-- <td><a href="{{url('/delete-category')}}/{{$cat_data->id}}" class="btn btn-danger">Delete</a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
        </footer> --}}
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
