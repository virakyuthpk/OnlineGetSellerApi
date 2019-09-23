
<section class="footer-bottom ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 copyright-w">
                <div class="copyright">© 2018 Onlineget. All Rights Reserved.
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 payment-w">
                <?php if(!$payment->isEmpty()): ?>
                    <?php $__currentLoopData = $payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img class="divle payway" src="<?php echo asset('uploads/payment/'.$pay->image); ?>" alt="Pay ment method">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                        
            </div>
        </div>
    </div>
</section>