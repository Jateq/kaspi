function validateAmount() {
    var inputElement = document.getElementById('amount_dep');
    var minAmount = 1000;

    // Check if the entered value is less than the minimum
    if (inputElement.value < minAmount) {
        // If less than the minimum, set the value to the minimum
        inputElement.value = minAmount;
    }
}



function transferDepo(phone, amount, type){

    // Make an AJAX request to the transfer.php file
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'deposit_process.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            try {
                // Try to parse the JSON response
                var result = JSON.parse(xhr.responseText);
                console.log(result);
                // Handle the result
                if (result.success) {
                    alert('Успешно отправлено!');
                    location.reload()
                }else if(result === "Такой карты не существует"){
                    alert("Такой карты не существует")
                    location.reload();
                } else if(result==="Недостаточно средств"){
                    alert("Недостаточно средств");
                    location.reload();
                }
                else {
                    alert('Ошибка при выполнении операции ' + result.message);
                }
            } catch (e) {
                // If parsing fails, show an error
                alert('Ошибка: ' + xhr.responseText);
            }
        }
    };


    // Send the data to the server
    xhr.send('senderId=' + phone + '&type=' + type + '&amount=' + amount);


}

function showSection(sectionId) {
    // Hide all sections
    var sections = document.querySelectorAll('.right-container > div');
    sections.forEach(function (section) {
        section.style.display = 'none';
    });

    // Show the selected section
    var selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'flex';
    }
}