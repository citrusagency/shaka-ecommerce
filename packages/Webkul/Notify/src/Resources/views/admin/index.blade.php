@extends('admin::layouts.content')

@section('page_title')
    {{ __('notify::app.page.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('notify::app.page.title') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('notify::app.page.export') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="page-content">
            <datagrid-plus src="{{ route('admin.notify.index') }}"></datagrid-plus>
        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('notify::app.page.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

@stop

@push('scripts')
    @include('admin::export.export', ['gridName' => app('Webkul\Notify\DataGrids\NotifyDataGrid')])
    <script>
        function sendQuickMail(notificationId) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.notify.updateStockStatus") }}',
                data: {
                    notificationId: notificationId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(error) {
                    console.error('Error sending notification:', error);
                }
            });
        }
    </script>
@endpush