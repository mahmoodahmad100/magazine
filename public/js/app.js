// *sign up - sign in windows* //

//sign in
$('#sign-in-btn').click(function(e){
	e.preventDefault();
	$('#sign-in-modal').modal();
});

//sign up
$('#sign-up-btn').click(function(e){
	e.preventDefault();
	$('#sign-up-modal').modal();
});

/*$('.modal-sign-up-btn').click(function(e){
	e.preventDefault();
});*/

// /*sign up - sign in windows* //



// control panel //

// edit categories window //
var c = null;
var a = null;
var cid = null;

$('.edit-category-btn').click(function(event){
	event.preventDefault();
	a = event.target.parentNode.parentNode.childNodes[3];
	c = event.target.parentNode.parentNode.childNodes[3].textContent;
	cid = event.target.parentNode.parentNode.childNodes[1].textContent;
	$('#categoryedit').val(c);
	$('#edit-category-modal').modal();
});

$('#save-category').click(function(){
	$.ajax({
		method:'POST',
		url:urlEditCategory,
		data:{ categoryedit:$('#categoryedit').val() , catId:cid , _token:token},
		success:function(msg){
			$(a).html(msg['edited-cat']);
			$('#edit-category-modal').modal('hide');
			console.log(msg['edited-cat']);
		}
});
});
// /edit categories window //

var Id = 0;
var tr = null; //table row
// delete the categories section//
$('.delete-category-btn').click(function(event){
	event.preventDefault();
	Id = event.target.parentNode.parentNode.childNodes[1].textContent;
	tr = event.target.parentNode.parentNode;
	console.log(Id);
	$('#category-delete-modal').modal();
});

$('#delete-category').click(function(){
	$.ajax({
		url:deleteCategoryUrl,
		method:'GET',
		data:{id:Id},
		success:function(){
			$('#category-delete-modal').modal('hide');
			//window.location.replace(catUrl);
			$('.success-msg').fadeIn().fadeOut(3000);
			$(tr).fadeOut();
		}
	});
});
// /delete the categories section//

// add new admin - ban users //

//admin section
$('.admin-btn').on('click',function(event){
	event.preventDefault();
	var userId = event.target.parentNode.parentNode.childNodes[1].textContent;
	var isAdmin = event.target.dataset['isadmin']== 0 ? 1 : 0;
 	$(this).attr('data-isadmin', isAdmin);
//isAdmin = event.target.dataset['isadmin'];
	$.ajax({
		method:'POST',
		url:makeAdminUrl,
		data:{ Admin:isAdmin , userId:userId , _token:token}
	})
	.done(function(msg){
		console.log(msg['Admin']);
		if(isAdmin == 1)
		{
			$(event.target).html('Admin (yes)');
			$(event.target.parentNode).find('.ban-btn').html('Ban');
		}
		else
			$(event.target).html('Admin');
	});
});

//ban section
$('.ban-btn').on('click',function(event){
	event.preventDefault();
	var userId = event.target.parentNode.parentNode.childNodes[1].textContent;
	var isBan = event.target.dataset['isban']== 0 ? 1 : 0;
	$(this).attr('data-isban',isBan);

	$.ajax({
		method:'POST',
		url:makeBanUrl,
		data:{ Ban:isBan , userId:userId , _token:token},
		success:function(msg){
			console.log(msg['Ban']);
			if(isBan == 1)
			{
				$(event.target).html('Banned (yes)');
				$(event.target.parentNode).find('.admin-btn').html('Admin');
			}
			else
				$(event.target).html('Ban');
		}
	})
});
// /add new admin - ban users //

// adding best posts - block posts && comments

//best posts section
$('.best-btn').on('click',function(event){
	event.preventDefault();
	var postId = event.target.parentNode.parentNode.childNodes[1].textContent;
	var isBest = event.target.dataset['isbest'];

	if(isBest == 0 || isBest == 2)
		isBest = 1;
	else
		isBest = 0;

	$(this).attr('data-isbest',isBest);
	$.ajax({
		method:'POST',
		url:makeBestPostUrl,
		data:{ BestPost:isBest , postId:postId , _token:token},
		success:function(msg){
			console.log(msg['BestPost']);
			if(isBest == 1)
			{
					$(event.target).html('Best post (yes)');
					$(event.target.parentNode).find('.block-post-btn').html('Block');
			}
			else
				$(event.target).html('Best post');
		}
	})
});

//block posts
$('.block-post-btn').on('click',function(event){
	event.preventDefault();
	var postId = event.target.parentNode.parentNode.childNodes[1].textContent;
	var isBlocked = event.target.dataset['isblocked'];

  if(isBlocked == 0 || isBlocked == 1 )
		isBlocked = 2;
	else
		isBlocked = 0;

	$(this).attr('data-isblocked',isBlocked);

	$.ajax({
		method:'POST',
		url:makeBlockPOrCUrl,
		data:{ Block:isBlocked , postId:postId , isPost:1, _token:token},
		success:function(msg){
			console.log(msg['Block_val']);
			if(isBlocked == 2)
			{
					$(event.target).html('Blocked (yes)');
					$(event.target.parentNode).find('.best-btn').html('Best post');
			}
			else
				$(event.target).html('Block');
		}
	})
});

