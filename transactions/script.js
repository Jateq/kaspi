function filterElements() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const elements = document.querySelectorAll('.elements-div');

    elements.forEach(element => {
        const text = element.querySelector('p').innerText.toLowerCase();
        if (text.includes(filter)) {
            element.style.display = 'flex';
        } else {
            element.style.display = 'none';
        }
    });
}


document.addEventListener('DOMContentLoaded', function() {
    var labels = document.querySelectorAll('.navbar-title');
    var tooltips = document.querySelectorAll('.tooltip-content');
    var timers = {};

    labels.forEach(function(label, index) {
        var tooltip = tooltips[index];
        var labelId = label.id;

        label.addEventListener('mouseenter', function() {
            clearTimeout(timers[labelId]);
            closeAllTooltips();
            tooltip.style.display = 'block';
        });

        label.addEventListener('mouseleave', function() {
            startCloseTimer(labelId);
        });

        tooltip.addEventListener('mouseenter', function() {
            clearTimeout(timers[labelId]);
        });

        tooltip.addEventListener('mouseleave', function() {
            startCloseTimer(labelId);
        });
    });

    function startCloseTimer(id) {
        timers[id] = setTimeout(function() {
            closeAllTooltips();
        }, 200);
    }

    function closeAllTooltips() {
        tooltips.forEach(function(tooltip) {
            tooltip.style.display = 'none';
        });
    }
});


    const elements = document.querySelectorAll('.elements-div');
    const displayingDiv = document.querySelector('.displaying div');

    elements.forEach(element => {
    element.addEventListener('click', () => {
        const elementContent = element.querySelector('p').innerText;
        displayingDiv.innerText = `Selected Element: ${elementContent}`;
    });
});


function showTabContent(tab) {

    // Remove "active" class from all tabs
    const tabs = document.querySelectorAll('.tab div');
    tabs.forEach(t => t.classList.remove('active'));

    // Add "active" class to the clicked tab
    tab.classList.add('active');

    // Hide all content divs
    const contentDivs = document.querySelectorAll('.elements, .history-content');
    contentDivs.forEach(div => (div.style.display = 'none'));

    // Show the corresponding content based on the clicked tab
    if (tab.innerText === 'Мои переводы') {
        document.querySelector('.elements').style.display = 'flex';
    } else if (tab.innerText === 'История') {
        document.querySelector('.history-content').style.display = 'flex';
    }
}

function updateDestination(selectId) {
    var sourceSelect = document.getElementById("source");
    var destinationSelect = document.getElementById("destination");

    // Get the selected value from the triggering select
    var selectedValue = sourceSelect.options[sourceSelect.selectedIndex].value;
    var destinationValue = destinationSelect.options[destinationSelect.selectedIndex].value;

    // Update the destination select based on the selected value
    if (selectId === "source") {
        if (selectedValue === "gold") {
            destinationSelect.value = "deposit";
        } else if (selectedValue === "deposit") {
            destinationSelect.value = "gold";
        }
    } else if (selectId === "destination") {
        if (destinationValue === "gold") {
            sourceSelect.value = "deposit";
        } else if (destinationValue === "deposit") {
            sourceSelect.value = "gold";
        }
    }
}

function showPlusSeven() {
    var phoneInput = document.getElementById('phone');
    if (!phoneInput.value.startsWith('+7')) {
        phoneInput.value = '+7' + phoneInput.value;
    }

    if (phoneInput.value.length === 12) {
        phoneInput.blur();
    }

    if (phoneInput.value.length > 12){
        alert("Напишите номер в формате +77000700707")
        location.reload()
    }



    var checkUserButton = document.getElementById('checkUserButton');
    if (phoneInput.value.length === 12) {
        checkUserButton.click();
    }

}

let receiver

function getUserByPhone() {
    var phoneNumber = encodeURIComponent(document.getElementById('phone').value);


    // Check if the phone number is not empty
    if (phoneNumber.trim() !== "") {
        // Create an AJAX object
        var xhr = new XMLHttpRequest();

        // Configure it: GET-request for the specified URL
        xhr.open('GET', 'getUserByPhone.php?phone=' + phoneNumber, true);
        // Send the request
        xhr.send();

        // This will be called after the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parse the JSON response
                var user = JSON.parse(xhr.responseText);

                if (user === 'error'){
                    alert("Вы не можете отправить себе")
                    location.reload()
                }
                var userDetails = document.getElementById('userDetails');
                userDetails.style.display = 'flex';

                // Set the user details
                receiver = user.phone;
                userDetails.innerHTML = user ? user.name + ' ' + user.surname : "Такого пользователя не существует";
                if (user) {
                    userDetails.innerHTML += "<br><p style='font-size: 15px; margin: 5px 0 0 0; font-weight: normal'>Деньги поступят на карту Kaspi Gold</p>";
                }
            }
        };
    }
}

<!-- Add this script to your HTML file -->
    function transferMoney(sender) {
        var senderId = '+' + sender
        var receiverId = receiver
        var amount = document.getElementById('amount').value;


        console.log(senderId, receiverId, amount)
        // Make an AJAX request to the transfer.php file
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'transfer.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                try {
                    // Try to parse the JSON response
                    var result = JSON.parse(xhr.responseText);

                    // Handle the result
                    if (result.success) {
                        alert('Успешно отправлено!');
                        location.reload()
                    } else {
                        alert('Ошибка при выполнении операции ' + result.message);
                    }
                } catch (e) {
                    // If parsing fails, show an error
                    alert('Ошибка: ' + xhr.responseText);
                }
            }
        };


        // Send the data to the server
    xhr.send('senderId=' + senderId + '&receiverId=' + receiverId + '&amount=' + amount);
}

