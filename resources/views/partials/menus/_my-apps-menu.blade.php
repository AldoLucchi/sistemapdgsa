<!--begin::My apps-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
	<!--begin::Card-->
	<div class="card">
		<!--begin::Card header-->
		<div class="card-header">
			<!--begin::Card title-->
			<div class="card-title">Accesos Directos</div>
			<!--end::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Menu-->
				{!! getIcon('setting', 'fs-2') !!}
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

					@if(session()->has('accesos_directos'))
					@foreach(session()->get('accesos_directos') as $acceso_directo)
					
					@if(!$acceso_directo->idcrud)
					<!--begin::Col-->
					<div class="col-4">
						<a href="{{ url($acceso_directo->url) }}" class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3" target="_blank">
							<img src="{{ '/images/'.$acceso_directo->icono   }}" class="w-25px h-25px mb-2" alt="" />
							<span class="fw-semibold">{{ $acceso_directo->titulo }}</span>
						</a>
					</div>
					<!--end::Col-->
					@elseif(session()->has('crud_active') && session()->has('crud_active_id') && session()->get('crud_active') && session()->get('crud_active_id'))
					@if(session()->get('crud_active') == $acceso_directo->CrudDetalle->nombre_componente)
					<!--begin::Col-->
					<div class="col-4">
						<a href="{{ url($acceso_directo->url.session()->get('crud_active_id')) }}" class="d-flex flex-column flex-center text-center text-gray-800 text-hover-primary bg-hover-light rounded py-4 px-3 mb-3" target="_blank">
							<img src="{{ '/images/'.$acceso_directo->icono   }}" class="w-25px h-25px mb-2" alt="" />
							<span class="fw-semibold">{{ $acceso_directo->titulo }}</span>
						</a>
					</div>
					<!--end::Col-->					
					@endif
					@endif
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