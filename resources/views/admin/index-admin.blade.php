@extends('admin.layouts.layout-admin')

@section('content')
{{-- {{dd(Auth::guard('webadmin'))}} --}}
    @include('admin.partials.navbar-admin')
    @include('partials.toast')
    <div class="container" style="padding-top:0.25rem;">
        {{-- {{dd($now)}} --}}
        @include("admin.partials.pages.$partial")
    </div>
@endsection