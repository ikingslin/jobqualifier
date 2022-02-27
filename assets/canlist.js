
let rollist = document.getElementById('role');

var i = 0;
for(let x of roles)
{
    var option = document.createElement("option");
    option.text = x;
    option.value = rolid[i];
    option.className = "dropdown-item";
    rollist.add(option);
    i++;
}

var video = document.getElementById("player");

function stopVideo()
{
          //console.log("Reset");
         //document.location.href="http://localhost:8000/jobqualifier/admin/candidatelist.php";
         
          video.pause();
          //video.remove();
          //video.children('source').prop('src', '');
          //video.remove();
}

function credit()
{
     var fd = new FormData();
     var cred = document.getElementById('credits').value;
     fd.append('credit', cred);
     $.ajax({
		url: 'credit.php',
		type: 'POST',
		data: fd,
		processData: false,
		contentType: false
	}).done(function(datum) {
          //console.log(datum);
     });
}
function selectionitem()
{
     //console.log(sessionStorage.getItem("selitem"));
     if(sessionStorage.getItem("selitem"))
     {
          var setitem = document.querySelector('#role');
          setitem.value = sessionStorage.getItem("selitem");
     }
}
function selection()
{
     if(sessionStorage.getItem("seitem"))
     {
          //console.log(sessionStorage.getItem("selitem"));
          var setitem = document.querySelector('#role');
          setitem.value = sessionStorage.getItem("seitem");
     }
}

function finalitem()
{
     if(sessionStorage.getItem("finalitem"))
     {
          var setitem = document.querySelector('#role');
          setitem.value = sessionStorage.getItem("finalitem");
     }
}