<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie9 no-focus" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-focus" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<title>@yield('title')</title>
	
	<meta name="description"
	      content="OneUI - Admin Dashboard Template &amp; UI Framework created by pixelcave and published on Themeforest">
	<meta name="author" content="pixelcave">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<!-- Icons -->
	<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
	@include('partials.header_css')
</head>
<body>
<!-- Page Container -->
<!--
	Available Classes:

	'enable-cookies'             Remembers active color theme between pages (when set through color theme list)

	'sidebar-l'                  Left Sidebar and right Side Overlay
	'sidebar-r'                  Right Sidebar and left Side Overlay
	'sidebar-mini'               Mini hoverable Sidebar (> 991px)
	'sidebar-o'                  Visible Sidebar by default (> 991px)
	'sidebar-o-xs'               Visible Sidebar by default (< 992px)

	'side-overlay-hover'         Hoverable Side Overlay (> 991px)
	'side-overlay-o'             Visible Side Overlay by default (> 991px)

	'side-scroll'                Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (> 991px)

	'header-navbar-fixed'        Enables fixed header
	'header-navbar-transparent'  Enables a transparent header (if also fixed, it will get a solid dark background color on scrolling)
-->
<div id="page-container" class="side-scroll header-navbar-fixed header-navbar-transparent">
	
	<!-- Header -->
@include('partials.header')
<!-- END Header -->
	
	<!-- Main Container -->
	<main id="main-container">
		<!-- Hero Content -->
		<div class="bg-image" style="background-image: url('assets/img/photos/photo3@2x.jpg');">
			<div class="bg-primary-dark-op">
				<section class="content content-full content-boxed overflow-hidden">
					<!-- Section Content -->
					<div class="push-30-t push-30 text-center">
						<h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear"
						    data-class="animated fadeInDown"><i
									class="fa fa-suitcase text-white-op"></i> @yield('header')
						</h1>
						<h2 class="h5 text-white-op visibility-hidden" data-toggle="appear"
						    data-class="animated fadeInDown">@yield('first_message')</h2>
					</div>
					<!-- END Section Content -->
				</section>
			</div>
		</div>
		<!-- END Hero Content -->
		
		<!-- Lessons -->
		<section class="content content-boxed overflow-hidden">
			<div class="row">
				<div class="col-md-12">
					<!-- Lesson -->
					@section('content')
						<div class="block block-rounded">
							<div class="block-content">
								<h3 class="push">1.1 HTML5 Intro (free preview)</h3>
								<p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad
									feugiat
									magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante
									urna
									molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus,
									libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur
									consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque
									etiam
									egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer
									luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum
									lorem, inceptos nibh orci.</p>
								
								<p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad
									feugiat
									magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante
									urna
									molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus,
									libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur
									consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque
									etiam
									egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer
									luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum
									lorem, inceptos nibh orci.</p>
								<div class="alert alert-warning font-w600 text-center">
									<i class="fa fa-warning"></i> This is an attention message.
								</div>
								<p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad
									feugiat
									magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante
									urna
									molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus,
									libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur
									consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque
									etiam
									egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer
									luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum
									lorem, inceptos nibh orci.</p>
								
								<p class="font-w600">Things to do:</p>
								<ul class="fa-ul list-simple-mini push">
									<li>
										<i class="fa fa-check fa-li text-success"></i>
										Make sure you are always closing your tags.
									</li>
									<li>
										<i class="fa fa-check fa-li text-success"></i>
										Keep writing markup to become more familiar.
									</li>
									<li>
										<i class="fa fa-check fa-li text-success"></i>
										Create your own projects.
									</li>
								</ul>
								<p class="alert alert-success font-w600 text-center">
									<i class="fa fa-thumbs-up"></i> Congrats! Let's head up to the next lesson.
								</p>
							</div>
						</div>
				@show
				<!-- END Lesson -->
				</div>
			</div>
			<!-- END Section Content -->
		</section>
		<!-- END Lessons -->
	
	</main>
	<!-- END Main Container -->
	
	<!-- Footer -->
@include('partials.footer')
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
@include('partials.script')

<!-- Page JS Code -->
<script>
    jQuery(function () {
        // Init page helpers (Appear + CountTo plugins)
        App.initHelpers(['appear', 'appear-countTo']);
    });
</script>
</body>
</html>

