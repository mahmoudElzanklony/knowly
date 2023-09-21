@extends('layout.master2')
@push('custom-scripts')
    <script>
        $(document).ready(function(){
            location.href = '{{ route('payment.fail')}}';
        });
    </script>
@endpush



