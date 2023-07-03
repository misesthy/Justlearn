<x-app-layout>
    <x-slot name="header">
        {{ __('Knowledge') }}
    </x-slot>

    <div class="site-hero clearfix">
        <div id="header-search" class="site-search clearfix">
            <!-- #header-search -->
            <form action="" method="get" class="search-form" role="search">
                <div class="form-border" style="border-radius: 0.9rem;">

                    <div class="form-inline">
                        <div class="form-group input-group" style="width: 100%;">
                            <input type="text" name="s" class="search-field form-control input-lg mr-3"
                                title="Enter search term"
                                placeholder="Have a question? Type your search term here..." />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-custom "
                                    style="border-radius: 0.9rem;">Search</button>
                            </span>
                        </div>

                    </div>

                    <div class="search-advance">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="#" class="col-sm-3 control-label">Category</label>
                                        <div class="col-sm-9">
                                            <select name="category" class="form-control">
                                                <option value="">-- All Categories --</option>
                                                <option value="">Account Settings</option>
                                                <option value="">API Questions</option>
                                                <option value="">Customization</option>
                                                <option value="">Mobile Apps</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="#" class="col-sm-3 control-label">Format</label>
                                        <div class="col-sm-9">
                                            <select name="format" class="form-control">
                                                <option value="">-- All Formats --</option>
                                                <option value="">Text</option>
                                                <option value="">Image</option>
                                                <option value="">Video</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- .search-advance -->

                    <a href="#" class="search-advance-button text-center"><i
                            class="fa fa-chevron-circle-up fa-2x"></i></a>

                </div>
            </form>
        </div><!-- #header-search -->
       
        <ol class="breadcrumb breadcrumb-custom">
                <li class="text">You are here:</li>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-chevron-right"></i>
                        Mobile Apps
                    </a>
                </li>
                <li class="active">
                    <i class="fas fa-chevron-right"></i>
                    How To Download Our iPad App
                </li>
            </ol>
        
    </div>
    <!-- .site-hero -->
    <div id="main" class="site-main clearfix">
        <div class="container">
            <div class="content-area">
                <div class="row">
                    <div id="content" class="site-content col-md-9">
                        <article class="hentry">
                            <header class="entry-header">
                                <h1 class="entry-title">How To Download Our iPad App</h1>
                                <div class="entry-meta text-muted">
                                    <span class="date">
                                        <i class="fa fa-film fa-fw"></i>
                                        <time datetime="2013-09-19T20:01:58+00:00">September 19, 2013 at 8:01 pm</time>
                                    </span>
                                    <span class="category">
                                        <i class="far fa-folder-open fa-fw"></i>
                                        <a href="#">Mobile Apps</a>
                                    </span>
                                </div>
                                <!-- .entry-meta -->
                            </header>
                            <!-- .entry-header -->
                            <div class="entry-content clearfix">
                                <div class="video-frame">
                                    <object width="560" height="315">
                                        <param name="movie" value="https://www.youtube.com/embed/rg_zwK_sSEY">
                                        <param name="allowFullScreen" value="true">
                                        <param name="allowscriptaccess" value="always">
                                        <embed
                                            src="https://www.youtube.com/embed/rg_zwK_sSEY"
                                            type="application/x-shockwave-flash"
                                            width="560"
                                            height="315"
                                            allowscriptaccess="always"
                                            allowfullscreen="true"
                                        >
                                    </object>
                                </div>
                                <p>Nulla bibendum vel ipsum ut suscipit. Nunc eu massa quis odio sollicitudin feugiat. Maecenas sit amet nunc nec urna placerat convallis at sit amet sem. Aenean luctus, eros vitae lobortis aliquet, purus dui rutrum libero, quis scelerisque est ipsum ut dui. Donec ligula velit, tincidunt et nisi quis, porta varius augue. Morbi volutpat fringilla velit.</p>
                                <p>Donec dapibus consectetur tempor. In tincidunt in purus sagittis suscipit. Aenean sit amet lorem turpis. Aliquam enim justo, laoreet in pharetra eu, semper at neque. Nunc posuere ipsum nulla, quis commodo urna laoreet nec. Sed lectus nunc, placerat ut dignissim ut, dictum sodales lacus. Duis blandit volutpat sapien a dapibus. Suspendisse tincidunt imperdiet nibh mollis malesuada.</p>
                                <p>Phasellus feugiat lobortis libero quis laoreet. Quisque ac fringilla purus. Integer eleifend, arcu eu egestas vestibulum, libero magna rhoncus magna, id pellentesque diam ante rutrum arcu. In hac habitasse platea dictumst. In vestibulum turpis nunc.</p>
                            </div>
                            <!-- .entry-content -->
                        </article>
                        <!-- .hentry -->
                    </div>
                    <!-- #content -->
                    <div id="sidebar" class="site-sidebar col-md-3">
                        <div class="widget-area">
                            <section id="section-banner" class="section">
                                <div class="banner-wrapper text-center clearfix">
                                    <h3 class="banner-title text-danger h4">Support Policy</h3>
                                    <div class="banner-content">
                                        <p>Praesent neque nibh, vulputate id bibendum et, lacinia vel mi. Ut elementum nisi et congue facilisis. Praesent suscipit nulla eu lorem dictum, a ultricies orci pretium.</p>
                                    </div>
                                </div>
                            </section>
                            <!-- #section-banner -->
                            <section id="section-categories" class="section">
                                <h2 class="section-title h4 clearfix">Categories</h2>
                                <ul class="nav nav-pills nav-stacked nav-categories">
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">6</span>
                                            Account Settings
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">5</span>
                                            API Questions
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">3</span>
                                            Customization
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">11</span>
                                            Mobile Apps
                                        </a>
                                    </li>
                                </ul>
                            </section>
                            <!-- #section-categories -->
                            <section id="section-tags" class="section">
                                <h2 class="section-title h4 clearfix">Tags</h2>
                                <div class="tagcloud">
                                    <a href="#" class="btn btn-tag btn-sm">basic</a>
                                    <a href="#" class="btn btn-tag btn-sm">beginner</a>
                                    <a href="#" class="btn btn-tag btn-sm">blogging</a>
                                    <a href="#" class="btn btn-tag btn-sm">colour</a>
                                    <a href="#" class="btn btn-tag btn-sm">css</a>
                                    <a href="#" class="btn btn-tag btn-sm">date</a>
                                    <a href="#" class="btn btn-tag btn-sm">design</a>
                                    <a href="#" class="btn btn-tag btn-sm">files</a>
                                    <a href="#" class="btn btn-tag btn-sm">format</a>
                                    <a href="#" class="btn btn-tag btn-sm">header</a>
                                    <a href="#" class="btn btn-tag btn-sm">images</a>
                                    <a href="#" class="btn btn-tag btn-sm">plugins</a>
                                    <a href="#" class="btn btn-tag btn-sm">setting</a>
                                    <a href="#" class="btn btn-tag btn-sm">templates</a>
                                </div>
                            </section>
                            <!-- #section-tags -->
                        </div>
                    </div>
                    <!-- #sidebar -->
                </div>
            </div>
            <!-- .content-area -->
        </div>
    </div>
    <!-- #main -->

    <!-- Script -->
	<script type="text/javascript" src="assets/app/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/app/js/superfish.js"></script>
	<script type="text/javascript" src="assets/app/js/jquery.mobilemenu.js"></script>
	<script type="text/javascript" src="assets/app/js/autocomplete.js"></script>
	<script type="text/javascript" src="assets/app/js/app.js"></script>

    <!-- Styles -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="assets/font-awesome/css/all.min.css" type="text/css" />
	<link rel="stylesheet" href="assets/app/css/app.css" type="text/css" />
	<link rel="stylesheet" href="assets/app/css/edit.css" type="text/css" />

</x-app-layout>
