	$(document).ready(function(){
		
		$('select').material_select();
		
		$('.carousel').carousel();
		
		$('.modal').modal();
		
		$('.parallax').parallax();
		
		$('.materialboxed').materialbox();
		
		$(".button-collapse").sideNav({
			menuWidth: 400, // Default is 300
			edge: 'left', // Choose the horizontal origin
			closeOnClick: true, // Closes side-nav on <a> clicks
			draggable: true, // Choose whether you can drag to open on touch screens
			preventScrolling: false
		});
		//$('.button-collapse').sideNav('show');
		
		//$('.collapsible').collapsible();
		$('.collapsible').collapsible('open', 0);
		
        $("#fav").click(function() {
          $(".tap-target").tapTarget("open");
        });
		
		$('.chips').material_chip();
		$('.chips-initial').material_chip({
		data: [{
		  tag: 'Apple',
		}, {
		  tag: 'Microsoft',
		}, {
		  tag: 'Google',
		}],
		});
		$('.chips-placeholder').material_chip({
		placeholder: 'Enter a tag',
		secondaryPlaceholder: '+Tag',
		});
		$('.chips-autocomplete').material_chip({
		autocompleteOptions: {
		  data: {
			'Apple': null,
			'Microsoft': null,
			'Google': null
		  },
		  limit: Infinity,
		  minLength: 1
		}
		});
		
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
	
	var chip = {
		tag: 'chip content',
		image: '', //optional
		id: 1, //optional
	};
	
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.carousel');
		var instances = M.Carousel.init(elems, options);
	});
	
	//星星評級
	const stars=document.querySelector(".rating").children;
	let ratingValue
	let index //目前選到的星星
	document.getElementById("rating-value").innerHTML = "提示 :  滿分五分，請為該餐廳評分"
	for(let i=0;i<stars.length;i++){
		stars[i].addEventListener("mouseover",function(){
			//  console.log(i)
			document.getElementById("rating-value").innerHTML = "提示 :  正在打分數..."
			for(let j=0;j<stars.length;j++){
				stars[j].classList.remove("fa-star")//reset 所有星星
				stars[j].classList.add("fa-star-o")
			}
			for(let j=0;j<=i;j++){
				stars[j].classList.remove("fa-star-o") //先移除空心的星星
				stars[j].classList.add("fa-star") //添加新的星星 如果i=j表示選中的
			}
		})
		stars[i].addEventListener("click",function(){
			ratingValue=i+1
			index=i
			document.getElementById("starvalue").value = ratingValue
			document.getElementById("rating-value").innerHTML = "提示 :  你打的分數是 "+ratingValue+" 顆星~"
		})
		stars[i].addEventListener("mouseout",function(){
			for(let j=0;j<stars.length;j++){
				stars[j].classList.remove("fa-star")//reset 所有星星
				stars[j].classList.add("fa-star-o")
			}
			for(let j=0;j<=index;j++){
				stars[j].classList.remove("fa-star-o")
				stars[j].classList.add("fa-star")
			}
		})
	}
	