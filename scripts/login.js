window.onload = function() {

    // form validation for the sign up
    document.getElementById("signup").onsubmit = function(e) {

        // variable pass stores the array of string that's in the username box
        var pass2 = document.getElementsByName("username")[0].value;
        if (pass2 == null || pass2 == "") {
            e.preventDefault();
            alert("Enter a username");
        }
        // variable pass stores the array of string that's in the description box
        var pass = document.getElementsByName("email")[0].value;
        if (pass == null || pass == "") {
            e.preventDefault();
            alert("Enter an email");
        }

        //validation for equivalent password
        var password1 = document.getElementsByName("password1")[0].value;
        var password2 = document.getElementsByName("password2")[0].value;
        if (password1 !== password2) {
            e.preventDefault();
            alert("Passwords are not equivalent.");
        }

      }

      // form validation for the login
      document.getElementById("login").onsubmit = function(e) {

          // variable pass stores the array of string that's in the username box
          var pass2 = document.getElementsByName("username2")[0].value;
          if (pass2 == null || pass2 == "") {
              e.preventDefault();
              alert("Enter a username");
          }
          // variable pass stores the array of string that's in the description box
          var pass = document.getElementsByName("password3")[0].value;
          if (pass == null || pass == "") {
              e.preventDefault();
              alert("Enter a password");
          }
        }
    }
