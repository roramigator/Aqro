<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistema</title>
    <!-- Barcode generator javascript library -->
    <script type="text/javascript" src="js/barcode.js"></script>
    <!-- PDF generator javascript library -->
    <script type="text/javascript" src="js/jspdf.min.js"></script>
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <style type="text/css">
        .table-borderless td,
        .table-borderless th{ 
            border: 0 !important
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">AQRO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#add_new_record_modal">Add code</a>
                </li>
            </ul>
            <div class="pull-right form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="query_search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="search()">Search</button>
            </div>
        </div>
    </div>
</nav>

<!-- Content Section -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="records_content"></div>
        </div>
    </div>
</div>
<!-- /Content Section -->

<!-- Bootstrap Modals -->
<!-- Modal - Generate/Print Ticket -->
<div class="modal fade" id="show_generated_ticket" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Ticket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="print_ticket">
                <table class="table" id="read_print_ticket">
                    <tr>
                        <td class="text-center">
                            <center><img src="img/logo.jpg" width="100"></center>
                            <center>
                                <svg id="barcode"></svg>
                                <!-- Generate barcode -->
                                <script type="text/javascript">
                                    function GenerateBarcode(code){
                                        JsBarcode("#barcode", code, {
                                            fontSize: 10,
                                            width: 1,
                                            height: 30
                                        });
                                    }
                                </script>
                            </center>
                        </td>
                    </tr>
                           
                    <tr>
                        <td>
                            <?php echo date('d-m-Y'); ?>
                            <center>
                                <span id="print_first_name"></span>
                                <span id="print_last_name"></span>
                                <br>
                                <span id="print_sales"></span>
                                <span id="print_price"></span>
                            </center>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td><center>Thank you</center></td>
                    </tr>
                </table>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="printIt()">Print</button>
            <button type="button" class="btn btn-primary" onclick="GeneratePDF()">Generate PDF</button>

            <script type="text/javascript">
                
                function GeneratePDF() {
                    var pdf = new jsPDF('p', 'pt', [300, 150]);
                    
                    source = $('#read_print_ticket')[0];
                    specialElementHandlers = {
                        // element with id of "bypass" - jQuery style selector
                        '#bypassme': function (element, renderer) {
                            // true = "handled elsewhere, bypass text extraction"
                            return true
                        }
                    };
                    margins = {
                        top: 10,
                        bottom: 0,
                        left: 10,
                        //width: 1000
                    };
                    pdf.fromHTML(
                        source, // HTML string or DOM elem ref.
                        margins.left, // x coord
                        margins.top, { // y coord
                            'width': margins.width, // max width of content on PDF
                            'elementHandlers': specialElementHandlers
                        },

                        function (dispose) {
                            pdf.save('ticket.pdf');
                        }, margins
                    );
                }

            </script>
            

            <script type="text/javascript">
                function printIt() {
                    var s = document.getElementById("read_print_ticket").innerHTML;
                    var win = window.open('','','left=0,top=0,width=700,height=500,toolbar=0,scrollbars=0,status =0');
                    win.document.write('<center>');
                    win.document.write(s);
                    win.document.write('</center>');
                    win.document.close();
                    win.print();
                    win.close();
                }

            </script>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Create</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="first_name">Name</label>
                    <input type="text" id="first_name" placeholder="John" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" placeholder="Doe" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="john@doe.com" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="sales">Description</label>
                    <textarea id="sales" placeholder="General repairs..." class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <input type="text" id="price" placeholder="100" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="update_first_name">Name</label>
                    <input type="text" id="update_first_name" placeholder="John" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_last_name">Last name</label>
                    <input type="text" id="update_last_name" placeholder="Doe" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_email">Email</label>
                    <input type="text" id="update_email" placeholder="john@doe.com" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_sales">Description</label>
                    <textarea id="update_sales" placeholder="..." class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="update_price">Price</label>
                    <div class="input-group">
                        <input type="text" id="update_price" placeholder="100" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()">Update</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Jquery JS file -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<!-- Custom JS file (USES AJAX) -->
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>
