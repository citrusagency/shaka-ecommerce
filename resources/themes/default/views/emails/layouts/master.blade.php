<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet" type="text/css">
        <style type="text/css">
            .text-primary-email{
                color:#232427;
            }
            .header-email{
                text-align: center;
                padding-top:60px;
                padding-bottom: 50px;
                background-color: #232427;
            }
            .header-email a{
                font-size:24px;
                color:white;
            }
            .main-container{
                font-size:16px;
                font-weight:500;
                line-height: 30px;
                margin-inline:80px;
                padding-top: 60px;
            }
            .email-content a{
                font-weight:400;
                text-transform: uppercase;
                text-decoration: none;
                line-height: 4px;
                letter-spacing: 3px;
            }
            .ver-heading{
                font-size:16px;
                color:#242424;
                font-weight:600;
                margin-top: 60px;
                margin-bottom: 15px
            }
            .dear-customer{
                font-weight: 600;
                font-size: 20px !important;
            }
            .p-text{
                font-size: 18px !important;
                color: #6a6a6a !important;
                font-weight:400;
                line-height: 24px !important;
            }
            .w-pd{
                padding-bottom: 20px !important;
            }
            .center-container{
                text-align: center;
                padding: 20px 0;
                margin: 50px 0;
            }
            .center-container a{
                padding: 14px 20px;
                background: #1197C2;
                color: #fff;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
                line-height: 22px;
                letter-spacing: 0.48px;
                border:none;
                border-radius: 6px;
            }
            .message-container{
                padding-left: 30px;
                border-left: 3px solid rgba(35, 36, 39, 0.63);
                border-radius: 1.5%;
                margin-bottom: 40px;
            }
            .message-container > div{
                padding: 5px 0;
            }
            .message-container > div > span{
                padding-left: 5px;
            }
            .by-author{
                font-size:16px;
                padding-bottom:60px;
                margin-inline:80px;
            }
            .by-author a{
                font-size:18px;
            }
            .footer-email{
                text-align: center;
                padding-top:30px;
                padding-bottom: 30px;
                background-color: #232427;
            }
            .footer-email p{
                font-weight:300; text-transform: uppercase ;
                text-decoration: none; font-size:20px;
                color:white;
                font-family: Outfit, sans-serif ;
                line-height: 3px;
                letter-spacing: 3px;
            }
        </style>
    </head>

    <body style="font-family: Outfit, sans-serif;">
        <div style="max-width: 1000px; margin-left: auto; margin-right: auto;">
            <div style="text-align: center;">
                {{ $header ?? '' }}
            </div>

            <div class="email-content">
                <div class="header-email">
                    <a href="{{ config('app.url') }}">
                        Katarina Zlajić
                    </a>
                </div>

                <div class="main-container text-primary-email">
                    {{ $slot }}
                </div>

                {{ $subcopy ?? '' }}

                <div class="by-author">
                    <a class="text-primary-email" href="{{ config('app.url') }}">
                        Katarina Zlajić
                    </a>
                </div>

                <div class="footer-email"><p></p></div>
            </div>

        </div>
    </body>
</html>
