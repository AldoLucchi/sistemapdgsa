<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

			@if(Session::has('menues'))
			@foreach( Session::get('menues') as $menu)
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">{{  $menu['nombre'] }}</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->

			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ request()->routeIs($menu['ruta'].'.*') ? 'here show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('abstract-28', 'fs-2') !!}</span>
					<span class="menu-title">{{  $menu['nombre'] }}</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">

					@foreach($menu['items'] as $item)
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
							@if($item['tipo'] == 'crud')
							<a class="menu-link {{ request()->routeIs($item['ruta'].'.*') ? 'active' : '' }}" href="{{ route($menu['ruta'].'.'.$item['ruta'].'.index') }}">
								@else
							<a class="menu-link {{ str_contains(request()->route()->getName(), $item['ruta_laravel'])  ? 'active' : '' }}" href="{{ $item['ruta'] }}"> 
							@endif
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">{{ $item['nombre'] }}</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					@endforeach
				</div>
				<!--end:Menu sub-->
			</div>
			
			<!--end:Menu item-->

			@endforeach
			@endif
		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->