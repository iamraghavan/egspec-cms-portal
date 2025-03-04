<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if (session('message'))

            {{ session('message') }}

    @endif Email Verification - EGSPEC CMS</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
body{font-family:Poppins,sans-serif;background-color:#f6f7fb;display:block;width:650px;padding:0 12px}a{text-decoration:none}span{font-size:14px}p{font-size:13px;line-height:1.7;letter-spacing:.7px;margin-top:0}.text-center{text-align:center}@media only screen and (max-width:767px){body{width:auto;margin:20px auto}.logo-sec{width:500px!important}}@media only screen and (max-width:575px){.logo-sec{width:400px!important}}@media only screen and (max-width:480px){.logo-sec{width:300px!important}}@media only screen and (max-width:360px){.logo-sec{width:250px!important}}
    </style>
  </head>
  <body style="margin: 30px auto;">
    <table style="width: 100%">
      <tbody>
        <tr>
          <td>
            <table style="background-color: #f6f7fb; width: 100%">
              <tbody>
                <tr>
                  <td>
                    <table style="margin: 0 auto; margin-bottom: 30px">
                      <tbody>
                        <tr class="logo-sec" style="display: flex; align-items: center; justify-content: space-between; width: 650px;">
                          <td><img class="img-fluid" src="{{asset('assets/egspec.svg')}}" alt=""></td>
                          <td style="text-align: right; color:#999"><span>Email Verification</span></td>
                        </tr>
                      </tbody>
                    </table>
                    <table style=" margin: 0 auto; background-color: #fff; border-radius: 8px">
                      <tbody>
                        <tr>
                          <td style="padding: 30px">
                            <p>Hi There,</p>
                            @if (session('message'))
                                <p class="alert alert-success">
                                    {{ session('message') }}
                                </p>
                            @endif

                            <p>Thank you for registering! Please verify your email address by clicking on the link we sent to your email.</p>
                            <div class="text-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" style="padding: 10px; background-color: #AF005F; color: #fff; display: inline-block; border-radius:30px; border:#AF005F; margin-bottom:18px; font-weight:600; padding:0.6rem 1.75rem;">Resend Verification Email</button>
        </form>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table style=" margin: 0 auto; margin-top: 30px">
                      <tbody>
                        <tr style="text-align: center">
                          <td>
                            <p style="color: #999; margin-bottom: 0">EGS Pillay Group of Institutions</p>
                            <p style="color: #999; margin-bottom: 0">Old, Nagore Main Rd, Thethi village, Nagore, Nagapattinam, Tamil Nadu 611002</p>
                            <p style="color: #999; margin-bottom: 0">Supported By <a href="mailto:raghavan@egspec.org">Mr. J.S Raghavan</a></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
