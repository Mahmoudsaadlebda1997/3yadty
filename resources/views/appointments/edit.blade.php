@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="d-flex justify-content-center align-items-center">
                <h1 class="m-0">تعديل الحجز</h1>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Display validation errors here -->
                    @if($errors->any())
                        <div class="alert alert-danger text-center">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-12 col-md-offset-">
                        <form action="{{ route('appointments.update', $appointment->id) }}" method="post"
                              enctype="multipart/form-data" class="text-right mx-auto" style="width: 80%;">
                        @csrf
                        @method('PUT')
                            <!-- Doctor -->
                            <div class="form-group">
                                <label for="doctor">اسم الطبيب:</label>
                                <select name="doctor_id" required class="form-control">
                                    <!-- Populate Doctors from your database -->
                                    @foreach($doctors as $doctor)
                                        <option
                                            value="{{ $doctor->user_id }}" {{ $doctor->user_id == $appointment->doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Appointment Time -->
                            <div class="form-group">
                                <label for="appointment_datetime">تاريخ ووقت الموعد:</label>
                                <input type="datetime-local" name="appointment_datetime" value="{{ old('appointment_datetime', $appointment->appointment_datetime ?? '') }}" class="form-control">
                            </div>
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">حالة الموعد:</label>
                                <select name="status" required class="form-control">
                                    <option value="INHOLD" {{ old('status', $appointment->status ?? '') == 'INHOLD' ? 'selected' : '' }}>في انتظار</option>
                                    <option value="ACCEPTED" {{ old('status', $appointment->status ?? '') == 'ACCEPTED' ? 'selected' : '' }}>مقبول</option>
                                    <option value="CANCELLED" {{ old('status', $appointment->status ?? '') == 'CANCELLED' ? 'selected' : '' }}>ملغي</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
