<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>عيادتي - لحجز الاطباء</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/templatemo-medic-care.css') }}" rel="stylesheet">
    <!--

    TemplateMo 566 Medic Care

    https://templatemo.com/tm-566-medic-care

    -->
    <style>
        /* Custom styles for the "التخصصات" section */
        #specialest {
            background-image: url('{{ asset('uploads/background.gif') }}'); /* Replace 'your_image.jpg' with the actual image filename */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 80px 0;
            color: #fff; /* Text color on the background */
        }

        #specialest h2 {
            color: #fff; /* Heading text color */
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background for cards */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card-body {
            color: #000; /* Text color on the cards */
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>

</head>

<body id="top">

<main>

    <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
        <div class="container">
            <a class="navbar-brand mx-auto d-lg-none" href="index.html">
                عيادتي
                <strong class="d-block">اخصائي الصحه</strong>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#hero">الرئيسيه</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#specialest">التخصصات</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#booking">الحجز</a>
                    </li>
                    <a class="navbar-brand d-none d-lg-block" href="">
                        عيادتي
                        <strong class="d-block">متخصصي الصحه</strong>
                    </a>
                    @auth
                        <a class="nav-link" href="{{ route('myAppointment') }}">حجوزاتي</a>
                    @endauth
                    <li class="nav-item">
                        @auth
                            <a class="nav-link" href="{{ route('logoutTemplate') }}">تسجيل الخروج</a>
                        @else
                            <a class="nav-link" href="{{ route('loginTemplate') }}">تسجيل الدخول</a>
                        @endauth
                    </li>
                    @auth
                        <li class="nav-item">
                            <span class="nav-link text-primary">مرحبًا بك: {{ auth()->user()->name }}</span>
                        </li>
                    @endauth
                </ul>
            </div>

        </div>
    </nav>

    <section class="hero" id="hero">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($sliders as $key => $slider)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="img-fluid" alt=""
                                         style="height: 1000px; width: 100%">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="heroText d-flex flex-column justify-content-center">

                        <h1 class="mt-auto mb-2">
                            افضل
                            <div class="animated-info">
                                <span class="animated-item">الصحه</span>
                                <span class="animated-item">الايام</span>
                                <span class="animated-item">حياه الاشخاص</span>
                            </div>
                        </h1>

                        <p class="mb-4">
                            عيادتي لحجز الأطباء هي منصة متقدمة وفعّالة توفر تجربة مميزة للمرضى والأطباء على حد سواء.
                            تقدم العيادة العديد من الميزات التي تسهل على المرضى العثور على الأطباء المناسبين وحجز
                            مواعيدهم بكل يسر وسهولة. يمكن للمرضى استعراض ملفات الأطباء وتقييمات المرضى السابقين لاتخاذ
                            قرار مستنير. كما توفر العيادة معلومات مفصلة حول تخصصات الأطباء وخدماتهم الطبية.
                            <div class="heroLinks d-flex flex-wrap align-items-center">
                                <a class="custom-link me-4" href="#about" data-hover="Learn More">تعلم المزيد</a>

                        <p class="contact-phone mb-0"><i class="bi-phone"></i> 010-30-23-90-78</p>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    {{--    specialites--}}
    <section id="specialest" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center mb-4">التخصصات</h2>

                    <div class="d-flex justify-content-center">
                        @foreach($specialites as $specialty)
                            <div class="card m-2" style="width: 18rem;">
                                <img src="{{ asset('uploads/' . $specialty->image) }}"
                                     class="card-img-top" alt="{{ $specialty->name }}"
                                     style="height: 200px; object-fit: cover;">
                                <div class="card-body text-center">
                                    <p class="card-text">{{ $specialty->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @auth
        <section class="section-padding" id="booking">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-12">
                        <div class="booking-form bg-white p-4 rounded text-right">

                            <h2 class="text-center mb-4" style="font-size:40px; text-align: right;">حجز موعد</h2>

                            <form action="{{ route('storeAppointment') }}" method="post">
                                @csrf
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                            @endif
                            <!-- Doctor -->
                                <div class="mb-3 text-end">
                                    <label for="doctor_id" class="form-label fs-4">:اختر الطبيب</label>
                                    <select name="doctor_id" required class="form-control">
                                        <!-- Populate doctors from your database -->
                                        <option value="">اختر الطبيب من فضلك</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->user_id }}">{{ $doctor->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- Appointment Datetime -->
                                <div class="mb-3 text-end">
                                    <label for="appointment_datetime" class="form-label fs-4">: اختر تاريخ ووقت
                                        الحجز</label>
                                    <input type="datetime-local" required name="appointment_datetime"
                                           value="{{ old('appointment_datetime') }}" class="form-control"/>
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-primary" style="font-size: 1.2em;">حجز الموعد
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>


    @endauth
</main>

<footer class="site-footer section-padding" id="contact">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 me-auto col-12">
                <h5 class="mb-lg-4 mb-3">مواعيدالعمل </h5>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex">
                        علي مدار الساعه
                    </li>
                    <li class="list-group-item d-flex">
                        جميع ايام الاسبوع
                    </li>
                    <li class="list-group-item d-flex">
                        جميع الاجازات
                    </li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-12 my-4 my-lg-0">
                <h5 class="mb-lg-4 mb-3 text-center">عيادتي</h5>

                <p><a href="mailto:3yadaty@gmail.com">3yadaty@gmail.com</a>
                <p>

                <p>المنصوره الدقهليه مصر</p>
            </div>

            <div class="col-lg-3 col-md-6 col-12 ms-auto">
                <h5 class="mb-lg-4 mb-2">مواقع التواصل الاجتماعي خاصتنا</h5>

                <ul class="social-icon">
                    <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                    <li><a href="#" class="social-icon-link bi-twitter"></a></li>

                    <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                    <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                </ul>

                <div>
                    <p class="copyright-text">جميع الحقوق محفوظة © عيادتي 2024
                        <br><br>التصميم: <a href="https://templatemo.com" target="_parent">تمبليت مو</a></p>
                    </p>
                </div>

            </div>


        </div>
        </section>
</footer>

<!-- JAVASCRIPT FILES -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollspy.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
</body>
</html>
