{{ Form::open(['url' => $url, 'method' => $method, 'id' => 'formReport']) }}

    <div class="card-body">

        <h4 class="header-title">Registrar informe</h4>

        <input type="hidden" name="{{ isset($report->id) ? $report->id : '' }}" name="id">

        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">N° Cotización</label>
            <div class="form-group col-md-3">
                {{ Form::text('quote_number', isset($report->quote_number) ? $report->quote_number : old('quote_number'), ['class' => 'form-control', 'id' => 'quote_number', 'style' => 'text-transform: uppercase;']) }}
            </div>
            <div class="col-md-1">
                <a id="findQuote" class="btn btn-outline-secondary"><i class="fas fa-search"></i></a>
            </div>

            <label for="example-text-input" class="col-md-1 col-form-label">Informe Lab.</label>
            <div class="form-group col-md-2">
                {{ Form::text('laboratory_report_number', isset($report->laboratory_report_number) ? $report->laboratory_report_number : old('laboratory_report_number'), ['class' => 'form-control', 'id' => 'laboratory']) }}
            </div>

            <label for="example-text-input" class="col-md-1 col-form-label">Código</label>
            <div class="form-group col-md-2">
                {{ Form::text('code', isset($report->code) ? $report->code : old('code'), ['class' => 'form-control', 'id' => 'code']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-email-input" class="col-md-2 col-form-label">Razón Social</label>
            <div class="form-group col-md-10">
                {{ Form::hidden('client_id', isset($report->client_id) ? $report->IdClient : old('client_id'), ['id' => 'client_id']) }}
                {{ Form::hidden('client_document', isset($report->client->document) ? $report->client->document : old('client_document'), ['id' => 'client_document']) }}
                {{ Form::text('client_name', isset($report->client->name) ? $report->client->name : old('client_name'), ['class' => 'form-control', 'id' => 'client_name', 'readonly']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-url-input" class="col-md-2 col-form-label">Ejecutivo Comercial</label>
            <div class="form-group col-md-10">
                {{ Form::hidden('client_executive_id', isset($report->client_executive_id) ? $report->client_executive_id : old('client_executive_id'), ['id' => 'client_executive_id']) }}
                {{ Form::text('client_executive', isset($report->client_executive) ? $report->client_executive : old('client_executive'), ['class' => 'form-control', 'id' => 'client_executive', 'readonly']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-search-input" class="col-md-2 col-form-label">Responsable</label>
            <div class="form-group col-md-4">
                <select name="report_manager_id" id="report_manager_id" placeholder="Seleccione" class="custom-select">
                    <option value="">Seleccione</option>
                    @if ($report_managers)
                        @foreach ($report_managers as $manager)
                            <option value="{{ $manager->id }}" {{ isset($report->report_manager_id) ? ($manager->id == $report->report_manager_id) ? 'selected' : ''  : ''   }}>{{ $manager->NombreCompleto() }}</option>    
                        @endforeach    
                    @endif
                </select>
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">Tipo reporte</label>
            <div class="form-group col-md-4">
                {{ Form::select('type_report_id', $types, (isset($report->type_report_id) ? $report->type_report_id : old('type_report_id')), [ 'class' => 'custom-select', 'placeholder' => 'Seleccione']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="example-number-input" class="col-md-2 col-form-label">Fecha de inicio</label>
            <div class="form-group col-md-4">
                {{ Form::date('expedition', isset($report->expedition) ? $report->expedition : '', [ 'class' => 'form-control']) }}
            </div>

            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Fecha de envío (preliminar)</label>
            <div class="col-md-4">
                {{ Form::date('notification', isset($report->notification) ? $report->notification : '', [ 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">

            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Fecha de envío</label>
            <div class="col-md-4">
                {{ Form::date('shipping', isset($report->shipping) ? $report->shipping : '', [ 'class' => 'form-control']) }}
            </div>

            <label for="example-search-input" class="col-md-2 col-form-label">A nombre de</label>
            <div class="form-group col-md-4">
                <select name="to_name" id="to_name" placeholder="Seleccione" class="custom-select  {{ ($errors->has('to_name')) ? 'is-invalid' : '' }}">
                    <option value="">Seleccione</option>
                    @if ($companies)
                        @foreach ($companies as $company)
                            <option value="{{ $company }}" {{ (isset($report->to_name) ? (($report->to_name == $company) ? 'selected' : '') : ( old('company') == $company ? 'selected' : '' )) }}>{{ $company }}</option>    
                        @endforeach    
                    @endif
                </select>
            </div>

        </div>

        <h5>Compromisos</h5>

        <div class="row" style="margin-bottom: 40px;">
            <div class="col">
              
                <select multiple="multiple" size="10" name="commitments[]" title="duallistbox_demo1[]">
                    @if (isset($commitments))
                        @foreach ($commitments as $commitment)
                            {!!  $found_key = array_search($commitment->IdCommitment, array_column($report_commitments, 'IdCommitment')) !!}
                            <option value="{{ $commitment->IdCommitment }}" {{ count($report_commitments) > 0 ? ( $found_key !== false ? 'selected' : '' ) : '' }} >
                                {{ $commitment->CodeCommitment . ' - ' . $commitment->Summary }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Guardar</button>
            <a href="{{ route('all.report') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>

{{ Form::close() }}

<span class="urlBuscarCotizacion d-none" data-url="{{ route('admin.find.cotizacion.ajax') }}"></span>