<div class="accordion-item bg-secondary">
    <h2 class="accordion-header" id="panel%OBJETO%">
        <button class="accordion-button bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panel%OBJETO%Collapse" aria-expanded="true" aria-controls="panel%OBJETO%Collapse">
            %OBJETO_ALIAS%  |  %CREATE%
        </button>
    </h2>
    <div id="panel%OBJETO%Collapse" class="accordion-collapse collapse " aria-labelledby="panel%OBJETO%">
        <div class="accordion-body">
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <div class="table-responsive">
                    {{ $dataTable%OBJETO%->table() }}
                </div>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
    </div>
</div>

<!-- %RELATIONS_DATATABLE% -->