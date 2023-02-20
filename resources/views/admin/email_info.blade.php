<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')
    <style>
        label{
            display: inline-block;
            width: 200px;
        }
        .text-black{
            color: black;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
       
        <div class="main-panel">
            <div class="content-wrapper">
                 <h1 class="text-center h1">Send Email to {{$orders->email}}</h1>
                 <form action="{{url('send_user_email')}}/{{$orders->id}}" method="post">
                    @csrf
                    <div style="padding-left: 35%; padding-top:30px">
                        <label for="">Email Greeting :</label>
                        <input type="text" name="greeting" class="text-black">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px" >
                        <label for="">Email FirstLine :</label>
                        <input type="text" name="firstline" class="text-black">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px">
                        <label for="">Email Body :</label>
                        <input type="text" name="body" class="text-black">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px">
                        <label for="">Email Button Name :</label>
                        <input type="text" name="button" class="text-black">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px">
                        <label for="">Email Url :</label>
                        <input type="text" name="url" class="text-black">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px">
                        <label for="">Email Last Line :</label>
                        <input type="text" name="lastline" class="text-black">
                    </div>
                    <div style="padding-left: 35%; padding-top:30px">
                        <input type="submit" value="Send Email" class="btn btn-success">
                    </div>
                 </form>
            </div>
        </div>
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