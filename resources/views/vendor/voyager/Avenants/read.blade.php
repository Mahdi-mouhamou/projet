@extends('voyager::master')
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #ff4400;
        color: white;
    }
</style>
@section('page_title', __('voyager::generic.view') . ' ' . $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }}
        {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.' . $dataType->slug . '.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <i class="glyphicon glyphicon-pencil"></i> <span
                    class="hidden-xs hidden-sm">{{ __('voyager::generic.edit') }}</span>
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            @if ($isSoftDeleted)
                <a href="{{ route('voyager.' . $dataType->slug . '.restore', $dataTypeContent->getKey()) }}"
                    title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore"
                    data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span
                        class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
                </a>
            @else
                <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete"
                    data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span
                        class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
                </a>
            @endif
        @endcan
        @can('browse', $dataTypeContent)
            <a href="{{ route('voyager.' . $dataType->slug . '.index') }}" class="btn btn-warning">
                <i class="glyphicon glyphicon-list"></i> <span
                    class="hidden-xs hidden-sm">{{ __('voyager::generic.return_to_list') }}</span>
            </a>
        @endcan
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')


    <table class="table" id="customers">
        <thead>
            
            <tr>
                @foreach ($dataType->readRows as $row)
                    <th scope="col">{{ $row->getTranslatedAttribute('display_name') }}</th>
@endforeach
            </tr>
        </thead>
            <tbody>
            <tr>
                @foreach ($dataType->readRows as $row)
                <td>
                
                    @if ($row->type == 'relationship')
                        @include('voyager::formfields.relationship', [
                            'view' => 'read',
                            'options' => $row->details,
                        ])
                    
                    @elseif ($row->type == 'select_dropdown' && property_exists($row->details, 'options') && !empty($row->details->options->{$dataTypeContent->{$row->field}}))
                        <?php echo $row->details->options->{$dataTypeContent->{$row->field}}; ?>
                    @elseif($row->type == 'select_multiple')
                        @if (property_exists($row->details, 'relationship'))

                            @foreach (json_decode($dataTypeContent->{$row->field}) as $item)
                                {{ $item->{$row->field} }}

                            @endforeach
                        @elseif(property_exists($row->details, 'options'))
                            @if (!empty(json_decode($dataTypeContent->{$row->field})))
                                @foreach (json_decode($dataTypeContent->{$row->field}) as $item)
                                    @if (@$row->details->options->{$item})
                                        {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    @else
                    @include('voyager::multilingual.input-hidden-bread-read')
                    {{ $dataTypeContent->{$row->field} }}
                    @endif
                </td>
                @endforeach
            </tr>
        

            </tbody>
    </table>

            {{-- Single delete modal --}}
            <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="{{ __('voyager::generic.close') }}"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="voyager-trash"></i>
                                {{ __('voyager::generic.delete_question') }}
                                {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('voyager.' . $dataType->slug . '.index') }}" id="delete_form"
                                method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                    value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                            </form>
                            <button type="button" class="btn btn-default pull-right"
                                data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @stop

        @section('javascript')
            @if ($isModelTranslatable)
                <script>
                    $(document).ready(function() {
                        $('.side-body').multilingual();
                    });
                </script>
            @endif
            <script>
                var deleteFormAction;
                $('.delete').on('click', function(e) {
                    var form = $('#delete_form')[0];

                    if (!deleteFormAction) {
                        // Save form action initial value
                        deleteFormAction = form.action;
                    }

                    form.action = deleteFormAction.match(/\/[0-9]+$/) ?
                        deleteFormAction.replace(/([0-9]+$)/, $(this).data('id')) :
                        deleteFormAction + '/' + $(this).data('id');

                    $('#delete_modal').modal('show');
                });
            </script>
        @stop
