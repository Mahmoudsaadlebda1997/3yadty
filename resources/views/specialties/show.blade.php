@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>تفاصيل التخصص الطبي</h1>
        </section>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <img src="{{ $specialty->image ? asset('uploads/' . $specialty->image) : asset('images/no-image.png') }}" class="card-img-top img-fluid mx-auto d-block w-25" alt="{{ $specialty->name }}">
                        <div class="card-body text-center">
                            <h2 class="text-center">{{ $specialty->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
