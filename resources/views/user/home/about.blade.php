@php

    $data = App\Models\About::find(1);
    $datas = App\Models\MultiImage::take(7)->get();
@endphp

<section id="aboutSection" class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="about__icons__wrap">
                    @foreach ($datas as $item)
                        <li>
                            {{-- <img class="light" src="{{ asset($item->image) }}" alt="XD"> --}}
                            <img class="light" src="{{ !empty($item->image) ? url($item->image) : url('no_image.jpg') }}" alt="XD">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <div class="section__title">
                        <span class="sub-title">01 - About me</span>
                        <h2 class="title">{{ $data->title }}</h2>
                    </div>
                    <div class="about__exp">
                        <div class="about__exp__icon">
                            <img src="{{ !empty($data->image) ? url($data->image) : url('no_image.jpg') }}" alt="">
                        </div>
                        <div class="about__exp__content">
                            <p>{{ $data->short_title }}</p>
                        </div>
                    </div>
                    <p class="desc">{{ $data->content }}</p>
                    <a href="about.html" class="btn">Download my resume</a>
                </div>
            </div>
        </div>
    </div>
</section>
