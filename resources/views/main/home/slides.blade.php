<!--banners-->
<div id="slideshow-container">

	@foreach ($banners as $banner)
		@if (isset($banner->url))
			<a href="#">
		@endif
		<div class="mySlides">
			<img src="{{ route('home.banners.show-image', $banner->id) }}" alt="">
		</div>
		@if ($banner->url)
			</a>
		@endif
	@endforeach

	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>

<!--base1-->
<div class="base_slide"><img src="{{ asset('assets/img/base_slide.png') }}" class="img_cem"></div>
