@extends('web.template')

@section('content')

<!-- Page Banner -->
<div class="page-banner blog-post-banner container-fluid no-padding">
    <!-- Container -->
    <div class="container">
        <h3>{{$data['dataPages'][0]->profil_nama}}</h3>

        <ol class="breadcrumb">
            <li><a href="#">home</a></li>
            <li class="active">Blog Single</li>
        </ol>
    </div><!-- Container /- -->
    <!-- Shape -->
    <div class="banner-shape container-fluid no-padding">
        <div class="col-md-6 col-sm-6 col-xs-6 shape-left no-padding">
            <div class="left-shape-blue">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon2" clipPathUnits="objectBoundingBox">
                        <polygon points="0 0, 0 100, 120 100, 0 0"></polygon>
                    </clipPath>
                </svg>
            </div>
            <div class="left-shape">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon1" clipPathUnits="objectBoundingBox">
                        <polygon points="0 0, 0 100, 100 100, 0 0"></polygon>
                    </clipPath>
                </svg>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 shape-right no-padding">
            <div class="right-shape-blue">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon3" clipPathUnits="objectBoundingBox">
                        <polygon points="1 0.2, 0 1, 0 0.835, 1 0"></polygon>
                    </clipPath>
                </svg>
            </div>
            <div class="right-shape">
                <svg width="100%" height="100%">
                    <clipPath id="clipPolygon4" clipPathUnits="objectBoundingBox">
                        <polygon points="1 0, 0 1, 100 100, 100 0"></polygon>
                    </clipPath>
                </svg>
            </div>
        </div>
    </div><!-- Shape -->
</div><!-- Page Banner /- -->

