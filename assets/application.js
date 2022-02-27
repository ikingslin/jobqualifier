
function allows()
{
    var selected = document.getElementById('agreement');
    var app = document.getElementById('capplication');
    var oapp = document.getElementById('oapplication');
    if(selected.checked)
    {
        app.disabled=false;
        oapp.disabled=false;
    }
    else
    {
        app.disabled=true;
        oapp.disabled=true;
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

  