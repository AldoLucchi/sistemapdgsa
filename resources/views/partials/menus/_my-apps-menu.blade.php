<!--begin::My apps-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
	<!--begin::Card-->
	<div class="card">
		<!--begin::Card header-->
		<div class="card-header">
			<!--begin::Card title-->
			<div class="card-title">Mis Proyectos</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Menu-->
				{!! getIcon('folder', 'fs-2') !!}
				<!--end::Menu-->
			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
		<!--begin::Card body-->
		<div class="card-body py-5">
			<!--begin::Scroll-->
			<div class="mh-450px scroll-y me-n5 pe-5">
				<!--begin::Row-->
				<div class="row g-2">					

					@if(Session::has('usuario_proyectos'))
					@foreach(Session::get('usuario_proyectos') as $proyecto)
					<!--begin::Col-->
					<div class="col-4">
						<a href="{{ url('/proyecto/'.$proyecto->idproyecto) }}" class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3">
							<img src="{{ '/images/'.$proyecto->logo   }}" class="w-25px h-25px mb-2" alt="" />
							<span class="fw-semibold">{{ $proyecto->nombre }}</span>
						</a>
					</div>
					<!--end::Col-->
					@endforeach
					@endif

				</div>
				<!--end::Row-->
			</div>
			<!--end::Scroll-->
		</div>
		<!--end::Card body-->
	</div>
	<!--end::Card-->
</div>
<!--end::My apps-->