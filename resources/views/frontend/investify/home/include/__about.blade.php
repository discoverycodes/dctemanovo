@php
$data1 =\App\Models\Page::where('code','about')->where('locale',app()->getLocale())->first();
$data = json_decode($data1->data, true);
@endphp

<section class="rock-join-members-section">
<div class="container">
        <div class="join-members-main" data-background="{{ asset('assets/frontend/theme_base/hardrock/images/bg/join-members-bg.png') }}">
        <div class="container">
           <div class="row gy-50">
              <div class="col-xxl-6 col-xl-6 col-lg-6">
                 <div class="rock-about-thumb-wrap">
                    <div class="rock-about-thumb">
                       <img src="{{ asset('assets/'.$data['aboutusLeftImg']) }}" alt="about">
                    </div>
                    <div class="card-text">
                       <p>{{ $data['left_img_badge'] }}</p>
                    </div>
                    <div class="shape-one">
                       <img src="{{ asset('assets/frontend/theme_base/hardrock/images/rock-shapes/newsletter-shape-01.png') }}" alt="rock">
                    </div>
                 </div>
              </div>
              <div class="col-xxl-6 col-xl-6 col-lg-6">
                 <div class="rock-about-content">
                    <div class="section-title-wrapper-four ">
                       <span class="subtitle-four">{{ $data['title_small'] }}</span>
                       <h2 class="section-title-four mb-30"><span class="text-highlight">{{ $data['title_big'] }}</span></h2>
                       <p class="description">
                        {!! $data['content'] !!}
                    </p>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        </div>
     </div>
</section>