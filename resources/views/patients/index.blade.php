@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>قائمة المرضي</h1>
        </section>
        <section class="content text-right">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>العمليات</th>
                            <th>العمر</th>
                            <th>الاسم</th>
                            <th>الصورة</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <td>
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                    </form>
                                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm">عرض</a>
                                </td>
                                <td>{{ $patient->age }}</td>
                                <td>{{ $patient->user->name }}</td>
                                <td>
                                    @if($patient->image)
                                        <img src="{{ asset('uploads/' . $patient->image) }}" alt="{{ $patient->user->name }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $patient->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
