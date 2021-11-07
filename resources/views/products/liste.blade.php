
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>eCommerce Product List Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="listep/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="listep/font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="listep/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="listep/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Liste de produits <small>Tous les produits</small></h1>
</div>

<!-- eCommerce Product List - START -->

<div class="main-container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4" style="padding:15px;">
            <div style="display:inline-block; border:solid 1px #808080; padding:15px">
                <div>
                    <img class="img-responsive" alt="eCommerce Product List" src="{{ asset('/storage/images/products/' . $product->image_produit) }}" style="width:200px;height:200px; margin-left:50px;"/>
                    <br />
                    <h2 class="pull-right">{{$product->prix_vente}}</h2>
                    <h2><a href="#">{{$product->libelle_produit}}</a></h2>
                    <br />
                    <p class="text-justify">{{$product->description}}</p>
                </div>
                <br />
             
                <br />
              
            </div>
        </div>
      
       @endforeach
    </div>
</div>

<div class="modal fade" id="productmodal1" tabindex="-1" role="dialog" aria-labelledby="productmodal1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Charger</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive" alt="Bootstrap template" src="https://www.prepbootstrap.com/Content/images/template/productslider/product_001.jpg" />
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>ID: <span>185</span></h4>
                        <div class="ratings">
                            <p>
                                <div id="rating4"></div>
                                (10 reviews)
                            </p>
                        </div>
                        <br />
                        <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <br />
                        <h2 class="pull-right">$285.00</h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productmodal2" tabindex="-1" role="dialog" aria-labelledby="productmodal2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Memory</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive" alt="Bootstrap template" src="https://www.prepbootstrap.com/Content/images/template/productslider/product_002.jpg" />
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>ID: <span>65</span></h4>
                        <div class="ratings">
                            <p>
                                <div id="rating5"></div>
                                (15 reviews)
                            </p>
                        </div>
                        <br />
                        <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <br />
                        <h2 class="pull-right">$146.00</h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="productmodal3" tabindex="-1" role="dialog" aria-labelledby="productmodal3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Board</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-responsive" alt="Bootstrap template" src="https://www.prepbootstrap.com/Content/images/template/productslider/product_003.jpg" />
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>ID: <span>569</span></h4>
                        <div class="ratings">
                            <p>
                                <div id="rating6"></div>
                                (20 reviews)
                            </p>
                        </div>
                        <br />
                        <p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <br />
                        <h2 class="pull-right">$348.00</h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- you need to include the shieldui css and js assets in order for the charts to work -->
<link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $('#rating1').shieldRating({
            max: 5,
            step: 1,
            value: 3,
            markPreset: false
        });

        $('#rating2').shieldRating({
            max: 5,
            step: 1,
            value: 4,
            markPreset: false
        });
        $('#rating3').shieldRating({
            max: 5,
            step: 1,
            value: 2,
            markPreset: false
        });
        $('#rating4').shieldRating({
            max: 5,
            step: 1,
            value: 3,
            markPreset: false
        });

        $('#rating5').shieldRating({
            max: 5,
            step: 1,
            value: 4,
            markPreset: false
        });
        $('#rating6').shieldRating({
            max: 5,
            step: 1,
            value: 2,
            markPreset: false
        });
    });
</script>

<style>

</style>

<!-- eCommerce Product List - END -->

</div>

</body>
</html>