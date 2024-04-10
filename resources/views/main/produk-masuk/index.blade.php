@extends('templates.master')

@section('page-title', 'Produk Masuk')
@section('page-sub-title', 'Data')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css">
@endpush

@section('content')
    <div class="row render">
        {{-- data rendered --}}
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
    <script src="{{ asset('assets/function/produk-masuk/main.js') }}"></script>
    <script>
        @if (session('status'))
            Swal.fire(
                "{{ session('title') }}",
                "{{ session('message') }}",
                "{{ session('status') }}",
            );
        @endif
    </script>
@endpush
