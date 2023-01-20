<!doctype html>
<html>
  <head>
    <title>Web Development</title>
  </head>
  <body>

    <h1>AJAX</h1>

    <p>Check the console for output!</p>


    <!-- bring in the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- custom application code -->
    <script>

      $(document).ready(function() {

        // AJAX allows you to request information from the server without asking the
        // browser to perform a full CGI request.
        // FEATURES OF AN AJAX REQUEST
        // * page does not need to refresh, so all JavaScript variables and states remain in tact
        // * requests are initiated and handled through JavaScript
        // * API for AJAX is a little clunky, so we often use jQuery to make things easier
        // * AJAX is asynchronus - you cannot asusme that the server will respond right away, so you have to wait to receive your result - we handle this through a callback function

        // simple AJAX request to obtain the value of a text file using jQuery
        // $ is jQuery's only object
        // .ajax is a function attaced to the $ object
        // it takes one argument - an object - which contains directions on how to initiate the AJAX request
        $.ajax({
          url: 'datasource1.txt',
          success: function(data, status) {
            console.log("AJAX request #1 completed");
            console.log("Data received from server: ", data);
            console.log("------");
          }
        });

        // if a datasource cannot be found or a server error occurs the request will fail - for example:
        $.ajax({
          url: 'pikachu.txt',
          success: function(data, status) {
            console.log("AJAX request #2 completed");
            console.log("Data received from server: ", data);
            console.log("------");
          }
        });

        // you can handle errors by supplying an error callback function, like this:
        $.ajax({
          url: 'charmander.txt',
          success: function(data, status) {
            console.log("AJAX request #3 completed");
            console.log("Data received from server: ", data);
            console.log("------");
          },
          error: function(request, data, status) {
            console.log("AJAX request #3 failed");
            console.log("Data received from server: ", data);
            console.log("Status received from server: ", status);
            console.log("------");
          }
        });

        // you can also use AJAX to run a server-side program such as a PHP script
        $.ajax({
          url: 'datasource2.php',
          success: function(data, status) {
            console.log("AJAX request #4 completed");
            console.log("Data received from server: ", data);
            console.log("------");
          },
          error: function(request, data, status) {
            console.log("AJAX request #4 failed");
            console.log("Data received from server: ", data);
            console.log("Status received from server: ", status);
            console.log("------");
          }
        });

        // you can also repeatidly initiate an AJAX request to get updated data from the server
        // we call this "POLLING" the server
        // note that you don't want to do this very often!  the faster your poll the server the more taxing your website will be on server, and
        // at some point the server may choose to stop honoring your requests.  try and keep your polls relatively slow (3-5 seconds between them, and never double them up)
        function simplePolling() {
          $.ajax({
            url: 'datasource2.php',
            success: function(data, status) {
              console.log("AJAX request #5 completed");
              console.log("Data received from server: ", data);
              console.log("------");

              // call the server again in 3 seconds for fresh data
              setTimeout(simplePolling, 3000);
            },
            error: function(request, data, status) {
              console.log("AJAX request #5 failed");
              console.log("Data received from server: ", data);
              console.log("Status received from server: ", status);
              console.log("------");
            }
          });
        }
        // uncomment this line to start the server polling demo
        //simplePolling();


        // just like with a CGI request, you can also send data to a server-side script using AJAX
        // we do this using one of the two CGI methods (GET or POST) along with a 'data' object
        $.ajax({
          url: 'datasource3.php',
          type: 'POST',
          data: {
            message: 'hello from JavaScript'
          },
          success: function(data, status) {
            console.log("AJAX request #6 completed");
            console.log("Data received from server: ", data);
            console.log("------");
          },
          error: function(request, data, status) {
            console.log("AJAX request #6 failed");
            console.log("Data received from server: ", data);
            console.log("Status received from server: ", status);
            console.log("------");
          }
        })

      }); // end jQuery document ready function




    </script>


  </body>
</html>
