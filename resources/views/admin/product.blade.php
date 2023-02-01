<!DOCTYPE html>
<html lang="en">

<head>
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
                    <h1>Add Product</h1>
                    <form action="{{ url('/add-product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label for="">Product Title</label>
                            <input type="text" class="input_color" name="title" placeholder="write a title"
                                required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product description</label>
                            <input type="text" class="input_color" name="description"
                                placeholder="write a description" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product price</label>
                            <input type="number" class="input_color" name="price" placeholder="write a price"
                                required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product quantity</label>
                            <input type="number" class="input_color" name="quantity" min="0"
                                placeholder="write a quantity" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Product Category</label>
                            <select name="category" id="" class="input_color" required>
                                <option value="" selected>Add Category Here</option>
                                @foreach ($category_data as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="">Product Image</label>
                            <input type="file" name="image" required>
                        </div>
                        <div class="mt-3">
                            <label for="">Discount price </label>
                            <input type="number" class="input_color" name="discount_price"
                                placeholder="write a Discount" required>
                        </div>
                        <div class="mt-3">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add Product">
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
