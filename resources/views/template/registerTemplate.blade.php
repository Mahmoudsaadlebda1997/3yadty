<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة مريض جديد</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add other necessary CSS styles or custom stylesheets here -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content-wrapper {
            margin-top: 50px;
        }

        .content-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            border-radius: 10px 10px 0 0;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .form-group {
            text-align: right;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            color: #007bff;
        }

        .form-control {
            font-size: 16px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 18px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div>
            <h1 class="m-0">التسجيل كمريض جديد</h1>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
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
                        <div class="form-container">
                            <form action="{{ route('storePatient') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Name -->
                                <div class="form-group">
                                    <label for="name">الاسم:</label>
                                    <input type="text" required name="name" value="{{ old('name') }}" class="form-control" />
                                </div>
                                <!-- Age -->
                                <div class="form-group">
                                    <label for="age">العمر:</label>
                                    <input type="number" required name="age" value="{{ old('age') }}" class="form-control" />
                                </div>

                                <!-- Image -->
                                <div class="form-group">
                                    <label for="image">الصورة:</label>
                                    <input type="file" name="image" class="form-control-file" />
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني:</label>
                                    <input type="email" required name="email" value="{{ old('email') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة المرور:</label>
                                    <input type="password" required name="password" class="form-control" />
                                </div>
                                <!-- Phone Number -->
                                <div class="form-group">
                                    <label for="phone_number">رقم الهاتف:</label>
                                    <input type="text" required name="phone_number" value="{{ old('phone_number') }}" class="form-control" />
                                </div>
                                <input type="hidden" name="user_type" value="PATIENT">
                                <button type="submit" class="btn btn-primary float-right">إرسال</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

