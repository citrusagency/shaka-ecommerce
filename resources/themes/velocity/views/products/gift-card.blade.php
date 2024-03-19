@extends('shop::layouts.master')

@push('css')
    <style type="text/css">
        body {
            overflow-x: hidden!important;
        }
        .breadcrumb-stl{
            color: #777;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: 151.682%;
            text-decoration-line: underline;
            text-transform: uppercase;
        }
        .breadcrumb-stl-main{
            color: #1197C2;
            font-size: 15px;
            font-style: normal;
            font-weight: 700;
            line-height: 151.682%; /* 19.719px */
            text-transform: uppercase;
        }
        .breadcrumbs-p{
            color: #777;
            font-size: 15px !important;
            margin-left: 20px;
            padding-bottom: 10px;
        }
        .gift-card-contents{
            display: flex;
            flex-direction: column;
            font-family: Outfit, sans-serif;
            justify-content: center;
            align-items: flex-start;
            gap: 24px;
            flex: 1 0 0;
        }
        .gift-card-txt{
            color:#777;
            font-size: 18px;
            font-style: normal;
            font-family: 'Outfit', sans-serif !important;
            font-weight: 300;
            line-height: 32px;
            width: 100%;
            height: auto;
            margin: 24px 0;
        }
        .gift-card-info{
            color: #232427;
            font-family: 'Outfit', sans-serif;
            font-size: 16px !important;
            font-style: normal;
            font-weight: 300;
            line-height: 22px;
            margin-bottom: 10px !important;
            vertical-align: center;
        }
        .gift-card-title{
            color:  #232427;
            font-size: 24px;
            font-family: "Open Sans", sans-serif;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .gift-card-category{
            color:  #1197C2;
            font-size: 17px !important;
            font-style: normal;
            font-weight: 600;
            line-height: 22px;
            letter-spacing: 0.48px;
            vertical-align: center;
        }
        .form-container{
            margin: 0;
            padding: 80px 130px;
            background: #EEEEE9;
        }
        .form-content{
            width: 40%;
            margin: auto;
        }
        .form-desc{
            color:#777;
            font-size: 16px;
            font-style: normal;
            font-weight: 300;
            line-height: 26px; /* 162.5% */
        }
        .form-title{
            color: #232427;
            font-size: 18px !important;
            font-style: normal;
            font-weight: 600 !important;
            line-height: 151.682%; /* 27.303px */
            text-transform: none;
            letter-spacing: 0;
        }
        .form-section-title{
            color:#232427;
            font-size: 16px;
            font-style: normal;
            font-weight: 600 !important;
            line-height: 151.682%; /* 24.269px */
            text-transform: none;
            letter-spacing: 0;
            margin:0;
        }
        .form-label{
            color: #777;
            font-size: 14px;
            font-style: normal;
            font-weight: 700;
            line-height: 16px; /* 114.286% */
            letter-spacing: 0.7px;
        }
        .input-fields{
            display: flex;
            width: 100%;
            flex-direction: row;
            align-items: flex-start;
            gap: 24px;
            flex-wrap:nowrap;
            margin: 20px 0;
        }
        .input-field{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            flex-wrap: wrap;
            width: 48%;
        }
        .input-btn >input{
            width: 100px !important;
            justify-content: space-between;
            color:  #777;
        }
        .input-field > input, .form-textarea, .input-btn >input{
            margin: 10px 0;
            padding: 16px;
            border: none;
            border-radius: 8px;
            width: 100%;
        }
        .btn-submit{
            border-radius: 8px;
            border:none;
            background:  #1197C2;
            display: flex;
            padding: 8px 22px;
            justify-content: center;
            align-items: center;
            gap: 16px;
            align-self: stretch;
            width: 100%;
            color: #FFF;
            text-align: center;
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: 22px; /* 137.5% */
            letter-spacing: 0.48px;
            margin-top: 14px;
        }
        .section-container{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap:30px;
            justify-content: center;
        }
        .mg-5{
            margin:50px auto;
        }

        .error_msg{
            color: #d14444;
            font-size: 14px;
            padding-top: 5px;
            padding-bottom: 10px;
            margin-left: 10px;
            font-family: Outfit, sans-serif;
            font-style: normal;
            font-weight: 600;
            letter-spacing: 0.7px;
        }

        @media only screen and (max-width: 1220px) {
            .section-container {
                flex-direction: column;
                margin:10px 100px;
            }
            .form-content{
                width: 100%;
            }
            .input-field{
                width: 100%;
            }
            .breadcrumbs-p{
                margin-left: 100px;
            }
            .input-fields{
                flex-wrap: wrap;
            }
        }

        @media only screen and (max-width: 480px) {
            .section-container {
                flex-direction: column;
                margin:10px auto;
                flex-wrap: nowrap;
                padding-inline: 10px;
            }
            .image-container > img{
                max-width: 340px;
                margin:20px 0;
            }
            .gift-card-contents{
                width: 100%;
                margin: auto;
                padding-inline: 13px;
            }
            .gift-card-title{
                font-size: 20px;
            }
            .form-container{
                width: 100%;
                margin:0;
                padding:30px 40px;
            }
            .form-content{
                width: 100%;
            }
            .input-field{
                width: 100%;
            }
            .breadcrumbs-p{
                margin-left:15px;
            }
            .input-fields{
                justify-content: space-around;
                align-items: center;
                flex-wrap: wrap;
            }
            .btn-submit{
                margin-bottom: 20px;
                margin-top: 20px;
            }
        }

    </style>
@endpush

@push('css')
    <style type="text/css">
        .hidden {
            display: none;
        }

        .label-chk {
            align-self: center;
            position: relative;
            width: 110px;
            height: 50px;
            padding:8px 16px;
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
            background-color: #fff;
            color:#777;
            border-radius: 8px;
            border: 1px solid #DADADA;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap:wrap;
        }

        .label-chk>.text {
            display: block;
            flex-grow: 1;
            text-align: center;
            height: 100%;
            padding-top: 2px;
            font-size: 13px;
            color: #333;
        }

        .label-chk:hover,
        input:checked+.label-chk {
            border: 1px solid #1197C2;
            border-radius: 6px;
        }

        .label-chk:hover,
        input:checked+.label-chk>.text {
            color: #1197C2;
        }

        input:checked+.label-chk {
            color: #1197C2;
            background-color: white;
        }
    </style>
@endpush

@push('css')
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endpush

@section('page_title')
    Gift Card
@stop

@section('content-wrapper')
    <div class="container mg-5">
        <p class="breadcrumbs-p"><span class="breadcrumb-stl" style="margin-right: 6px;">HOME</span> > <span class="breadcrumb-stl" style="margin-inline: 6px;">SHOP</span> > <span class="breadcrumb-stl-main" style="margin-left: 6px;">GIFT CARD</span> </p>
        <div class="section-container">
            <section class="image-container">
                <img src="{{asset('/images/gift_card.png')}}" alt="Gift Card photo"/>
            </section>
            <section class="gift-card-contents">
                <h6 class="gift-card-title">GIFT CARD</h6>
                <p class="gift-card-txt p-0 m-0">
                    Getting a gift card from Katarina Zlajic is the simplest way to win presents.  Please make sure you enter the recipient's email address accurately if you are buying a Katarina Zlajic gift card for someone else. If you get it wrong and the Gift Voucher is emailed to someone else who uses it, there’s not much we can do. Before you buy, make sure to double-check!
                </p>
                <svg xmlns="http://www.w3.org/2000/svg" width="575" height="2" viewBox="0 0 575 2" fill="none">
                    <path d="M1 1H574" stroke="#DADADA" stroke-linecap="square"/>
                </svg>
                <div>
                    <div class="text-uppercase gift-card-info">
                        <span class="gift-card-info"> Category: </span><span class="gift-card-category"> Gift Card</span>
                    </div>
                    <div class="text-uppercase gift-card-info">
                        <span class="gift-card-category" style="display:flex; gap:8px;">
                            <span class="gift-card-info"> Share this product: </span>
                            <a href="https://www.facebook.com/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <path d="M11.8346 2.51562C10.8125 2.51562 9.83213 2.942 9.1093 3.70093C8.38655 4.45987 7.98047 5.4892 7.98047 6.5625V8.81562H5.91797C5.81442 8.81562 5.73047 8.90374 5.73047 9.0125V11.9875C5.73047 12.0963 5.81442 12.1844 5.91797 12.1844H7.98047V18.2875C7.98047 18.3963 8.06442 18.4844 8.16797 18.4844H11.0013C11.1049 18.4844 11.1888 18.3963 11.1888 18.2875V12.1844H13.2696C13.3556 12.1844 13.4306 12.1229 13.4515 12.0353L14.1598 9.06028C14.1894 8.93603 14.0999 8.81562 13.9779 8.81562H11.1888V6.5625C11.1888 6.38265 11.2569 6.21016 11.378 6.08299C11.4991 5.95582 11.6634 5.88437 11.8346 5.88437H14.0013C14.1049 5.88437 14.1888 5.79623 14.1888 5.6875V2.7125C14.1888 2.60377 14.1049 2.51562 14.0013 2.51562H11.8346Z" fill="#1197C2"/>
                                </svg>
                            </a>
                            <a href="https://www.messenger.com/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">
                                    <g clip-path="url(#clip0_78_2766)">
                                        <path d="M0 7.29C0 3.38837 3.05638 0.5 7 0.5C10.9436 0.5 14 3.38837 14 7.29C14 11.1916 10.9436 14.08 7 14.08C6.29125 14.08 5.61225 13.9864 4.9735 13.8114C4.84964 13.7769 4.7177 13.7862 4.59987 13.8376L3.21037 14.4519C3.12646 14.4889 3.03473 14.5047 2.94325 14.498C2.85178 14.4913 2.76336 14.4622 2.68576 14.4133C2.60817 14.3644 2.54378 14.2971 2.49824 14.2175C2.45271 14.1379 2.42743 14.0483 2.42462 13.9566L2.38613 12.7115C2.38347 12.6357 2.36542 12.5613 2.33307 12.4927C2.30073 12.4241 2.25478 12.3628 2.198 12.3125C0.8365 11.0945 0 9.3305 0 7.29ZM4.85275 6.01337L2.7965 9.27537C2.59963 9.58862 2.98375 9.94125 3.27863 9.71812L5.488 8.04163C5.56067 7.98643 5.64933 7.95641 5.74058 7.95609C5.83183 7.95577 5.9207 7.98519 5.99375 8.03987L7.62912 9.26662C7.74516 9.35364 7.87796 9.41567 8.01916 9.44881C8.16036 9.48195 8.30689 9.48548 8.44952 9.45917C8.59215 9.43286 8.72779 9.37729 8.84787 9.29596C8.96796 9.21463 9.06989 9.10931 9.14725 8.98662L11.2035 5.72462C11.4012 5.41138 11.0163 5.05875 10.7214 5.28187L8.512 6.95837C8.43933 7.01357 8.35067 7.04359 8.25942 7.04391C8.16817 7.04422 8.0793 7.01481 8.00625 6.96012L6.37088 5.7325C6.25484 5.64549 6.12204 5.58345 5.98084 5.55031C5.83964 5.51718 5.69311 5.51365 5.55048 5.53995C5.40785 5.56626 5.27222 5.62183 5.15213 5.70316C5.03204 5.78449 4.93011 5.88982 4.85275 6.0125V6.01337Z" fill="#1197C2"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_78_2766">
                                        <rect width="14" height="14" fill="white" transform="translate(0 0.5)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a href="https://twitter.com/?lang=en" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                    <path d="M17.2666 4.92973C17.3126 4.86579 17.2448 4.78323 17.1714 4.81167C16.6499 5.01381 16.1049 5.15019 15.549 5.21739C16.168 4.84759 16.6457 4.28465 16.9106 3.61817C16.9375 3.55028 16.8634 3.48965 16.7994 3.52497C16.2241 3.8427 15.6036 4.07148 14.9591 4.20325C14.9321 4.20876 14.9043 4.19958 14.8854 4.17959C14.4017 3.66923 13.7649 3.32941 13.0709 3.21198C12.3622 3.09209 11.6338 3.2108 10.9999 3.5495C10.3659 3.8882 9.86235 4.42773 9.56808 5.08348C9.28831 5.70696 9.21286 6.40197 9.35085 7.06944C9.36154 7.12123 9.321 7.17013 9.2682 7.16685C8.0142 7.08897 6.78891 6.75541 5.6679 6.18628C4.54974 5.6186 3.55958 4.82887 2.75772 3.86578C2.72214 3.82304 2.65469 3.82857 2.62875 3.87778C2.37925 4.35124 2.24861 4.87897 2.24897 5.41531C2.24795 5.9492 2.37897 6.47505 2.63035 6.94605C2.88174 7.41705 3.24569 7.81858 3.6898 8.11489C3.21881 8.10207 2.75702 7.98562 2.33704 7.77453C2.28291 7.74733 2.21799 7.78607 2.22081 7.84658C2.25356 8.55055 2.512 9.25727 2.95934 9.79956C3.43538 10.3765 4.09612 10.7714 4.8298 10.9174C4.54737 11.0034 4.25416 11.0487 3.95897 11.052C3.79831 11.0501 3.63795 11.0383 3.47884 11.0165C3.41985 11.0084 3.37168 11.0645 3.39233 11.1203C3.61116 11.7121 3.99775 12.2285 4.50606 12.6054C5.0495 13.0083 5.70504 13.2319 6.38147 13.2449C5.23925 14.1437 3.82904 14.6342 2.37563 14.6382C2.22629 14.6387 2.07701 14.6339 1.92809 14.6237C1.84416 14.618 1.80557 14.7298 1.8779 14.7727C3.29401 15.6132 4.9126 16.0573 6.56355 16.0553C7.78247 16.068 8.99167 15.8376 10.1206 15.3777C11.2495 14.9178 12.2754 14.2376 13.1385 13.3767C14.0016 12.5158 14.6845 11.4917 15.1473 10.3639C15.61 9.23621 15.8435 8.02757 15.834 6.80865V6.42878C15.834 6.40379 15.8458 6.38028 15.8657 6.36522C16.4027 5.95977 16.8749 5.47572 17.2666 4.92973Z" fill="#1197C2"/>
                                </svg>
                            </a>
                            <a href="https://me.linkedin.com/" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="19" viewBox="0 0 21 19" fill="none">
                                    <path d="M4.15625 1.48438C3.12934 1.48438 2.29688 2.23756 2.29688 3.16667C2.29688 4.09577 3.12934 4.84896 4.15625 4.84896C5.18315 4.84896 6.01562 4.09577 6.01562 3.16667C6.01562 2.23756 5.18315 1.48438 4.15625 1.48438Z" fill="#1197C2"/>
                                    <path d="M2.40625 6.23438C2.34584 6.23438 2.29688 6.27868 2.29688 6.33333V16.625C2.29688 16.6796 2.34584 16.724 2.40625 16.724H5.90625C5.96666 16.724 6.01562 16.6796 6.01562 16.625V6.33333C6.01562 6.27868 5.96666 6.23438 5.90625 6.23438H2.40625Z" fill="#1197C2"/>
                                    <path d="M8.09375 6.23438C8.03334 6.23438 7.98438 6.27868 7.98438 6.33333V16.625C7.98438 16.6796 8.03334 16.724 8.09375 16.724H11.5938C11.6541 16.724 11.7031 16.6796 11.7031 16.625V11.0833C11.7031 10.6896 11.8759 10.3121 12.1837 10.0337C12.4913 9.75531 12.9086 9.59896 13.3438 9.59896C13.7789 9.59896 14.1962 9.75531 14.5038 10.0337C14.8116 10.3121 14.9844 10.6896 14.9844 11.0833V16.625C14.9844 16.6796 15.0334 16.724 15.0938 16.724H18.5938C18.6541 16.724 18.7031 16.6796 18.7031 16.625V9.80099C18.7031 7.87985 16.8563 6.37687 14.7436 6.55065C14.0921 6.60423 13.4479 6.75079 12.8463 6.98404L11.7031 7.42731V6.33333C11.7031 6.27868 11.6541 6.23438 11.5938 6.23438H8.09375Z" fill="#1197C2"/>
                                </svg>
                            </a>
                            <a href="" onclick="copyToClipboard()" title="Copy Link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                    <path d="M5.89352 8.6775L4.17852 10.3925C3.4752 11.0958 3.08008 12.0497 3.08008 13.0444C3.08008 14.039 3.4752 14.9929 4.17852 15.6962C4.88184 16.3996 5.83575 16.7947 6.83039 16.7947C7.82504 16.7947 8.77895 16.3996 9.48227 15.6962L11.7673 13.41C12.1914 12.9858 12.5076 12.4661 12.6893 11.8944C12.8709 11.3228 12.9129 10.7159 12.8115 10.1247C12.7101 9.53346 12.4683 8.97521 12.1066 8.49676C11.7448 8.01831 11.2735 7.63362 10.7323 7.375L9.99977 8.1075C9.9254 8.182 9.86073 8.26557 9.80727 8.35625C10.2254 8.47646 10.605 8.70372 10.9084 9.01557C11.2118 9.32742 11.4286 9.71305 11.5373 10.1344C11.646 10.5556 11.6428 10.998 11.5282 11.4177C11.4135 11.8375 11.1913 12.22 10.8835 12.5275L8.59977 14.8125C8.13067 15.2816 7.49443 15.5451 6.83102 15.5451C6.16761 15.5451 5.53137 15.2816 5.06227 14.8125C4.59317 14.3434 4.32963 13.7072 4.32963 13.0437C4.32963 12.3803 4.59317 11.7441 5.06227 11.275L6.05352 10.285C5.91366 9.76091 5.85963 9.21762 5.89352 8.67625V8.6775Z" fill="#1197C2"/>
                                    <path d="M8.23293 6.33999C7.80881 6.76417 7.49263 7.2839 7.31094 7.85555C7.12925 8.42721 7.08733 9.03411 7.18873 9.62532C7.29012 10.2165 7.53185 10.7748 7.89364 11.2532C8.25543 11.7317 8.72671 12.1164 9.26793 12.375L10.2367 11.405C9.81286 11.2913 9.42643 11.0681 9.11622 10.7577C8.80601 10.4474 8.58294 10.0609 8.46944 9.63701C8.35594 9.21315 8.356 8.76688 8.46961 8.34305C8.58322 7.91921 8.80639 7.53275 9.11668 7.22249L11.4004 4.93749C11.8695 4.46838 12.5058 4.20485 13.1692 4.20485C13.8326 4.20485 14.4688 4.46838 14.9379 4.93749C15.407 5.40659 15.6706 6.04283 15.6706 6.70624C15.6706 7.36965 15.407 8.00589 14.9379 8.47499L13.9467 9.46499C14.0867 9.98999 14.1404 10.5337 14.1067 11.0737L15.8217 9.35874C16.525 8.65542 16.9201 7.70151 16.9201 6.70686C16.9201 5.71221 16.525 4.75831 15.8217 4.05499C15.1184 3.35166 14.1644 2.95654 13.1698 2.95654C12.1752 2.95654 11.2212 3.35166 10.5179 4.05499L8.23293 6.33999Z" fill="#1197C2"/>
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="form-container">
        <form class="form-content" onsubmit="{{route('shop.sendGiftCard')}}" method="POST">
            @csrf
            @method("post")
            <h5 class="form-title">Gift Voucher amount</h5>
            <p class="form-desc">Choose a gift card amount, drop in a message and we'll slide it straight into the lucky person's inbox on your chosen day.</p>
            <div class="input-fields" style="justify-content: space-between; gap:5px;">
                <div class="input-btn">
                    <input class="hidden" id="chk1" type="radio" name="amount" value="100">
                    <label class="label-chk money money1" for="chk1">100 EUR</label>
                </div>
                <div class="input-btn">
                    <input class="hidden" id="chk2" type="radio" name="amount" value="300">
                    <label class="label-chk money money2" for="chk2">300 EUR</label>
                </div>
                <div class="input-btn">
                    <input class="hidden" id="chk3" type="radio" name="amount" value="500">
                    <label class=" label-chk money money3" for="chk3">500 EUR</label>
                </div>
                <div class="input-btn">
                    <input class="hidden" id="chk4" type="radio" name="amount" value="1000">
                    <label class=" label-chk money money4" for="chk4">1000 EUR</label>
                </div>
            </div>
            @error('amount')
                <div class="error_msg" style="text-align: center;">
                    {{ $message }}
                </div>
            @enderror
            <h6 class="form-section-title">To</h6>
            <div class="input-fields">
                <div class="input-field">
                    <label class="form-label" for="recipient-name">Recipient's name</label>
                    <input type="text" placeholder="Name" id="recipient-name" name="recipient-name" value="{{old('recipient-name')}}"/>
                    @error('recipient-name')
                    <div class="error_msg">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="input-field">
                    <label class="form-label" for="recipient-email">Recipient's e-mail address</label>
                    <input type="email" placeholder="example@mail.com" id="recipient-email" name="recipient-email" value="{{old('recipient-email')}}"/>
                    @error('recipient-email')
                    <div class="error_msg">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <h6 class="form-section-title">From</h6>
            <div class="input-fields">
                <div class="input-field">
                    <label class="form-label" for="sender-name">Your name</label>
                    <input type="text" placeholder="Name"  name="sender-name" id="sender-name" value="{{old('sender-name')}}"/>
                    @error('sender-name')
                    <div class="error_msg">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="input-field">
                    <label class="form-label" for="delivery-date">Delivery date</label>
                    <input type="text" class="cursor-pointer" id="delivery-date" name="delivery-date" value="{{old('delivery-date')}}" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Choose date"/>
                    @error('delivery-date')
                    <div class="error_msg">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div>
                <label style="width:100%" class="form-label" for="message">Personal message</label>
                <textarea class="form-textarea" placeholder="Want to add a note?" rows="5" name="message" id="message">{{old('message')}}</textarea>
                @error('message')
                <div class="error_msg">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn-submit mt-4" style="height: 50px!important;">Pay securely</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href)
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        }
    </script>
@endpush