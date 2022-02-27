
function allows()
{
    var selected = document.getElementById('agreement');
    var app = document.getElementById('capplication');
    
    if(selected.checked)
    {
        app.disabled=false;
    }
    else
    {
        app.disabled=true;
    }

}
function createapp()
{
    document.createElement("list");
}

function searchlist() {
    var input, filter;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    roles.filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
  }

  