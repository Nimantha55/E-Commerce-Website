<?php

function component($productName, $productPrice, $productImg, $productId){
	
	$element = " 
	<div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-4\">
				<form action=\"index.php\" method=\"post\">
				    <div class=\"card cardAnimation\">
						<div>
							<img src=\"$productImg\" alt=\"image1\" class=\"img-fluid card-img-top d-block w-100 productImg\" style='height: 200px;'>
						</div>
						<div class=\"card-body\">
							<h5 class=\"card-title text-center\">$productName</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<h5 class=\"text-secondary\">Price $$productPrice</h5>
							<button type='submit' class='btn btn-success btn-sm p-1 mt-2' name='wishlist'>Add To Wishlist</button>
							<button type='button' name='popup' class='btn btn-warning text-white btn-sm mt-2 p-1' data-toggle='modal' data-target='#$productId'>Info</button>
						</div>
						<div class=\"card-footer\">
							<button type=\"submit\" class=\"btn btn-primary btnCart\" name='add'>Add To Cart<i class=\"fas fa-shopping-cart ml-2\"></i></button>
							<input type='hidden' name='product_id' value='$productId'>
							<input type='hidden' name='product_name' value='$productName'>
							<input type='hidden' name='product_price' value='$productPrice'>
							<input type='hidden' name='product_img' value='$productImg'>
						</div>
					</div>
				</form>
			</div>		
";
	echo $element;
}
function cartElement($productImg, $productName, $productPrice, $productid){
    $element = "
        <form action=\"cart.php\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white shadow\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productImg alt=\"image1\" class=\"img-fluid productImg\" style=\"height: 150px;\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productName</h5>
                                <small class=\"text-secondary\">Seller: Nimantha</small>
                                <h5 class=\"pt-2\">$$productPrice</h5>
                                <button type=\"submit\" class=\"btn btn-secondary\">Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5 my-1\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\" id='minus'></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline text-center\" id='count' disabled>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\" id='plus'></i></button>
                                    <input type='hidden' name='product_id' value='$productid'>
							        <input type='hidden' name='product_name' value='$productName'>
							        <input type='hidden' name='product_price' value='$productPrice'>
							        <input type='hidden' name='product_img' value='$productImg'>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
    ";
    echo $element;
}
function emptyData(){
    $element = "
      <div class='text-muted text-center'>
         <h4>Product details not available...!</h4>
      </div>
    ";
    echo $element;
}
function wishlist_item($productName, $productPrice, $productImg, $productId){
    $element = "
        <div class=\"col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 mb-4\">
				<form action=\"wishlist.php\" method=\"post\">
				    <div class=\"card cardAnimation\">
						<div>
							<img src=\"$productImg\" alt=\"image1\" class=\"img-fluid card-img-top d-block w-100 productImg\" style='height: 200px;'>
						</div>
						<div class=\"card-body\">
							<h5 class=\"card-title text-center\">$productName</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
							<h5 class=\"text-secondary\">Price $$productPrice</h5>
							<button type='submit' class='btn btn-danger btn-sm p-1 mt-2' name='remove'>Remove From Wishlist</button>
						</div>
						<div class=\"card-footer\">
							<button type=\"submit\" class=\"btn btn-primary btnCart\" name='add'>Add To Cart<i class=\"fas fa-shopping-cart ml-2\"></i></button>
							<input type='hidden' name='product_id' value='$productId'>
							<input type='hidden' name='product_name' value='$productName'>
							<input type='hidden' name='product_price' value='$productPrice'>
							<input type='hidden' name='product_img' value='$productImg'>
						</div>
					</div>
				</form>
			</div>
    ";
    echo $element;
}
function no_records($massage){
    $element = "
    <div class='container'>
        <div class='row'>
            <div class='col-12 text-center'>
                <img src='img/empty.png' alt='' width='350' height='300'>
                <h4 class='text-muted mt-3'>$massage</h4>
                <a href='index.php' class='btn btn-outline-primary mt-2'>Shop Now</a>
            </div>
        </div>
    </div>
    
    ";
    echo $element;
}
function no_product($massage){
    $element = "
    <div class='container'>
        <div class='row'>
            <div class='col-12 text-center'>
                <img src='img/img2.png' alt='' width='350' height='300'>
                <h4 class='text-muted'>$massage</h4>
                <a href='index.php' class='btn btn-outline-primary mt-2'>Shop Now</a>
            </div>
        </div>
    </div>
    
    ";
    echo $element;
}
function order($productImg, $productName, $productPrice, $productid){
    $element = "
        <form action=\"orders.php\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white shadow\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productImg alt=\"image1\" class=\"img-fluid productImg\" style=\"height: 150px;\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productName</h5>
                                <small class=\"text-secondary\">Seller: Nimantha</small>
                                <h5 class=\"pt-2\">$$productPrice</h5>                             
                            </div>
                            <div class=\"col-md-3 py-5 my-1\">
                                <div>
                                <button type=\"submit\" class=\"btn btn-success mx-2\" name=\"received\">Received</button>
                                    <input type='hidden' name='product_id' value='$productid'>
							        <input type='hidden' name='product_name' value='$productName'>
							        <input type='hidden' name='product_price' value='$productPrice'>
							        <input type='hidden' name='product_img' value='$productImg'>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
    ";
    echo $element;
}
function received($productImg, $productName, $productPrice, $productid){
    $element = "
        <form action=\"orders.php\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white shadow\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productImg alt=\"image1\" class=\"img-fluid productImg\" style=\"height: 150px;\">
                            </div>
                            <div class=\"col-md-9\">
                                <h5 class=\"pt-2\">$productName</h5>
                                <small class=\"text-secondary\">Seller: Nimantha</small>
                                <h5 class=\"pt-2\">$$productPrice</h5>  
                                <input type='hidden' name='product_id' value='$productid'>
							    <input type='hidden' name='product_name' value='$productName'>
							    <input type='hidden' name='product_price' value='$productPrice'>
							    <input type='hidden' name='product_img' value='$productImg'>                           
                            </div>
                        </div>
                    </div>
                </form>
                <br>
    ";
    echo $element;
}
function popupModel($productName, $productPrice, $productImg, $productId){
    $element = "
        <div class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" id=\"$productId\">
        <div class=\"modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable\" role=\"document\"><!-- For scroll we can use modal-dialog-scrollable class. To display the modal in center of the screen we can use modal-dialog-centered class. Modal sizes = modal-sm / modal-lg /
            modal-xl -->
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" area-label=\"Close\">
                    <span area-hidden=\"true\">&times;</span>
                    </button>
                </div>
                <form action='index.php' method='post'>
                    <div class=\"modal-body\">
                    <div class='text-center mb-4'>
                        <img src=$productImg alt='image' class='img-fluid' width='200' height='150'>
                        <h5 class='font-weight-bold text-uppercase'>$productName</h5>
                    </div>
                    <div class='text-center'>                   
                    <div class='row justify-content-center'>
                        <div class='col-10'>
                            <h5 class='text-left text-muted font-weight-bold'>Product Info</h5>
                            <table class=\"table bg-light\">
                              <tbody>
                                <tr>
                                  <td class='text-left text-info font-weight-bold'>Product ID</td>
                                  <td class='text-left font-weight-bold'>$productId</td>
                                </tr>
                                <tr>
                                  <td class='text-left text-info font-weight-bold'>Product Name</td>
                                  <td class='text-left font-weight-bold'>$productName</td>
                                </tr>
                                <tr>
                                  <td class='text-left text-info font-weight-bold'>Price</td>
                                  <td class='text-left font-weight-bold'>$$productPrice</td>
                                </tr>
                                <tr>
                                  <td class='text-left text-info font-weight-bold'>Features</td>
                                  <td class='text-left font-weight-bold'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, quod?</td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12'>
                            <img src='img/lap1.jpg' alt='' width='200' height='150'>
                        </div>
                        <div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12'>
                            <img src='img/lap2.jpg' alt='' width='200' height='150'>
                        </div>
                        <div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12'>
                            <img src='img/lap3.jpg' alt='' width='200' height='150'>
                        </div>
                        <div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12'>
                            <img src='img/lap4.jpg' alt='' width='150' height='100'>
                        </div>
                    </div>
                        <input type='hidden' name='product_id' value='$productId'>
						<input type='hidden' name='product_name' value='$productName'>
						<input type='hidden' name='product_price' value='$productPrice'>
						<input type='hidden' name='product_img' value='$productImg'>
                    </div>
                </div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-danger btn-sm\" data-dismiss=\"modal\">Close</button>
                     <button type=\"submit\" class=\"btn btn-success btn-sm\" name='modal_wishlist'>Add To Wishlist</button>
                    <button type=\"submit\" class=\"btn btn-primary btn-sm\" name='modal_cart'>Add To Cart</button>
                </div>
                </form>               
            </div>
        </div>
    </div>
    ";
    echo $element;
}
function addNewProduct(){
    $element = "
        <div class='modal fade' tabindex='-1' role='dialog' id='addModal'>
            <div class='modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' area-label='Close'>
                        <span area-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <form action='display_products.php' method='post'>
                        <div class='modal-body'>
                            <h5 class='text-muted font-weight-bold text-center text-uppercase mb-4'>Add New Product</h5>
                            <div class='row'>
                                <div class='col-6'>
                                    <div class='form-group'>
                                        <label for='productName' class='text-dark font-weight-bold'>Product Name</label>
                                        <input type='text' name='product_name' class='form-control' id='productName' placeholder='Enter Product Name'>
                                    </div>
                                </div>
                                <div class='col-6'>
                                    <div class='form-group'>
                                        <label for='productPrice' class='text-dark font-weight-bold'>Product Price($)</label>
                                        <input type='number' name='product_price' class='form-control' id='productPrice' placeholder='Enter Product Price'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-6'>
                                    <div class='form-group'>
                                        <label for='customFile' class='text-dark font-weight-bold'>Product Image</label>
                                        <div class=\"custom-file\">
                                            <input type=\"file\" class=\"custom-file-input\" id=\"customFile\" name='product_image'>
                                            <label class=\"custom-file-label\" for=\"customFile\">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-6'>
                                    <div class='form-group'>
                                        <label for='productCategory' class='text-dark font-weight-bold'>Product Category</label>
                                        <select id='productCategory' class='form-control' name='product_category'>
                                            <option selected class='dropdown-item'>Choose Product Category</option>
                                            <option class='dropdown-item' value='All'>All</option>
                                            <option class='dropdown-item' value='Sport'>Sport</option>
                                            <option class='dropdown-item' value='Technology'>Technology</option>
                                            <option class='dropdown-item' value='Electronic'>Electronic</option>
                                            <option class='dropdown-item' value='Furniture'>Furniture</option>
                                            <option class='dropdown-item' value='Foods'>Foods</option>
                                            <option class='dropdown-item' value='Cloths'>Cloths</option>
                                            <option class='dropdown-item' value='Shoes'>Shoes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='form-group'>
                                        <label for='productDesc' class='text-dark font-weight-bold'>Product Description</label>
                                        <input type='text' name='product_description' class='form-control' id='productDesc' placeholder='Enter Product Description'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-12'>
                                    <div class='form-group'>
                                        <label for='productFeat' class='text-dark font-weight-bold'>Product Features</label>
                                        <input type='text' name='product_features' class='form-control' id='productFeat' placeholder='Enter Product Features'>
                                    </div>
                                </div>
                            </div>                           
                            <div class='text-right mt-4'>
                                <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Close</button>
                                <button type='Submit' class='btn btn-primary btn-sm' name='addProduct'>Add Product</button>                         
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    ";
    echo $element;
}