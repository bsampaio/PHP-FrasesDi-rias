<!DOCTYPE html>
<html ng-app="Guracle">
<head>
	<meta charset="utf-8"/>
	<title>Guracle - Your daily source of motivation!</title>
  <link href='http://fonts.googleapis.com/css?family=Alegreya:400,700|Roboto+Condensed' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <style type="text/css">
    html, body, .container {
      height: 100%;
      overflow: hidden;
    }
    body {
      background-repeat: no-repeat;
      background-size: cover;
      background-color: rgba(0,0,0,.5);
    }
    #quote-data {
      font-family: 'Alegreya', serif !important;
      color: #fff;
      text-shadow: 1px 1px 1px rgba(80, 80, 80, 0.8);
    }
    #score {
      font-family: 'Alegreya', serif !important;
      color: #fff;
      text-shadow: 1px 1px 1px rgba(30, 30, 30, 0.8);
      position: absolute;
      top: 25px; 
      right: 24px;
      font-size: 1.4em
    }
    #quotation {
      font-family: 'Alegreya', serif !important;
      font-size: 4.2em !important;
    }
  </style>
  <style type="text/css">
    #newQuote {
      font-family: 'Roboto' !important;
    }

    .opacity-6 {
      background-color: rgba(255,255,255,0.6);
    }

    span.character-counter,
    input[type=text],
    textarea.materialize-textarea,
    h4 {
      color: rgba(0,0,0,0.75);
    }

    textarea.materialize-textarea{
      font-size: 2.5em;
    }

    /* label color */
    .input-field label {
      color: rgba(0,0,0,0.75);
    }

    /* label focus color */
    .input-field input[type=text]:focus + label {
      color: rgba(0,0,0,0.75);
    }
    /* label underline focus color */
    .input-field input[type=text]:focus {
      border-bottom: 1px solid rgba(0,0,0,0.75);
      box-shadow: 0 1px 0 0 rgba(0,0,0,0.75) !important;
    }
    /* valid color */
    .input-field input[type=text].valid {
      border-bottom: 1px solid rgba(0,0,0,0.75);
      box-shadow: 0 1px 0 0 rgba(0,0,0,0.75) !important;
    }
    /* invalid color */
   .input-field textarea.materialize-textarea.invalid {
      border-bottom: 1px solid #d9534f;
      box-shadow: 0 1px 0 0 #d9534f !important;
    }

    /* label focus color */
    .input-field textarea.materialize-textarea:focus + label {
      color: rgba(0,0,0,0.75);
    }

    /* label underline focus color */
    .input-field textarea.materialize-textarea:focus {
      border-bottom: 1px solid rgba(0,0,0,0.75);
      box-shadow: 0 1px 0 0 rgba(0,0,0,0.75) !important;
    }
    /* valid color */
    .input-field textarea.materialize-textarea.valid {
      border-bottom: 1px solid rgba(0,0,0,0.75);
      box-shadow: 0 1px 0 0 rgba(0,0,0,0.75) !important;
    }
    /* invalid color */
   .input-field textarea.materialize-textarea.invalid {
      border-bottom: 1px solid  #d9534f;
      box-shadow: 0 1px 0 0  #d9534f !important;
    }

    /* icon prefix focus color */
    .input-field .prefix.active {
      color: rgba(0,0,0,0.75);
    }
  </style>
	<script type="text/javascript">
		angular.module("Guracle",[]);
		angular.module("Guracle").controller("QuotesController", function ($scope, $http){
			$scope.app = "Guracle - Your daily source of motivation!";
      $scope.icons = {
        shuffle: 'mdi-av-shuffle',
        quote: 'mdi-editor-format-quote',
        up: 'mdi-action-thumb-up',
        down: 'mdi-action-thumb-down'
      }
      $scope.loading = false;
      $scope.img = {};

      $scope.newQuote = {};
      $scope.newQuote.author = null;
      $scope.newQuote.text = null;

      $scope.save = function(newQuote){
        if (newQuote.author && newQuote.text) {
          $scope.loading = true;
            $http.post("http://guracle.herokuapp.com/rest/save",newQuote)
              .success(function (response){
                $scope.randomize();
                $scope.loading = false;
              })
              .error(function (response){
                console.log(response);
                $scope.randomize();
                $scope.loading = false;
              });
        }else{
          console.log('Error!');
          console.log(newQuote);
        }
      }

			$scope.randomize = function (id) {
        $scope.loadImage();
        var url = "http://guracle.herokuapp.com/rest/randomize";
        $scope.loading = true;

        if (typeof id != 'undefined') {
          url = "http://guracle.herokuapp.com/rest/randomize/"+id;
        };
        $http.get(url)
          .success(function (response) {
            $scope.quote = response;
            $scope.loading = false;
          })
          .error(function (response) {
            $scope.loading = false;
          });
      }

      $scope.vote = function (id, vote){
        $scope.loading = true;
        switch (vote) {
          case 'up'   : var url = 'http://guracle.herokuapp.com/rest/up/'+id; break;
          case 'down' : var url = 'http://guracle.herokuapp.com/rest/down/'+id; break;
          default     : break;
        }
        
        $http.post(url)
          .success(function (response) {
            $scope.loading = false;
            $scope.randomize(id);
          })
          .error(function (response) {
            $scope.loading = false;
            console.log(response);
            $scope.randomize(id);
          });
      }

      $scope.detectImgSize = function (){
        $scope.img.height = $(document).height();
        $scope.img.width  = $(document).width();
      }

      $scope.loadImage = function(){
        var randomId = new Date().getTime();
        $('body').css('background-image','none');
        $('body').css('background-image','url(https://unsplash.it/'+$scope.img.width+'/'+$scope.img.height+'?random='+randomId+')');
      }

      $scope.detectImgSize();
      $scope.randomize();
		});
	</script>
