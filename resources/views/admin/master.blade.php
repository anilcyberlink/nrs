<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> {{ config('app.name', '') }} - @yield('title') </title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="Cyberlink">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="<?= url('/') ?>" />
  <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600'>
  @yield('additional-css')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme2.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme3.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-tools/admin-forms/css/admin-forms.css') }}">
  <link rel="shortcut icon" href="{{asset('themes-assets/images/favicon.png')}}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
 <script>
   var editor_config = {
     path_absolute: "/",
     selector: 'textarea.my-editor',
     relative_urls: false,
     plugins: 'code table lists advlist charmap emoticons fullscreen hr image insertdatetime link media nonbreaking pagebreak paste preview print searchreplace spellchecker tabfocus toc visualblocks visualchars wordcount fontfamily fontsize style',
     toolbar: 'undo redo | blocks | bold italic underline removeformat | fontfamily fontsize style | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | link unlink image media code hr | table fullscreen insertdatetime',
     toolbar_mode: 'sliding',
     force_br_newlines: false,
     force_p_newlines: false,
     forced_root_block: '',
     cleanup: true,
     remove_linebreaks: true,
     convert_newlines_to_brs: false,
     inline_styles: false,
     entity_encoding: 'raw',
     paste_auto_cleanup_on_paste: true,
     entities: '160,nbsp,38,amp,60,lt,62,gt',

     file_picker_callback: function (callback, value, meta) {
       var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
         'body')[0].clientWidth;
       var y = window.innerHeight || document.documentElement.clientHeight || document
         .getElementsByTagName('body')[0].clientHeight;

       var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
       if (meta.filetype == 'image') {
         cmsURL = cmsURL + "&type=Images";
       } else {
         cmsURL = cmsURL + "&type=Files";
       }
   
       tinyMCE.activeEditor.windowManager.openUrl({
         url: cmsURL,
         title: 'Filemanager',
         width: x * 0.8,
         height: y * 0.8,
         resizable: "yes",
         close_previous: "no",
         onMessage: (api, message) => {
           callback(message.content);
         }
       });
     }
   };

   tinymce.init(editor_config);
 </script>
 <style>
   .tox-editor-container .tox-promotion{
     visibility: hidden!important;
   }
 </style>
</head>
  <body class="dashboard-page sb-l-o sb-r-c">
  <!-- Start: Main -->
  <div id="main">

   <!-- Start: Header -->
    <header class="navbar navbar-fixed-top">
      <div class="navbar-branding">
        <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
         Admin Panel
        </a>
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="avoid:javascript;" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="{{ asset(env('PUBLIC_PATH') . 'assets/img/avatars/1.png') }}" alt="avatar" class="mw30 br64 mr15">

         {{ Auth::user()->name }}

            <span class="caret caret-tp hidden-xs"></span>
          </a>
          <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
          <li><a href="{{ route('admin.userprofile') }}">User Profile</a></li>
          <li><a href="{{ route('admin.changepassword') }}">Change Password </a></li>
                        @guest
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else

                    <li class="dropdown-footer">
                        <a class="animated animated-short fadeInUp" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                             <span class="fa fa-power-off pr5"></span>


                                                {{ __('Logout') }}
                                            </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           {{ csrf_field() }}
                        </form>

                    </li>
            @endguest

          </ul>
        </li>
      </ul>
    </header>

    <!-- Start: Sidebar Left -->
    @include('admin.common.sidebar')

    <section id="content_wrapper">

      <!-- End: Topbar-Dropdown -->
      <!-- Start: Topbar -->
     {{-- @include('admin.common.breadcrumb') --}}
      <!-- End: Topbar -->
      <header id="topbar">
        <div class="topbar-left">
        </div>
        <div class="topbar-right">
        @yield('breadcrumb')
        </div>
        </header>
        <!-- Begin: Content -->
        <section id="content" class="animated fadeIn">
        <!-- // -->

        <!-- Admin-panels -->
        @include('admin.common.message')
        @yield('content')
        <!-- <div class="admin-panels fade-onload">
          <div class="row">
         </div>
        </div>  -->

      <!-- Begin: Page Footer -->

       <!-- <footer id="content-footer">
        <div class="row">
          <div class="col-md-6">
            <span class="footer-legal">
              &copy; <?php
                //echo date('Y');
                ?>
              Cyberlink Pvt. Ltd. </span>
          </div>
          <div class="col-md-6 text-right">
            <span class="footer-meta"></span>
            <a href="#content" class="footer-return-top">
              <span class="fa fa-arrow-up"></span>
            </a>
          </div>
        </div>
      </footer>  -->

      <!-- End: Page Footer -->
      </section>

    </section>
    <!-- End: Content-Wrapper -->

    <!-- Start: Right Sidebar -->
  </div>
  <!-- End: Main -->

  <!-- BEGIN: PAGE SCRIPTS -->

  <!-- jQuery -->
   <script src="{{ asset('vendor/jquery/jquery-1.11.1.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>


  <!-- HighCharts Plugin -->
  <script src="{{ asset('vendor/plugins/highcharts/highcharts.js') }}"></script>

  <!-- Sparklines Plugin -->
  <script src="{{ asset('vendor/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

  <!-- Simple Circles Plugin -->
  <script src="{{ asset('vendor/plugins/circles/circles.js') }}"></script>

  <!-- JvectorMap Plugin + US Map (more maps in plugin/assets folder) -->
  <script src="{{ asset('vendor/plugins/jvectormap/jquery.jvectormap.min.js') }}"></script>
  <script src="{{ asset('vendor/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js') }}"></script>
  @yield('libraries')

  <!-- Theme Javascript -->
  <script src="{{ asset('assets/js/utility/utility.js') }}"></script>
  <script src="{{ asset('assets/js/demo/demo.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Widget Javascript -->
  <script src="{{ asset('assets/js/demo/widgets.js') }}"></script>

