@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>تفاصيل الحجز</h1>
        </section>
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="text-center">{{ $appointment->patient->name  }} : اسم المريض  </h2>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>:تاريخ ووقت الحجز</strong><br>
                                {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('l, F j, Y h:i A') }}                            </li>
                            <li class="list-group-item"><strong>:اسم الدكتور</strong><br>{{ $appointment->doctor->name }}</li>
                            <li class="list-group-item"><strong>:تخصص الدكتور</strong><br>{{ $appointment->doctor->doctor->specialty->name }}</li>
                            <li class="list-group-item">
                                <strong>:رقم هاتف الطبيب </strong><br>
                                {{ $appointment->doctor->phone_number }}
                            </li>
                            <li class="list-group-item">
                                <strong>:حالة الحجز </strong><br>
                                @if($appointment->status == 'INHOLD')
                                    <span class="badge badge-info">في الانتظار</span>
                                @elseif($appointment->status == 'ACCEPTED')
                                    <span class="badge badge-success">مقبول</span>
                                @elseif($appointment->status == 'CANCELLED')
                                    <span class="badge badge-danger">ملغي</span>
                                @else
                                    <span class="badge badge-secondary"></span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
