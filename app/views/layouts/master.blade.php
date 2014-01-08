<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png" />

    @section('meta_description')
      <meta name="description" content="A repository of useful code snippets for Laravel framework">
    @show

    @section('meta_author')
      <meta name="author" content="John Kevin M. Basco">
    @show

    <!-- <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png"> -->

    @section('title')
      <title>LaravelSnippets.com</title>
    @show

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('packages/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- FontAwesome core CSS -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Code mirror css -->
    <link rel="stylesheet" href="{{ asset('packages/codemirror-3.19/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/codemirror-3.19/theme/monokai.css') }}">

    <!-- Google code prettify css -->
    <link rel="stylesheet" href="{{ asset('packages/google-code-prettify/prettify.css') }}">

    <!-- Chosen.js css -->
    <link rel="stylesheet" href="{{ asset('packages/chosen_v1.0.0/chosen.min.css') }}">

    <!-- jquery file upload -->
    <link rel="stylesheet" href="{{ asset('packages/jquery-file-upload-8.9.0/css/jquery.fileupload.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/laravel-prettyprint.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Google analytics script -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-45609720-1', 'laravelsnippets.com');
      ga('send', 'pageview');
    </script>

  </head>

  <body>

    <div class="wrap">


      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Laravel Snippets</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Snippets <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('snippet.getIndex') }}">View all</a></li>
                  <li><a href="{{ route('member.snippet.getCreate') }}">Submit</a></li>
                </ul>
              </li>

              @if(Auth::check())
<!--                 <li>
                  <a href="#">Profile</a>
                </li> -->
                <li>
                  <a href="{{ route('member.user.dashboard') }}">Dashboard</a>
                </li>
              @endif

              <li>
                <a href="{{ route('user.getIndex') }}">Browse Members</a>
              </li>

              @if(Auth::check() && Auth::user()->isAdmin())
<!--                 <li>
                  <a href="#">All Snippets</a>
                </li> -->
              @endif

            </ul>

          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
              <li>
                <a href="{{ route('auth.getLogout') }}">Logout</a>
              </li>
            @else
              <li>
                <a href="{{ route('auth.getLogin') }}">Login</a>
              </li>
            @endif
          </ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>


      <div class="container">

        @if(Session::has('message'))
          <div class="alert alert-{{ Session::get('messageType', 'danger') }}">{{ Session::get('message') }}</div>
        @endif

        <div class="row">

          <div class="col-md-9 primary">
            @yield('content')
          </div>

          <div class="col-md-3 sidebar">

            <div class="tags">
              <h4>Tags:</h4>
              <ul class="tags-list">
                @foreach ($tags as $tag)
                  <li class="tag">
                    <a href="{{ route('tag.getShow', $tag->slug) }}">
                      <span class="label label-primary">{{ e($tag->name) }}</span>
                    </a>
                  </li>
                @endforeach
              </ul>
              <span class="clearfix"></span>
            </div>

            <h4>Get connected:</h4>
            <a href="https://twitter.com/laravelsnippets" target="_blank">@laravelsnippets on Twitter</a>
            <br>
            <a href="https://www.facebook.com/LaravelSnippets" target="_blank">laravelsnippets on Facebook</a>

          </div>

        </div>

      </div><!-- /.container -->
    </div>

    <div class="footer">
      <div class="container">
        <p class="text-muted credit">&copy; <a href="{{ route('home') }}">laravelsnippets.com</a> by <a href="https://twitter.com/johnkevinmbasco" target="_blank">John Kevin M. Basco</a> | <a href="http://mayonvolcanosoftware.com/" target="_blank">Mayon Volcano Software Ltd.</a></p>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/js/vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Codemirror javascript -->
    <script src="{{ asset('packages/codemirror-3.19/lib/codemirror.js') }}"></script>
    <script src="{{ asset('packages/codemirror-3.19/mode/clike/clike.js') }}"></script>
    <script src="{{ asset('packages/codemirror-3.19/mode/php/php.js') }}"></script>

    <!-- Google code prettify javascript -->
    <script src="{{ asset('packages/google-code-prettify/prettify.js') }}"></script>

    <!-- Chosen.js javascript -->
    <script src="{{ asset('packages/chosen_v1.0.0/chosen.jquery.min.js') }}"></script>

    <!-- backbone -->
    <script src="{{ asset('assets/js/vendors/json2/json2.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/underscore/1.5.2/underscore.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/backbone/1.1.0/backbone.js') }}"></script>


    <!-- jquery file upload -->
    <script src="{{ asset('packages/jquery-file-upload-8.9.0/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('packages/jquery-file-upload-8.9.0/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('packages/jquery-file-upload-8.9.0/js/jquery.fileupload.js') }}"></script>

    <!-- App specific javascript -->
    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/user.js') }}"></script>
    <script src="{{ asset('assets/js/snippet.js') }}"></script>

    <!--ShareThis Plugin-->
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">
      stLight.options({
        publisher: "b1eb8f86-ebb5-408b-9cb8-0a08b830b3c7",
        doNotHash: false,
        doNotCopy: false,
        hashAddressBar: false
      });
    </script>

    @section('scripts')
    @show

  </body>
</html>
