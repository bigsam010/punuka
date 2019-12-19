
$(document).ready(function(){
  $(".edit").click(function(){
	var position = $(this).closest("tr").find(".position").text();
	var title = $(this).closest("tr").find(".title").text();
	var author = $(this).closest("tr").find(".author").text();
	var accessno = $(this).closest("tr").find(".accessno").text();
	var subject = $(this).closest("tr").find(".subject").text();
	var publisher = $(this).closest("tr").find(".publisher").text();
	var view = $(this).closest("tr").find(".view").text();
	var year = $(this).closest("tr").find(".year").text();
	var id = $(this).closest("tr").find(".id").text();
	
	$(".tit").val(title);
	$(".aut").val(author);
	$(".loc").val(position);
	$(".access").val(accessno);
	$(".sub").val(subject);
	$(".v").val(view);
	$(".pub").val(publisher);
	$(".y").val(year);
	$(".identity").val(id);
	$(".modal").fadeIn();
	$(".modal_main").show();
	
	
	  });
});
$(document).ready(function(){
  $(".allMail").click(function(){
	$(".modal").fadeIn();
	$(".modal_main").show();
	
	
	  });
});
$(document).ready(function(){
	$(".k").click(function(){
		$(".modal").fadeOut();
	$(".modal_main").fadeOut();
	});
});
$(document).ready(function(){
  $(".close").click(function(){
	$(".modal").fadeOut();
	$(".modal_main").fadeOut();
	  });
});


$(document).ready(function(){
	$(".del").click(function(){
		var id = $(this).closest("tr").find(".id").text();
	var con = swal({
  title: "Are you sure?",
  text: "You will not be able to recover this book!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Deleted!", "Book has been deleted.", "success");
		window.location="delete_books.php?id="+id;
  } else {
    swal("Cancelled", "Book is safe :)", "error");
  }
});

		
	
	
		
	});	
});


$(document).ready(function(){
  $(".make",this).click(function(){
	
	 var name = $(this).closest("tr").find(".name").text();
	 var login = $(this).closest("tr").find(".login").text();
	 var staff_id = $(this).closest("tr").find(".staff").text();
	 var mail = $(this).closest("tr").find(".mail").text();
	 var id = $(this).closest("tr").find(".id").text();
	 var admin = $(this).closest("tr").find(".admin").text();
	 var location = $(this).closest("tr").find(".location").text();
	 var admin_userName = $(this).closest("tr").find(".admin_user_name").text();
	
	$(".fname").val(name);
	$(".staff_id").val(staff_id);
	$(".login").val(login);
	$(".em").val(mail);
	$(".locate").val(location);
	$(".id_s").val(id);

	if(admin_userName!="lighted"){
	var selected = $(".adminn");
	if(admin=="active"){
		$('.tilty').removeClass("mmm");
		$(".t").show();
		$(selected,this).show();
		$(selected,this).empty();
		$(selected,this).append('<option val=""></option>');
		$(selected,this).append('<option val="">Deactivate</option>');
	}else{
		$('.tilty').removeClass("mmm");
		$(".t").show();
		$(selected,this).show();
		$(selected,this).empty();
		$(selected,this).append('<option val=""></option>');
		$(selected,this).append('<option val="">Activate</option>');
	}
	}else{
		var selected = $(".adminn");
		$(selected,this).hide();
		$(".t").hide();
		$('.tilty').addClass("mmm");
	}
	

	
	$(".modal").fadeIn();
	$(".modal_main").show();
	
	
	  });
});



$(document).ready(function(){
	$(".dell").click(function(){
		var id = $(this).closest("tr").find(".id").text();
		var con = swal({
  title: "Are you sure?",
  text: "You will not be able to reverse this action!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Deleted!", "User has been removed", "success");
		window.location="delete_user.php?id="+id;
  } else {
    swal("Cancelled", "User not deleted :)", "error");
  }
});
});
});


/* $(document).ready(function(){
	$(".admin").click(function(){
		var location = $(this).closest("tr").find(".location").text();
		var staff_id = $(this).closest("tr").find(".staff").text();
		var con = swal({
  title: "Are you sure?",
  text: "You want to make this user an Admin?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, Confirm it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Done!", "User has been made "+location+" admin", "success");
		 window.location="make_admin.php?staff_id="+staff_id+'&location='+location;
  } else {
    swal("Cancelled", "User not made Admin :)", "error");
  }
});
});
});
 */



$(document).ready(function(){
	$(".retn").click(function(){
		var id = $(this).closest("tr").find(".id").text();
		var fname = $(this).closest("tr").find(".fname").text();
		var email = $(this).closest("tr").find(".email").text();
		var title = $(this).closest("tr").find(".title").text();
		var con = swal({
  title: "Are you sure?",
  text: "You will not be able to reverse this action!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, return it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Returned!", "Book has been returned", "success");
		window.location="return_confirm.php?id="+id+'&email='+email+'&fname='+fname+'&title='+title;
  } else {
    swal("Cancelled", "Book not returned :)", "error");
  }
});
});
});




$(document).ready(function(){
	$(".sug").click(function(){
		var id = $(this).closest("tr").find(".id").text();
		var con = swal({
  title: "Are you sure you have purchased this book?",
  text: "You will not be able to reverse this action!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, return it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Purchased!", "Book has been purchased", "success");
		window.location="suggest_confirm.php?id="+id;
  } else {
    swal("Cancelled", "Book not purchased :)", "error");
  }
});
});
});

$(document).ready(function(){
	$(".fsug").click(function(){
		var id = $(this).closest("tr").find(".id").text();
		var con = swal({
  title: "Are you sure you have purchased this book?",
  text: "You will not be able to reverse this action!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, return it!",
  cancelButtonText: "No, cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Purchased!", "Book has been purchased", "success");
		window.location="fsuggest_confirm.php?id="+id;
  } else {
    swal("Cancelled", "Book not purchased :)", "error");
  }
});
});
});




$(document).ready(function(){
  $(".sendit").click(function(){
	
	 var name = $(this).closest("tr").find(".name").text();
	 var mail = $(this).closest("tr").find(".mail").text();
	
	$(".r_name").val(name);
	$(".r_mail").val(mail);
	
	$(".moda").fadeIn();
	$(".modal_mail").show();
	
	
	  });
});

$(document).ready(function(){
  $(".die").click(function(){
	$(".moda").fadeOut();
	$(".modal_mail").fadeOut();
	  });
});
















