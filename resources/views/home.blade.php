<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Laravel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <style>
               
        .btnItemRight1 {
            padding-left: 100px;
        }
        
        .btnItemLeft2 {
            padding-top: 10px;
        }
        .btnItemRight2 {
            padding-left: 65px;
        }

        .btnItemRight3 {
            padding-left: 60px;
        }
        .btnItemRight4 {
            padding-left: 80px;
            padding-top: 10px;
        }
        a:link, a:visited {
            color: white;
            text-decoration: none;
        }

        label, h1, th, td{
            color: #fff;
        }

        .dropdown a {
            color: black;
        }
        .dropdown-menu {
            padding: 10px;
        }

        .table-responsive tbody {
            display: block;
            overflow: auto;
            height: 50px;
        }
        .table-responsive thead tr {
            display: block;
        }
        .table-responsive th,
        .table-responsive  td {
            width: 500px;
        }

        .table-bordered td {
            border: none !important;
        }

        /* width */
        ::-webkit-scrollbar {
        width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #f1f1f1; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #888; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555; 
        }
        
        tr:nth-child(even) {
            background-color: #424242;
        }

    </style>
</head>
<body style="background-color:black;">
    {{--<p>My name is Arijit</p>--}}
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>        
        <div class="d-flex align-items-center">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">                
                <li class="nav-item">
                    <a class="nav-link navbar-brand" href="{{ route('emart_home') }}">Emart</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="collapsibleNavbar"> 
            <ul class="navbar-nav">
                @auth
                    @if ($userRole === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{-- route('emart_administration') --}}">Administration</a>
                    </li> 
                    @elseif ($userRole === 'customer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('another_check') }}">Check</a>
                        </li> 
                    @endif                               
                @endauth

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('emart_login') }}">Login/Signup</a>
                </li>
                @endguest

                @auth
                <li class="nav-item">
                <form method="POST" action="{{ route('emart_logout') }}">@csrf
                    <a href="{{ route('emart_logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form>
                </li>                
                @endauth
            </ul>
        </div>
        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                <?php
                    $hour = date('H');
                    if ($hour > 16)
                        $greetings = "Good Evening"; 
                    elseif ($hour >=  12)
                        $greetings = "Good Afternoon";
                    elseif ($hour < 12)
                        $greetings = "Good Morning";
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ $greetings.', '.Auth::user()->name.' ('.Auth::user()->role.') ' }}</a>  {{--if login--}}
                </li>
                @endauth
            </ul>
        </div>
        <!-- Right elements -->
    </nav>
    <!-- Navbar -->

    <br>    
    <br>

    @auth
    <div class="container">
    @if ($userRole === 'customer')
        <h1>Customer</h1>
        <br>
        <form>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="input-group">
                        <input class="form-control custom-control" rows="1"  style="text-transform: uppercase" name="saveCategory" id="saveCategory" placeholder="Save Category"></input>     
                        <!-- <span class="input-group-addon btn btn-primary saveCategoryBtn">Save</span> -->
                        <button type="button" class="input-group-addon btn btn-primary saveCategoryBtn">Save</button>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="input-group">
                        <select class="selectpicker form-control show-tick" id="selectcategoryID" title="" style="text-transform: uppercase">
                            <option value="">Choose Category</option>
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{ $c->category_name }}</option>
                                @endforeach
                        </select>
                        <input class="form-control custom-control" rows="1"  style="text-transform: uppercase" name="saveItem" id="saveItem" placeholder="Save Items"></input>
                        <select class="selectpicker form-control show-tick" id="status" title="" style="text-transform: uppercase">
                            <option value="">Status</option>
                                    <option value="active">Active</option>                                    
                                    <option value="inactive">Inactive</option>
                        </select>
                        <br>
                        <span class="input-group-addon btn btn-primary saveItemBtn">Save</span>
                    </div>
                </div>
                <!-- for image upload -->
                <div class="form-group col-md-4">
                    <select class="form-control" id="selectproductid" title="" style="text-transform: uppercase">
                        <option value="">Choose Product</option>
                            @foreach($items as $p)
                                <option value="{{$p->id}}">{{ $p->item_name }}</option>
                            @endforeach
                    </select>
                </div>
                <!-- <form method="POST" action="{{ route('emart_upload_image') }}" enctype="multipart/form-data"> -->
                <!-- <form method="POST" action="/uploadsss" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" id="imageID">
                    <input type="hidden" name="productid" id="imageproductid" value="1">
                    <button type="submit">Upload</button>
                </form> -->

                <form method="POST" action="/save_product_image" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input type="file" name="image">
                        <input type="hidden" name="productid" id="imageproductid" value="1">
                        <input type="hidden" name="employeeimage" id="imageproductid" value="1">
                        <button type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </form>
    </div>
    <br>
    @elseif ($userRole === 'admin')
    <div class="container">
        <div class="body">
            <div class="table-responsive">
                <table id="example" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Items</th>
                            <th class="text-center">Categories</th>
                        </tr>
                    </thead>
                    <tbody style="min-height:350px">
                        @if(isset($items) && count($items))
                            @foreach($items as $i => $item)
                                <tr>
                                    <td style="text-transform: uppercase" class="text-center">{{ $i+1 }}</td>
                                    <td onclick="myFunctionItem('{{$item->id}}','{{ $item->user_id }}','{{ $item->item_name }}')" style="text-transform: uppercase" class="text-center">{{ $item->item_name }}</td>
                                    <td onclick="myFunctionCategory('{{$item->mastercategories->id}}','{{ $item->mastercategories->category_name }}')" style="text-transform: uppercase" class="text-center">{{ $item->mastercategories->category_name }}</td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="17" class="text-center">No record(s) found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>        
        <div class="modal fade" id="myModalItemEdit" role="dialog">
            <div class="modal-dialog">            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Items</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h6>Item Name</h6>
                        <input type="text" class="modalTextInput form-control" id="edit_item">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="master_item_id">
                        <button type="button" class="input-group-addon btn btn-danger deleteItemBtn">Delete</button>
                        <button type="button" class="input-group-addon btn btn-primary updateItemBtn">Update</button>
                    </div>
                </div>            
            </div>
        </div>       
        <div class="modal fade" id="myModalCategoryEdit" role="dialog">
            <div class="modal-dialog">            
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Categories</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h6>Category Name</h6>
                        <input type="text" class="modalTextInput form-control" id="edit_category">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="master_category_id">
                        <button type="button" class="input-group-addon btn btn-danger deleteCategorymBtn">Delete</button>
                        <button type="button" class="input-group-addon btn btn-primary updateCategoryBtn">Update</button>
                    </div>
                </div>            
            </div>
        </div>
    </div>
    @endif
    @endauth

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Save Category -->
    <script type="text/javascript">
        $(document).on("click", ".saveCategoryBtn", function(){
            var savecategory = $('#saveCategory').val().toLowerCase();
            if(savecategory.length == 0){
                $("#saveCategory").focus();
                alert('Add something before save!');
                return false;
            }
            @foreach($categories as $c)
                if(savecategory=="{{ $c->category_name }}"){
                    alert('Category already exists!');
                    return false;
                }
            @endforeach
            $('.saveCategoryBtn').attr('disabled',true);
            $.ajax({
                url:"{{ route('emart_saveCategory') }}",
                type:"POST",
                data:{_token: '{{ csrf_token() }}',
                save_category:savecategory,},
                success: function(response) {
                    $('.saveCategoryBtn').attr('disabled',false);
                    if(response.status == 'success'){
                        alert('Created successfully');
                        window.location.href = "{{ route('emart_home') }}";
                    } else {
                        alert('Something went wrong');
                    }
                },
                error:function(err){
                    $('.saveCategoryBtn').attr('disabled',false);
                    alert('Something went wrong. No response error');
                    console.log('Error is: '+err);
                }
            });
        });
    </script>
    <!-- Save Category -->

    <!-- Save Items -->
    <script type="text/javascript">
        $(document).on("click", ".saveItemBtn", function(){

            var saveitem = $('#saveItem').val();
            if(saveitem.length == 0){
                $("#saveItem").focus();
                alert('Add something before save!');
                return false;
            }

            var categoryid = $('#selectcategoryID').val();
            if(categoryid.length == 0){
                $("#selectcategoryID").focus();
                alert('Please choose any category or choose others!');
                return false;
            }
            
            var status = $('#status').val();
            if(status.length == 0){
                $("#status").focus();
                alert('Please choose any status or choose others!');
                return false;
            }

            @foreach($items as $i)
                if(saveitem=="{{ $i->item_name }}"){
                    alert('Item already exists!');
                    return false;
                }
            @endforeach

            $('.saveItemBtn').attr('disabled',true);
            $.ajax({
                url:"{{ route('emart_saveItem') }}",
                type:"POST",
                data:{_token: '{{ csrf_token() }}',
                save_item:saveitem, category_id:categoryid, status:status},
                success: function(response) {
                    $('.saveItemBtn').attr('disabled',false);
                    if(response.status == 'success'){
                        alert('Created successfully');
                        window.location.href = "{{ route('emart_home') }}";
                    } else {
                        alert('Something went wrong');
                    }
                },
                error:function(err){
                    $('.saveItemBtn').attr('disabled',false);
                    alert('Something went wrong. No response error');
                    console.log('Error is: '+err);
                }
            });
        });
    </script>
    <!-- Save Items -->
    <!-- Filter Dropdown -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#selectproductid').on('change', function() { 
                var productid = $('#selectproductid').val();
                var image = $('#imageID').val();
                console.log(productid);
                console.log(image);
                $("#imageproductid").val(productid);
            });                        
        });
    </script>
    <!-- Filter Dropdown -->
</body>
</html>