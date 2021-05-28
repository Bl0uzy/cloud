(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

	$("input[type=color]").change(function (){
		var mainColor = $("#mainColor").val()
		var secondColor = $("#secondColor").val()
		changeColor(mainColor,secondColor)
	})



})(jQuery);

function changeColor(color1,color2) {
	$("#sidebar").css("background",color1)
	$(".btn.btn-primary").css("background",color2).css("border-color",color2).hover(function (){$(this).css("background",color2)})

}