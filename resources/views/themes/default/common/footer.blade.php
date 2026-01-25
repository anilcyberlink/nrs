<!-- Footer -->
<footer id="footer" class="footer wow fadeIn">
	<!-- Footer Bottom -->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class=" ">
						<!-- Social -->
						<ul class="social">
							<li><a href="{{$setting->facebook_link}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li><a href="{{$setting->twitter_link}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a href="{{$setting->linkedin_link}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="{{$setting->youtube_link}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
						</ul>
						<!--/ End Social -->
						<!-- Copyright -->
						<div class="copyright mt-10">
							<p>{{$setting->copyright_text}}
							<br>Design & Development By <a target="_blank" href="https://cyberlink.com.np/">Cyberlink</a> </p>
						</div>
						<!--/ End Copyright -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Footer Bottom -->
</footer>
<!--/ End footer -->
<!-- Jquery -->
<script src="{{asset('themes-assets/js/jquery.min.js')}}"></script>
<script src="{{asset('themes-assets/js/jquery-migrate.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('themes-assets/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('themes-assets/js/bootstrap.min.js')}}"></script>
<!-- Colors JS -->
<script src="{{asset('themes-assets/js/colors.js')}}"></script>
<!-- Modernizer JS -->
<!-- <script src="js/modernizr.min.js"></script> -->
<!-- Nice select JS -->
<script src="{{asset('themes-assets/js/niceselect.js')}}"></script>
<!-- Tilt Jquery JS -->
<script src="{{asset('themes-assets/js/tilt.jquery.min.js')}}"></script>
<!-- Fancybox  -->
<script src="{{asset('themes-assets/js/jquery.fancybox.min.js')}}"></script>
<!-- Jquery Nav -->
<script src="{{asset('themes-assets/js/jquery.nav.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('themes-assets/js/owl.carousel.min.js')}}"></script>
<!-- Slick Slider JS -->
<script src="{{asset('themes-assets/js/slickslider.min.js')}}"></script>
<!-- Cube Portfolio JS -->
<script src="{{asset('themes-assets/js/cubeportfolio.min.js')}}"></script>
<!-- Slicknav JS -->
<script src="{{asset('themes-assets/js/jquery.slicknav.min.js')}}"></script>
<!-- Jquery Steller JS -->
<script src="{{asset('themes-assets/js/jquery.stellar.min.js')}}"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('themes-assets/js/magnific-popup.min.js')}}"></script>
<!-- Wow JS -->
<script src="{{asset('themes-assets/js/wow.min.js')}}"></script>
<!-- CounterUp JS -->
<script src="{{asset('themes-assets/js/jquery.counterup.min.js')}}"></script>
<!-- Waypoint JS -->
<script src="{{asset('themes-assets/js/waypoints.min.js')}}"></script>
<!-- Jquery Easing JS -->
<script src="{{asset('themes-assets/js/easing.min.js')}}"></script>
<!-- Google Map JS -->
<!-- Main JS -->
<script src="{{asset('themes-assets/js/main.js')}}"></script>
<!-- Event JS -->
<script src="{{asset('themes-assets/js/history.js')}}"></script>
<script src="{{asset('themes-assets/lightbox-plus-jquery.min.js')}}"></script>
<script type="text/javascript">
    const individual= document.getElementById('individual');
    const group= document.getElementById('group');
    const group_entry= document.getElementById('group-entry');
    const group_event= document.getElementById('group-event');
    const individual_category= document.getElementById('individual_category');
    const individual_event= document.getElementById('individual_event');
    const upload_id= document.getElementById('upload_id');

    function groupType(){
        group_entry.style.display ='block';
        group_event.style.display ='block';
        individual_category.style.display ='hidden';
        individual_event.style.display = 'none';
        upload_id.style.display = 'none';

    }

    function individualType(){
        group_entry.style.display ='none';
        group_event.style.display ='none';
        individual_category.style.display ='block';
        individual_event.style.display = 'block';
        upload_id.style.display = 'block';
    }
</script>
</body>
</html>