// Function to display user profile
function displayProfile() {
    var username = localStorage.getItem("username");
    console.log(username);

    $.ajax({
        type: "GET",
        url: "http://localhost/Guvi/php/profile.php",
        data: {
            username: username
        },
        success: function(response) {
            var data = JSON.parse(response); // Ensure the response is parsed if not already
            console.log(data);

        
            document.getElementById("username").value = data.username || '';
            document.getElementById("phonenumber").value = data.phomnenumber || '';
            document.getElementById("dateofbirth").value = data.dateofbirth || '';
            document.getElementById("Age").value = data.Age || '';
            if (data.dob) document.getElementById("email").value = data.email;
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
    });
}

// Function to update user data
function updateData(e) {
    e.preventDefault();

    var name = $("input[id='name']").val();
    var number = $("input[id='number']").val();
    var dob = $("input[id='dob']").val();
    var age = $("input[id='age']").val();
    var password = $("input[id='password']").val();
    var email = $("input[id='email']").val();
   

    $.ajax({
        type: "POST", // Use POST method for sensitive data
        url: "http://localhost/Guvi/php/updateProfile.php",
        data: {
            name: name,
            lastname: lastname,
            username: username,
            password: password,
            email: email,
            phoneNumber: phoneNumber,
            dob: dob
        },
        success: function(data) {
            console.log(data);
            var statusBar = document.getElementById("status-bar");
            statusBar.classList.add("activate");
            setTimeout(function() {
                statusBar.classList.remove("activate");
            }, 1000);
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
    });
}

// Function to clear local storage
function clearStorage() {
    console.log("Cleared");

    // Clear the local storage data
    window.localStorage.clear();

    // Redirect to login page
    window.location.replace("./login.html");
}

// Function Controls 
window.onload = function() {
    displayProfile(); // Call function after page is fully loaded
    document.getElementById("profile-form").addEventListener("submit", updateData);
};


