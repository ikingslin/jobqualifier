
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
    
}