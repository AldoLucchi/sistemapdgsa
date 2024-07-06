<div class="accordion-item bg-secondary">
    <h2 class="accordion-header" id="panel%OBJECT%">
        <button class="accordion-button bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panel%OBJECT%Collapse" aria-expanded="true" aria-controls="panel%OBJECT%Collapse">
            %OBJECT_ALIAS%
        </button>
    </h2>
    <div id="panel%OBJECT%Collapse" class="accordion-collapse collapse " aria-labelledby="panel%OBJECT%">
        <div class="accordion-body">
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <div class="table-responsive">
                    {{ $dataTable%OBJETO_DATATABLE%->table() }}
                </div>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
    </div>
</div>

<!-- %RELATIONS_DATATABLE% -->