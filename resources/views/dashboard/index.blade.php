@extends('dashboard.layouts.main')
@section('container')
@if (auth()->user()->is_admin == 0)
@include('dashboard.anggota.awal')
@else
@include('dashboard.admin.awal')
@endif
@endsection