<!-- Page Content -->
<div class="container-fluid no-padding page-content">
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Blog Area -->
            <div class="col-md-9 col-sm-8 col-xs-12 blog-area">
                <article class="blog-post-list single-post col-md-12 col-sm-12 col-xs-12">
                    <div class="entry-header">
                        <div class="entry-cover">
                            <img src="{{asset('template-web/images/blog-2.jpg')}}" alt="blog-1" />
                        </div>
                    </div>
                    <div class="entry-content" style="color:#fff !important">
                        <div class="entry-meta">
                            <a href="#"><i class="fa fa-comment-o"></i>Comments<span>(18)</span></a>
                            <a href="#"><i class="fa fa-heart-o"></i>Favorite<span>(33)</span></a>
                            <a href="#"><i class="fa fa-share-alt"></i>Share Post<span>(12)</span></a>
                        </div>
                        <h3 class="entry-title">Varying walking speed may burn more calories</h3>
                        <div class="post-meta">
                            <a href="#" title="25th sep 2015" class="post-date">25th sep 2015</a> by
                            <a href="#" title="Mathov" class="post-admin">Mathov</a> in Hospital
                        </div>
                        <div class="content">
                            {{!! $data['dataPages'][0]->profil_isi !!}}
                        </div>
                    </div>
                </article>
                <!-- About Author -->
                <div class="col-md-12">
                    <div class="about-author">
                        <div class="author-img">
                            <a title="Evans Corner" href="#"><img src="images/author.jpg" alt="author"></a>
                        </div>
                        <div class="author-content">
                            <a href="#">Evans Corner</a>
                            <p>On your mark get set and go now. Got a dream and we just know now we're gonna make our
                                dream come true. Doin' it our way. Nothin's gonna turn us back now. Straight ahead and
                                on the track now. We're gonna make our dreams come true. </p>
                            <span class="author-socials">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </span>
                        </div>
                    </div>
                </div><!-- About Author /- -->
                <div class="col-md-12">
                    <!-- Comment Section -->
                    <div class="comment-section">
                        <h3 class="section-heading"><span>3</span>Comments</h3>
                        <ul class="media-list">
                            <li class="media">
                                <div class="media-left">
                                    <a title="Micheal " href="#"><img alt="comment" src="images/comment-1.jpg"></a>
                                </div>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading">
                                            <span>Micheal</span>
                                            <span class="comment-minute"><span>5</span>Min Ago</span>
                                        </h4>
                                        <p class="comment-content">Goodbye gray sky hello blue. There's nothing can hold
                                            me when I hold you. Feels so right it cant be wrong. Rockin' and rollin' all
                                            week long. Well the first thing you know ol' Jeds a millionaire. Kinfolk
                                            said Jed move away from there.</p>
                                        <div class="media-reply">
                                            <i class="fa fa-reply"></i>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                    <ul class="media-list media-even">
                                        <li class="media">
                                            <div class="media-left">
                                                <a title="Lucy" href="#"><img alt="comment"
                                                        src="images/comment-2.jpg"></a>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-content">
                                                    <h4 class="media-heading">
                                                        <span>Lucy</span>
                                                        <span class="comment-minute"><span>5</span>Min Ago</span>
                                                    </h4>
                                                    <p class="comment-content">Buck Rogers are blown out of their
                                                        trajectory into an orbit which freezes his life support systems
                                                        and returns Buck Rogev rs to Earth five-hundred years later. So
                                                        lets make the most of this beautiful day.</p>
                                                    <div class="media-reply">
                                                        <i class="fa fa-reply"></i>
                                                        <a href="#">Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left">
                                    <a title="Gusriso" href="#"><img alt="comment" src="images/comment-3.jpg"></a>
                                </div>
                                <div class="media-body">
                                    <div class="media-content">
                                        <h4 class="media-heading">
                                            <span>Gusriso</span>
                                            <span class="comment-minute"><span>5</span>Min Ago</span>
                                        </h4>
                                        <p class="comment-content">On your mark get set and go now. Got a dream and we
                                            just know now we're gonna make our dream come true. Doin' it our way.
                                            Nothin's gonna turn us back now. Straight ahead and on the track now. We're
                                            gonna make our dreams come true.</p>
                                        <div class="media-reply">
                                            <i class="fa fa-reply"></i>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- Leave Comment -->
                </div>
                <div class="col-md-12">
                    <div class="leave-comment">
                        <h3 class="section-heading">Leave Your Comment</h3>
                        <form class="comment-form">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" id="name" placeholder="Your Name" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="email" placeholder="E-Mail Address" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" placeholder="Phone" class="form-control">
                                </div>
                                <div class="col-md-6 col-sm-6 form-group">
                                    <input type="text" placeholder="Subject" class="form-control">
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea rows="7" placeholder="Your Comment" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="post" id="post" value="Post Your Comment">
                                </div>
                            </div>
                        </form>
                    </div><!-- Leave Comment /- -->
                </div>
            </div><!-- Blog Area /- -->

            <!-- Widget Area -->
            <div class="col-md-3 col-sm-4 col-xs-12 widget-area no-left-padding">
                <!-- Widget Search -->
                <aside class="widget widget-search">
                    <h3 class="widget-title">Search Blog</h3>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Here">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </aside><!-- Widget Search /- -->
                <!-- Widget Categories -->
                <aside class="widget widget-categories">
                    <h3 class="widget-title">Categories</h3>
                    <ul class="categories-type">
                        <li><a href="#" title="Ambulance">Ambulance<span>(10)</span></a></li>
                        <li><a href="#" title="Brain">Brain<span>(03)</span></a></li>
                        <li><a href="#" title="Cardinal">Cardinal<span>(12)</span></a></li>
                        <li><a href="#" title="Disease">Disease<span>(05)</span></a></li>
                        <li><a href="#" title="Illness">Illness <span>(02)</span></a></li>
                        <li><a href="#" title="Pain">Pain <span>(19)</span></a></li>
                        <li><a href="#" title="Weight">Weight <span>(08)</span></a></li>
                    </ul>
                </aside><!-- Categories /- -->
                <!-- Widget Social Media -->
                <aside class="widget widget-social-media">
                    <h3 class="widget-title">Social Media</h3>
                    <ul class="">
                        <li><a href="#" class="tw" title="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" class="fb" title="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" class="gp" title="google-plus"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" class="inst" title="instagram"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" class="ln" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" class="tm" title="tumblr"><i class="fa fa-tumblr"></i></a></li>
                    </ul>
                </aside><!-- Categories /- -->
                <!-- Widget Recent Post -->
                <aside class="widget wiget-recent-post">
                    <h3 class="widget-title">Recent Post</h3>
                    <div class="recent-post-box">
                        <div class="recent-img">
                            <a href="blog-post.html"><img src="images/recent-1.jpg" alt="recent-1" /></a>
                        </div>
                        <div class="recent-title">
                            <a href="blog-post.html">Were gonna pay a call on the Addams Family</a>
                            <a href="#"><span><i class="fa fa-calendar"></i>Aug 06, 2015</span></a>
                        </div>
                    </div>
                    <div class="recent-post-box">
                        <div class="recent-img">
                            <a href="blog-post.html"><img src="images/recent-2.jpg" alt="recent-1" /></a>
                        </div>
                        <div class="recent-title">
                            <a href="blog-post.html">So lets make the most of this beautiful day</a>
                            <a href="#"><span><i class="fa fa-calendar"></i>Sep 11, 2015</span></a>
                        </div>
                    </div>
                    <div class="recent-post-box">
                        <div class="recent-img">
                            <a href="blog-post.html"><img src="images/recent-3.jpg" alt="recent-1" /></a>
                        </div>
                        <div class="recent-title">
                            <a href="blog-post.html">We're gonna make our dreams come true.</a>
                            <a href="#"><span><i class="fa fa-calendar"></i>Nov 18, 2015</span></a>
                        </div>
                    </div>
                    <div class="recent-post-box">
                        <div class="recent-img">
                            <a href="blog-post.html"><img src="images/recent-4.jpg" alt="recent-1" /></a>
                        </div>
                        <div class="recent-title">
                            <a href="blog-post.html">New life and new civilizations to boldly go</a>
                            <a href="#"><span><i class="fa fa-calendar"></i>Dec 25, 2015</span></a>
                        </div>
                    </div>
                </aside><!-- Recent Post /- -->
                <!-- Widget Archives -->
                <aside class="widget widget-categories widget-archives">
                    <h3 class="widget-title">Archives</h3>
                    <ul class="categories-type archives-type">
                        <li><a href="#" title="October 2015">October 2015<span>(10)</span></a></li>
                        <li><a href="#" title="September 2015">September 2015<span>(03)</span></a></li>
                        <li><a href="#" title="Augest 2015">Augest 2015<span>(12)</span></a></li>
                        <li><a href="#" title="July 2015">July 2015<span>(05)</span></a></li>
                    </ul>
                </aside><!-- Archives /- -->
                <!-- Widget Tags -->
                <aside class="widget widget-tags">
                    <h3 class="widget-title">Tags</h3>
                    <div class="tags">
                        <a href="#" title="Amazing">Amazing</a>
                        <a href="#" title="Envato">Envato</a>
                        <a href="#" title="Themes">Themes</a>
                        <a href="#" title="Clean">Clean</a>
                        <a href="#" title="Responsiveness">Responsiveness</a>
                        <a href="#" title="SEO">SEO</a>
                        <a href="#" title="Mobile">Mobile</a>
                        <a href="#" title="IOS">Ios</a>
                        <a href="#" title="Flat">Flat</a>
                        <a href="#" title="Design">Design</a>
                    </div>
                </aside><!-- Widget Tags /- -->
            </div><!-- Widget Area /- -->
        </div><!-- Row /- -->
    </div><!-- Container /- -->
</div><!-- Page Content /- -->

@endsection