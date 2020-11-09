<div
	class="main-menu menu-fixed menu-light menu-accordion    menu-shadow "
	data-scroll-to-active="true">
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation"
			data-menu="menu-navigation">

			<li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
					class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.main')}}
				</span></a></li>

<!-- 			 <li class="nav-item @if(Request::is('admin/associations*')) open @endif"> -->
<!--                 <a href=""><i class="la la-home"></i> -->
<!--                     <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.languages')}} </span> -->
<!--                     <span -->
<!--                         class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Language::count()}}</span> -->
<!--                 </a> -->
<!--                 <ul class="menu-content"> -->
<!--                     <li class="active"><a class="menu-item" href="{{route('admin.languages')}}" -->
<!--                                           data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a> -->
<!--                     </li> -->
<!--                     <li><a class="menu-item" href="{{route('admin.languages.create')}}" data-i18n="nav.dash.crypto"> -->
<!--                             {{__('admin/sidebar.add new language')}} </a> -->
<!--                     </li> -->
<!--                 </ul> -->
<!--             </li> -->
			
			<li
				class="nav-item @if(Request::is('admin/associations*')) open @endif">
				<a href=""><i class="la la-home"></i> <span class="menu-title"
					data-i18n="nav.dash.main">{{__('admin/sidebar.users')}} </span>
					<span class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Admin::count()}}</span>
			</a>
				<ul class="menu-content">
					@if (auth()->user()->hasPermission('read_users'))
					<li class="active"><a class="menu-item" href="{{route('admin.users')}}"
						data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a>
					</li>
					@else
					<li class="active"><a class="menu-item disabled" href="#"
						data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a>
					</li>
					@endif
					@if (auth()->user()->hasPermission('create_users'))
					<li><a class="menu-item" href="{{route('admin.users.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new user')}} </a></li>
                    @else
					<li><a class="menu-item disabled" href="#" data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new user')}} </a></li>
                    @endif
				</ul>
			</li>


			<li class="nav-item  @if(Request::is('admin/associations*')) open @endif"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.categories')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\MainCategory::count()}}
</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->hasPermission('read_users'))
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a>
                    </li>
                    @else
                    <li class="active"><a class="menu-item disabled" href="#"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a>
                    </li>
                    @endif
                    @if (auth()->user()->hasPermission('create_users'))
                    <li><a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">
                             {{__('admin/sidebar.add new cat')}}  </a>
                    </li>
                    @else
                    <li><a class="menu-item disabled" href="#" data-i18n="nav.dash.crypto">
                             {{__('admin/sidebar.add new cat')}}  </a>
                    </li>
                    @endif
                </ul>
            </li>

			<li class="nav-item  @if(Request::is('admin/associations*')) open @endif"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.settings')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">3
</span>
                </a>
                <ul class="menu-content">
                    @if (auth()->user()->hasPermission('read_settings'))
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                          data-i18n="nav.dash.ecommerce"> About Us </a>
                    </li>
                    @else
                    <li class="active"><a class="menu-item disabled" href="#"
                                          data-i18n="nav.dash.ecommerce"> About Us </a>
                    </li>
                    @endif
                    @if (auth()->user()->hasPermission('read_settings'))
                    <li><a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">
                             {{__('admin/sidebar.contact')}} </a>
                    </li>
                    @else
                    <li><a class="menu-item disabled" href="#" data-i18n="nav.dash.crypto">
                             {{__('admin/sidebar.contact')}} </a>
                    </li>
                    @endif
                    @if (auth()->user()->hasPermission('read_settings'))
                    <li><a class="menu-item" href="{{route('admin.maincategories.create')}}" data-i18n="nav.dash.crypto">
                             Site Settings  </a>
                    </li>
                    @else
                    <li><a class="menu-item disabled" href="#" data-i18n="nav.dash.crypto">
                             Site Settings </a>
                    </li>
                    @endif
                </ul>
            </li>
			

		</ul>
	</div>
</div>