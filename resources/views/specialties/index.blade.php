@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>قائمة التخصصات الطبيه</h1>
        </section>
        <section class="content text-right">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>العمليات</th>
                            <th>اسم التخصص</th>
                            <th>الصورة</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($specialties as $specialty)
                            <tr>
                                <td>
                                    <form action="{{ route('specialties.destroy', $specialty->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                    </form>
                                    <a href="{{ route('specialties.edit', $specialty->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <a href="{{ route('specialties.show', $specialty->id) }}" class="btn btn-info btn-sm">عرض</a>
                                </td>
                                <td>{{ $specialty->name }}</td>
                                <td>
                                    @if($specialty->image)
                                        <img src="{{ asset('uploads/' . $specialty->image) }}" alt="{{ $specialty->name }}" class="img-thumbnail" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $specialty->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
