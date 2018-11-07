@extends('panel.master.main')

@section('styles')
	<?php $styles = [
		// Morris Charts CSS
		'vendors/bower_components/morris.js/morris.css',
		// Data table CSS
		'vendors/bower_components/datatables/media/css/jquery.dataTables.min.css',
		'vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css',
		// bootstrap-select CSS
		'vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css',	
		// Bootstrap Switches CSS
		'vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
		// switchery CSS
		'vendors/bower_components/switchery/dist/switchery.min.css',
		// Custom CSS
		'dist/css/style.css',
	]; ?>

	@foreach ($styles as $style)
		<link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
	@endforeach

@endsection

@section('content')
	<div class="container pt-30">
		<!-- Row -->
		<div class="row">
			@foreach ($errors -> all() as $message)
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ $message }} 
				</div>
			@endforeach

			@if(session()->has('message'))
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{ session()->get('message') }}
				</div>
			@endif
			
			<div class="col-md-4 col-sm-6">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel card-view">
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">ثبت قیمت دلار</h6>
								</div>
								<div class="pull-left">
									<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_1" aria-expanded="true">
										<i class="zmdi zmdi-chevron-down"></i>
										<i class="zmdi zmdi-chevron-up"></i>
									</a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div  id="collapse_1" class="panel-wrapper collapse in">
								<div  class="panel-body">
									<div class="form-wrap">
										<div class="form-group mb-20">
											<p class="text-muted inline-block mb-10 ml-10 font-13">قیمت امروز دلار را ثبت کنید</p>
											<div class="input-group mb-15"> <span class="input-group-addon">$</span>
												<input type="number" value="{{$dollar_cost}}" onkeyup="this.parentNode.parentNode.nextElementSibling.href = 'panel/setting/dollar_cost/'+this.value" placeholder="قیمت 1 دلار" class="form-control">
											</div>
										</div>
										<a class="btn btn-danger btn-block mb-10">ثبت قیمت</a>
									</div>
								
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">محصولات برتر</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div  class="panel-body">
										<span class="font-12 head-font txt-dark">هندزفری beats</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-info" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
										<span class="font-12 head-font txt-dark">گلس A5 2017</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
										<span class="font-12 head-font txt-dark">ساعت هوشمند aWatch</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-danger" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 70%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
										<span class="font-12 head-font txt-dark">اپل iPhone X</span>
										<div class="progress mt-5">
											<div class="progress-bar progress-bar-grad-warning" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
										</div>
									</div>									
								</div>	
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel review-box card-view">
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">بررسی های اخیر</h6>
								</div>
								{{-- <div class="pull-left">
									<div class="form-group mb-0 sm-bootstrap-select">
										<select class="selectpicker" data-style="form-control">
											<option>جدید ترین ها</option>
											<option>بالاترین امتیاز</option>
											<option>پایین ترین امتیاز</option>
										</select>
									</div>	
								</div> --}}
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
							<div class="panel-body row pa-0">
									<div class="streamline">
										@foreach($reviews as $review)
										<div class="sl-item">
											<div class="sl-content">
												<div class="per-rating inline-block pull-right">
													<span class="inline-block">برای {{$review->name}}</span>
													@for ($i = 0; $i < 5; ++$i)
														<a class="zmdi @if($review->rating > 0) zmdi-star <?php --$review->rating; ?> @else zmdi-star-outline @endif"></a>
													@endfor
												</div>
												<a href="javascript:void(0);"  class="pull-left txt-grey"><i class="zmdi zmdi-mail-reply"></i></a>
												<div class="clearfix"></div>
												<div class="inline-block pull-right">
													<span class="reviewer font-13">
														<span>توسط</span>
														<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5">{{$review->fullname}}</a>
													</span>
													<?php 
														$time = new Carbon\Carbon($review->created_at);
														$created_at = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
													?>
													<span class="inline-block font-13  mb-5">{{$time->hour.':'.$time->minute.' | '.$created_at}}</span>
												</div>	
												<div class="clearfix"></div>
												<p class="mt-5">{{$review->review}}</p>
											</div>
										</div>
										<hr class="light-grey-hr"/>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-6">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">تجزیه و تحلیل فروش</h6>
								</div>
								<div class="pull-left sales-btn-group">
									<div class="btn-group btn-group-rounded">
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">امسال</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">این فصل</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">این ماه</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">این هفته</button>
										<button type="button" class="btn btn-default btn-xs btn-outline pl-10 pr-10">امروز</button>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div id="chart_1" class="" style="height:418px;"></div>
									<ul class="flex-stat flex-stat-2 mt-40">
										<li>
											<span class="block">آمار بازدید</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">3,24,222</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+15%</span>
											</span>
											<div class="clearfix"></div>
										</li>
										<li>
											<span class="block">سفارشات</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">1,23,432</span></span>
											<span class="block txt-success mt-5">
												<i class="zmdi zmdi-caret-up pr-5 font-20"></i><span class="weight-500">+4%</span>
											</span>
											<div class="clearfix"></div>
										</li>
										<li>
											<span class="block">درآمد</span>
											<span class="block txt-dark weight-500 font-18"><span class="counter-anim">324,222</span> تومان</span>
											<span class="block txt-danger mt-5">
												<i class="zmdi zmdi-caret-down pr-5 font-20"></i><span class="weight-500">-5%</span>
											</span>
											<div class="clearfix"></div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-xs-12">
						<div class="panel panel-default border-panel card-view panel-refresh">
							<div class="refresh-container">
								<div class="la-anim-1"></div>
							</div>
							<div class="panel-heading">
								<div class="pull-right">
									<h6 class="panel-title txt-dark">لیست سفارشات</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body row pa-0">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="datable_1" class="table  display table-hover mb-30">
												<thead>
													<tr>
														<th>شناسه فاکتور</th>
														<th>خریدار</th>
														<th>توضیحات</th>
														<th>مبلغ</th>
														<th>وضعیت</th>
														<th>ثبت سفارش</th>
														<th>پرداخت</th>
														<th>اطلاعات بیشتر</th>
													</tr>
												</thead>

												<tbody>
													@foreach ($orders as $order)
													<tr>
														<td>#{{$order->id}}</td>
														<td>{{$order->first_name.' '.$order->last_name}}</td>
														<td>{{$order->admin_description}}</td>
														<td><span class="num-comma">{{$order->total}}</span> تومان</td>
														<td>
															<?php
															switch ($order->status) {
																case 0: $status = ['پرداخت نشده', 'info']; break;
																case 1: $status = ['در انتظار پرداخت', 'warning']; break; 
																case 2: $status = ['پرداخت شده', 'dark']; break;
																case 3: $status = ['در حال بررسی', 'orange']; break;
																case 4: $status = ['در حال بسته بندی', 'warning']; break;
																case 5: $status = ['در حال ارسال', 'primary']; break;
																case 6: $status = ['ارسال شده', 'success']; break;
																case 7: $status = ['لغو شده', 'danger']; break;
																default: $status = ['پرداخت نشده', 'info'];
															}
															?>
															<span class="label label-{{$status[1]}}">{{$status[0]}}</span>
														</td>
														<?php 
															$time = new Carbon\Carbon($order->created_at);
															$created_at = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
														?>
														<td>{{$created_at.' | '.$time->hour.':'.$time->minute}}</td>
														<?php 
															$time = new Carbon\Carbon($order->payment);
															$payment = \App\Classes\jdf::gregorian_to_jalali($time->year, $time->month, $time->day, '/');	
														?>
														<td>{{$payment.' | '.$time->hour.':'.$time->minute}}</td>
														<td>
															<a href="/panel/invoice/{{$order->id}}">
																<i class="fa fa-file-text-o" aria-hidden="true"></i>
															</a>	
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- /Row -->
	</div>
