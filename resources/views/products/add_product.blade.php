<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>add product</title>
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div style="float:left;">
                        <h2>{{ __('Add New Product') }}</h2>
                    </div>
                    <div style="float:right;">
                        <a class="btn btn-dark" href="{{ route('all.product') }}">{{ __('All Product') }}</a>
                        <a class="btn btn-dark" href="{{ route('all.category') }}">{{ __('All Category') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('msg'))
                        <p class="alert alert-success">{{ Session::get('msg') }}</p>
                    @endif
                    <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group mb-3">
                            <label for="">Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Category Id</label>
                            <input type="text" name="category_id" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Product Color</label>
                            <input type="text" name="color" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Product Size</label>
                            <input type="text" name="size" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Product Image</label>
                            <input type="file" name="images[]" id="images" multiple>
                            {{-- <input type="file" name="image" class="form-control"> --}}
                        </div>

                        <button type="submit" class="btn btn-dark">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
