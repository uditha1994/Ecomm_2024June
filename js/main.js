function userReg() {
    // Get the form data
    const form = document.getElementById('regform');
    const formData = {
        email: form.email.value,
        firstname: form.fname.value,
        lastname: form.lname.value,
        contact: form.contact.value,
        address1: form.address1.value,
        address2: form.address2.value,
        address3: form.address3.value,
        dob: form.dob.value
    };

    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "controllers/User_Reg_Conroller.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Define a function to handle the server response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Parse and handle the JSON response
            try {
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
                if (response.status === 200) {
                    // Redirect if registration is successful
                    window.location.href = "./login.php";
                }
            } catch (error) {
                // Log and display any errors during JSON parsing
                console.error("Error parsing response:", error);
                console.error("Raw response:", xhr.responseText);
                alert("An error occurred. Please try again.");
            }
        }
    };

    // Send the form data as a JSON string
    xhr.send(JSON.stringify(formData));
}

function userLogin(){
    // Get the form data
    const form = document.getElementById('loginForm');
    const formData = {
        email: form.email.value,
        password: form.password.value
    };

    const xhr = new XMLHttpRequest();
    xhr.open("POST","controllers/User_Login_Controller.php",true);
    xhr.setRequestHeader("Content-Type","application/json;charset=UTF-8");

    // Define a function to handle the server response
    xhr.onreadystatechange = function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            // Parse and handle the JSON response
            try{
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
                if(response.status === 200){
                    // Redirect if login is successful
                    window.location.href = "./index.php";
                }
            }catch(error){
                // Log and display any errors during JSON parsing
                console.error("Error parsing response:",error);
                console.error("Raw response:",xhr.responseText);
                alert("An error occurred. Please try again.");
            }
        }
    }

    // Send the form data as a JSON string
    xhr.send(JSON.stringify(formData));
}

function registerProduct(){
    const form = document.getElementById('productForm');

    const formData = {
        product_name: form.product_name.value,
        product_code: form.product_code.value,
        manufacturer: form.manufacturer.value,
        category: form.category.value,
        price: form.price.value,
        stock_quantity: form.stock_quantity.value
    };

    const xhr = new XMLHttpRequest();
    xhr.open("POST","controllers/Product_Reg_Controller.php",true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onreadystatechange = function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            try{
                const response = JSON.parse(xhr.responseText);
                alert(response.message);
                if(response.status === 200){
                    window.location.href = "./index.php";
                }
            }catch(error){
                console.error("Error parsing response:",error);
                console.error("Raw response:",xhr.responseText);
                alert("An error occurred. Please try again.");
            }
        }
    };

    xhr.send(JSON.stringify(formData));
}
