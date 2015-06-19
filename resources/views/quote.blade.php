<html>  
<head> 
	<meta charset="utf-8"> 
    <title>Guracle — Your daily source of motivation!</title>
    
    <link href='http://fonts.googleapis.com/css?family=Alegreya:400,700|Roboto+Condensed' rel='stylesheet' type='text/css'>
    <!-- Compiled and minified CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">

  	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>

	<link href="/css/style.css" rel="stylesheet" type="text/css"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
</head>  
@if (!empty($quote->background))
    <body style="background-image: url('/img/{{$quote->background}}')"> 
@endif
    <div class="container">
        @if (!empty($quote->id))
            <span class="right badge" style="margin-top: 1%; color:white; text-shadow: 1px 1px 1px rgba(150, 150, 150, 0.8); font-size: 1.2em">Score: {{$quote->score}}</span>
        @endif        
        <div class="quote-container">
            <div class="row">
                <div class="col s2">
                    @if (!empty($quote->id))
                        <form action="/down/{{$quote->id}}" method="POST">
                            <button class="btn-unlike right btn-floating btn-large waves-effect waves-red-darken-2 btn-flat">
                                <i class="mdi-action-thumb-down"></i>
                            </button>
                        </form>
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="col s8">
                    <p class="text">
                        {{$quote->text}}
                    </p>
                </div>
                <div class="col s2">
                @if (!empty($quote->id))
                    <form action="/up/{{$quote->id}}" method="POST">
                        <button class="btn-like left btn-floating btn-large waves-effect waves-blue-lighten-2 btn-flat">
                            <i class="mdi-action-thumb-up"></i>
                        </button>
                    </form>
                @endif
                </div>
            </div>
            <p class="author">— {{$quote->author}}</p>
        </div>
    </div>
    <div class="fixed-action-btn" style="bottom: 45px; left: 24px;">
        <a href="/randomize/{{$quote->id}}" class="btn-floating btn-large blue tooltipped"
           data-position="top" data-delay="30" data-tooltip="Randomize">
            <i class="large mdi-av-shuffle"></i>
        </a>
    </div>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a href="/new" class="btn-floating btn-large blue tooltipped"
           data-position="top" data-delay="30" data-tooltip="New quote">
            <i class="large mdi-editor-format-quote"></i>
        </a>
    </div>
    <script type="text/javascript">
        var w = window,
            d = document,
            e = d.documentElement,
            g = d.getElementsByTagName('body')[0],
            width = w.innerWidth || e.clientWidth || g.clientWidth,
            height = w.innerHeight|| e.clientHeight|| g.clientHeight;
        d.body.style.backgroundImage = "url('https://unsplash.it/"+width+"/"+height+"/?random')";
    </script>
</body>  
</html>  