</head>
<body ng-controller="QuotesController">
  <div id="quote-data" class="container valign-wrapper">
      <div ng-hide="loading" class="valign center" style="width: 100%;">
        <span id="score" class="right" style="top: 25px; right: 24px;">Score: {{quote.score}}</span>
        <div class="row">
          <h2 id="quotation" class="valign center" style="width: 100%">{{quote.text}}</h2>
        </div>
        <div class="row">
          <h5 class="valign center" style="width: 100%">— {{quote.author}}</h5>
        </div>

        <!-- Modal Structure -->
        <div id="newQuote" class="modal modal-fixed-footer">
          <div class="modal-content">
            <h4>New Quote</h4>
            <div>
              <div class="row">
                <div class="input-field col s6">
                  <input ng-model="newQuote.author" id="author" name="author" type="text" class="validate">
                  <label for="author">Author</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="quote" ng-model="newQuote.text" name="text" class="materialize-textarea" length="140"></textarea>
                  <label for="quote">Quote</label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a ng-click="save(newQuote)" class="modal-action modal-close btn waves-effect waves-light right">
              Save
              <i class="mdi-content-send right"></i>
            </a>
          </div>
        </div>
      </div>
      <div ng-show="loading" class="valign center" style="width: 100%">
        <div class="center preloader-wrapper big active">
          <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>

          <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
              <div class="circle"></div>
            </div><div class="gap-patch">
              <div class="circle"></div>
            </div><div class="circle-clipper right">
              <div class="circle"></div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <a ng-click="randomize(quote.id)" class="btn-floating btn-large blue">
      <i class="large {{icons.shuffle}}"></i>
    </a>
    <ul>
      <li>
        <a class="btn-floating green " style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;" ng-click="vote(quote.id, 'up')">
          <i class="large {{icons.up}}"></i>
        </a>
      </li>
      <li>
        <a class="btn-floating red" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"
        ng-click="vote(quote.id, 'up')">
          <i class="large {{icons.down}}"></i>
        </a>
      </li>
      <li>
        <a class="modal-trigger btn-floating blue tooltipped" href="#newQuote" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;" data-position="left" data-delay="30" data-tooltip="New quote">
          <i class="large {{icons.quote}}"></i>
        </a>
      </li>
    </ul>
  </div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
      $('.modal-trigger').leanModal();
    });
  </script>
</body>
</html>