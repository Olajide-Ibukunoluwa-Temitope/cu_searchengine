<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/styles.min.css" rel="stylesheet">

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
    <link rel="stylesheet" href="owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="animate.css">

	<title>CU searchengine</title>
</head>
<body>

	<div class="container">
		<div class="m">
			<div id="title"></div>
		</div>
		<div class="text-center">
			<form action="./php/resultpage.php">
                <div class="form-group">
                  <input name="q" type="search" class="form-control input-lg" id="search_box" style="border-width: 2px;">
                </div>

                <div id="search_buttons">
                  <button type="submit" class="btn btn-primary btn-lg" style="padding-right: 40px; padding-left: 40px;">Search</button>
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


        /* KEYPRESS */

        // Ctrl+return - 'Feelink Lucky?' Shortcut
        // $("input, html").bind('keydown', "Ctrl+return", function (){
        //    var query = input.val();

        //    input.val(query = query.replace(/\s+/g, ' '));
           
        //    if (query && !query.match(/^\s+$/)){
        //       window.location = "./php/resultpage.php?q="+query+"&lucky=1";
        //    }
        // });

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