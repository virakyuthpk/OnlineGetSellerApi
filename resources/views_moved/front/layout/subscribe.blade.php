<section class="footer-top">
    <div class="container ftop">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 ">
                <div class="module newsletter-footer1">
                    <div class="newsletter">
                        @if(!$payment->isEmpty())
                            @foreach($payment as $pay)
                            <div class="col-md-2 col-xs-6">
                                <img class="divle" src="{!!asset('uploads/payment/'.$pay->image)!!}" alt="About Us">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 ">
                <div class="module newsletter-footer1">
                    <div class="newsletter">
                        <ul class="socials">
                            <li class="facebook"><a class="_blank" href="https://www.facebook.com/gechchouonline/" target="_blank"><img class="" src="{!!asset('front/image/if_facebook_386622.png') !!}" alt="Facebook"><!--<i class="fa fa-facebook"></i>--><span>Facebook</span></a></li>
                            <li class="twitter"><a class="_blank" href="#" target="_blank"><!--<i class="fa fa-twitter"></i>--><img class="" src="{!!asset('front/image/if_twitter_252077.png') !!}" alt="Twitter"><span>Twitter</span></a></li>
                            <li class="google_plus"><a class="_blank" href="#" target="_blank"><img class="" src="{!!asset('front/image/if_google_plus_386644.png') !!}" alt="Google"><!--<i class="fa fa-google-plus"></i>--><span>Google Plus</span></a></li>
                            <li class="youtube"><a class="_blank" href="#" target="_blank"><img class="" src="{!!asset('front/image/if_youtube2_252069.png') !!}" alt="Youtube"><!--<i class="fa fa-youtube-square" aria-hidden="true"></i>--><span>Youtube</span></a></li> 
                           <li class="line"><a class="_blank" href="#" target="_blank"><img class="" src="{!!asset('front/image/if_line_986949.png') !!}" alt="Line"><!--<i class="fa fa-comment-o" aria-hidden="true"></i>--><span>Line</span></a></li> 
                        </ul>
                        
                    </div>
                    
                </div>
            </div>
            <div class="module newsletter-footer1 col-md-6 pull-right">
                <div class="newsletter">
                    <div class="sub block_content pull-right">
                        <form method="post" class="form-group form-inline signup send-mail">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="input-box">
                                    <input type="email" placeholder="Your email address..."  class="form-control" id="txtemail" name="email" size="55" required="">
                                </div>
                                <div class="subcribe">
                                    <button class="btn btn-primary btn-default font-title subscribeEmail" type="button"  name="submit">
                                    Subscribe
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>