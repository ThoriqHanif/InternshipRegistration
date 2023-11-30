{{-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Informasi Pendaftaran Magang</title>
    <style type="text/css">
      body {
        margin: 0;
        background-color: #f3f3f3;
      }
      table {
        border-spacing: 0;
      }
      td {
        padding: 0;
      }
      img {
        border: 0;
      }
	  .wrapper {
		width: 100%;
		table-layout: fixed;
        background-color: #cccccc;
		padding-bottom: 60px;
	  }
	  .main {
		background-color: #ffffff;
		margin: 0 auto;
		width: 100%;
		max-width: 600px;
		border-spacing: 0;
		font-family: sans-serif;
		color: #4a4a4a;
	  }
      .two-columns {
        text-align: center;
        font-size: 0;
      }
      .two-columns .column{
        width: 100%;
        max-width: 300px;
        display: inline-block;
        vertical-align: top;
      }
        .button {
            background-color: #1c6dcb;
            color: #ffffff;
            border-radius: 5px;
            text-decoration: none;
            padding: 12px 20px;
            font-weight: bold;
        }
    </style>
  </head>
  <body>
    <center class="wrapper">
      <table class="main" width="100%">
        <!-- BLUE BORDER -->
			<tr>
				<td height="8" style="background-color: #1c6dcb;"></td>
			</tr>
        <!-- LOGO SECTION -->
			<tr>
                <td style="padding: 14px 0 4px;">
                    <table width="100%">
                        <tr>
                            <td class="two-columns">
                                <table class="column">
                                    <tr>
                                        <td style="padding: 0 62px 10px;">
                                            <a href="https://kadangkoding.com"><img src="{{$message->embed(public_path().'/img/logo/logofull.png')}}" alt="" width="180" title="Logo"></a>
                                        </td>
                                    </tr>
                                </table>

                                <table class="column">
                                    <tr>
                                        <td style="padding: 0 102px 10px;">
                                            <a href="https://www.instagram.com/kadangkoding/" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-instagram.png')}}" alt="" width="32" title="Instagram" ></a>
                                            <a href="https://www.linkedin.com/company/kadang-koding-indonesia/about/" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-linkedin.png')}}" alt="" width="32" title="Linkedin"></a>
                                            <a href="https://www.facebook.com/kadangkodingindonesia/" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-facebook.png')}}" alt="" width="32" title="Facebook"></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <!-- BANNER IMAGE -->

        <tr>
            <td>
                <a href="http://127.0.0.1:8000/"><img src="{{$message->embed(public_path().'/img/sosmed/banner.png')}}" alt="" width="600" style="max-width: 100%;"></a>
            </td>
        </tr>
        <!-- TITLE, TEXT & BUTTON -->
            <tr>
                <td style="padding: 5px 0 50px;">
                    <table width="100%">
                        <tr>
                            <td style="text-align: center; padding: 15px;">
                                <p style="font-size: 20px; font-weight: bold;">Informasi Pendaftaran Magang</p>
                                <p style="font-size: 15px; font-weight: bold;">Halo, <strong style="color: #1c6dcb;">{{ $data->full_name }}</strong></p>
                                <p style="font-size: 15px; line-height: 23px; padding: 5px 0 15px;">Selamat datang di Kadang Koding Indonesia. Terimakasih telah mendaftarkan magang di Kadang Koding Indonesia. Berikut kami lampirkan Status Pendaftaran Magang anda
                                    @if ($newStatus === 'diterima')
                                    <p style="font-size: 15px; line-height: 23px; padding: 5px 0 15px;">
                                        Selamat {{ $data->full_name }}, pendaftaran magang Anda di Kadang
                                        Koding Indonesia <strong style="color: green">{{ ucfirst($newStatus) }}</strong>
                                    </p>
                                    @elseif ($newStatus === 'ditolak')
                                    <p style="font-size: 15px; line-height: 23px; padding: 5px 0 15px;">
                                        Mohon maaf {{ $data->full_name }}, pendaftaran magang Anda di Kadang Koding Indonesia 
                                        <strong style="color: red">{{ ucfirst($newStatus) }}</strong>
                                    </p>
                                    @elseif ($newStatus === 'pending')
                                    <p style="font-size: 15px; line-height: 23px; padding: 5px 0 15px;">
                                        Data {{ $data->full_name }} akan segera kami proses, pendaftaran magang Anda di Kadang Koding Indonesia
                                         <strong style="color: orange">{{ ucfirst($newStatus) }}</strong>
                                    </p>
                                    @endif
                                </p>
                                <p style="font-size: 15px; font-weight: bold;">Berikut Detail Pendaftaran Anda</p>
                                    <div class="" style="background-color: #eaf2ff; border-radius: 10px; padding: 15px; align-items: center; align-text:center; ">
                                        <li style="padding: 5px; list-style: none;">Nama : <strong>{{ $data->full_name }}</strong></li>
                                        <li style="padding: 5px; list-style: none;">Sekolah : <strong>{{ $data->school }}</strong></li>
                                        <li style="padding: 5px; list-style: none;">Jurusan : <strong>{{ $data->major }}</strong></li>
                                        <li style="padding: 5px; list-style: none;">Tanggal Mulai : <strong>{{ $data->start_date }}</strong></li>
                                        <li style="padding: 5px; list-style: none;">Tanggal Selesai : <strong>{{ $data->end_date }}</strong></li>
                                        <li style="padding: 5px; list-style: none;">Status Pendaftaran : <strong >{{ ucfirst($newStatus) }}</strong></li>
                                    </div>
                                    @if ($newStatus === 'diterima')
                                    <p style="font-size: 15px; font-weight: bold; padding-top: 10px;">Akun Login Anda</p>
                                    <div class="list-container" style="background-color: #eaf2ff; border-radius: 10px; padding: 15px;">
                                        <li style="padding: 5px; list-style: none;">Email : <strong style="color: #1c6dcb;">{{ $data->user->email }}</strong></li>
                                        <li style="padding: 5px; list-style: none;">Password : <strong>{{ $password }}</strong></li>
                                    </div>
                                    <a href="http://127.0.0.1:8000/login" class="button" style="display: inline-block; margin-top: 20px; color:#ffffff;">Login Sekarang</a>
                                    @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <!-- BLUE BORDER -->

        <!-- THREE COLUMN SECTION -->
        <tr>
            <td>
                <table width="100%">
                    
                </table>
            </td>
        </tr>
        <!-- BLUE BORDER -->

        <!-- TWO COLUMN SECTION -->
        <tr>
            <td>
                <table width="100%">
                    
                </table>
            </td>
        </tr>
        <!-- FOOTER SECTION -->
        <tr>
            <td style="background-color: #565656; color: #fff;">
                <table width="100%">
                    <tr>
                        <td style="text-align: center; padding: 45px 20px;">
                            <a href=""><img src="{{$message->embed(public_path().'/img/logo/logofull.png')}}" alt="" width="160"></a>
                            <p style="padding: 10px;">Copyright 2023 Kadang Koding Indonesia</p>
                            <p style="padding: 10px;">Kuyudan RT 02/RW 05, Dusun II, Makamhaji, Kec. Kartasura, Kabupaten Sukoharjo, Jawa Tengah 57161</p>
                            <a href="https://www.instagram.com/kadangkoding/" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-instagram.png')}}" alt="" width="32" title="Instagram" ></a>
                            <a href="https://kadangkoding.com" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-website.png')}}" alt="" width="32" title="Website"></a>
                            <a href="https://www.linkedin.com/company/kadang-koding-indonesia/about/" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-linkedin.png')}}" alt="" width="32" title="Linkedin"></a>
                            <a href="https://www.facebook.com/kadangkodingindonesia/" target="_blank"><img src="{{$message->embed(public_path().'/img/sosmed/circle-facebook.png')}}" alt="" width="32" title="Facebook"></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
      </table>
    </center>
  </body>
</html> --}}

