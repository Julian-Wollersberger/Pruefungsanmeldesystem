
function sendToServer() {
    var username=document.getElementById("username").value
    var password=document.getElementById("password").value

    if(username==null||username==""){
        //future: set style to a red border @ username
        alert("username empty")
    }else if(password==null||password==""){
        //future: set style to a red border @ password
        alert("password empty")
    }else{
        alert("Logging in")
    }

}