<?php $errors = Session::has('errors') ? Session::get('errors') : []; ?>
<html>  
	<head> 
		<meta charset="utf-8"> 
	    <title>Guracle — Your daily source of motivation!</title>
	    <!-- Compiled and minified CSS -->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">

	  	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
	    
	    <link href='http://fonts.googleapis.com/css?family=Alegreya:400,700|Roboto+Condensed' rel='stylesheet' type='text/css'>
	    <style type="text/css">
	    	.opacity-6 {
	    		background-color: rgba(255,255,255,0.6);
	    	}

	    	.new-form {
	    		margin-top: 12% !important;
	    	}

	    	body {  
			    background-size: cover;
			}
			<?php 
				$defaultColor = "rgba(0,0,0,0.75)";
				$invalidColor = "#d9534f";
				$warningColor = "#f0ad4e";
			?>

			span.character-counter,
			input[type=text],
			textarea.materialize-textarea,
			h4 {
				color: {{$defaultColor}};
			}

			textarea.materialize-textarea{
				font-size: 2.5em;
			}

	    	/* label color */
		    .input-field label {
		      color: {{$defaultColor}};
		    }
			/* label focus color */
			.input-field input[type=text]:focus + label {
				color: {{$defaultColor}};
		   	}
		   	/* label underline focus color */
	   		.input-field input[type=text]:focus {
		    	border-bottom: 1px solid {{$defaultColor}};
		     	box-shadow: 0 1px 0 0 {{$defaultColor}};
		   	}
		   	/* valid color */
		   	.input-field input[type=text].valid {
		    	border-bottom: 1px solid {{$defaultColor}};
		     	box-shadow: 0 1px 0 0 {{$defaultColor}};
		   	}
		   	/* invalid color */
		   .input-field textarea.materialize-textarea.invalid {
		    	border-bottom: 1px solid {{$defaultColor}};
		     	box-shadow: 0 1px 0 0 {{$defaultColor}};
		   	}

		   	/* label focus color */
			.input-field textarea.materialize-textarea:focus + label {
				color: {{$defaultColor}};
		   	}
		   	/* label underline focus color */
	   		.input-field textarea.materialize-textarea:focus {
		    	border-bottom: 1px solid {{$defaultColor}};
		     	box-shadow: 0 1px 0 0 {{$defaultColor}};
		   	}
		   	/* valid color */
		   	.input-field textarea.materialize-textarea.valid {
		    	border-bottom: 1px solid {{$defaultColor}};
		     	box-shadow: 0 1px 0 0 {{$defaultColor}};
		   	}
		   	/* invalid color */
		   .input-field textarea.materialize-textarea.invalid {
		    	border-bottom: 1px solid {{$defaultColor}};
		     	box-shadow: 0 1px 0 0 {{$defaultColor}};
		   	}

		   	/* icon prefix focus color */
		   	.input-field .prefix.active {
		    	color: {{$defaultColor}};
		   	}
	    </style>
	</head>
	<body style="background-image: url('https://unsplash.it/2000/1000/?random')">
	
	<div style="z-index:9999">
		
	</div>
		<div class="valign-wrapper">
			<div class="container ">
				<div class="col s12 m2">
			      <p class="z-depth-2">
			      	@if (count($errors) > 0)
					    <div class="card-panel red lighten-2">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li><span class="white-text text-darken-1">{{ $error }}</span></li>
					            @endforeach
					        </ul>
					    </div>
					@endif
			      </p>
			    </div>
				<div class="new-form card-panel opacity-6">
			  		<h4>New Quote</h4>
					<div>
						<div class="row">
							<form class="col s12" name="quote" action="./new" method="post">
						    	<div class="row">
							        <div class="input-field col s6">
							        	<input id="author" name="author" type="text" class="validate">
						          		<label for="author">Author</label>
							        </div>
						      	</div>
						      	<div class="row">
									<div class="input-field col s12">
										<textarea id="quote" name="text" class="materialize-textarea" length="140"></textarea>
										<label for="quote">Quote</label>
									</div>
	      						</div>
	      						<div class="input-field col s12">
		      						<button class="btn waves-effect waves-light right" type="submit">
		      						Submit
										<i class="mdi-content-send right"></i>
									</button>
								</div>
						    </form>
					  	</div>
				  	</div>
			  	</div>
		  	</div>
		  	<div class="fixed-action-btn" style="bottom: 45px; left: 24px;">
		      <a href="/" class="btn-floating btn-large blue">
		        <i class="large mdi-action-home"></i>
		      </a>
  			</div>
	  	</div>
	</body>
</html>