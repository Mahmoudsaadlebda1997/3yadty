<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول كمريض</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-form {
            margin-top: 50px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: right;
        }

        .form-group {
            text-align: right;
        }

        .checkbox {
            text-align: right;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Additional Styles */
        main {
            padding: 20px;
        }

        form {
            margin-top: 20px;
        }

        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>
<body>

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-right">تسجيل الدخول للمرضى</div>
                    <div class="card-body">
                        <form action="{{ route('loginTemplate') }}" method="POST" style="direction: rtl;">
                            @csrf
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">البريد
                                    الالكتروني</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required
                                           autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">رقم
                                    المرور</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> تذكرني
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-6 offset-md-4 mt-3">
                            <p>ليس لديك حساب؟ <a href="{{ route('registerTemplate') }}">سجل الآن</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
