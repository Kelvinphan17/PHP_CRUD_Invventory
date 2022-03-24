var popup = document.getElementById("addpopup");

// Get the button that opens the popup
var btn = document.getElementById("additembtn");

function display() {
    popup.style.display = "block";
}

function closeDisplayFunc(){
    popup.style.display = "none";
}

window.closeDisplay = closeDisplayFunc;

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

    $(document).on("click", '#additembtn', function(){

        $button = $(this);

        $.ajax({
            url: '../models/ajax.php',
            type: "POST",
            data: {add:1},
            success: function(result){
                $("#popup").html(result);
                display();

                var span = document.getElementsByClassName("close")[0];
                span.addEventListener("click",function(){closeDisplay();});
            }
        })

    })

    $(document).on("click", '.editbtn', function(){

        $button = $(this);

        $.ajax({
            url: '../models/ajax.php',
            type: "POST",
            data: { edit_id: $button.data("id")},
            success: function(result){
                $("#popup").html(result);
                display();
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


    $(document).on("submit","#insert", function(e){

        e.preventDefault();

        var id = $("input[name=id]").val();
        var item_name = $("input[name=item_name]").val();
        var item_size = $("input[name=item_size]").val();
        var item_sku = $("input[name=item_sku]").val();
        var item_price = $("input[name=item_price]").val();
        var item_market = $("input[name=item_market]").val();
        var item_color = $("input[name=item_color]").val();
        var purchase_date = $("input[name=purchase_date]").val();
        var sold_price = $("input[name=sold_price]").val();
        var status = (sold_price !== null) ? 1 : 0;
        var profit = (sold_price !== null) ? (sold_price - item_price) : 'NULL';
        console.log(id);
        var formType = ( typeof id !== "undefined") ? 1 : 0;

        $.ajax({
            url: '../models/ajax.php',
            type: "POST",
            data: {
                type: formType,
                id:id,
                item_name:item_name,
                item_size:item_size,
                item_sku:item_sku,
                item_price:item_price,
                item_market:item_market,
                item_color:item_color,
                purchase_date:purchase_date,
                sold_price:sold_price,
                status:status,
                profit:profit
            },
            success: function(result){
                $("#table").html(result);
            }
        })
        closeDisplayFunc();

    })
    

})