@endsection

@section('scripts')
	<?php $scripts = [
		// jQuery
		'vendors/bower_components/jquery/dist/jquery.min.js',
		// Bootstrap Core JavaScript
		'vendors/bower_components/bootstrap/dist/js/bootstrap.min.js',
		// Data table JavaScript
		'vendors/bower_components/datatables/media/js/jquery.dataTables.min.js',
		// Slimscroll JavaScript
		'dist/js/jquery.slimscroll.js',
		// simpleWeather JavaScript
		'vendors/bower_components/moment/min/moment.min.js',
		'vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js',
		'dist/js/simpleweather-data.js',
		// Progressbar Animation JavaScript
		'vendors/bower_components/waypoints/lib/jquery.waypoints.min.js',
		'vendors/bower_components/jquery.counterup/jquery.counterup.min.js',
		// Fancy Dropdown JS
		'dist/js/dropdown-bootstrap-extended.js',
		// Sparkline JavaScript
		'vendors/jquery.sparkline/dist/jquery.sparkline.min.js',
		// Owl JavaScript
		'vendors/bower_components/owl.carousel/dist/owl.carousel.min.js',
		// ChartJS JavaScript
		'vendors/chart.js/Chart.min.js',
		// EasyPieChart JavaScript
		'vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
		// EChartJS JavaScript
		'vendors/bower_components/echarts/dist/echarts-en.min.js',
		'vendors/echarts-liquidfill.min.js',
		// Morris Charts JavaScript
		'vendors/bower_components/raphael/raphael.min.js',
		'vendors/bower_components/morris.js/morris.min.js',
		// Toast JavaScript
		'vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js',
		// Switchery JavaScript
		'vendors/bower_components/switchery/dist/switchery.min.js',
		// Bootstrap Select JavaScript
		'vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js',
		// Init JavaScript
		'dist/js/init.js',
		'dist/js/ecommerce-data.js',
		// js numeral formatter
		'js/numeral.min.js'
	]; ?>

	@foreach ($scripts as $script)
		<script src="{{ asset($script) }}"></script>
	@endforeach

	<script>
		var nums = document.getElementsByClassName('num-comma');

		for (num in nums) {
			nums[num].innerHTML = numeral(nums[num].innerHTML).format('0,0');
		}
	</script>
@endsection