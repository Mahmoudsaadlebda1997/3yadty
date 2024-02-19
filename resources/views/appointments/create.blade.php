@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="d-flex justify-content-center align-items-center">
                <h1 class="m-0">إضافة موعد حجز</h1>
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
                        <form action="{{ route('appointments.store') }}" method="post" class="text-right mx-auto"
                              style="width: 80%;">
                        @csrf
                        <!-- Doctor -->
                            <div class="form-group">
                                <label for="doctor_id">الطبيب:</label>
                                <select name="doctor_id" required class="form-control">
                                    <!-- Populate doctors from your database -->
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->user_id }}">{{ $doctor->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Appointment Datetime -->
                            <div class="form-group">
                                <label for="appointment_datetime">تاريخ ووقت الحجز:</label>
                                <input type="datetime-local" required name="appointment_datetime"
                                       value="{{ old('appointment_datetime') }}" class="form-control"/>
                            </div>

                            <button type="submit" class="btn btn-primary">إرسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
