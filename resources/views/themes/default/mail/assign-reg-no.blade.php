<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> {{ $setting->site_name }}</title>

</head>

<body style="font-family: sans-serif">
    <div style="margin:0 auto; max-width:700px; width:100%;">
        <center>
            <div style="background:hsl(0, 0%, 100%); padding:8px 0px; margin-bottom:5px;">
                <img src="{{ asset('themes-assets/images/logo-white.png') }}" height="100px;" />
            </div>
        </center>
        <p>
            Dear {{ $full_name }} ,<br>

            <br>We are pleased to inform you that your registration for One Run Marathon has been successfully
            processed. 

            <br><h2>Your registration number is: <strong>{{ $reg_no }}</strong></h2>

            <br>Please keep this number safe and easily accessible. Should you have any questions, feel free to contact our support team.

            <br> <br>Thank you for choosing Us. We look forward to your participation and hope you have a rewarding
            experience.

            <br><br>Best regards,<br>

            {{ $setting->site_name }}

    </div>
</body>

</html>
