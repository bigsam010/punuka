$(document).ready(function(){
				$("ul.you").css({
					textDecoration: 'none'
				}).hide();
				$("li a.you").css({
					textDecoration: 'none'
				}).hover(function(){
					$(this).css("text-decoration", "none");
				}, function(){
					$(this).css("text-decoration", "none");
				}).click(function(e){
					e.preventDefault();
					$(this).find("img#cola").toggle();
					$(this).next('ul.you').toggle();		
					});
				
			});
