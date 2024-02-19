@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>تفاصيل المريض</h1>
        </section>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <img src="{{ $patient->image ? asset('uploads/' . $patient->image) : asset('images/no-image.png') }}" class="card-img-top img-fluid mx-auto d-block w-25" alt="{{ $patient->user->name }}">
                        <div class="card-body text-center">
                            <h2 class="text-center">{{ $patient->user->name }}</h2>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>:العمر</strong><br>{{ $patient->age }}</li>
                            <li class="list-group-item">
                                <strong>:البريد الإلكتروني</strong><br>
                                {{ $patient->user->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>:رقم الهاتف</strong><br>
                                {{ $patient->user->phone_number }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
