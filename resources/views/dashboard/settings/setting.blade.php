@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">{{__('admin/sidebar.main')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">{{__('admin/sidebar.settings')}} </a>
                                </li>
                                <li class="breadcrumb-item active"> Edit Setting Web
                                </li>
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
                                    <h4 class="card-title" id="basic-layout-form">Setting Web </h4>
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
                                              action="{{route('admin.setting.update',$setting -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$setting -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="{{asset('assets/images/settings')}}/{{$setting -> logo}}"
                                                        class="rounded-circle  height-150" alt="logo">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label> Logo </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                             <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>Setting Data Main Language</h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Site Name
                                                                - {{__('messages.'.$setting -> translation_lang)}} </label>
                                                            <input type="text" id="title"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   value="{{$setting -> title}}"
                                                                   name="settings[0][title]">
                                                            @error("settings.0.title")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Keywords Meta Web
                                                                 {{__('messages.'.$setting -> translation_lang)}} </label>
                                                            
                                                                   <textarea id="issueinput8" rows="5" class="form-control"
															name="settings[0][keywords}}]" placeholder="meta keywords"
															data-toggle="tooltip" data-trigger="hover"
															data-placement="top" data-title="settings[0][keywords}}]">{{$setting -> keywords}}</textarea>

                                                            @error("settings.0.keywords")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Description Meta Web
                                                                 {{__('messages.'.$setting -> translation_lang)}} </label>
                                                                 <textarea id="issueinput8" rows="5" class="form-control"
															name="settings[0][description}}]" placeholder="meta description"
															data-toggle="tooltip" data-trigger="hover"
															data-placement="top" data-title="settings[0][description}}]">{{$setting -> description}}</textarea>

                                                            @error("settings.0.description")
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
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
                                            @isset($setting -> settings)
                                                @foreach($setting -> settings   as $index =>  $translation)
                                                    <li class="nav-item">
                                                        <a class="nav-link @if($index ==  0) active @endif  " id="homeLable-tab"  data-toggle="tab"
                                                           href="#homeLable{{$index}}" aria-controls="homeLable"
                                                            aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                            {{$translation -> translation_lang}}</a>
                                                    </li>
                                                @endforeach
                                            @endisset
                                        </ul>
                                        <div class="tab-content px-1 pt-1">

                                            @isset($setting -> settings)
                                                @foreach($setting -> settings   as $index =>  $translation)

                                                <div role="tabpanel" class="tab-pane  @if($index ==  0) active  @endif  " id="homeLable{{$index}}"
                                                 aria-labelledby="homeLable-tab"
                                                 aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">

                                                <form class="form"
                                                      action="{{route('admin.setting.update',$translation -> id)}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <input name="id" value="{{$translation -> id}}" type="hidden">


                                                    <div class="form-body">

                                                        <h4 class="form-section"><i class="ft-home"></i> Setting Data Other Languages </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> Site Name
                                                                        - {{__('messages.'.$translation -> translation_lang)}} </label>
                                                                    <input type="text" id="name"
                                                                           class="form-control"
                                                                           placeholder=""
                                                                           value="{{$translation -> title}}"
                                                                           name="settings[0][title]">
                                                                    @error("settings.0.title")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> Keywords Meta Web
                                                                        - {{__('messages.'.$translation -> translation_lang)}} </label>
                                                                        <textarea id="issueinput8" rows="5" class="form-control"
															name="settings[0][keywords]" placeholder="meta keywords"
															data-toggle="tooltip" data-trigger="hover"
															data-placement="top" data-title="settings[0][keywords]">{{$translation -> keywords}}</textarea>
                                                                    
                                                                    @error("settings.0.title")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> Description Meta Web
                                                                        - {{__('messages.'.$translation -> translation_lang)}} </label>
                                                                        <textarea id="issueinput8" rows="5" class="form-control"
															name="settings[0][description}}]" placeholder="meta description"
															data-toggle="tooltip" data-trigger="hover"
															data-placement="top" data-title="settings[0][description}}]">{{$translation -> description}}</textarea>
                                                                    
                                                                    @error("settings.0.description")
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
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

                                                @endforeach
                                            @endisset

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
