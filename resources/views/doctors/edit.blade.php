@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="d-flex justify-content-center align-items-center">
                <h1 class="m-0">تعديل الطبيب</h1>
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
                        <form action="{{ route('doctors.update', $doctor->id) }}" method="post"
                              enctype="multipart/form-data" class="text-right mx-auto" style="width: 80%;">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                            <div class="form-group">
                                <label for="name">الاسم:</label>
                                <input type="text" required name="name" value="{{ $doctor->user->name }}"
                                       class="form-control"/>
                            </div>
                            <!-- Age -->
                            <div class="form-group">
                                <label for="age">العمر:</label>
                                <input type="number" required name="age" value="{{ $doctor->age }}"
                                       class="form-control"/>
                            </div>

                            <!-- Specialty -->
                            <div class="form-group">
                                <label for="specialty">التخصص:</label>
                                <select name="specialty_id" required class="form-control">
                                    <!-- Populate specialties from your database -->
                                    @foreach($specialties as $specialty)
                                        <option
                                            value="{{ $specialty->id }}" {{ $doctor->specialty_id == $specialty->id ? 'selected' : '' }}>
                                            {{ $specialty->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">الصورة:</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني:</label>
                                <input type="email" required name="email" value="{{ $doctor->user->email }}"
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
                                       value="{{ $doctor->user->phone_number }}" class="form-control"/>
                            </div>
                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">الوصف:</label>
                                <textarea name="description" required
                                          class="form-control">{{ $doctor->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
