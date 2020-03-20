<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Index Event</title>
    <!-- Material Desain Icon CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Bootstrap and Jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="content">
        <div class="w-100 my-4 d-flex justify-content-flex-start">
            <button class="btn btn-black" onclick="location.href='{{ url('event/admin/add') }}'">Add Event</button>
        </div>
        <div class="event-list" id="eventList">
            @foreach ($event as $item)
            <div class="event-item" onclick="location.href='{{ url('/event/admin/' . $item->id . '/post') }}'">
                <span class="dot"></span>
                {{-- php for split data --}}
                @php
                    // event date formating
                    $date = date('F j, Y', strtotime($item->event_date));
                    // snippet event_description
                    $desList = explode("\r\n", $item->event_description);
                    $desSnippet = "";
                    foreach ($desList as $itemList) {
                        if(strpos($itemList, "<p>") === 0){
                            $desSnippet .= $itemList;
                            break;
                        }
                    }
                    $desSnippet = str_replace(array('<p>', '</p>'), '', $desSnippet);
                    $desSnippet = substr($desSnippet, 0, 350) . "...";
                    // $desSnippet = htmlspecialchars($desSnippet);
                @endphp
                <h5>{{$item->event_name}}</h5>
                <span>{{$date}}</span>
                <div class="location"><i class="material-icons">location_on</i>{{$item->event_location}}</div>
                <p>@php echo $desSnippet @endphp</p>
            </div>
            @endforeach
            {{-- pagination --}}
            <div class="my-4 d-flex justify-content-center">
                <span>{{$event->links()}}</span>
            </div>
        </div>
    </div>
</body>
</html>