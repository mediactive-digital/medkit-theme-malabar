@extends('medKitTheme::_layouts.back.app')

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
		<span class="btn px-0 border-0 title">
            {{ _i('Historique') }}
        </span>
        </div>
        <div class="card-body">
            <table id="history-table" class="table table-striped table-bordered dt-responsive nowrap">
                <thead>
                <tr>
                    <th>{{ _i('Table') }}</th>
                    <th>{{ _i('Identifiant') }}</th>
                    <th>{{ _i('Utilisateur') }}</th>
                    <th>{{ _i('Action') }}</th>
                    <th>{{ _i('Modification') }}</th>
                    <th>{{ _i('Date action') }}</th>
                  <!--  <th>{{ _i('Date de modification') }}</th> -->
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    {!! MDAsset::addJs('back.pages.history') !!}
@endpush
