<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة حجوزاتي</title>
    <!-- Add your CSS links and other head elements here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
<div class="content-wrapper text-right">
    <section class="content-header">
        <div class="container-fluid">
            <h1>قائمة حجوزاتي</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>العمليات</th>
                            <th>موعد الحجز</th>
                            <th>التخصص</th>
                            <th>الدكتور</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>
                                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="post"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('هل أنت متأكد؟')">حذف
                                        </button>
                                    </form>
                                    <a href="{{ route('appointments.show', $appointment->id) }}"
                                       class="btn btn-info btn-sm">عرض</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('l, F j, Y h:i A') }}
                                </td>
                                <td>{{ $appointment->doctor->doctor->specialty->name }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>{{ $appointment->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <!-- Pagination links go here if needed -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add your scripts and other body content here -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
