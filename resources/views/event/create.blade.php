<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Event</title>
  <!-- Bootstrap and Jquery -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <!-- Date Picker CSS and Js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <!-- Material Desain Icon CDN -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
    <form method="post" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- Image Upload -->
        <h3 class="jumbotron my-4 bg-dark text-light"><i class="material-icons">cloud_upload</i> Image Upload</h3> 
        <div class="input-group control-group increment" >
          <input type="file" name="file_name[]" class="form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="file_name[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>
        @error('file_name')
          <div class="alert alert-danger my-3">{{ $message }}</div>
        @enderror
        <!-- Yang lain -->
        <h3 class="jumbotron my-4 bg-dark text-light">Add Data</h3>
        <div class="form-group">
            <label for="event_name">Your event name:</label>
            <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" value="{{ old('event_name') }}">
            @error('event_name')
            <div class="alert alert-danger my-3">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="event_date">Pick your event date:</label>
            <div class="input-group">
                <input class="date form-control @error('event_date') is-invalid @enderror" id="event_date" autocomplete="off" name="event_date" value="{{ old('event_date') }}">
                <div class="input-group-append">
                    <span for="event_date" class="input-group-text" id="basic-addon2"><i class="material-icons">calendar_today</i></span>
                </div>
            </div>
            @error('event_date')
            <div class="alert alert-danger my-3">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="event_location">Your event location:</label>
            <input type="text" class="form-control @error('event_location') is-invalid @enderror" name="event_location" id="event_location" value="{{ old('event_location') }}">
            @error('event_location')
            <div class="alert alert-danger my-3">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="event_description">Your event description:</label>
            <textarea class="form-control" id="event_description" name="event_description" rows="3"> {{ old('event_description') }}</textarea>
            @error('event_description')
            <div class="alert alert-danger my-3">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-info" style="margin-top:12px"><i class="glyphicon glyphicon-check"></i> Submit</button>
    </form>
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>