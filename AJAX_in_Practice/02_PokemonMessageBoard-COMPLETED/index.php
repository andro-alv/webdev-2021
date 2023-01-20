<!doctype html>
<html>
  <head>
    <title>Web Development</title>
    <style>
      .entry {
        width: 18%;
        height: 200px;
        box-sizing: border-box;
        text-align: center;
        border: 1px solid black;
        border-radius: 20px;
        padding: 10px;
        float: left;
        word-break: break-all;
        overflow: hidden;
        background-color: #eee;
        margin: 1%;
      }
      .entry img {
        display: block;
        margin: auto;
        width: 50%;
      }
    </style>
  </head>
  <body>

    <h1>Pokemon Message Board with AJAX</h1>

    <!-- a form the user can fill out to create a new entry for the page -->
    <div>
      Avatar:
      <select id="pokemon">
        <option value="images/pikachu.png">Pikachu</option>
        <option value="images/charmander.png">Charmander</option>
        <option value="images/bulbasaur.png">Bulbasaur</option>
        <option value="images/squirtle.png">Squirtle</option>
      </select>
    </div>
    <div>
      Message (keep it clean!):
      <input type="text" id="message" maxlength="50">
      <button id="save">Save Message</button>
    </div>

    <hr>

    <!-- where previous entries will be stored -->
    <div id="previous"></div>

    <!-- template for a previous entry:

      <div id="item_id" class="entry">
        <img src="images/pikachu.png">
        <p>Message goes here</p>
      </div>

    -->


    <!-- bring in the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- custom application code -->
    <script>

      // when jQuery & the page are ready to go
      $(document).ready(function() {

        // dom refs
        var dropdown = document.getElementById('pokemon');
        var message = document.getElementById('message');
        var saveButton = document.getElementById('save');
        var previous = document.getElementById('previous');

        // get existing entries
        function getExistingEntries() {

          // step 1: use AJAX to grab the data.txt file from the server
          $.ajax({
            type: 'GET',
            url: 'data/data.txt?nocache=' + Math.random(),
            success: function(data, status) {
              console.log("Success, got the file from the server");
              console.log(data);

              // step 2: successfully retrieved file, now we need to parse it using standard string mechanics

              // split on line break
              let lines = data.split("\n");

              // examine each line
              for (let i = 0; i < lines.length; i++) {

                // further split each line using the '|' character
                let items = lines[i].split("|");

                // only pay attention to items that have exactly 3 elements
                if (items.length == 3) {

                  // extract each item into variables to make things easier for us
                  let id = items[0];
                  let img = items[1];
                  let msg = items[2];

                  // see if we already have a DOM element with this ID - if so, we don't want to do anything
                  if (!document.getElementById( id )) {

                    // create an entry div for this item
                    createEntry(id, img, msg);

                  } // end 'if' seeing if this is a unique element
                } // end 'if' testing to see if we have enough elements in our array
              } // end 'for' loop

              // in 2 seconds, do this all again to get any new entries that may have been added
              setTimeout(getExistingEntries, 2000);

            },
            error: function(req, data, status) {
              console.log("Error, couldn't get file");

              // in 2 seconds let's try again
              setTimeout(getExistingEntries, 2000);
            }
          })

        }

        // call our function 1 time to start up the process of getting data from the server
        getExistingEntries();

        function createEntry(id, img, msg) {
          // create a new 'div' on the page with this ID
          let tempDiv = document.createElement('div');
          tempDiv.id = id;
          tempDiv.classList.add('entry');

          // create an image
          let tempImg = document.createElement('img');
          tempImg.src = img;
          tempDiv.appendChild( tempImg );

          // create a 'p' tag for the message
          let tempP = document.createElement('p');
          tempP.innerHTML = msg;
          tempDiv.appendChild( tempP );

          // add to the 'previous' div at the beginning
          if (previous.children.length == 0) {
            previous.appendChild( tempDiv );
          }
          else {
            previous.insertBefore( tempDiv, previous.firstElementChild );
          }
        }

        // save a new entry
        saveButton.onclick = function(event) {

          // grab the info the server needs to save this entry
          let avatarImage = dropdown.value;
          let messageText = message.value;

          // make an AJAX request to the server
          $.ajax({
            type: 'POST',
            url: 'saveentry.php',
            data: {
              message: messageText,
              avatar: avatarImage
            },
            success: function(data, status) {
              console.log("Success! Received this data from the server: ", data);
              createEntry(data, avatarImage, messageText);
            },
            error: function(req, data, status) {
              console.log("Error!");
            }
          })

        }


      })

    </script>

  </body>
</html>
