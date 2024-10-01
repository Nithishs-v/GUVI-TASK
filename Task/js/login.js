
$(document).ready(function()
{
    $("#login-form").submit(function(e)
    {

        e.preventDefault();

        // Retriving the username and password
        var username=$("input[id='username']").val();
        var password=$("input[id='password']").val();

        // alert(username);

        $.ajax({
            type: "GET",
            url: "http://localhost/Task/php/login.php",
            data: {
                username: $("input[id='username']").val(),
                password: $("input[id='password']").val(),
            },
            error: function(xhr, textStatus, errorThrown)
            {
                console.log(xhr.responseText);
            },
            success: function(response)
            {
                console.log(response);

                if(response=="true") {
                    localStorage.setItem("username", username);
                    localStorage.setItem("password", password);

                    // Redirect to the profile page
                    window.location.href="profile.html";
                }
                else {
                    alert("Invalid credentails");
                }

                
            }
        });

    });
})
