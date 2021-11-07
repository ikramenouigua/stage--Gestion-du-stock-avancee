@extends('products.layout')
  
@section('content')
  <!--  <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Référence:</strong>
                {{ $product->ref_produit }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Libéllé:</strong>
                {{ $product->libelle_produit }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Quantité:</strong>
                {{ $product->quantite }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix d'achat:</strong>
                {{ $product->prix_achat }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Prix de vente:</strong>
                {{ $product->prix_vente }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Unité du produit:</strong>
                {{ $product->unite_produit }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Stocke minimum:</strong>
                {{ $product->stocke_min }}
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <img src="/images/{{ $product->image_produit }}" style="width:80px; height:80px;">
            </div>
        </div>  -->

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<br>  <p class="text-center">Des informations sur ce produit </p>
<hr>

	
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
  <div> <a href="#"><img src="{{ asset('/storage/images/products/' . $product->image_produit) }}" style="width:400px;height:400px;border-radius:50px;margin-top:20px;margin-left:30px;"></a></div>  
</div> <!-- slider-product.// -->

</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">
<article class="card-body p-5">
	<h3 class="title mb-3">{{ $product->libelle_produit }}</h3>

<p class="price-detail-wrap"> 
	<span class="price h3 text-warning"> 
		<span class="num">{{$product->prix_vente}}</span><span class="currency"> DH</span>
	</span> 
	<span>/unité {{ $product->unite_produit }}</span> 
</p> <!-- price-detail-wrap .// -->
<dl class="item-property">
  <dt>Description</dt>
  <dd><p>{{ $product->description }}
 </p></dd>
</dl>
<dl class="param param-feature">
  <dt>Référence</dt>
  <dd>{{$product->ref_produit}}</dd>
</dl>  <!-- item-property-hor .// -->
<dl class="param param-feature">

  <dt>Color</dt>
  @foreach($caracteristique as $c)
  <dd>{{$c->couleur}}</dd>
  @endforeach
</dl>  <!-- item-property-hor .// -->
<dl class="param param-feature">
  <dt>Taille</dt>
  @foreach($caracteristique as $c)
  <dd>{{$c->taille}}</dd>
  @endforeach
</dl>  <!-- item-property-hor .// -->

<hr>
	<div class="row">
		
		
	<hr>

</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->


</div>
<!--container.//-->


<br><br><br>


    
@endsection