@push('css')
    <style type="text/css">
        .profile-index{
            display: grid;
            grid-template-columns: 230px 1fr; /* First column fixed width, second column takes up remaining space */
            grid-column-gap: 40px;
            background-color: white;
            min-height: 65vh;
            padding: 40px 136px;
        }
        .profile-content{
            /*display: flex;*/
            flex-direction: column;
            align-items: flex-start;
            align-self: stretch;
            /*max-width: 1300px;*/
            gap: 24px;
            overflow-x: auto;
        }
        .profile-content-title{
            color: #232427;
            font-family: "Open Sans", sans-serif;
            font-size: 24px;
            font-style: normal;
            font-weight: 700;
            line-height: normal;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .page-title-container{
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .kz-link{
            color: #1197C2;
            text-align: center;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: 22px;
            letter-spacing: 0.48px;
        }
        @media (max-width: 992px){
            .sidebar_menu{
                display: none !important;
            }
            .profile-index{
                grid-template-columns: 1fr;
                grid-column-gap: 20px;
                padding: 50px 60px;
            }
        }

        @media (max-width: 626px){
            .profile-index{
                padding: 50px 30px;
            }
            .page-title-container{
                margin-bottom: 20px;
            }
        }
    </style>
@endpush

@extends('shop::layouts.master')

@section('content-wrapper')
    <div class="profile-index" >
        <div class="sidebar left sidebar_menu" >
            @include('shop::customers.account.partials.sidemenu')
        </div>

        <div class="profile-content">
            @yield('page-detail-wrapper')
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
@endpush