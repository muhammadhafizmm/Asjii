<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Page</title>
    <!-- Bootstrap and Jquery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="content">
        <div class="about d-flex flex-column">
            <div class="header d-flex flex-column align-self-center align-items-center">
                <h3>About</h3>
                <span class="line"></span>
            </div>
            <div class="p">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus elit a eros convallis, eu consequat purus fringilla. Aliquam erat volutpat. Vestibulum convallis accumsan nisi, eu suscipitquam. Mauris eget condimentum turpis. Maecenas quis diam efficitur, imperdiet orci at, porta est. In ut bibendum ex. Aenean porta efficitur hendrerit. Vestibulum efficitur est id varius lacinia.</p><br>
                <p>Quisque vestibulum ut ante sit amet congue. Nunc suscipit efficitur ligula, lacinia molestie velit placerat sed. Mauris suscipit, enim sit amet tristique posuere, sem velit blandit nisi, nontincidunt purus dui sit amet mauris. Suspendisse tempor molestie mi, quis efficitur lectus sollicitudin a.</p><br>
                <p>Morbi at laoreet neque. Fusce porttitor erat nec orci condimentum, hendrerit tempor lacus bibendum.</p>
            </div>
        </div>
        <div class="news d-flex flex-column">
            <div class="header d-flex flex-column align-self-center align-items-center">
                <h3>News</h3>
                <span class="line"></span>
            </div>
            <div class="news-list">
                @foreach ($news as $item)
                    @php
                        // date
                        $date = date('j F, Y', strtotime($item->created_at));
                        // news body snippet
                        $bodyList = explode("\r\n", $item->news_body);
                        $bodySnippet = "";
                        foreach ($bodyList as $itemList) {
                            if(strpos($itemList, "<p>") === 0){
                                $bodySnippet .= $itemList;
                                break;
                            }
                        }
                        $bodySnippet = str_replace(array('<p>', '<p>'), '', $bodySnippet);
                        $bodySnippet = substr($bodySnippet, 0, 500) . "...";
                    @endphp
                    <div class="news-item my-5" onclick="location.href='{{ url('/news/' . $item->id . '/post') }}'">
                        <span><b>{{$item->news_title}},</b><span class="text-muted"> at {{$date}}</span></span>
                        <p>@php echo $bodySnippet @endphp</p>
                    </div>
                @endforeach
            </div>

            {{-- Load More --}}
            <div class="w-100 my-2 d-flex justify-content-center">
                <button class="btn btn-black" id="loadMore">Load More</button>
            </div>
        </div>
    </div>
</body>
<!-- js -->
<script>
$(document).ready(function(){
    $(".news-item").slice(0, 3).show();
    if($(".news-item:hidden").length != 0){
        $("#loadMore").show();
    }
    $("#loadMore").on('click', function(e){
        e.preventDefault();
        $(".news-item:hidden").slice(0, 3).slideDown();
        if ($(".news-item:hidden").length == 0){
            $("#loadMore").fadeOut('slow');
        }
    });
});
</script>
<script src="{{ asset('js/app.js') }}"></script>
</html>