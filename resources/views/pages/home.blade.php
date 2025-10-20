@extends('components.layouts.pages-layout')

@section('content')
    <div class="">
        <livewire:link-history />
        <livewire:track-link-click url="https://github.com" />
        <livewire:track-link-click url="{{ route('dashboard') }}" />

    </div>
@endsection
