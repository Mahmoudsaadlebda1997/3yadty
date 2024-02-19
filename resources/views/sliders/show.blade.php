@extends('layouts.master')

@section('content')
    <div class="content-wrapper text-right">
        <section class="content-header">
            <h1>تفاصيل السلايدر</h1>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $slider->title }}</h2>
                            <p class="card-text"><strong>العنوان:</strong> {{ $slider->title }}</p>
                            <p class="card-text"><strong>نشط:</strong> {{ $slider->is_active ? 'نعم' : 'لا' }}</p>
                            <p class="card-text"><strong>الصورة:</strong>
                                @if($slider->image_path)
                                    <img src="{{ asset('storage/sliders/' . $slider->image_path) }}" alt="{{ $slider->title }}" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                @else
                                    No Image
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