//block comments
$('.block-comment-btn').on('click',function(event){
	event.preventDefault();
	var commentId = event.target.parentNode.parentNode.childNodes[1].textContent;
	var isBlocked = event.target.dataset['isblocked']== 0 ? 2 : 0;
	$(this).attr('data-isblocked',isBlocked);

	$.ajax({
		method:'POST',
		url:makeBlockPOrCUrl,
		data:{ Block:isBlocked , commentId:commentId ,isPost:0 , _token:token},
		success:function(msg){
			console.log(msg['Block_val']);
			if(isBlocked == 2)
				$(event.target).html('Blocked (yes)');
			else
				$(event.target).html('Block');
		}
	})
});

// /adding best posts - block posts && comments

// /control panel //




// the posts and the comments //

// like handling in posts and comments //
$('.like-post').on('click',function(event){
	event.preventDefault();
	var userId = event.target.dataset['userid'];
	var postId = event.target.dataset['postid'];

	$.ajax({
		method:'POST',
		url:likeUrl,
		data:{userId:userId, p_or_c:postId, isPost:1, _token:token},
		success:function(msg){
			if(msg['like'] == 0)
				$(event.target).html('<span class="glyphicon glyphicon-star-empty"></span>like ');
			else
				$(event.target).html('<span class="glyphicon glyphicon-star"></span>like ');

			if(msg['Plikes'] == 1)
				$(event.target.parentNode.parentNode).find('.p-likes').html(msg['Plikes']+' '+'like');
			else
				$(event.target.parentNode.parentNode).find('.p-likes').html(msg['Plikes']+' '+'likes');

			console.log(msg['like']+'yes'+msg['Plikes']);
		}
	});
});

$('.like-comment').on('click',function(event){
	event.preventDefault();
	var userId = event.target.dataset['userid'];
	var commentId = event.target.dataset['commentid'];

	$.ajax({
		method:'POST',
		url:likeUrl,
		data:{userId:userId, p_or_c:commentId, isPost:0, _token:token},
		success:function(msg){
			if(msg['like'] == 0)
				$(event.target).html('<span class="glyphicon glyphicon-star-empty"></span>like ');
			else
				$(event.target).html('<span class="glyphicon glyphicon-star"></span>like ');

			if(msg['Clikes'] == 1)
				$(event.target.parentNode.parentNode).find('.c-likes').html(msg['Clikes']+' '+'like');
			else
				$(event.target.parentNode.parentNode).find('.c-likes').html(msg['Clikes']+' '+'likes');

			console.log(msg['like']+'yes'+msg['Clikes']);

		}
	});
});
// /like handling in posts and comments //


// report handling in posts and comments //
var userId = null;
var postId = null;
var reportObj = null;
var reported = 0;
var reportVal = null ;

//add report && show warnning window to delete the report if it's already reported from that user (posts)
$('.report-post').click(function(event){
	event.preventDefault();
	reported = event.target.dataset['reported'];
	if (reported == 1) {
		$('#report-post-delete-modal').modal();
	}else {
		$('#report-post-modal').modal();
	}
	userId = event.target.dataset['userid'];
  postId = event.target.dataset['postid'];
	reportObj = event.target;
	reportVal = $(this);
	console.log(reported);
});

$('#save-report-post').click(function(event){
	var reason = $('#report-post-body').val();
	console.log(userId+reason+postId);
	$.ajax({
		url:reportUrl,
		method:'POST',
		data:{userId:userId, p_or_c:postId, isPost:1, reason:reason , _token:token},
		success:function(msg){
			$('#report-post-modal').modal('hide');

			if(msg['report'] == 0){
				$(reportObj).html('Report');
				reportVal.attr('data-reported',0);
			}
			else{
				$(reportObj).html('UnReport');
				reportVal.attr('data-reported',1);
			}
			console.log(msg['report']+' '+reported);
		}
	});
});

// delete the report (posts)
$('#delete-report-post').click(function(event){
	console.log(userId+postId);
	$.ajax({
		url:reportUrl,
		method:'POST',
		data:{userId:userId, p_or_c:postId, isPost:1, _token:token},
		success:function(msg){
			$('#report-post-delete-modal').modal('hide');

			if(msg['report'] == 0){
				$(reportObj).html('Report');
				reportVal.attr('data-reported',0);
			}
			else{
				$(reportObj).html('UnReport');
				reportVal.attr('data-reported',1);
			}
			console.log(msg['report']+' '+reported);
		}
	});
});


