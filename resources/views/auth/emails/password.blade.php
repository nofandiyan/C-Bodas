<!-- Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
 -->

 Anda mendapatkan pesan ini karena Anda telah meminta penggantian kata sandi untuk akun pada website C-Bodas<br><br>

Klik link berikut untuk melakukan penggantian kata sandi: <br>
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
<br><br>
Terimakasih<br>
Admin C-Bodas