@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// alerts CSS
		'vendors/bower_components/sweetalert/dist/sweetalert.css',
		//  Custom Fonts
		'dist/css/font-awesome.min.css',
		//  Calendar CSS
		'vendors/bower_components/fullcalendar/dist/fullcalendar.css"',
		//  Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
	@endforeach

	<style>
	.product-card {
		float: right;
	}

	.product-card .info {
	    height: 130px;
		overflow: auto;
	}

	.product-card .label {
		position: absolute;
		bottom: 10px;
		left: 0px;
		box-shadow: 0px 0px 10px -3px #000;
		padding: 5px 10px !important;
	}

	.product-card .btn.btn-circle {
		height: 20px;
		width: 20px;
	}

	.product-card .btn.btn-circle i {
		font-size: 10px !important;
	}

	.product-pic {
		height: 250px;
	}
	</style>
@endsection
	
@section('content')
	<div class="container">

		<!-- Title -->
		<div class="row heading-bg">
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
					<li><a href="index.html">داشبورد</a></li>
					<li><a href="#"><span>فروشگاه</span></a></li>
					<li class="active"><span>محصولات</span></li>
				</ol>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">محصولات</h5>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->
		
		<!-- Group Row -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view">
					<div class="panel-heading">
						<div class="pull-right">
							<h6 class="panel-title txt-dark">جستجو در محصولات</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div  class="panel-wrapper collapse in">
						<div  class="panel-body">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="product_name" onkeyup="this.nextElementSibling.href = '/panel/products/search/'+this.value" @isset($query) value="{{$query}}" @endisset id="firstName" class="form-control" placeholder="مثلا : تلفن همراه">
									<a href="/panel/products/search/" class="input-group-addon"><i class="ti-search"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Group Row -->

		<div class="seprator-block"></div>
		
		<!-- Product Row One -->
		<div class="row">
			@empty($products[0])
			<div class="alert alert-warning alert-dismissable">
				<i class="zmdi zmdi-alert-circle-o pl-15 pull-right"></i>
				<p class="pull-right">هیچ محصولی تا کنون ثبت نشده است !</p>
				<div class="clearfix"></div>
			</div>
			@else
				@foreach ($products as $product)
				<div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 product-card">
					<div class="panel panel-default card-view pa-0">
						<div class="panel-wrapper collapse in">
							<div class="panel-body pa-0">
								<article class="col-item">
									<div class="photo">
										<div class="options">
											<a href="/panel/products/edit/{{$product->pro_id}}" class="font-18 txt-grey mr-10 pull-left"><i class="zmdi zmdi-edit"></i></a>
											<a href="javascript:void(0);" class="font-18 txt-grey pull-left sa-warning"><i class="zmdi zmdi-close"></i></a>
										</div>
										
										<a href="javascript:void(0);">
											<div class="product-pic img-responsive"
												style="background: url('{{ asset('uploads/'.$product->photo) }}') center center;
													background-size: cover;">
												@if($product->status)
													<span class="label label-success capitalize-font inline-block ml-10">انتشار یافته</span>
												@else
													<span class="label label-warning capitalize-font inline-block ml-10">پیشنویس</span>
												@endif
											</div>
										</a>
									</div>
									<div class="info">
										<h5>{{$product->name}}</h5>
										<h6>شناسه : {{$product->code}}</h6>
										<?php if ($product->unit) { $product->unit = 'دلار'; } else { $product->unit = 'ریال'; } ?>
										@if($product->offer)
											<span class="head-font block txt-orange-light-1 font-16"><del>{{$product->price.' '.$product->unit}}</del></span>
											<?php $product->offer = $product->price - ($product->offer * $product->price) / 100; ?>
											<span class="head-font block txt-dark-1 font-16"><ins>{{$product->offer.' '.$product->unit}}</ins></span>
										@else
											<span class="head-font block txt-orange-light-1 font-16">{{$product->price.' '.$product->unit}}</span>
										@endif
									</div>
								</article>
							</div>
						</div>	
					</div>	
				</div>
				@endforeach	
			@endempty
		</div>	
		<!-- /Product Row Four -->
		
		<div class="row">
			<div class="col-md-5"></div>

			<div class="col-md-2">
				<input type="button" class="btn btn-primary col-md-12" value="بارگذاری بیشتر ..." />
			</div>
		</div>
		
	</div>
@endsection

@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// Sweet-Alert 
		'vendors/bower_components/sweetalert/dist/sweetalert.min.js',
		'dist/js/sweetalert-data.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Init JavaScript
		'dist/js/init.js',
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach
@endsection