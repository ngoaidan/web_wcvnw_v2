@extends('layouts.customer')
@section('title')
{{$title}}
@endsection
@section('main class')
<main>
<!-- Modal advertising -->
   <section class="spacer-20">
      <div class="container">
         <div class="row">
            <aside class="col-md-3">
               <div class="block block-nav">
                  <div class="title">
                     <h4 class="text-uppercase no-margin">Thông Tin</h4>
                  </div>
                  <div class="content">
                     <dl class="list-unstyled">
                        <dt>
                           <strong>
                           <i class="fa fa-angle-down"></i> Tìm hiểu WeCareVN
                           </strong>
                        </dt>
                        @foreach($about_pages as $item)
                        <dd>
                           <a class="{{ Request::is($item->slug) ? 'current' : '' }}" href="{{$item->slug}}">          <i class="fa fa-angle-right"></i> {{$item->name}}
                           </a>      
                        </dd>
                        @endforeach
                        
                        <!-- <dd>
                           <a class="current" href="terms-conditions.html">          <i class="fa fa-angle-right"></i> Terms and Conditions
                           </a>      
                        </dd> -->
                     </dl>
                     <dl class="list-unstyled">
                        <dt>
                           <strong>
                           <i class="fa fa-angle-down"></i> Chăm sóc khách hàng
                           </strong>
                        </dt>
                        @foreach($service_pages as $item)
                        <dd>
                           <a class="{{ Request::is($item->slug) ? 'current' : '' }}" href="{{$item->slug}}">          <i class="fa fa-angle-right"></i> {{$item->name}}
                           </a>      
                        </dd>
                        @endforeach
                        
                     </dl>
                  </div>
               </div>
               <div class="general-info">
                  <h5 class="title">Liên hệ với chúng tôi</h5>
                  <div class="content text-center">
                     <div class="fb-page" data-href="https://www.facebook.com/Cfarm.vn/" data-tabs="timeline" data-height="156" data-small-header="true" data-width="263" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Cfarm.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Cfarm.vn/">Cfarm.vn</a></blockquote></div>  
                  </div>
               </div>
            </aside>
            <article id="article" class="col-md-9">
               <h3 class="text-uppercase no-margin-top">
                  {{$page->name}}
               </h3>
               <?php
                  echo($page->content); 
               ?>
            </article>
         </div>
      </div>
   </section>
</main>
@endsection

@section('scrip_code')

<script type="text/javascript">

   $(document).ready(function(){
     $('#article').children('p').children('img').each(function(){
       $(this).addClass('img-responsive');
       $(this).css("height", "auto");
     });
     $('#article').children('img').each(function(){
       $(this).addClass('img-responsive');
       $(this).css("height", "auto");
     });
   });
</script>

@endsection