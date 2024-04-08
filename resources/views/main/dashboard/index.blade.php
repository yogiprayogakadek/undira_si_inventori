@extends('templates.master')

@section('page-title', 'Dashboard')
@section('page-sub-title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto text-center">
            <h1>Test</h1>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.pointer', function() {
                window.location = '/' + $(this).data('href');
            });
        });
    </script>
@endpush
