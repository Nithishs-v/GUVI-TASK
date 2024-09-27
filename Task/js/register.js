console.log("Fnc Called");
$(document).ready(function()
{
    $("#register-form").submit(function(e)
    {
        e.preventDefault();

        var username=$("input[name='username']").val();
        var password=$("input[name='password']").val();
        // alert(username);
        $.ajax({
            url: "http://localhost/Guvi/php/register.php",
            method: "GET",
            data: {
                username: username,
                password: password,
            },
            success: function(data)
            {
                // alert(data);
                alert("User Successfully Registered")
                $("#register-form")[0].reset();
            },
            error: function(xhr, status, error)
            {
                console.log(xhr.responseText);
            },
        });

    });
});

function saveInMongo(e)
{
    e.preventDefault();

    var username=$("input[id='username']").val();
    var password=$("input[id='password']").val();
    var email=$("input[id='email']").val();


    $.ajax({
        type: "GET",
        url: "http://localhost/Guvi/php/mongodb.php",
        data: {
            username: username,
            password: password,
            email: email,
        
        },
        success: function(data)
        {
            console.log(data);
            var url="./login.html";
            window.location.href=url;
        },
        error: function(xhr, status, error)
        {
            console.log(error);
        },
    });
}

document.getElementById("register-form").addEventListener("submit", saveInMongo);

function storeData()
{

    // storing the current registered data in local storage
    let username, password, email;
    username=document.getElementById("username").value;
    password=document.getElementById("password").value;
    email=document.getElementById("email").value;


    localStorage.setItem("username", username)
    localStorage.setItem("password", password)
    localStorage.setItem("email", email)

}