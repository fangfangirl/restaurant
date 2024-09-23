	$(document).ready(function() {
		$('select').material_select();
		$('.carousel.carousel-slider').carousel({fullWidth: true});
	});
	autoplay()   
	function autoplay() {
		$('.carousel').carousel('next');
		setTimeout(autoplay, 4500);
	}
	
	function enter() 
	{ 
		var a=document.forms["register_c"]["nameuser"].value;
		var b=document.forms["register_c"]["account"].value;
		var c=document.forms["register_c"]["password"].value; 
		var d=document.forms["register_c"]["password2"].value; 
		var e=document.forms["register_c"]["email"].value; 
		var f=document.forms["register_c"]["phonenum"].value; 
		if(a.length==0 || b.length==0 || c.length==0 || d.length==0 || e.length==0 || f.length==0)
		{ 
			swal({
				icon: 'warning',
				text: '不可以為空',
				button: 'OK!'
			})
			return false; 
		} 
		else if(c!=d)
		{
			swal({
				icon: 'warning',
				text: '兩次密碼不相等',
				button: 'OK!'
			})
			return false; 
		}
	} 
	function enter2() 
	{ 
		var a=document.forms["register_b"]["nameres"].value;
		var b=document.forms["register_b"]["accountres"].value;
		var c=document.forms["register_b"]["passwordres"].value; 
		var d=document.forms["register_b"]["password2res"].value; 
		var e=document.forms["register_b"]["email_res"].value; 
		var f=document.forms["register_b"]["phone_res"].value; 
		var g=document.forms["register_b"]["owner"].value; 
		if(a.length==0 || b.length==0 || c.length==0 || d.length==0 || e.length==0 || f.length==0 || g.length==0)
		{ 
			swal({
				icon: 'warning',
				text: '不可以為空',
				button: 'OK!'
			})
			return false; 
		} 
		else if(c!=d)
		{
			swal({
				icon: 'warning',
				text: '兩次密碼不相等',
				button: 'OK!'
			})
			return false; 
		}
	} 