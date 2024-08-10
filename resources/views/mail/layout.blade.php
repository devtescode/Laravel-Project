<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif; 
            margin: 0;
            padding: 0;
        }
        .container, .botton_container {
            width: 640px;
            display: grid;
            gap: 10px;
            border-radius: 32px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: white;
        }
        .main {
            padding: 20px 45px;
            margin: 20px 0;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #596780;
            text-align: left;
        }
        .contain {
            text-align: center;
            justify-content: center;
            align-items: center;
            display: flex;
        }
        .contain > div > h1 {
            font-size: 30px;
            font-weight: 700;
            line-height: 40.92px;
            text-align: left;
            color: #00693d;
            margin: 0;
            padding: 0;
        }
        .item, .item-no-pad {
            justify-content: center;
            display: flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            padding: 0;
        }
        .item > p {
            color: #2e2e2e;
            font-size: 14px;
            font-weight: 500;
            line-height: 19.1px;
            text-align: center;
        }
        .fa-map-marker-alt {
            color: #00693d;
        }
        .group_paragraph {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .fas, .far {
            color: #facc96;
        }
        .center {
            text-align: center;
            margin: 0 auto;
        }
        .padding-x-5 {
            padding-left: 15px;
            padding-right: 15px;
        }
        .w-full {
            width: 100%;
        }
        .pl-5 {
            padding-left: 5px;
        }
        .pr-5 {
            padding-right: 5px;
        }
        .py-10 {
            padding-top: 12px;
            padding-bottom: 12px;
        }
        .flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @media (prefers-color-scheme: dark) {
            body, table, tr, td {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
            }
            .container, .botton_container {
                background-color: #333333 !important;
            }
            .main {
                color: #cccccc !important;
            }
            .contain > div > h1 {
                color: #00ff00 !important; /* Adjust this to your preferred color for dark mode */
            }
            .item > p {
                color: #ffffff !important;
            }
        }
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center">
                <div class="container" style="background-color: white; border-radius: 32px; padding: 20px; margin-bottom: 30px;">
                    <div class="header" style="position: relative;">
                        <img src="https://www.landearn.com/assets/Frame-22.png" width="635" alt="looking" class="" style="display: block; max-width: 100%; height: auto;" />
                        {{-- @yield('title') --}}
                    </div>
                    @yield('message')
                </div>

                <div class="botton_container" style="background-color: white; border-radius: 32px; padding: 20px; margin-bottom: 30px;">
                    <div class="contain">
                        <div class="text center">
                            <h1 class="center w-full py-10" style="text-align:center; color: #00693d;">Need help? Talk to our expert.</h1>
                            <div class="group_paragraph py-10" style="text-align:center;">
                                <div class="item-no-pad center">
                                    <img src="https://www.landearn.com/assets/phone-bold.png" width="22" alt="phone" />
                                    <p class="center pl-5"><a href="tel:+2348060457344" style="color: #00693d;">(+234) 806-0457-344</a></p>
                                </div>
                                <div class="item center padding-x-5">
                                    <img src="https://www.landearn.com/assets/outline-mail.png" width="22" alt="mail" />
                                    <p class="center pl-5"><a href="mailto:info@landearn.com" style="color: #00693d;">info@landearn.com</a></p>
                                </div>
                                <div class="item-no-pad center">
                                    <img src="https://www.landearn.com/assets/globe-bold.png" width="22" alt="website" />
                                    <p class="center pl-5"><a href="https://www.google.com/" style="color: #00693d;">Feranmi</a></p>
                                </div>
                            </div>
                            {{-- <div class="flex item-no-pad center w-full py-10">
                                <img src="https://www.landearn.com/assets/map-marker.png" width="22" alt="website" />
                                <p class="center" style="color: #2e2e2e;">6 General Okpobrisi Street, Graceville Est, Ogunlana, Lekki, Lagos</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
