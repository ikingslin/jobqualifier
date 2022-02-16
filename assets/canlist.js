
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

