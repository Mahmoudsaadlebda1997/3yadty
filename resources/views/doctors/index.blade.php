@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>قائمة الأطباء</h1>
        </section>
        <section class="content text-right">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>العمليات</th>
                            <th>التخصص</th>
                            <th>العمر</th>
                            <th>الاسم</th>
                            <th>الصورة</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doctors as $doctor)
                            <tr>
                                <td>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                    </form>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-info btn-sm">عرض</a>
                                </td>
                                <td>{{ $doctor->specialty->name }}</td>
                                <td>{{ $doctor->age }}</td>
                                <td>{{ $doctor->user->name }}</td>
                                <td>
                                    @if($doctor->image)
                                        <img src="{{ asset('uploads/' . $doctor->image) }}" alt="{{ $doctor->user->name }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $doctor->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
