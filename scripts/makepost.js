window.onload = function() {

    // make post must have a title and content
    document.getElementById("post_content").onsubmit = function(e) {{

        // variable pass stores the array of string that's in the username box
        var pass2 = document.getElementsByName("title")[0].value;
        if (pass2 == null || pass2 == "") {
            e.preventDefault();
            alert("Enter a title");
        }
        // variable pass stores the array of string that's in the description box
        var pass = document.getElementsByName("content")[0].value;
        if (pass == null || pass == "") {
            e.preventDefault();
            alert("Enter some content");
        }

        var pass3 = document.getElementById("opt");
        var selected = pass3.options[pass3.selectedIndex].value;
        if (selected == "no")
        {
            e.preventDefault();
            alert("Please select a board");
        }

    }
    }
}


