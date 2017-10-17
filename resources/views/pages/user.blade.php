@extends('layouts.customer')
@section('title')
{{$title}}
@endsection

@section('headInput')
<link href="{{url('')}}/packages/kartik-rate/css/star-rating.css" media="all" rel="stylesheet" type="text/css" />

<!-- optionally if you need to use a theme, then include the theme CSS file as mentioned below -->
<link href="{{url('')}}/packages/kartik-rate/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />

<!-- important mandatory libraries -->
<script src="{{url('')}}/packages/kartik-rate/js/star-rating.js" type="text/javascript"></script>

<!-- optionally if you need to use a theme, then include the theme JS file as mentioned below -->
<script src="{{url('')}}/packages/kartik-rate/themes/krajee-svg/theme.js"></script>

<!-- optionally if you need translation for your language then include locale file as mentioned below -->
<!-- <script src="{{url('')}}/packages/kartik-rate/js/locales/<lang>.js"></script> -->
@endsection


@section('main class')
<main>
   <section class="spacer-20">
      <div class="container">
         <div class="row">
            @include('layouts.menu_user')
            <article class="col-sm-12 col-md-9">
               <div class="spacer-bottom-25">
                  <h3 class="no-margin-top text-uppercase spacer-10 text-center">
                     Thông tin cá nhân
                  </h3>
                  <section class="wrap internal-padding wrap-border action-box bg-white wrap-radius">
                     <div class="row clearfix">
                       <div class="col-sm-3 titlebar">
                         <div class="hgroup">
                           <h2 class="text-uppercase no-margin">Đơn hàng cuả tôi</h2>
                           <h3 class="no-margin">Xem và đánh giá đơn hàng gần đây</h3>
                         </div>
                         <div class="icon-box">
                           <img alt="orders" src="{{url('')}}/assets/images/icons/icon-my-order.png">
                         </div>
                       </div>
                       <div class="col-sm-9 listbar">
                         <div class="listbox">
                           <p>Đánh giá sản phẩm để xây dựng cộng đồng lương <br>Bạn có thể đánh giá chất lượng đơn hàng ngày 21/10/2017</p>
         <a class="btn btn-info btn-lg lg-2x" data-toggle="modal" data-target="#modal-rate"> Xem đơn hàng <i class="fa fa-angle-double-right"></i>
         </a>                </div>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                             <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingOne">
                                 <h4 class="panel-title">
                                   <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     <i class="fa fa-angle-down btn-link"></i> Chấm điểm
                                   </a>
                                 </h4>
                               </div>
                               <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                               <div class="modal-body">
                                        <div class="form-group">
                                          <!-- <label for="input-1" class="control-label">Chấm điểm:</label> -->
                                           <input id="input-4" name="input-4" type="number" class="rating rating-loading" data-show-clear="false" data-min="0" data-max="5" data-step="1">
                                        </div>
                                 </div>
                               </div>
                             </div>
                             <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingTwo">
                                 <h4 class="panel-title">
                                   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                     <i class="fa fa-angle-down btn-link"></i> Collapsible Group Item #2
                                   </a>
                                 </h4>
                               </div>
                               <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                 <div class="panel-body">
                                   Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                 </div>
                               </div>
                             </div>
                             <div class="panel panel-default">
                               <div class="panel-heading" role="tab" id="headingThree">
                                 <h4 class="panel-title">
                                   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                     <i class="fa fa-angle-down btn-link"></i> Collapsible Group Item #3
                                   </a>
                                 </h4>
                               </div>
                               <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                 <div class="panel-body">
                                   Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                 </div>
                               </div>
                             </div>
                           </div>
                       </div>
                     </div>
                   </section>
                  
               </div>
            </article>
         </div>
         
      </div>
   </section>
   @include('layouts.banner_bottom')
</main>
 <!-- Modal buy voucher -->
<div class="modal fade style-base-modal" id="modal-rate" tabindex="-1" role="dialog" aria-labelledby="modalBuyVoucher" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="inner-container">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
              <i class="fa fa-times"></i>
            </span>
          </button>
          <h4 class="modal-title" id="modalBuyVoucher">Đánh giá sản phẩm ngày 21/10/2017</h4>
        </div>
        <div class="modal-body">
          <p>
            Bạn có thể đánh giá sản phẩm mua trong vòng một tuần, kể từ ngày nhận được hàng.
          </p>

          <div class="form-group">
            <label for="input-1" class="control-label">Chấm điểm</label>
             <input id="input-4" name="input-4" type="number" class="rating rating-loading" data-show-clear="false" data-min="0" data-max="5" data-step="1">
          </div>
          <div class="form-group" id="next1">

          </div>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scrip_code')
<script type="text/javascript" src="{{url('')}}/assets/javascripts/vendor/dataTables/jquery.dataTables.min.js"></script>

<script type="text/javascript">
   initRatingStar();
   var rate = 0;
   function initRatingStar() {
      var $rate = $('input[type="number"]');
      $rate.rating({
         clearCaption: '',
         step: 1,
         starCaptions: {1: 'Rất kém', 2: 'Kém', 3: 'Được', 4: 'Tốt', 5: 'Đáng khen'},
         starCaptionClasses: {1: 'text-danger', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'}
         });
      };
$(document).on('ready', function () {
   $('.rating,.kv-gly-star,.kv-gly-heart,.kv-uni-star,.kv-uni-rook,.kv-fa,.kv-fa-heart,.kv-svg,.kv-svg-heart').on(
                'change', function () {
                    rate = $(this).val();
                    next1();
                });
    });

function next1() {
   $('#next1').html('aaaa');
}
</script>

@endsection