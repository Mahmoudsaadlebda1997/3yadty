@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="d-flex justify-content-center align-items-center">
                <h1 class="m-0">تعديل التخصص الطبي</h1>
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
                        <form action="{{ route('specialties.update', $specialty->id) }}" method="post"
                              enctype="multipart/form-data" class="text-right mx-auto" style="width: 80%;">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                            <div class="form-group">
                                <label for="name">الاسم:</label>
                                <input type="text" required name="name" value="{{ $specialty->name }}"
                                       class="form-control"/>
                            </div>
                            <!-- Image -->
                            <div class="form-group">
                                <label for="image">الصورة:</label>
                                <input type="file" name="image" class="form-control"/>
                            </div>

                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
