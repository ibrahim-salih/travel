@extends('layouts.admin') @section('content')

<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-6 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="">main </a></li>
							<li class="breadcrumb-item"><a href="{{route('admin.users')}}">
									admins </a></li>
							<li class="breadcrumb-item active">edit admin</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- Basic form layout section start -->
			<section id="basic-form-layouts">
				<div class="row match-height">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title" id="basic-layout-form">edit admin</h4>
								<a class="heading-elements-toggle"><i
									class="la la-ellipsis-v font-medium-3"></i></a>
								<div class="heading-elements">
									<ul class="list-inline mb-0">
										<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
										<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
										<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
										<li><a data-action="close"><i class="ft-x"></i></a></li>
									</ul>
								</div>
							</div>
							@include('dashboard.includes.alerts.success')
							@include('dashboard.includes.alerts.errors')
							<div class="card-content collapse show">
								<div class="card-body">
									<input name="id" value="{{$user -> id}}" type="hidden">
									<form class="form"
										action="{{ route('admin.users.update', $user->id) }}"
										method="POST" enctype="multipart/form-data">
										@csrf @if($user -> image != '' )
										<div class="form-group">
											<div class="text-center">
												<figure class="effect-romeo">
													<img style="width: 150px; height: 150px;"
														src="{{asset('assets/images/users')}}/{{$user -> image}}"
														alt="{{$user->name}}" />
													<figcaption>
														<h2>
															<span>x</span>
														</h2>
														<a href="{{route('admin.userdelete.image',$user->id)}}">Delete Image</a>
													</figcaption>
												</figure>
											</div>
										</div> 
										@else
										<div class="form-group">
											<label> image </label> <label id="projectinput7"
												class="file center-block"> <input type="file" id="file"
												name="photo"> <span class="file-custom"></span>
											</label> @error('photo') <span class="text-danger">{{$message}}</span>
											@enderror
										</div>
										@endif



										<div class="form-body">

											<h4 class="form-section">
												<i class="ft-home"></i> admin data
											</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> name </label> <input
															type="text" id="name" class="form-control"
															placeholder="  " value="{{$user->name}}" name="name">
														@error("name") <span class="text-danger">{{$message}}</span>
														@enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> email </label> <input
															type="text" id="email" class="form-control"
															placeholder="  " value="{{$user->email}}" name="email">
														@error("email") <span class="text-danger">{{$message}}</span>
														@enderror
													</div>
												</div>
												
                                                   

												<div class="col-md-12">
													<div class="form-group">
														<label>Permissions For Used</label>
														<div class="nav-tabs-custom">

															@php 
															$models = ['users', 'categories', 'settings','cities','attr','daytour','vedios','gallery','que_ans'];
															$maps= ['create', 'read', 'update', 'delete']; 
															@endphp

															<ul class="nav nav-tabs">
																@foreach ($models as $index=>$model)
																<li class="nav-item"><a
																	class="nav-link @if($index ==  0 ) active @endif  "
																	id="homeLable-tab" data-toggle="tab"
																	href="#homeLable{{$index}}" aria-controls="homeLable"
																	aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
																		@lang($model)</a>
																		</li> 
																		@endforeach
															</ul>

															<div class="tab-content px-1 pt-1">

																@foreach ($models as $index=>$model)
																<div role="tabpanel"
																	class="tab-pane  @if($index ==  0) active  @endif  "
																	id="homeLable{{$index}}"
																	aria-labelledby="homeLable-tab"
																	aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
																	@foreach ($maps as $map) <label><input
																		class="switchery" data-color="success" type="checkbox"
																		name="permissions[]" {{ $user->hasPermission($map .
																		'_' . $model) ? 'checked' : '' }} value="{{ $map . '_'
																		. $model }}"> @lang($map)</label>
																	@endforeach
																</div>

																@endforeach

															</div>
															<!-- end of tab content -->

														</div>
														<!-- end of nav tabs -->
														@error("permissions") <span class="text-danger">{{$message
															}}</span> @enderror
													</div>
												</div>

											</div>

										</div>


										<div class="form-actions">
											<button type="button" class="btn btn-warning mr-1"
												onclick="history.back();">
												<i class="ft-x"></i> back
											</button>
											<button type="submit" class="btn btn-primary">
												<i class="la la-check-square-o"></i> update
											</button>
										</div>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- // Basic form layout section end -->
		</div>
	</div>
</div>

@stop
