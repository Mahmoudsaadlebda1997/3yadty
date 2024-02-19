@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="d-flex justify-content-center align-items-center">
                <h1 class="m-0">تعديل المريض</h1>
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
                        <form action="{{ route('patients.update', $patient->id) }}" method="post"
                              enctype="multipart/form-data" class="text-right mx-auto" style="width: 80%;">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                            <div class="form-group">
                                <label for="name">الاسم:</label>
                                <input type="text" required name="name" value="{{ $patient->user->name }}"
                                       class="form-control"/>
                            </div>
                            <!-- Age -->
                            <div class="form-group">
                                <label for="age">العمر:</label>
                                <input type="number" required name="age" value="{{ $patient->age }}"
                                       class="form-control"/>
                            </div>


                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">الصورة:</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني:</label>
                                <input type="email" required name="email" value="{{ $patient->user->email }}"
                                       class="form-control"/>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">كلمة المرور:</label>
                                <input type="password" name="password" class="form-control"/>
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group">
                                <label for="phone_number">رقم الهاتف:</label>
                                <input type="text" required name="phone_number"
                                       value="{{ $patient->user->phone_number }}" class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
