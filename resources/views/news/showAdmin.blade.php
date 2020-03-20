<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show News</title>
    <!-- Bootstrap and Jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="content">
        <div class="content-news" >
            <h1 class="header-show">{{$news->news_title}}</h1>
            <span class="text-muted">{{ date('j F, Y', strtotime($news->created_at)) }}</span>
            <div class="news_body">
                @php echo $news->news_body; @endphp
            </div>
        </div>
        <div class="w-100 d-flex justify-content-start">
            <button class="btn btn-edit mx-2" onclick="location.href='{{ url('/news/admin/' . $news->id . '/edit') }}'">Edit</button>
            <form action="" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$news->id}}">
                @method('delete')
                <button type="submit" class="btn btn-delete">Delete</button>
            </form>
        </div>
    </div>
</body>
</html>