<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>Penerimaan Santri Baru PKPPS AlQosim Jambi</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}" />
    <!-- FONTS -->
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Red+Hat+Display:100,200,300,400,400italic,500,600,700,700italic,900'>
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,400italic,500,600,700,700italic,900'>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('asset2/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--CSS -->
    <link rel='stylesheet' href='{{ asset('asset2/css/structure.css') }}'>
    <link rel='stylesheet' href='{{ asset('asset2/css/consultant.css') }}'>
    <!-- Revolution Slider -->
    <link rel="stylesheet" href='{{ asset('asset2/plugins/rs-plugin-6.custom/css/rs6.css') }}'>
</head>

<body
    class="home page template-slider style-simple button-custom layout-full-width no-shadows header-transparent header-fw sticky-header sticky-tb-color ab-hide subheader-both-center menu-line-below-80 menuo-right menuo-no-borders footer-copy-center mobile-tb-hide mobile-side-slide mobile-mini-mr-lc tablet-sticky mobile-header-mini mobile-sticky">
    <div id="Wrapper">
        <div id="Header_wrapper">
            <header id="Header">
                {{-- MENU --}}
                <div id="Top_bar">
                    <div class="row">
                        <div class="column one">
                            <div class="top_bar_left clearfix">
                                <div class="logo">
                                    <a id="logo" href="" title="PK-PPS Alqosim Jambi" data-height="60"
                                        data-padding="30"><img class="logo-main scale-with-grid"
                                            src="{{ asset('asset2/images/favicon.png') }}" data-height="60"
                                            alt="Alqosim Jambi" data-no-retina /></a>
                                </div>
                                {{-- <div class="menu_wrapper">
                                    <nav id="menu" style="color: #ffff !important">
                                        <ul id="menu-main-menu" class="menu menu-main">
                                            <li class=" current-menu-item page_item current_page_item"> <a
                                                    href="#tentang"><span>Tentang Pondok</span></a> </li>
                                            <li> <a href="#marhalah"><span>Marhalah/Jenjang</span></a>
                                            </li>
                                            <li> <a href="#kompetensi"><span>Kompetensi
                                                        Lulusan</span></a>
                                            </li>
                                            <li> <a href="#mekanisme"><span></span>Mekanisme
                                                    Pendaftaran</a> </li>
                                            <li> <a href="#kontak"><span>Kontak</span></a>
                                            </li>
                                        </ul>
                                    </nav><a class="responsive-menu-toggle" href="#"><i
                                            class="icon-menu-fine"></i></a>
                                </div> --}}
                            </div>
                            <div class="top_bar_right mt-5">
                                <div class="top_bar_right_wrapper"> <a href="{{ url('/pendaftaran') }}"
                                        class="action_button"> BERANDA</a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div id="Content">
            {{-- Marhalah --}}
            <div class="section" style="background-color:#3a4046; padding:20% 0">
                <div class="container">
                    <div class="row" style="margin:auto 5%">
                        <div class="col-md-6 border border-success pb-5">
                            <div class="column_attr clearfix mobile_align_center text-center" style="padding:0 5%;">
                                <img src="{{ asset('asset2/images/ra.png') }}" alt="" width="200px">
                                <div class="button_align align_center mt-5"> <a class="btn btn-success p-3"
                                        href="{{ $link['ra'] }}"><span class="button_label">PENDAFTARAN</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pb-5 border border-success">
                            <div class="column_attr clearfix mobile_align_center text-center" style="padding:0 5%;">
                                <img src="{{ asset('asset2/images/ula.png') }}" alt="" width="200px">
                                <div class="button_align align_center mt-5"> <a class="btn btn-success p-3"
                                        href="{{ $link['ula'] }}"><span class="button_label">PENDAFTARAN</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border border-success pb-5">
                            <div class="column_attr clearfix mobile_align_center text-center" style="padding:0 5%;">
                                <img src="{{ asset('asset2/images/wustha.png') }}" alt="" width="200px">
                                <div class="button_align align_center mt-5 d-block"> <a class="btn btn-success p-3"
                                        href="{{ $link['putra'] }}"><span class="button_label">PENDAFTARAN
                                            PUTRA</span></a>
                                </div>
                                <div class="button_align align_center mt-5"> <a class="btn btn-success p-3"
                                        href="{{ $link['putri'] }}"><span class="button_label">PENDAFTARAN
                                            PUTRI</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border border-success pb-5">
                            <div class="column_attr clearfix mobile_align_center text-center" style="padding:0 5%;">
                                <img src="{{ asset('asset2/images/ulya.png') }}" alt="" width="200px">
                                <div class="button_align align_center mt-5"> <a class="btn btn-success p-3"
                                        href="{{ $link['putra'] }}"><span class="button_label">PENDAFTARAN
                                            PUTRA</span></a>
                                </div>
                                <div class="button_align align_center mt-5"> <a class="btn btn-success p-3"
                                        href="{{ $link['putri'] }}"><span class="button_label">PENDAFTARAN
                                            PUTRI</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <footer id="Footer" class="clearfix">
            <div class="footer_copy">
                <div class="container">
                    <div class="column one">
                        <div class="copyright"> &copy; 2023 - Pendidikan Kesetaraan Pondok Pesantren Salafiyah Alqosim
                            Jambi </div>
                    </div>
                </div>
            </div>
        </footer> --}}
    </div>
    <div id="body_overlay"></div>
    <!-- JS -->
    <script src="{{ asset('asset2/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('asset2/js/jquery-migrate-3.4.0.min.js') }}""></script>
    <script src="{{ asset('asset2/js/mfn.menu.js') }}"></script>
    <script src="{{ asset('asset2/js/jquery.plugins.js') }}"></script>
    <script src="{{ asset('asset2/js/jquery.jplayer.min.js') }}"></script>
    <script src="{{ asset('asset2/js/animations/animations.js') }}"></script>
    <script src="{{ asset('asset2/js/translate3d.js') }}"></script>
    <script src="{{ asset('asset2/js/scripts.js') }}"></script>
    <script src="{{ asset('asset2/plugins/rs-plugin-6.custom/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('asset2/plugins/rs-plugin-6.custom/js/rs6.min.js') }}"></script>
    <script type="text/javascript">
        var revapi1, tpj;

        function revinit_revslider11() {
            jQuery(function() {
                tpj = jQuery;
                revapi1 = tpj("#rev_slider_1_1");
                if (revapi1 == undefined || revapi1.revolution == undefined) {
                    revslider_showDoubleJqueryError("rev_slider_1_1");
                } else {
                    revapi1.revolution({
                        sliderType: "hero",
                        sliderLayout: "fullwidth",
                        visibilityLevels: "1240,1240,778,778",
                        gridwidth: "1240,1240,778,778",
                        gridheight: "820,820,750,750",
                        spinner: "spinner8",
                        perspective: 600,
                        perspectiveType: "local",
                        spinnerclr: "#5aac4e",
                        editorheight: "820,768,750,720",
                        responsiveLevels: "1240,1240,778,778",
                        progressBar: {
                            disableProgressBar: true
                        },
                        navigation: {
                            onHoverStop: false
                        },
                        fallbacks: {
                            allowHTML5AutoPlayOnAndroid: true
                        },
                    });
                }
            });
        } // End of RevInitScript
        var once_revslider11 = false;
        if (document.readyState === "loading") {
            document.addEventListener('readystatechange', function() {
                if ((document.readyState === "interactive" || document.readyState === "complete") && !
                    once_revslider11) {
                    once_revslider11 = true;
                    revinit_revslider11();
                }
            });
        } else {
            once_revslider11 = true;
            revinit_revslider11();
        }
    </script>
</body>

</html>
