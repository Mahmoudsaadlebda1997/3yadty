@extends('layouts.master')
@section('title')
    لوحه التحكم
@endsection
@section('css')

@endsection
@section('title_1')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">لوحه التحكم</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        تم تسجيل دخولك بنجاج  {{auth()->user()->name}}
                    </div>
                    <img src="https://image.shutterstock.com/image-vector/ad-letter-logo-design-template-260nw-1052025881.jpg">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
