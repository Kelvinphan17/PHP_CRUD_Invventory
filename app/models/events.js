var popup = document.getElementById("addpopup");

// Get the button that opens the popup
var btn = document.getElementById("additembtn");

// Get the span that closes the popup
var span = document.getElementsByClassName("close")[0];

// When user clicks on the button, open the popup
btn.onclick = function() {
    display();
}

// When the user clicks on the x, close the popup
span.onclick = function() {
    closeDisplay();
}

// When the user clicks anywhere outside of the popup, close it
window.onclick = function(event) {
    if (event.target == popup) {
        closeDisplay();
    }
}


$(document).ready(function() {

    // On using the search bar, execute an AJAX call
    $("#search").keyup(function() {
        $.ajax({
            url: '../models/ajax.php',
            type: "POST",
            data: {search: $(this).val()},
            success: function(result){
                $("#table").html(result);
            }
        })
    })


    $(document).on("click", '.deletebtn', function() {

        $button = $(this);

        var $content =  
        "<div class='dialog-overlay'>" +
            "<div class='dialog'>" +
                "<header>" +
                    " <h3> Delete Item </h3> " +
                "</header>" +
                "<div class='dialog-msg'>" +
                    "<p> Are you sure you want to delete this item? </p>" +
                "</div>" +
                "<footer>" +
                    "<div class='controls'>" +
                        " <button class='doAction'>Yes</button> " +
                        " <button class='cancelAction'>No</button> " +
                    "</div>" +
                "</footer>" +
            "</div>" +
        "</div>";

        var $value = false;
        $('body').prepend($content);

        $('.doAction').click(function () {
            $('.dialog-overlay').remove();

            $.ajax({
                url: '../models/ajax.php',
                type: "POST",
                data: {delete_id: $button.data("id"), search_id: $("#search").val()},
                success: function(result){
                    $("#table").html(result);
                }
            })


            });
        
        $('.cancelAction').click(function () {
            $('.dialog-overlay').remove();
        });
        

    })

})