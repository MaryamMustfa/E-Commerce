<!-- resources/views/user/carousel.blade.php -->

<style>
    #shopCarousel .slick-slide img {
        height: 200px;
        width: 100%; 
        object-fit: cover;
    }

    .carousel-heading {
        margin-bottom: 10px;
        font-size: 60px;
    }

</style>

<div class="carousel-heading">
    <h1>Shops</h1>
</div>

<div id="shopCarousel" class="slick-carousel">
    @foreach ($shops as $shop)
        <div>
            <a href="{{ route('shopdetail', $shop) }}">
                <img src="{{ $shop->image }}" alt="{{ $shop->name }}">
            </a>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    // Initialize Slick Carousel
    $(document).ready(function(){
        $('#shopCarousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000, // Adjust this value for faster scrolling
            dots: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>
@endpush
