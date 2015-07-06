<html>

<head>
	<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel='stylesheet' type='text/css' href='css/show.css'>
</head>


<body>

	<div class="container">
	<div class="row toggleRow">
		<div class="col-lg-12 text-right">
			<i data-type="boxFormat" class="fa fa-th-large fa-fw selected toggle"></i>
			<i data-type="tableFormat" class="fa fa-th-list fa-fw toggle"></i>&nbsp;&nbsp;&nbsp;
			<button type="button" class="btn btn-default btn-sm logout"  onClick="logout()">
				<span class="glyphicon glyphicon-log-out"></span> Log out
			</button>
		</div>
	</div>
	<div class="row text-center boxFormat contentStore" id="content">		
	</div>

	<div class="tableFormat contentStore">
	<table class="table table-hover">
    <thead>
      <tr>
        <th>Profile Picture</th>
        <th>Full Name</th>
		<th>Screen Name</th>
        <th>Unfollow</th>
      </tr>
    </thead>
    <tbody class='tableView'>
      <tr>
        <td class="profilePic"></td>
        <td class="fullName"></td>
        <td class="unfollowButton"></td>
      </tr>
      
    </tbody>
	</table>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>

	$(document).ready(function(){
		$.get("getFriends.php", function(data){
			var _html = "";
			var url;

			console.log(data);
			for(var i=0; i<data.length; i++){
				url = data[i]["profile_pic"].replace("400x400", "normal");
				sName = '@'+data[i]["screen_name"];
				
				_html += '<tr class="'+data[i]["_id"]+'">'
					+'<td class="profilePic"><a target="_blank" href="https://twitter.com/'+data[i].screen_name+'"><img src="'+url+'"></a> </td>'
					+'<td class="fullName"><span class=""><a target="_blank" href="https://twitter.com/'+data[i].screen_name+'">'+data[i].full_name+'</a> </span></td>'
					+'<td class=screenName><span class="">'+sName+'</span></td>'
					+'<td class="unfollowButton"><button class="btn btn-danger unfollow" data-id="'+data[i]._id+'">Unfollow</button></td>'
				+'</tr>'
			}
			$(".tableView").html(_html);
			
			_html="";
			for(var i=0; i<data.length; i++)
			{
				_html +='<div class="col-lg-2 tableForFriends '+data[i]["_id"]+'">'
				 +'<div class="row">'
					+'<div class="col-lg-12 profilePic">'
						+'<a target="_blank" href="https://twitter.com/'+data[i].screen_name+'"><img src="'+data[i].profile_pic+'"></a>'
					+'</div>'
				 +'</div>'
				 +'<div class="row">'
					+'<div class="col-lg-12 fullName text-center">'
						+'<span class=""><a target="_blank" href="https://twitter.com/'+data[i].screen_name+'">'+data[i].full_name+'</a></span>'
					+'</div>'
				 +'</div>'
				 +'<div class="row">'
					+'<div class="col-lg-12 unfollowButton text-center">'
						+'<button class="btn btn-danger unfollow" data-id="'+data[i]["_id"]+'">Unfollow</button>'
					+'</div>'
				 +'</div>'
				 
			+'</div>';

			}
			$("#content").html(_html);

			});
		
		$(document).on("click", ".unfollow", function(){
			var el = $(this);
			var id = $(this).data("id");
			console.log(id);
			$.get("unfollow.php?id="+id, function(data){
				if(data.status==true){
					$("."+id).slideUp(300);
				}
			});
		});
		
		$(".toggle").click(function(){
			$(".toggle").removeClass("selected");
			$(this).addClass("selected");
			if(!$("."+$(this).data("type")).hasClass("active"))
			{
				$(".contentStore").removeClass("active").slideUp(200);
				$("."+$(this).data("type")).addClass("active").delay(220).slideDown(300);
			}
		});
		
		$(".logout").click(function(){
			window.location.href = "logout.php";
		});
	});

</script>

</body>

</html>