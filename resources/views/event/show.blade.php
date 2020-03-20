<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Event</title>
    <!-- Material Desain Icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Bootstrap and Jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="content">
        <div class="event-carousell">
            <div id="imgCarousel" class="carousel slide" data-ride="carousel">
                @php
                    $fileName = explode("," , str_replace(array('[','"',']'), "", $event->file_name));
                @endphp
                <div class="carousel-inner">
                    @for ($i = 0; $i < count($fileName); $i++)
                    <div class="carousel-item @if($i == 0) active @endif ">
                        <div class="imgCarousel" style="background-image: url('{{ asset('storage/image/' . $fileName[$i]) }}')"></div>
                    </div>
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#imgCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imgCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
        <div class="event-detail my-4">
            <h1>{{$event->event_name}}</h1>
            <span>{{date('F j, Y', strtotime($event->event_date))}}</span>
            <div class="location"><i class="material-icons">location_on</i>{{$event->event_location}}</div>
            <div class="event-description">
                @php echo $event->event_description; @endphp
            </div>
        </div>
    </div>
</body>

<!-- bootstrapt script -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>