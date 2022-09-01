@extends("client.base")

@section("page_title")
    مرحبا
@endsection

@section("content")
    <div class="column small-12 align-center center nataalam-hero">

        <p class="column small-12">
            <strong>{{ trans('strings.nataalam') }}</strong>
            {{ trans('strings.nataalamIsSchool') }}
        </p>

        @if (!Auth::user())
            <div class="column small-12">
                <a href="/register"
                   class="button large text-bold">
                    <i class="fa fa-user-plus"></i>
                    &nbsp;
                    {{ trans('strings.createAnAccount') }}
                </a>
            </div>
        @endif
    </div>
    <div class="column small-12 text-center"
         style="background: url(/images/frontpage/new/tablet.svg) no-repeat bottom left, url(/images/frontpage/new/violet-bg.png);">
        <div class="column margin-40">
            <img src="/images/frontpage/new/globe.svg" alt="">
            <br>
            <p class="text-white text-bold text-medium">
                {{ trans('strings.feature3') }}
            </p>
            <img src="/images/frontpage/new/violet-leaf.svg" alt="">
        </div>
    </div>
    <div class="column small-12 text-center"
         style="background: url(/images/frontpage/new/drawing.svg) no-repeat bottom right, url(/images/frontpage/new/red-bg.png);">
        <div class="column margin-40">
            <img src="/images/frontpage/new/awesome-features.svg" alt="">
            <br>
            <p class="text-white text-bold text-medium">
                {{ trans('strings.feature2') }}
            </p>
            <img src="/images/frontpage/new/red-leaf.svg" alt="">
        </div>
    </div>
    <div class="column small-12 text-center"
        style="background: url(/images/frontpage/new/coffee.svg) no-repeat bottom left, url(/images/frontpage/new/blue-bg.png);">
        <div class="column margin-40">
            <img src="/images/frontpage/new/holding-book.svg" alt="">
            <br>
            <p class="text-white text-bold text-medium">
                {{ trans('strings.feature1') }}
            </p>
            <img src="/images/frontpage/new/blue-leaf.svg" alt="">
        </div>
    </div>

    <section class="column small-12 nataalam-row-container"
             style="background-color: #0C5191;"
             id="donate">
        <div class="nataalam-front-footer">
            <p> {{ trans('strings.helpNataalam') }} </p>
            <p><strong> {{ trans('strings.helpMoney') }} </strong></p>
            <p>
                {{ trans('strings.helpQuality') }}
            </p>
            <a href="#"
               class="button hollow">
                ادعمنا الان
            </a>
        </div>
    </section>
@endsection
