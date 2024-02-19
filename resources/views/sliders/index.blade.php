@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>قائمة السلايدر</h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>العمليات</th>
                            <th>نشط</th>
                            <th>الصورة</th>
                            <th>العنوان</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>
                                    <a href="{{ route('sliders.show', $slider->id) }}" class="btn btn-info btn-sm">عرض</a>
                                    <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <form action="{{ route('sliders.destroy', $slider->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                                    </form>
                                </td>
                                <td>{{ $slider->is_active ? 'نعم' : 'لا' }}</td>
                                <td>
                                    @if($slider->image_path)
                                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="{{ $slider->title }}" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
