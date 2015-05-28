<?php
@session_start();?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>Who's tweets near you</title>
	<script src="js/jquery-latest.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false&libraries=places"></script>
	<script src="js/google.js"></script>
	<script src="js/twitter.js"></script>
	<script src="js/facebook.js"></script>
	<script src="js/maplabel-compiled.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        width:100%;

      }

      .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

		  #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
        height:40px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      .container {
    		width: 80%;
    		height:60%;
    		margin-left: auto;
    		margin-right: auto;
    	}

      #map-canvas {
    		width: 100%;
    		height:100%;
    	}

      .text-header {
        font-size: 25px;
        color: #959595;
      }

      .text-profile {

      }

      .page-header {
        bottom: 0px;
      }

      @media (max-width: 767px) {
        .text-header {
          font-size: 15px;
        }

        .img-profile img {
          width: 40px;
        }
      }
    </style>
  </head>

<body>
<div class="container">

        <fb:login-button scope="public_profile,email" id="facebook" onlogin="checkLoginState();" style="float:right"></fb:login-button>
        <div class="row"><div id="status"></div></div>
        <input type="hidden" id="sessionId" value="<?php echo $_SESSION['id'];?>"/>
   		<h1 class="page-header" style=""><div class="text-header">Who's tweets near you</div></h1>
		<div id="map-canvas"></div>
		<div id="history"></div>
		<div id="debug" style="color:blue;font-size:45px;margin-top:5px;line-height:1em;"></div>

		<input id="pac-input" class="controls"  type="text" placeholder="Enter a location"></div>
		</div>
	</div>
</div>
</body>
</html>


