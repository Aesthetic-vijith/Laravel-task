<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test Application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Customer Form</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('store.customer') }}" method="post" id="customerForm">
            @csrf
            <div class="name">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Customer name" name="name" id="name">
            </div><br>

            <div class="email">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="name@example.com" name="email" id="email">
                <span id="emailError" class="text-danger"></span>
            </div><br>

            <div class="phone">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" placeholder="Contact number" name="phone" id="phone">
                <span id="phoneError" class="text-danger"></span>
            </div><br>

            <div class="address">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Customer address" name="address" id="address">
            </div><br>

            <div class="pincode">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="number" class="form-control" placeholder="Address pincode" name="pincode" id="pincode">
            </div><br><br>

            <div class="submit">
                <button type="submit" class="btn btn-success" id="submitButton" disabled>Submit</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#email').on('blur', function () {
                var email = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/check-email',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.exists) {
                            $('#emailError').text('Email already exists');
                            $('#submitButton').prop('disabled', true);
                        } else {
                            $('#emailError').text('');
                            checkFormvalidation();
                        }
                    }
                });
            });

            $('#phone').on('blur', function () {
                var phone = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '/check-phone',
                    data: {
                        phone: phone,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.exists) {
                            $('#phoneError').text('Phone number already exists');
                            $('#submitButton').prop('disabled', true);
                        } else {
                            $('#phoneError').text('');
                            checkFormvalidation();
                        }
                    }
                });
            });

            function checkFormvalidation() {

                if ($('#emailError').text() === '' && $('#phoneError').text() === '') 
                {
                    $('#submitButton').prop('disabled', false);
                } else {
                    $('#submitButton').prop('disabled', true);
                }
            }
        });
    </script>
</body>
</html>
