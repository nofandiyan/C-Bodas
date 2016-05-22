<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Reset Password</h2>
        <div>
            Anda mendapatkan pesan ini karena Anda telah meminta penggantian kata sandi untuk akun pada website C-Bodas<br>
            Silahkan klik link dibawah ini untuk penggantian password akun anda : <br>
            <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a><br>
			
			<div align="right">
				Terimakasih<br>
				<b>Admin C-Bodas</b>
			</div>
        </div>
    </body>
</html>