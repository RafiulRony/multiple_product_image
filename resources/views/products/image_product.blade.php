<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>images</title>
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div style="float:left;">
                        <h2>{{ __('Images') }}</h2>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('msg'))
                        <p class="alert alert-danger">{{ Session::get('msg') }}</p>
                    @endif
                    <table class="table table_bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Image') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($images as $key=>$image)
                            <tr>
                                <td><img style="width:150px" src="{{ asset('storage/'.$image->name) }}"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
