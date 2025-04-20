@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <livewire:widgets.stats />
    <livewire:widgets.users-count />
@endsection
@section('scripts')
    <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
@endsection
