<html>  
<head> 
	<meta charset="utf-8"> 
    <title>Motivational — Your daily source of motivation!</title>
    
    <link href='http://fonts.googleapis.com/css?family=Alegreya:400,700|Roboto+Condensed' rel='stylesheet' type='text/css'>
    <!-- Compiled and minified CSS -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">

  	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>

	<link href="/css/style.css" rel="stylesheet" type="text/css"/>
</head>  
@if (!empty($quote->background))
    <body style="background-image: url('/img/{{$quote->background}}')"> 
@else
    <body style="background-image: url('https://unsplash.it/2000/1000/?random')">
@endif
<div class="container">  
    <div class="quote-container">
        <p class="text">{{$quote->text}}</p>
        <p class="author">— {{$quote->author}}</p>
    </div>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    	<a href="/new" class="btn-floating btn-large green">
    		<i class="large mdi-editor-format-quote"></i>
    	</a>
	</div>
</div>  
</body>  
</html>  