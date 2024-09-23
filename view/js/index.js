	$(document).ready(function(){
				
		$('.carousel').carousel(
		{
			dist: 0,
			padding: 0,
			fullWidth: true,
			indicators: true,
			duration: 100,
		});
		
		$('.parallax').parallax();
		
		$(".button-collapse").sideNav({
			menuWidth: 400, // Default is 300
			edge: 'left', // Choose the horizontal origin
			closeOnClick: true, // Closes side-nav on <a> clicks
			draggable: true, // Choose whether you can drag to open on touch screens
			preventScrolling: false
		});
		$('.button-collapse').sideNav('hide');
		
		//$('.collapsible').collapsible();
		$('.collapsible').collapsible('open', 0);
		
		$("#fav").click(function() {
          $(".tap-target").tapTarget("open");
        });
		
		$('.modal').modal();
		
	});

	autoplay()   
	function autoplay() {
		$('.carousel').carousel('next');
		setTimeout(autoplay, 4500);
	}
	
	topFunction()
	function topFunction() {
		document.body.scrollTop = 0; // For Safari
		document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
	}
	
	document.addEventListener('DOMContentLoaded', function() {
		var locationDropdown = document.getElementById('location');
		var typeDropdown = document.getElementById('type');
		var inputField = document.getElementById('restaurant');

		locationDropdown.style.display = 'none';
		typeDropdown.style.display = 'none';

		inputField.addEventListener('click', function() {
			locationDropdown.style.display = 'block';
			typeDropdown.style.display = 'block';
		});
	});