@yield('scripts')
<script src=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- <script src="https://cdn.tiny.cloud/1/yz9djrr6u186lz8f77akzbcbzsutx4f2iasfz5ble210nis1/tinymce/5/tinymce.min.js"-->
<!--        referrerpolicy="origin"></script>-->
<!--<script src="{{ asset('tinymce/init-tinymce.js') }}"></script>-->
<script>
$(document).ready(function(){
$(".category-search").on("keyup", function() {
var value = $(this).val().toLowerCase();
$(".category-list li").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});


$(document).ready(function(){
$(".category-search1").on("keyup", function() {
var value = $(this).val().toLowerCase();
$(".category-list1 li").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});

</script>

     <script src="https://www.google.com/recaptcha/api.js?render={{ env('SITE_KEY') }}"></script>
    <script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo env('SITE_KEY'); ?>', {
            action: 'homepage'
        }).then(function(token) {
            document.getElementById('g_recaptcha_response').value = token;
        });
    });
    </script>

  <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core
    Core.init();

     // Init Admin Panels on widgets inside the ".admin-panels" container
    $('.admin-panels').adminpanel({
      grid: '.admin-grid',
      draggable: true,
      preserveGrid: true,
      mobile: false,
      onStart: function() {
        // Do something before AdminPanels runs
      },
      onFinish: function() {
        $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

        // Init the rest of the plugins now that the panels
        // have had a chance to be moved and organized.
        // It's less taxing to organize empty panels
        demoHighCharts.init();
        runVectorMaps(); // function below
      },
      onSave: function() {
        $(window).trigger('resize');
      }
    });

    // Widget VectorMap
    function runVectorMaps() {

      // Jvector Map Plugin
      var runJvectorMap = function() {
        // Data set
        var mapData = [900, 700, 350, 500];
        // Init Jvector Map
        $('#WidgetMap').vectorMap({
          map: 'us_lcc_en',
          //regionsSelectable: true,
          backgroundColor: 'transparent',
          series: {
            markers: [{
              attribute: 'r',
              scale: [3, 7],
              values: mapData
            }]
          },
          regionStyle: {
            initial: {
              fill: '#E5E5E5'
            },
            hover: {
              "fill-opacity": 0.3
            }
          },
          markers: [{
            latLng: [37.78, -122.41],
            name: 'San Francisco,CA'
          }, {
            latLng: [36.73, -103.98],
            name: 'Texas,TX'
          }, {
            latLng: [38.62, -90.19],
            name: 'St. Louis,MO'
          }, {
            latLng: [40.67, -73.94],
            name: 'New York City,NY'
          }],
          markerStyle: {
            initial: {
              fill: '#a288d5',
              stroke: '#b49ae0',
              "fill-opacity": 1,
              "stroke-width": 10,
              "stroke-opacity": 0.3,
              r: 3
            },
            hover: {
              stroke: 'black',
              "stroke-width": 2
            },
            selected: {
              fill: 'blue'
            },
            selectedHover: {}
          },
        });
        // Manual code to alter the Vector map plugin to
        // allow for individual coloring of countries
        var states = ['US-CA', 'US-TX', 'US-MO',
          'US-NY'
        ];
        var colors = [bgWarningLr, bgPrimaryLr, bgInfoLr, bgAlertLr];
        var colors2 = [bgWarning, bgPrimary, bgInfo, bgAlert];
        $.each(states, function(i, e) {
          $("#WidgetMap path[data-code=" + e + "]").css({
            fill: colors[i]
          });
        });
        $('#WidgetMap').find('.jvectormap-marker')
          .each(function(i, e) {
            $(e).css({
              fill: colors2[i],
              stroke: colors2[i]
            });
          });
      }

      if ($('#WidgetMap').length) {
        runJvectorMap();
      }
    }

  });

  // Date picker for tender form
  $( function() {
    // $( "#datepicker1" ).datepicker({dateFormat:'dd-mm-yy'});
    // $( "#datepicker2" ).datepicker({dateFormat:'dd-mm-yy'});
  } );
</script>
<script type="text/javascript">
$("#individual").click(function() {
    $("#group-entry").hide();
     $("#group-event").hide();
     $("#individual_category").show();
});
$("#group").click(function() {
    $("#group-event").show();
    $("#group-entry").show();
    $("#individual_category").hide();
});

// $('input[name=event]').change(function (e) {
//  $('#group_size').val(2);
// $('#group_size').val(4);
// })

$('#corporate').click(function() {
    //    $('#group_size').val();
   $('#group_size').val(4);
   $('#group_size').attr({
    "readonly" : true
   });
                 
});

$('#family').click(function() {
    $('.family_size').val(2);
        $(".family_size").attr({
       "max" : 4,        // substitute your own
       "min" : 2,          // values (or variables) here
        "readonly" : false
    });
                 
});
    </script>
  <!-- END: PAGE SCRIPTS -->
</body>
</html>
