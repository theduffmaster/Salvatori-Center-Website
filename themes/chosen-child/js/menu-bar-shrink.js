jQuery(document).ready(function($) {
	//Create box behind menu bar for shadow to drop off of
	var box = document.createElement('div');
		box.className = 'shadow-holder-box';
		document.querySelector('#menu-primary-container').appendChild(box);
	var header = document.querySelector('#menu-primary-container');
	var header_bottom = document.querySelector('.shadow-holder-box');

	window.onscroll = function() {
		//Thinker icon box
		var logoBox = document.querySelector('.thinker-icon'),
		//Actual thinker icon svg image
		logo = logoBox.querySelector('a');
		
		var mq = window.matchMedia('(min-width: 56.25em)').matches;
		//Width at which icon might overlap with menu items
		var mw = window.matchMedia('(max-width: 70em)').matches;
		if (mq){
			growShrinkLogo();
		}
		
		//To prevent overlap with top menu items 
		//to the left of the thinker icon
		//Shifts thinker icon all the way to the right
		if ((logo.style.width == '4em') && mq && mw){
			logoBox.style.left = '700px';
		} else{
			logoBox.style.left = null;
		}
	};

	window.onresize = function() {
		//Thinker icon box
		var logoBox = document.querySelector('.thinker-icon'),
		//Actual thinker icon svg image
		logo = logoBox.querySelector('a');
		
		var mq = window.matchMedia('(min-width: 56.25em)').matches;
		//Width at which icon might overlap with menu items
		var mw = window.matchMedia('(max-width: 70em)').matches;
		
		if (!mq){
			//If smaller then 56.25em do not shrink 
			//and move thinker icon
			logoBox.style.marginTop = null;
			logo.style.width = null;
			header.style.height = null;
			header_bottom.style.height = null;
		}else{
			if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
				logoBox.style.marginTop = '-31px';
			} else {
				logoBox.style.marginTop = '0px';
				logo.style.width = '6em';
			}
		}
		
		//To prevent overlap with top menu items 
		//to the left of the thinker icon
		//Shifts thinker icon all the way to the right
		if ((logo.style.width == '4em') && mq && mw){
			logoBox.style.left = '700px';
		} else{
			logoBox.style.left = null;
		}
	};

	/* Grows and shrinks the menu icon when user scrolls and also
	 * controls the shadow on scroll. 
	 */ 
	function growShrinkLogo() {
	  	//Thinker icon box
		var logoBox = document.querySelector('.thinker-icon'),
		//Actual thinker icon svg image
		logo = logoBox.querySelector('a');

		if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
			header_bottom.style.boxShadow = '0px 14px 7px -15px #888888';
		} else {
			header_bottom.style.boxShadow = '0 0px 0px 0px #888888';
		}

		if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
			//Icon is moved vertically to adjust for height displaced when shrunken
			logoBox.style.marginTop = '-31px';
			logo.style.width = '4em';
			header.style.height = '4.5em';
			header_bottom.style.height = '4.5em';
		} else {
			logoBox.style.marginTop = '0px';
			logo.style.width = '6em';
			header.style.height = '8em';
			header_bottom.style.height = '8em';
		}	
	}
})