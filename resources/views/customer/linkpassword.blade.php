<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Please follow the link below to reset your password
            {{ URL::to('reset/password/' . $Customer->confirmation_code) }}.<br/>

        </div>

    </body>
</html>