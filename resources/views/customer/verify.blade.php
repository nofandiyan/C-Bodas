<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Thanks for creating an C-Bodas account.
            Please follow the link below to verify your email address
            {{ URL::to('register/verify/' . $Customer->confirmation_code) }}.<br/>

        </div>

    </body>
</html>