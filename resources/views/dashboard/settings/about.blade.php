@extends('layouts.admin') @section('content')

<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-6 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="breadcrumb-wrapper col-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="">{{__('admin/sidebar.main')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">About Us </a>
                                </li>
							<li class="breadcrumb-item active">Edit About Us</li>
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
								<h4 class="card-title" id="basic-layout-form">About Us</h4>
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
									<form class="form"
										action="{{route('admin.about.update',$about -> id)}}"
										method="POST" enctype="multipart/form-data">
										@csrf <input name="id" value="{{$about -> id}}" type="hidden">

										<div class="form-group">
											<div class="text-center">
												<img
													src="{{asset('assets/images/abouts')}}/{{$about -> image}}"
													class="rounded-circle  height-150" alt="image">
											</div>
										</div>


										<div class="form-group">
											<label> logo </label> <label id="projectinput7"
												class="file center-block"> <input type="file" id="file"
												name="photo"> <span class="file-custom"></span>
											</label> @error('photo') <span class="text-danger">{{$message}}</span>
											@enderror
										</div>

										<div class="form-body">

											<h4 class="form-section">
												<i class="ft-home"></i> About Us Data Main Language
											</h4>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> Title -
															{{__('messages.'.$about -> translation_lang)}} </label> 
															<input type="text" id="name" class="form-control"
															placeholder="  " value="{{$about -> title}}"
															name="abouts[0][title]"> @error("abouts.0.title") <span
															class="text-danger"> {{$message}}</span> @enderror
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> Title Slug-
															{{__('messages.'.$about -> translation_lang)}} </label> 
															<input disabled type="text" id="name" class="form-control"
															placeholder="" value="{{$about -> slug}}"
															name="abouts[0][slug]"> 
															
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> Keywords About Us
															{{__('messages.'.$about -> translation_lang)}} </label>
														<textarea id="issueinput8" rows="5" class="form-control"
															name="abouts[0][keywords]" placeholder="meta keywords"
															data-toggle="tooltip" data-trigger="hover"
															data-placement="top" data-title="abouts[0][keywords]">{{$about -> keywords}}</textarea>
														@error("abouts.0.keywords") <span class="text-danger"> {{$message}}</span> @enderror
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> Description About Us
															{{__('messages.'.$about -> translation_lang)}} </label>
														<textarea id="issueinput8" rows="5" class="form-control"
															name="abouts[0][description]"
															placeholder="meta description" data-toggle="tooltip"
															data-trigger="hover" data-placement="top"
															data-title="abouts[0][description]">{{$about -> description}}</textarea>
														@error("abouts.0.description") <span class="text-danger">
															{{$message}}</span> @enderror
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="projectinput1"> Details -
															{{__('messages.'.$about -> translation_lang)}} </label>
														<textarea name="abouts[0][details]"
															id="abouts[0][details]" cols="30" rows="15"
															class="ckeditor" placeholder="">{{$about ->details}}</textarea>

														@error("abouts.0.details") <span class="text-danger"> {{$message}}
															 </span> @enderror
													</div>
												</div>

												

											</div>

										</div>


										<div class="form-actions">
											<button type="button" class="btn btn-warning mr-1"
												onclick="history.back();">
												<i class="ft-x"></i> Cancel
											</button>
											<button type="submit" class="btn btn-primary">
												<i class="la la-check-square-o"></i> Update
											</button>
										</div>
									</form>

									<ul class="nav nav-tabs">
										@isset($about -> abouts) @foreach($about -> abouts as $index
										=> $translation)
										<li class="nav-item"><a
											class="nav-link @if($index ==  0) active @endif  "
											id="homeLable-tab" data-toggle="tab"
											href="#homeLable{{$index}}" aria-controls="homeLable"
											aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
												{{$translation -> translation_lang}}</a></li> @endforeach
										@endisset
									</ul>
									<div class="tab-content px-1 pt-1">

										@isset($about -> abouts) @foreach($about -> abouts as $index
										=> $translation)

										<div role="tabpanel"
											class="tab-pane  @if($index ==  0) active  @endif  "
											id="homeLable{{$index}}" aria-labelledby="homeLable-tab"
											aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">

											<form class="form"
												action="{{route('admin.about.update',$translation -> id)}}"
												method="POST" enctype="multipart/form-data">
												@csrf <input name="id" value="{{$translation -> id}}"
													type="hidden">

												<div class="form-body">

													<h4 class="form-section">
														<i class="ft-home"></i> About Us Data Other Languages
													</h4>
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label for="projectinput1"> Title -
																	{{__('messages.'.$translation -> translation_lang)}} </label>
																<input type="text" id="name" class="form-control"
																	placeholder="  " value="{{$translation -> title}}"
																	name="abouts[0][title]"> @error("abouts.0.title") <span
																	class="text-danger"> {{$message}}</span> @enderror
															</div>
														</div>
														<div class="col-md-6">
													<div class="form-group">
														<label for="projectinput1"> Title Slug-
															{{__('messages.'.$translation -> translation_lang)}} </label> 
															<input disabled type="text" id="name" class="form-control"
															placeholder="" value="{{$translation -> slug}}"
															name="abouts[0][slug]"> 
															
													</div>
												</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="projectinput1"> Keywords About Us -
																	{{__('messages.'.$translation -> translation_lang)}} </label>
																	<textarea name="abouts[0][keywords]" placeholder="meta keywords" data-toggle="tooltip"
															data-trigger="hover" data-placement="top"
															data-title="abouts[0][keywords]" id="issueinput8" rows="5" class="form-control" >{{$translation -> keywords}}</textarea>
																	@error("abouts.0.title") <span
																	class="text-danger"> {{$message}}</span>
																	 @enderror
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="projectinput1"> Description About Us -
																	{{__('messages.'.$translation -> translation_lang)}} </label>
																	<textarea name="abouts[0][description]" placeholder="meta description" data-toggle="tooltip"
															data-trigger="hover" data-placement="top"
															data-title="abouts[0][description]" id="issueinput8" rows="5" class="form-control">{{$translation -> description}}</textarea>
																
																@error("abouts.0.description") <span class="text-danger">
																	{{$message}}</span> @enderror
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<label for="projectinput1">Details -
																	{{__('messages.'.$translation -> translation_lang)}} </label>
																	<textarea name="abouts[0][details]"
															id="abouts[0][details]" cols="30" rows="15"
															class="ckeditor" placeholder="">{{$translation -> details}}</textarea>
																
																@error("abouts.0.details") <span class="text-danger">
																	{{$message}}</span> @enderror
															</div>
														</div>


													</div>

												</div>


												<div class="form-actions">
													<button type="button" class="btn btn-warning mr-1"
														onclick="history.back();">
														<i class="ft-x"></i> Cancel
													</button>
													<button type="submit" class="btn btn-primary">
														<i class="la la-check-square-o"></i> Update
													</button>
												</div>
											</form>
										</div>

										@endforeach @endisset

									</div>


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

@endsection
