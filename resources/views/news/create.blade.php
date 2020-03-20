<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add News</title>
  <!-- Bootstrap and Jquery -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- Text-Editor CDN -->
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container my-4">
      @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div> 
      @endif
    <form method="post" action="">
        {{csrf_field()}}
        <!-- Input -->
        <h3 class="jumbotron my-4 bg-dark text-light">Add News</h3>
        <div class="form-group">
            <label for="news_title">News Title :</label>
            <input type="text" class="form-control @error('news_title') is-invalid @enderror" id="news_title" name="news_title" value="{{ old('news_title') }}">
            @error('news_title')
            <div class="alert alert-danger my-3">{{ $message }}</div>
            @enderror
        <div class="form-group">
            <label for="news_body">News Body :</label>
            <textarea class="form-control" id="news_body" name="news_body" rows="3"> {{ old('news_body') }}</textarea>
            @error('news_body')
            <div class="alert alert-danger my-3">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-info" style="margin-top:12px"><i class="glyphicon glyphicon-check"></i> Submit</button>
    </form>
</div>
</body>
<script>
    // CKEDITOR
    CKEDITOR.replace('news_body');
</script>
<script src="{{ asset('js/app.js') }}"></script>
</html>