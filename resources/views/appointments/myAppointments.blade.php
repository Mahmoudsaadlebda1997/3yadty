@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>قائمة حجوزاتي</h1>
        </section>
        <section class="content text-right">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>العمليات</th>
                            <th>موعد الحجز</th>
                            <th>التخصص</th>
                            <th>الدكتور</th>
                            <th>اسم المريض</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                    </form>
                                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">عرض</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('l, F j, Y h:i A') }}</td>
                                <td>{{ $appointment->doctor->doctor->specialty->name }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