//add report && show warnning window to delete the report if it's already reported from that user (comments)
$('.report-comment').click(function(event){
	event.preventDefault();
	reported = event.target.dataset['reported'];
	if (reported == 1) {
		$('#report-comment-delete-modal').modal();;
	}else {
		$('#report-comment-modal').modal();
	}
	userId = event.target.dataset['userid'];
  commentId = event.target.dataset['commentid'];
	reportObj = event.target;
	reportVal = $(this);
	console.log(reported);
});

$('#save-report-comment').click(function(event){
	var reason = $('#report-comment-body').val();
	console.log(userId+reason+commentId);
	$.ajax({
		url:reportUrl,
		method:'POST',
		data:{userId:userId, p_or_c:commentId, isPost:0, reason:reason , _token:token},
		success:function(msg){
			$('#report-comment-modal').modal('hide');

			if(msg['report'] == 0){
				$(reportObj).html('Report');
				reportVal.attr('data-reported',0);
			}
			else{
				$(reportObj).html('UnReport');
				reportVal.attr('data-reported',1);
			}
			console.log(msg['report']+' '+reported);
		}
	});
});

// delete the report (comments)
$('#delete-report-comment').click(function(event){
	console.log(userId+commentId);
	$.ajax({
		url:reportUrl,
		method:'POST',
		data:{userId:userId, p_or_c:commentId, isPost:0, _token:token},
		success:function(msg){
			$('#report-comment-delete-modal').modal('hide');

			if(msg['report'] == 0){
				$(reportObj).html('Report');
				reportVal.attr('data-reported',0);
			}
			else{
				$(reportObj).html('UnReport');
				reportVal.attr('data-reported',1);
			}
			console.log(msg['report']+' '+reported);
		}
	});
});
// /report handling in posts and comments //

// edit & delete the posts and the comments //
var titleContent = null;
var bodyContent = null;
var Id = 0;

// edit the post
$('.edit-post').click(function(event){
	event.preventDefault();
	titleContent = $('.post-title').html();
	bodyContent = $('.post-body').html();
	Id = event.target.parentNode.dataset['postid'];
	$('#edit-post-title').val(titleContent);
//	$('#edit-post-body').val(bodyContent);
	tinymce.init({selector:'#edit-post-body'});
	tinymce.get('edit-post-body').setContent(bodyContent);
	$('#edit-post-modal').modal();
});

$('#edit-post').click(function(){
	$.ajax({
		url: editPostUrl,
		method: 'POST',
		data: {bodyContent:tinymce.get('edit-post-body').getContent(), titleContent:$('#edit-post-title').val(), _token:token , id:Id},
		success: function(){
			$('.post-title').html($('#edit-post-title').val());
			$('.post-body').html(tinymce.get('edit-post-body').getContent());
			$('#edit-post-modal').modal('hide');
		}
	});
});

// delete the post
$('.delete-post').click(function(event){
	event.preventDefault();
	Id = event.target.parentNode.dataset['postid'];
	console.log(Id);
	$('#post-delete-modal').modal();
});

$('#delete-post').click(function(){
	$.ajax({
		url:deletePostUrl,
		method:'GET',
		data:{id:Id},
		success:function(){
			$('#post-delete-modal').modal('hide');
			window.location.replace(homeUrl);
		}
	});
});

// edit the comment
var commentBody = null;
$('.edit-comment').click(function(event){
	event.preventDefault();
	bodyContent = $(event.target.parentNode.parentNode.parentNode).find('.comment-body').html();
	commentBody = $(event.target.parentNode.parentNode.parentNode).find('.comment-body');
	Id = event.target.parentNode.dataset['commentid'];
	console.log(Id);
	/*$('#edit-comment-body').val(bodyContent);*/
	tinymce.init({selector:'#edit-comment-body'});
	tinymce.get('edit-comment-body').setContent(bodyContent);
	$('#edit-comment-modal').modal();
});

$('#edit-comment').click(function(){
	$.ajax({
		url: editCommentUrl,
		method: 'POST',
		data: {bodyContent:tinymce.get('edit-comment-body').getContent(), _token:token , id:Id},
		success: function(){
			$(commentBody).html(tinymce.get('edit-comment-body').getContent());
			$('#edit-comment-modal').modal('hide');
		}
	});
});

// delete the comment
$('.delete-comment').click(function(event){
	event.preventDefault();
	Id = event.target.parentNode.dataset['commentid'];
	console.log(Id);
	$('#comment-delete-modal').modal();
});

$('#delete-comment').click(function(){
	$.ajax({
		url:deleteCommentUrl,
		method:'GET',
		data:{id:Id},
		success:function(){
			$('#comment-delete-modal').modal('hide');
			location.reload();
		}
	});
});
// /edit & delete the posts and the comments //

// /the posts and the comments //
