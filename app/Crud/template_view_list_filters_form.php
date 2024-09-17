<div class="row border-0 pt-6 collapse  card-filtros " id="filtros">
            
            <div class="col-12 col-lg-4">
                <label for="texto" class=" form-label">Buscar</label>
                <input type="text" class="form-control form-control-transparent" id="texto" name="texto" value="{{ (isset($texto))?$texto:'' }}" />
            </div>

            %VIEW_LIST_FILTROS%

            <div class="col-12">
                <button type="button" class="btn btn-primary float-end" onclick="redirectFiltros()">
                    {!! getIcon('search-list', 'fs-2', '', 'i') !!}
                    Filtrar
                </button>
            </div>

        </div>