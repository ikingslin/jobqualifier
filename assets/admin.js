function validate(a)
{
    if(a)
    {
        document.getElementById('error').innerHTML = "";
    }
    else
    {
        document.getElementById('error').innerHTML = "Invalid Credentials";
    }

}