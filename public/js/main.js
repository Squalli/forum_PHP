	
	$(document).ready(function(){
		
		
		$(".message").each(function(index){
			$(this).delay(2000*index).animate(
				{"left": 0},
				700,
				function(){
					$(this).delay(2000).fadeOut(1000)
				}
			)
		})
		
		$(".ajax-link").click(function(event){
			event.preventDefault();
			var elem = $(this);
			var action = elem.data("action");
			var target = elem.data("target");
			$.get(
				"index.php",
				{"control" : "forum", "action" : action, "id": target, "async": true},
				function(data){
					$("main").html(data);
				}
			);
		});
	})
	