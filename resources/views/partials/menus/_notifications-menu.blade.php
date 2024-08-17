@inject('notificationService', 'App\Services\NotificationService')

@php
$data = $notificationService->getNotificationsByUser();
@endphp


<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
	<!--begin::Heading-->
	<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('assets/media/misc/menu-header-bg.jpg')">
		<!--begin::Title-->
		<h3 class="text-white fw-semibold px-9 mt-10 mb-6">Notificaciones
			<span class="fs-8 opacity-75 ps-3">{{ $data['cantidad'] }} notificaciones</span>
		</h3>
		<!--end::Title-->
		<!--begin::Tabs-->
		<ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
			<li class="nav-item">
				<a class="nav-link text-white opacity-75 opacity-state-100 pb-4 active" data-bs-toggle="tab" href="#kt_topbar_notifications_1">Sin leer</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white opacity-75 opacity-state-100 pb-4 " data-bs-toggle="tab" href="#kt_topbar_notifications_2">Leídas</a>
			</li>

		</ul>
		<!--end::Tabs-->
	</div>
	<!--end::Heading-->


	<!--begin::Tab content-->
	<div class="tab-content">
		<!--begin::Tab panel-->
		<div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
			<!--begin::Items-->
			<div class="scroll-y mh-325px my-5 px-8">

				@foreach($data['noleidas'] as $notificationNoLeida)
				@if($loop->iteration <= 10)

					<!--begin::Item-->
					<div class="d-flex flex-stack py-4">
						<!--begin::Section-->
						<div class="d-flex align-items-center">
							<!--begin::Symbol-->
							<div class="symbol symbol-35px me-4">
								<span class="symbol-label bg-light-danger">{!! getIcon('information', 'fs-2 text-danger') !!}</span>
							</div>
							<!--end::Symbol-->
							<!--begin::Title-->
							<div class="mb-0 me-2">
								<a data-bs-toggle="collapse" href="#notification_{{ $notificationNoLeida->id }}" class="fs-6 text-gray-800 text-hover-primary fw-bold markRead" aria-expanded="false" role="button" aria-controls="notification_{{ $notificationNoLeida->id }}" id="{{ $notificationNoLeida->id }}">
									{{ $notificationNoLeida['data']['title'] }}
								</a>

							</div>
							<!--end::Title-->
						</div>
						<!--end::Section-->
						<!--begin::Label-->
						<span class="badge badge-light fs-8">{{ $notificationNoLeida->created_at }}</span>
						<!--end::Label-->

					</div>

					<div class="col-12 py-4 collapse" id="notification_{{ $notificationNoLeida->id }}">
						{!! $notificationNoLeida['data']['body'] !!}
					</div>
					<!--end::Item-->

					@endif
					@endforeach
			</div>
			<!--end::Items-->
			<!--begin::View more-->
			<!--
			<div class="py-3 text-center border-top">
				<a href="#" class="btn btn-color-gray-600 btn-active-color-primary">Ver todas {!! getIcon('arrow-right', 'fs-5') !!}</a>
			</div>
			-->
			<!--end::View more-->
		</div>
		<!--end::Tab panel-->


		<!--begin::Tab panel-->
		<div class="tab-pane fade  " id="kt_topbar_notifications_2" role="tabpanel">
			<!--begin::Items-->
			<div class="scroll-y mh-325px my-5 px-8">

				@foreach($data['leidas'] as $notificationLeida)
				@if($loop->iteration <= 10)

					<!--begin::Item-->
					<div class="d-flex flex-stack py-4">
						<!--begin::Section-->
						<div class="d-flex align-items-center">
							<!--begin::Symbol-->
							<div class="symbol symbol-35px me-4">
								<span class="symbol-label bg-light-danger">{!! getIcon('information', 'fs-2 text-danger') !!}</span>
							</div>
							<!--end::Symbol-->
							<!--begin::Title-->
							<div class="mb-0 me-2">
								<a data-bs-toggle="collapse" href="#notification_{{ $notificationLeida->id }}" class="text-gray-500 fs-7" aria-expanded="false" role="button" aria-controls="notification_{{ $notificationLeida->id }}">
									{{ $notificationLeida['data']['title'] }}
								</a>
							</div>
							<!--end::Title-->
						</div>
						<!--end::Section-->
						<!--begin::Label-->
						<span class="badge badge-light text-gray-500 fs-8">{{ $notificationLeida->created_at }}</span>
						<!--end::Label-->
					</div>

					<div class="col-12 py-4 collapse" id="notification_{{ $notificationLeida->id }}">
						{!! $notificationLeida['data']['body'] !!}
					</div>
					<!--end::Item-->
					@endif
					@endforeach
			</div>
			<!--end::Items-->
			<!--begin::View more-->
			<!--
			<div class="py-3 text-center border-top">
				<a href="#" class="btn btn-color-gray-600 btn-active-color-primary">Ver todas {!! getIcon('arrow-right', 'fs-5') !!}</a>
			</div>
			-->
			<!--end::View more-->
		</div>
		<!--end::Tab panel-->

	</div>
	<!--end::Tab content-->
</div>
<!--end::Menu-->

<script>
	var notificationes = document.getElementsByClassName("markRead");

	for (var i = 0; i < notificationes.length; i++) {
		notificationes[i].addEventListener("click", (event) => {
			var notification_id = event.target.id;
			console.log('notification -- ' +notification_id  );

			$.get("/notificationMarkRead/"+notification_id, function(data, status) {
				console.log(data);
			});
		});
	}
</script>