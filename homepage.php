<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/styles.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.css">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
    <link rel="stylesheet" href="owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="animate.css">

	<title>CU searchengine</title>
</head>
<body>

  <div>
    <marquee>
      <h1>Welcome To Covenant University's Private Search Engine</h1> 
    </marquee>
  </div>

  	<div class="container">
  		<div class="m">
  			<div id="title"></div>
  		</div>
  		<div class="text-center">
  			<form action="./php/resultpage.php">
                  <div class="form-group">
                    <input name="q" type="search" class="form-control input-lg" style="font-size: 15px" id="search_box" style="border-width: 2px;">
                  </div>

                  <div id="search_buttons">
                    <button type="submit" class="btn btn-primary btn-lg" style="padding-right: 60px; padding-left: 60px; padding-top: 10px; padding-bottom: 5px;"><h3>Search</h3></button>
                  </div>
              </form>
  		</div>
  	</div>

  	<script src="./assets/js/libs/jquery.min.js"></script>
    <script src="./assets/js/libs/bootstrap.min.js"></script>
    <script src="./assets/js/libs/jquery.hotkeys.js"></script>

    <script>
      $(function(){

        var input = $("input"),
            $form = $("form");
        input.focus();

        // prevent whitespace search and empty input
        $form.on("submit", function(e) {
          var $input = input;
          var query = $input.val();

          if (!query || query.match(/^\s+$/)) {
            e.preventDefault();
            $input.focus();
          }

          // trim query string
          $input.val(query.replace(/\s+/g, ' '));
        });


        // focus input `onkeypress`
        $(document).keypress(function(e) {

          if (!input.is(":focus")) {

            var v = String.fromCharCode(e.which);
            if (v.match(/[a-z0-9]/i)) {
              input.val(input.val() + v);
            }

            input.focus();
          }

        });


      });
    </script>
	
</body>
</html>