<!--begin:: Avatar -->
<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $crud->name) }}">
        {{ substr($crud->name, 0, 1) }}
    </div>       
</div>
<!--end::Avatar-->
<!--begin::Crud details-->
<div class="d-flex flex-column">
        {{ $crud->name }}
</div>
<!--begin::Crud details-->
