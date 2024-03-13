@extends('shop::layouts.master')

@push('css')
    <style type="text/css">
        body {
            overflow-x: hidden!important;
        }
        .breadcrumb-stl{
            color: #777;
            font-size: 13px;
            font-style: normal;
            font-weight: 400;
            line-height: 151.682%;
            text-decoration-line: underline;
            text-transform: uppercase;
        }
        .breadcrumb-stl-main{
            color: #1197C2;
            font-size: 13px;
            font-style: normal;
            font-weight: 700;
            line-height: 151.682%; /* 19.719px */
            text-transform: uppercase;
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
            font-size: 16px !important;
            font-style: normal;
            font-weight: 300;
            line-height: normal;
            margin-bottom: 10px !important;
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
            font-size: 16px !important;
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
            flex-wrap: wrap;
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

    </style>
@endpush

@section('page_title')
    GIFT CARD
@stop

@section('content-wrapper')
    <div class="container py-5" style="margin:auto;">
        <p style="color: #777; font-size: 13px; margin-left: 20px; padding-bottom: 10px"><span class="breadcrumb-stl" style="margin-right: 6px;">HOME</span> > <span class="breadcrumb-stl" style="margin-inline: 6px;">SHOP</span> > <span class="breadcrumb-stl-main" style="margin-left: 6px;">GIFT CARD</span> </p>
        <div class="row container justify-content-center col-12">
            <section class="col-6">
                <img src="{{asset('/images/gift_card.png')}}" alt="Gift Card photo"/>
            </section>
            <section class="col-6 gift-card-contents">
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
                        <span class="gift-card-info"> Share this product: </span><span class="gift-card-category"> icons..</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="form-container">
        <form class="form-content">
            <h5 class="form-title">Gift Voucher amount</h5>
            <p class="form-desc">Choose a gift card amount, drop in a message and we'll slide it straight into the lucky person's inbox on your chosen day.</p>
            <div class="input-fields">
                <div class="input-btn">
                    <label></label>
                    <input class="cursor-pointer" value="100EUR"/>
                </div>
                <div class="input-btn">
                    <label></label>
                    <input class="cursor-pointer" value="300EUR"/>
                </div>
                <div class="input-btn">
                    <label></label>
                    <input class="cursor-pointer" value="500EUR"/>
                </div>
                <div class="input-btn">
                    <label></label>
                    <input class="cursor-pointer" value="1000EUR"/>
                </div>
            </div>
            <h6 class="form-section-title">To</h6>
            <div class="input-fields">
                <div class="input-field">
                    <label class="form-label">Recipient's e-mail address</label>
                    <input type="email" placeholder="example@mail.com"/>
                </div>
                <div class="input-field">
                    <label class="form-label">Recipient's name</label>
                    <input type="text" placeholder="Name"/>
                </div>
            </div>
            <h6 class="form-section-title">From</h6>
            <div class="input-fields">
                <div class="input-field">
                    <label class="form-label">Your name</label>
                    <input type="text" placeholder="Name"/>
                </div>
                <div class="input-field">
                    <label class="form-label">Delivery date</label>
                    <input type="text" class="cursor-pointer" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Choose date"/>
                </div>
            </div>
            <div>
                <label style="width:100%" class="form-label">Personal message</label>
                <textarea class="form-textarea" placeholder="Want to add a note?" rows="5" ></textarea>
            </div>

            <button class="btn-submit">Pay securely</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush