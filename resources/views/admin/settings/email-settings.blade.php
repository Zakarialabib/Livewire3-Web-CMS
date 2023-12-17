@extends('layouts.dashboard')
@section('title', __('Email Settings'))
@section('content')
    <div class="card bg-white ">
        <div class="p-6 rounded-t rounded-r mb-0 border-b border-gray-200">
            <div class="card-header-container flex flex-wrap">
                <h6 class="text-xl font-bold text-zinc-700">
                    {{ __('Email Settings') }}
                </h6>
            </div>
        </div>
        <div class="py-10">
            @livewire('admin.settings.smtp')
        </div>
    </div>
@endsection