<!DOCTYPE html>

<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;900&display=swap" rel="stylesheet"
        type="text/css" /><!--<![endif]-->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
        }

        p {
            line-height: inherit
        }

        .desktop_hide,
        .desktop_hide table {
            mso-hide: all;
            display: none;
            max-height: 0px;
            overflow: hidden;
        }

        .image_block img+div {
            display: none;
        }

        @media (max-width:620px) {

            .desktop_hide table.icons-inner,
            .social_block.desktop_hide .social-table {
                display: inline-block !important;
            }

            .icons-inner {
                text-align: center;
            }

            .icons-inner td {
                margin: 0 auto;
            }

            .mobile_hide {
                display: none;
            }

            .row-content {
                width: 100% !important;
            }

            .stack .column {
                width: 100%;
                display: block;
            }

            .mobile_hide {
                min-height: 0;
                max-height: 0;
                max-width: 0;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide,
            .desktop_hide table {
                display: table !important;
                max-height: none !important;
            }

            .reverse {
                display: table;
                width: 100%;
            }

            .reverse .column.first {
                display: table-footer-group !important;
            }

            .reverse .column.last {
                display: table-header-group !important;
            }

            .row-11 td.column.first .border,
            .row-11 td.column.last .border {
                padding: 0;
                border-top: 0;
                border-right: 0px;
                border-bottom: 0;
                border-left: 0;
            }
        }
    </style>
</head>

<body style="margin: 0; background-color: #fff; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
    <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff;" width="100%">
        <tbody>
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1d6dcc;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-left: 20px; padding-right: 20px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2"
                        role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 10px; padding-left: 10px; padding-top: 15px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="image_block block-1" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad" style="width:100%;">
                                                                <div align="center" class="alignment"
                                                                    style="line-height:10px"><a
                                                                        href="https://kadangkoding.com"
                                                                        style="outline:none" tabindex="-1"
                                                                        target="_blank"><img alt="Logo Kadang Koding"
                                                                            src="{{ $message->embed(public_path() . '/img/logo/logofull.png') }}"
                                                                            style="display: block; height: auto; border: 0; max-width: 140px; width: 100%;"
                                                                            title="Logo Kadang Koding"
                                                                            width="140" /></a></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="column column-2"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="33.333333333333336%">
                                                    <div class="spacer_block block-1"
                                                        style="height:1px;line-height:1px;font-size:1px;"> </div>
                                                </td>
                                                <td class="column column-3"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="41.666666666666664%">
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="social_block block-1" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" class="social-table"
                                                                        role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;"
                                                                        width="108px">
                                                                        <tr>
                                                                            <td style="padding:0 2px 0 2px;"><a
                                                                                    href="https://www.instagram.com/kadangkoding/"
                                                                                    target="_blank"><img
                                                                                        alt="Instagram" height="32"
                                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/instagram2x.png') }}"
                                                                                        style="display: block; height: auto; border: 0;"
                                                                                        title="Instagram"
                                                                                        width="32" /></a></td>
                                                                            <td style="padding:0 2px 0 2px;"><a
                                                                                    href="https://www.linkedin.com/company/kadang-koding-indonesia/about/"
                                                                                    target="_blank"><img
                                                                                        alt="Linkedin" height="32"
                                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/linkedin2x.png') }}"
                                                                                        style="display: block; height: auto; border: 0;"
                                                                                        title="Linkedin"
                                                                                        width="32" /></a></td>
                                                                            <td style="padding:0 2px 0 2px;"><a
                                                                                    href="https://www.facebook.com/kadangkodingindonesia/"
                                                                                    target="_blank"><img
                                                                                        alt="Facebook" height="32"
                                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/facebook2x.png') }}"
                                                                                        style="display: block; height: auto; border: 0;"
                                                                                        title="Facebook"
                                                                                        width="32" /></a></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-3"
                        role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-4"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1d6dcc;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-5"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1d6dcc;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="50%">
                                                    <div class="spacer_block block-1"
                                                        style="height:25px;line-height:25px;font-size:1px;"> </div>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="heading_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:15px;text-align:center;width:100%;">
                                                                <h3
                                                                    style="margin: 0; color: #fac424; direction: ltr; font-family: 'Montserrat', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; font-size: 37px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">KADANG KODING
                                                                        INDONESIA</span>
                                                                </h3>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="paragraph_block block-3" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:10px;">
                                                                <div
                                                                    style="color:#fff;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0; word-break: break-word;">
                                                                        Selamat Datang di Kadang Koding Indonesia.
                                                                        Terimakasih telah mendaftarkan diri sebagai
                                                                        Pemagang di Kadang Koding Indonesia.</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="button_block block-4" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:10px;text-align:left;">
                                                                <div align="left" class="alignment">
                                                                    <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://127.0.0.1:8000/login" style="height:43px;width:183px;v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#fac424" fillcolor="#fac424"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Tahoma, Verdana, sans-serif; font-size:16px"><![endif]--><a
                                                                        href="http://127.0.0.1:8000/login"
                                                                        style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#fac424;border-radius:4px;width:auto;border-top:1px solid transparent;font-weight:700;border-right:1px solid transparent;border-bottom:1px solid transparent;border-left:1px solid transparent;padding-top:5px;padding-bottom:5px;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"
                                                                        target="_blank"><span
                                                                            style="padding-left:35px;padding-right:35px;font-size:16px;display:inline-block;letter-spacing:normal;"><span
                                                                                style="word-break: break-word; line-height: 32px;">Mulai
                                                                                Sekarang</span></span></a><!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="spacer_block block-5"
                                                        style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                </td>
                                                <td class="column column-2"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="50%">
                                                    <div class="spacer_block block-1"
                                                        style="height:25px;line-height:25px;font-size:1px;"> </div>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="image_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment"
                                                                    style="line-height:10px"><img
                                                                        alt="Illustration Banner"
                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/imgBanner.png') }}"
                                                                        style="display: block; height: auto; border: 0; max-width: 280px; width: 100%;"
                                                                        title="Illustration Banner" width="280" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-6"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1d6dcc;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-7"
                        role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; border-radius:10px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="text_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div style="font-family: Arial, sans-serif">
                                                                    <div class=""
                                                                        style="font-size: 12px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #222222; line-height: 1.2;">
                                                                        <p
                                                                            style="margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 19.2px;">
                                                                            <span style="font-size:30px;"><strong>Informasi
                                                                                </strong><strong>Pendaftaran
                                                                                    Magang</strong></span></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="text_block block-3" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="font-family: 'Trebuchet MS', Tahoma, sans-serif">
                                                                    <div class=""
                                                                        style="font-family: 'Montserrat', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
                                                                        <p
                                                                            style="margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 19.2px;">
                                                                            <span style="font-size:22px;"><strong>Halo,
                                                                                    <span style="color:#085ff7;">{{$data->full_name}}</span></strong></span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-8"
                        role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#303030;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                    @if ($newStatus === 'diterima')
                                                                    <p style="margin: 0; margin-bottom: 16px;">
                                                                        {!! $data->messages !!}

                                                                       
                                                                    </p>
                                                                    @elseif ($newStatus === 'ditolak')
                                                                    <p style="margin: 0; margin-bottom: 16px;">
                                                                        {!! $data->messages !!}

                                                                       
                                                                    </p>
                                                                    @elseif ($newStatus === 'pending')
                                                                    <p style="margin: 0; margin-bottom: 16px;">
                                                                        {!! $data->messages !!}

                                                                        
                                                                    </p>
                                                                    <p style="margin: 0;"> </p>
                                                                    @elseif ($newStatus === 'interview')
                                                                    <p style="margin: 0; margin-bottom: 16px;">
                                                                        
                                                                        {!! $data->messages !!}
                                                                    </p>
                                                                    <p style="margin: 0;"> </p>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
                    <div class="spacer_block block-1" style="height:20px;line-height:20px;font-size:1px;"> </div>
                    @if ($newStatus === 'diterima' || $newStatus === 'ditolak' || $newStatus === 'interview' || $newStatus === 'pending')
                        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-11"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 1000px; margin: 0 auto;"
                                        width="1000px">
                                        <tbody>
                                            <tr class="reverse">
                                                <td class="column column-1 first"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="50%">
                                                    <div class="border">
                                                        <div class="spacer_block block-1"
                                                            style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            class="paragraph_block block-2" role="presentation"
                                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                            width="100%">
                                                            <tr>
                                                                <td class="pad"
                                                                    style="padding-left:25px;padding-right:25px;padding-top:10px;">
                                                                    <div
                                                                        style="color:#085ff7;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                        <p style="margin: 0; word-break: break-word;">
                                                                            <span>Informasi Pendaftaran Magang</span>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            class="heading_block block-3" role="presentation"
                                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                            width="100%">
                                                            <tr>
                                                                <td class="pad"
                                                                    style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:5px;text-align:center;width:100%;">
                                                                    <h3
                                                                        style="margin: 0; color: #454562; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 25px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;">
                                                                        <span class="tinyMce-placeholder">Update Status
                                                                            Anda</span>
                                                                    </h3>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            class="paragraph_block block-4" role="presentation"
                                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                            width="100%">
                                                            <tr>
                                                                <td class="pad"
                                                                    style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:10px;">
                                                                    <div
                                                                        style="color:#393d47;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                        <p style="margin: 0; word-break: break-word;">
                                                                            <span>{!! $data->messages !!}</span>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <div class="spacer_block block-14"
                                                            style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                    </div>
                                                </td>
                                                <td class="column column-2 last"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="50%">
                                                    <div class="border">
                                                        <div class="spacer_block block-1"
                                                            style="height:15px;line-height:15px;font-size:1px;"> </div>
                                                        <table border="0" cellpadding="10" cellspacing="0"
                                                            class="image_block block-2" role="presentation"
                                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                            width="100%">
                                                                
                                                            <tr>
                                                                <td class="pad">
                                                            @if ($newStatus === 'diterima')

                                                                    <div align="center" class="alignment"
                                                                        style="line-height:10px"><img
                                                                            alt="Illustration Login"
                                                                            src="{{ $message->embed(public_path() . '/img/diterima.png') }}"
                                                                            style="display: block; height: auto; border: 0; max-width: 280px; width: 100%;"
                                                                            title="Illustration Login"
                                                                            width="280" /></div>
                                                            @endif
                                                            @if ($newStatus === 'interview')

                                                                    <div align="center" class="alignment"
                                                                        style="line-height:10px"><img
                                                                            alt="Illustration Login"
                                                                            src="{{ $message->embed(public_path() . '/img/interview.png') }}"
                                                                            style="display: block; height: auto; border: 0; max-width: 280px; width: 100%;"
                                                                            title="Illustration Login"
                                                                            width="280" /></div>
                                                            @endif
                                                            @if ($newStatus === 'ditolak')

                                                                    <div align="center" class="alignment"
                                                                        style="line-height:10px"><img
                                                                            alt="Illustration Login"
                                                                            src="{{ $message->embed(public_path() . '/img/ditolak.png') }}"
                                                                            style="display: block; height: auto; border: 0; max-width: 280px; width: 100%;"
                                                                            title="Illustration Login"
                                                                            width="280" /></div>
                                                            @endif
                                                            @if ($newStatus === 'pending')

                                                                    <div align="center" class="alignment"
                                                                        style="line-height:10px"><img
                                                                            alt="Illustration Login"
                                                                            src="{{ $message->embed(public_path() . '/img/pending2.png') }}"
                                                                            style="display: block; height: auto; border: 0; max-width: 280px; width: 100%;"
                                                                            title="Illustration Login"
                                                                            width="280" /></div>
                                                            @endif

                                                                </td>
                                                            </tr>

                                                        </table>
                                                        <div class="spacer_block block-3"
                                                            style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif

                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-9"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #e8f6f6; background-size: auto;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-size: auto; border-radius: 20px; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="heading_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:5px;text-align:center;width:100%;">
                                                                <h3
                                                                    style="margin: 0; color: #085ff7; direction: ltr; font-family: 'Montserrat', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Detail
                                                                        Pendaftaran</span>
                                                                </h3>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="paragraph_block block-3" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:10px;">
                                                                <div
                                                                    style="color:#393d47;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:25px;font-weight:700;line-height:120%;text-align:center;mso-line-height-alt:30px;">
                                                                    <p style="margin: 0; word-break: break-word;">
                                                                        <span>Berikut Data Pendaftaran Magang
                                                                            Anda</span>
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-4" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="heading_block block-5" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <h1
                                                                    style="margin: 0; color: #61615d; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Nama
                                                                        Lengkap</span>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-6" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0;">
                                                                        {{ $data->full_name }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-7" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="heading_block block-8" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <h1
                                                                    style="margin: 0; color: #61615d; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Asal
                                                                        Sekolah</span>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-9" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0;">{{ $data->school }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-10" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="heading_block block-11" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <h1
                                                                    style="margin: 0; color: #61615d; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Jurusan</span>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-12" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0;">{{ $data->major }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-13" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="heading_block block-14" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <h1
                                                                    style="margin: 0; color: #61615d; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Posisi
                                                                        Magang</span>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-15" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0;">{{ $data->position->name }}
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-16" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="heading_block block-17" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <h1
                                                                    style="margin: 0; color: #61615d; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Tanggal
                                                                        Mulai</span>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-18" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0;">{{ $data->start_date }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-19" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="heading_block block-20" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <h1
                                                                    style="margin: 0; color: #61615d; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;">
                                                                    <span class="tinyMce-placeholder">Tanggal
                                                                        Selesai</span>
                                                                </h1>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-21" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;">
                                                                    <p style="margin: 0;">{{ $data->end_date }}</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="divider_block block-22" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                        width="100%">
                                                                        <tr>
                                                                            <td class="divider_inner"
                                                                                style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                <span> </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="spacer_block block-23"
                                                        style="height:20px;line-height:20px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-10"
                        role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($newStatus === 'diterima')
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-11"
                            role="presentation"
                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;"
                            width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <table align="center" border="0" cellpadding="0" cellspacing="0"
                                            class="row-content stack" role="presentation"
                                            style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                            width="600">
                                            <tbody>
                                                <tr class="reverse">
                                                    <td class="column column-1 first"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                        width="50%">
                                                        <div class="border">
                                                            <div class="spacer_block block-1"
                                                                style="height:20px;line-height:20px;font-size:1px;">
                                                            </div>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="paragraph_block block-2" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-left:25px;padding-right:25px;padding-top:10px;">
                                                                        <div
                                                                            style="color:#085ff7;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                            <p
                                                                                style="margin: 0; word-break: break-word;">
                                                                                <span>Account Login</span>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="heading_block block-3" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:5px;text-align:center;width:100%;">
                                                                        <h3
                                                                            style="margin: 0; color: #454562; direction: ltr; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 25px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;">
                                                                            <span class="tinyMce-placeholder">Detail
                                                                                Akun
                                                                                Anda</span>
                                                                        </h3>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="paragraph_block block-4" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:10px;">
                                                                        <div
                                                                            style="color:#393d47;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                            <p
                                                                                style="margin: 0; word-break: break-word;">
                                                                                <span>Karena anda diterima Magang di
                                                                                    Kadang
                                                                                    Koding Indonesia. Pemagang dapat
                                                                                    Login
                                                                                    di Website Internship. Berikut Akun
                                                                                    anda</span>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="spacer_block block-5"
                                                                style="height:30px;line-height:30px;font-size:1px;">
                                                            </div>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="heading_block block-6" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:5px;padding-left:25px;padding-right:10px;padding-top:10px;text-align:center;width:100%;">
                                                                        <h1
                                                                            style="margin: 0; color: #085ff7; direction: ltr; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;">
                                                                            <span
                                                                                class="tinyMce-placeholder">Email</span>
                                                                        </h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="paragraph_block block-7" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:5px;padding-left:25px;padding-right:25px;padding-top:5px;">
                                                                        <div
                                                                            style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                            <p style="margin: 0;">
                                                                                {{ $data->user->email }}</p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="10" cellspacing="0"
                                                                class="divider_block block-8" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div align="center" class="alignment">
                                                                            <table border="0" cellpadding="0"
                                                                                cellspacing="0" role="presentation"
                                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                                width="100%">
                                                                                <tr>
                                                                                    <td class="divider_inner"
                                                                                        style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                        <span> </span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="heading_block block-9" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:10px;padding-left:25px;padding-right:10px;padding-top:10px;text-align:center;width:100%;">
                                                                        <h1
                                                                            style="margin: 0; color: #085ff7; direction: ltr; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; font-size: 18px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: left; margin-top: 0; margin-bottom: 0;">
                                                                            <span
                                                                                class="tinyMce-placeholder">Password</span>
                                                                        </h1>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="paragraph_block block-10" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:5px;padding-left:25px;padding-right:25px;padding-top:5px;">
                                                                        <div
                                                                            style="color:#101112;direction:ltr;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                                                            <p style="margin: 0;">{{ $password }}
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table border="0" cellpadding="10" cellspacing="0"
                                                                class="divider_block block-11" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div align="center" class="alignment">
                                                                            <table border="0" cellpadding="0"
                                                                                cellspacing="0" role="presentation"
                                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                                width="100%">
                                                                                <tr>
                                                                                    <td class="divider_inner"
                                                                                        style="font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;">
                                                                                        <span> </span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="spacer_block block-12"
                                                                style="height:30px;line-height:30px;font-size:1px;">
                                                            </div>
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                class="button_block block-13" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad"
                                                                        style="padding-bottom:10px;padding-left:25px;padding-right:25px;padding-top:10px;text-align:left;">
                                                                        <div align="left" class="alignment">
                                                                            <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://127.0.0.1:8000/login" style="height:43px;width:183px;v-text-anchor:middle;" arcsize="10%" strokeweight="0.75pt" strokecolor="#085ff7" fillcolor="#085ff7"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Tahoma, Verdana, sans-serif; font-size:16px"><![endif]--><a
                                                                                href="http://127.0.0.1:8000/login"
                                                                                style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#085ff7;border-radius:4px;width:auto;border-top:1px solid transparent;font-weight:400;border-right:1px solid transparent;border-bottom:1px solid transparent;border-left:1px solid transparent;padding-top:5px;padding-bottom:5px;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"
                                                                                target="_blank"><span
                                                                                    style="padding-left:35px;padding-right:35px;font-size:16px;display:inline-block;letter-spacing:normal;"><span
                                                                                        style="word-break: break-word; line-height: 32px;">Login
                                                                                        Sekarang</span></span></a><!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="spacer_block block-14"
                                                                style="height:30px;line-height:30px;font-size:1px;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="column column-2 last"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                        width="50%">
                                                        <div class="border">
                                                            <div class="spacer_block block-1"
                                                                style="height:15px;line-height:15px;font-size:1px;">
                                                            </div>
                                                            <table border="0" cellpadding="10" cellspacing="0"
                                                                class="image_block block-2" role="presentation"
                                                                style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                                width="100%">
                                                                <tr>
                                                                    <td class="pad">
                                                                        <div align="center" class="alignment"
                                                                            style="line-height:10px"><img
                                                                                alt="Illustration Login"
                                                                                src="{{ $message->embed(public_path() . '/img/sosmed/imgLogin.png') }}"
                                                                                style="display: block; height: auto; border: 0; max-width: 280px; width: 100%;"
                                                                                title="Illustration Login"
                                                                                width="280" /></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <div class="spacer_block block-3"
                                                                style="height:20px;line-height:20px;font-size:1px;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-12"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #e8f6f6;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 15px; padding-top: 15px; vertical-align: top; border-radius:10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="image_block block-1" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="center" class="alignment"
                                                                    style="line-height:10px"><img
                                                                        alt="Illustration Thank You"
                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/imgThx.png') }}"
                                                                        style="display: block; height: auto; border: 0; max-width: 210px; width: 100%;"
                                                                        title="Illustration Thank You"
                                                                        width="210" /></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="text_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="font-family: 'Trebuchet MS', Tahoma, sans-serif">
                                                                    <div class=""
                                                                        style="font-size: 12px; font-family: 'Montserrat', 'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Tahoma, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #222222; line-height: 1.2;">
                                                                        <p
                                                                            style="margin: 0; font-size: 20px; text-align: center; mso-line-height-alt: 24px;">
                                                                            <span
                                                                                style="font-size:20px;color:#085ff7;"><strong>Kami
                                                                                    Ucapkan Terimakasih</strong></span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="text_block block-3" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div style="font-family: sans-serif">
                                                                    <div class=""
                                                                        style="font-size: 12px; font-family: Roboto, Tahoma, Verdana, Segoe, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #000000; line-height: 1.2;">
                                                                        <p
                                                                            style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">
                                                                            Terimakasih telah mendaftarkan Magang di
                                                                            Kadang Koding Indonesia.</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-13"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <div class="spacer_block block-1"
                                                        style="height:30px;line-height:30px;font-size:1px;"> </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-14"
                        role="presentation"
                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0"
                                        class="row-content stack" role="presentation"
                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000; width: 600px; margin: 0 auto;"
                                        width="600">
                                        <tbody>
                                            <tr>
                                                <td class="column column-1"
                                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 10px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                                    width="100%">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="html_block block-1" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center"
                                                                    style="font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;text-align:center;">
                                                                    <div style="height:30px;"> </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="image_block block-2" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="width:100%;padding-right:0px;padding-left:0px;">
                                                                <div align="center" class="alignment"
                                                                    style="line-height:10px"><a
                                                                        href="https://kadangkoding.com"
                                                                        style="outline:none" tabindex="-1"
                                                                        target="_blank"><img alt="Logo Kadang Koding"
                                                                            src="{{ $message->embed(public_path() . '/img/logo/logofull.png') }}"
                                                                            style="display: block; height: auto; border: 0; max-width: 150px; width: 100%;"
                                                                            title="Logo Kadang Koding"
                                                                            width="150" /></a></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="paragraph_block block-3" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:25px;">
                                                                <div
                                                                    style="color:#000000;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:12px;font-weight:400;line-height:120%;text-align:center;mso-line-height-alt:14.399999999999999px;">
                                                                    <p style="margin: 0; word-break: break-word;">
                                                                        Kuyudan RT 02/RW 05, Dusun II, Makamhaji, Kec.
                                                                        Kartasura, Kabupaten Sukoharjo, Jawa Tengah
                                                                        57161</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="paragraph_block block-4" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div
                                                                    style="color:#000000;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:12px;font-weight:400;line-height:120%;text-align:center;mso-line-height-alt:14.399999999999999px;">
                                                                    <p style="margin: 0; word-break: break-word;">
                                                                        <span>Follow us on social media:</span>
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="10" cellspacing="0"
                                                        class="social_block block-5" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad">
                                                                <div align="center" class="alignment">
                                                                    <table border="0" cellpadding="0"
                                                                        cellspacing="0" class="social-table"
                                                                        role="presentation"
                                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;"
                                                                        width="108px">
                                                                        <tr>
                                                                            <td style="padding:0 2px 0 2px;"><a
                                                                                    href="https://www.instagram.com/kadangkoding/"
                                                                                    target="_blank"><img
                                                                                        alt="Instagram"
                                                                                        height="32"
                                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/instagram2x.png') }}"
                                                                                        style="display: block; height: auto; border: 0;"
                                                                                        title="Instagram"
                                                                                        width="32" /></a></td>
                                                                            <td style="padding:0 2px 0 2px;"><a
                                                                                    href="https://www.linkedin.com/company/kadang-koding-indonesia/about/"
                                                                                    target="_blank"><img
                                                                                        alt="Linkedin"
                                                                                        height="32"
                                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/linkedin2x.png') }}"
                                                                                        style="display: block; height: auto; border: 0;"
                                                                                        title="Linkedin"
                                                                                        width="32" /></a></td>
                                                                            <td style="padding:0 2px 0 2px;"><a
                                                                                    href="https://www.facebook.com/kadangkodingindonesia/"
                                                                                    target="_blank"><img
                                                                                        alt="Facebook"
                                                                                        height="32"
                                                                                        src="{{ $message->embed(public_path() . '/img/sosmed/facebook2x.png') }}"
                                                                                        style="display: block; height: auto; border: 0;"
                                                                                        title="facebook"
                                                                                        width="32" /></a></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                        class="paragraph_block block-6" role="presentation"
                                                        style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                                        width="100%">
                                                        <tr>
                                                            <td class="pad"
                                                                style="padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:25px;">
                                                                <div
                                                                    style="color:#000000;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:12px;font-weight:400;line-height:120%;text-align:center;mso-line-height-alt:14.399999999999999px;">
                                                                    <p style="margin: 0; word-break: break-word;">
                                                                        Copyright © 2023 Kadang Koding Indonesia, All
                                                                        rights reserved.</p>
                                                                    <p style="margin: 0;"> </p>
                                                                    <p style="margin: 0; word-break: break-word;">
                                                                    </p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
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
    </table><!-- End -->
</body>

</html>
