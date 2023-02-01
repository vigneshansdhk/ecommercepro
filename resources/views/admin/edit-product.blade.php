<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')
</head>

<body>
    <style>
        label {
            display: inline-block;
            width: 200px;
        }
    </style>
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
                <div class="text-center">
                    <h1>Update Product</h1>
                    <form action="{{ url('/update-product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product_data->id }}">
                        <div class="mt-3">
                            <label for="">Product Title</label>
                            <input type="text" class="input_color" name="title" placeholder="write a title"
                                required value="{{ $product_data->title }}">
                        </div>
                        <div class="mt-3">
                            <label for="">Product description</label>
                            <input type="text" class="input_color" name="description"
                                placeholder="write a description" required value="{{ $product_data->description }}">
                        </div>
                        <div class="mt-3">
                            <label for="">Product price</label>
                            <input type="number" class="input_color" name="price" placeholder="write a price"
                                required value="{{ $product_data->price }}">
                        </div>
                        <div class="mt-3">
                            <label for="">Product quantity</label>
                            <input type="number" class="input_color" name="quantity" min="0"
                                placeholder="write a quantity" required value="{{ $product_data->quantity }}">
                        </div>
                        <div class="mt-3">
                            <label for="">Product Category</label>
                            <select name="category" id="" class="input_color" required>
                                <option value="{{ $product_data->category }}" selected>{{ $product_data->category }}</option>
                                @foreach ($category_data as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="">Current Product Image</label>
                            <img src="product/{{ $product_data->image }}" class="image_size" alt=""
                                style="margin: auto">
                        </div>
                        <div class="mt-3">
                            <label for="">Product Image</label>
                            <input type="file" name="image" >
                        </div>
                        <div class="mt-3">
                            <label for="">Discount price </label>
                            <input type="number" class="input_color" name="discount_price"
                                placeholder="write a Discount" required value="{{ $product_data->discount_price }}">
                        </div>
                        <div class="mt-3">
                            <input type="submit" class="btn btn-primary" name="submit" value="Update Product">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>
