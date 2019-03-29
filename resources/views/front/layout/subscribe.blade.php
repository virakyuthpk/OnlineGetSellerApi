<section class="footer-top">
    <div class="container ftop">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 ">
                <div class="module newsletter-footer1">
                    <div class="newsletter" style="width:100%   ; background-color: #fff ; ">
                        <div class="title-block">
                            <div class="page-heading font-title">
                                {!!trans('menu.subscribe')!!}
                            </div>
                            <div class="promotext"> {!!trans('menu.shear')!!}</div>
                        </div>
                        <div class="block_content">
                            <form method="post" class="form-group form-inline signup send-mail">
                            {{csrf_field()}}
                                <div class="form-group">
                                    <div class="input-box">
                                        <input type="email" placeholder="Your email address..."  class="form-control" id="txtemail" name="email" size="55" required="">
                                    </div>
                                    <div class="subcribe">
                                       <button class="btn btn-primary btn-default font-title subscribeEmail" type="button"  name="submit">
                                    {!!trans('menu.btnsubscribe')!!}
                                    </button>
                                </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                <ul class="socials">
                     <li class="facebook"><a class="_blank" href="https://www.facebook.com/gechchouonline/" target="_blank"><img class="" src="{!!asset('front/image/if_facebook_386622.png') !!}" alt="Facebook"><!--<i class="fa fa-facebook"></i>--><span>Facebook</span></a></li>
                            <li class="twitter"><a class="_blank" href="#" target="_blank"><!--<i class="fa fa-twitter"></i>--><img class="" src="{!!asset('front/image/if_twitter_252077.png') !!}" alt="Twitter"><span>Twitter</span></a></li>
                            <li class="google_plus"><a class="_blank" href="#" target="_blank"><img class="" src="{!!asset('front/image/if_google_plus_386644.png') !!}" alt="Google"><!--<i class="fa fa-google-plus"></i>--><span>Google Plus</span></a></li>
                            <li class="youtube"><a class="_blank" href="#" target="_blank"><img class="" src="{!!asset('front/image/if_youtube2_252069.png') !!}" alt="Youtube"><!--<i class="fa fa-youtube-square" aria-hidden="true"></i>--><span>Youtube</span></a></li> 
                           <li class="line"><a class="_blank" href="#" target="_blank"><img class="" src="{!!asset('front/image/if_line_986949.png') !!}" alt="Line"><!--<i class="fa fa-comment-o" aria-hidden="true"></i>--><span>Line</span></a></li> 
                    <!--<li class="facebook"><a class="_blank" href="https://www.facebook.com/gechchouonline/" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
                    <li class="twitter"><a class="_blank" href="#" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                    <li class="google_plus"><a class="_blank" href="#" target="_blank"><i class="fa fa-google-plus"></i><span>Google Plus</span></a></li>
                    <li><a class="_blank" href="#" target="_blank"><i class="fa fa-linkedin"></i><span>Linkedin</span></a></li>-->
                </ul>
            </div>
        </div>
    </div>
</section>