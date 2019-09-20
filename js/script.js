// Add Record
function addRecord() {
    // get values
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var sales = $("#sales").val();
    var price = $("#price").val();
    var barcode = Math.floor(Math.random() * 1000000000);

    // Add record
    $.post("ajax/addRecord.php", {
        first_name: first_name,
        last_name: last_name,
        email: email,
        sales: sales,
        price: price,
        barcode: barcode
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#first_name").val("");
        $("#last_name").val("");
        $("#email").val("");
        $("#sales").val("");
        $("#price").val("");
        $("#barcode").val("");
    });
}

// READ records
function readRecords() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteUser(id) {
    var conf = confirm("Are you sure you want to delete? This action cannot be undone!");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function PrintTicket(id) {
    //location = "ajax/printTicket.php";
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            document.getElementById("print_first_name").innerHTML = user.first_name;
            document.getElementById("print_last_name").innerHTML = user.last_name;
            document.getElementById("print_sales").innerHTML = user.sales;
            document.getElementById("print_price").innerHTML = user.price;
            GenerateBarcode(user.barcode);
        }
    );
    $("#show_generated_ticket").modal("show");
}

function search(){
    var code = $('#query_search').val();
    
    $.get("ajax/searchRecord.php", {code: code}, function (data, status) {
        $(".records_content").html(data);
    });
}

function UpdateStatus(id, s) {
    if (s == 1) { var conf = confirm("Do you want to change the status to 'Completed'?"); }
    else { conf = confirm("Are you sure you want to change a 'Completed' status to 'Pending'?"); }
    if (conf == true) {
        $.post("ajax/updateStatus.php", {
                id: id,
                status: s
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_first_name").val(user.first_name);
            $("#update_last_name").val(user.last_name);
            $("#update_email").val(user.email);
            $("#update_sales").val(user.sales);
            $("#update_price").val(user.price);
        }
    );

    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();
    var sales = $("#update_sales").val();
    var price = $("#update_price").val();
    
    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            first_name: first_name,
            last_name: last_name,
            email: email,
            sales: sales,
            price: price
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});