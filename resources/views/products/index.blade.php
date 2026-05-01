@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
    <livewire:product-manager />
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
