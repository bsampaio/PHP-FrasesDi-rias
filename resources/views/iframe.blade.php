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
    <style type="text/css">
        .container {
            overflow-x: hidden;
            margin: 0px !important;
            padding: 0px !important;
            max-width: none;
            height: 100% !important;
            width: 100% !important;
            background: rgba(0,0,0,.3);
        }
        .quote-container {
            position: relative;
            top: 0;
            transform: none !important;
            padding: 0;
        }
        #quotation{
            margin-top: 10%
        }
    </style>
</head>  
@if (!empty($quote->background))
<body style="background-image: url('/img/{{$quote->background}}')"> 
@else
<body style="background-image: url('https://unsplash.it/520/400/?random')">
@endif
    <div class="container">
        <div class="row">
            @if (!empty($quote->id))
                <span class="right badge" style="margin-top: 1%; color:white; text-shadow: 1px 1px 1px rgba(150, 150, 150, 0.8); font-size: 1.2em">Score: {{$quote->score}}</span>
            @endif        
        </div>
        <div id="quotation" class="row valign-wrapper">
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
                <div class="quote-container">
                    <div class="row">
                        <div class="row">
                            <p class="text">
                                {{$quote->text}}
                            </p>
                        </div>
                        <div class="row">
                            <p class="author">— {{$quote->author}}</p>
                        </div>
                    </div>
                </div>
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
    </div>  
</body>  
</html>  