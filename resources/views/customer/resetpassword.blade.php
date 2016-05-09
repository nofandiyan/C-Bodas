<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>
        <script>
        function validateForm() {
            var x = document.forms["myForm"]["password"].value;
            var y = document.forms["myForm"]["password_confirmation"].value;
            if (x != y) {
                alert("Password Doesn't Match h3h3h");
                return false;
            }
        }
        </script>
        <div>
            <form name="myForm" method="POST" onsubmit="return validateForm()" action="{{ URL::to('reset/password') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="confirmation_code" value="{{ $confirmation_code }}">

                <div>
                    Password
                    <input type="password" name="password" required>
                </div>

                <div>
                    Confirm Password
                    <input type="password" name="password_confirmation" required>
                </div>

                <div>
                    <button type="submit">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
        
    </body>
</html>