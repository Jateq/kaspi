function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

function saveAndClose() {
    // Ваш код для сохранения данных
    // ...

    // Закрываем модальное окно после сохранения
    closeModal();
}

window.onclick = function (event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function openPhoneModal() {
        document.getElementById('phoneModal').style.display = 'block';
    }

    function closePhoneModal() {
        document.getElementById('phoneModal').style.display = 'none';
    }

    function savePhoneAndClose() {
        // Ваш код для сохранения нового номера телефона
        var newPhoneNumber = document.getElementById('newPhoneNumber').value;
        // Дополнительные операции сохранения, если необходимо

        // Закрываем модальное окно после сохранения
        closePhoneModal();
        if (currentPhoneNumber === "ТЕКУЩИЙ_НОМЕР") {
            // Ваш код для сохранения нового номера телефона
            // Дополнительные операции сохранения, если необходимо

            // Закрываем модальное окно после сохранения
            closePhoneModal();
        } else {
            alert("Текущий номер телефона неверен");
        }
    }

    window.onclick = function (event) {
        var phoneModal = document.getElementById('phoneModal');
        if (event.target == phoneModal) {
            phoneModal.style.display = 'none';
        }
    }


    function openPhotoModal() {
        document.getElementById('photoModal').style.display = 'block';
    }

    function closePhotoModal() {
        document.getElementById('photoModal').style.display = 'none';
    }

function openPhoto() {
    document.getElementById('my_photo').style.display = 'block';
}

function closePhoto() {
    document.getElementById('my_photo').style.display = 'none';
}

    function uploadProfilePhoto() {
        // Ваш код для загрузки нового фото профиля
        var newProfilePhoto = document.getElementById('newProfilePhoto').files[0];
        // Дополнительные операции загрузки, если необходимо

        // Закрываем модальное окно после загрузки
        closePhotoModal();
    }

    window.onclick = function (event) {
        var photoModal = document.getElementById('photoModal');
        if (event.target == photoModal) {
            photoModal.style.display = 'none';
        }
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


document.getElementById('fileInput').addEventListener('change', function() {
    let fileInput = this;
    const selectButton = document.getElementById('uploadButton');
    const uploadedImage = document.getElementById('uploadedImage');
    const fileChoose = document.getElementById('fileChoose');
    let descriptionInput = document.createElement('input');

    uploadedImage.style.display = 'flex';

    uploadedImage.src = URL.createObjectURL(fileInput.files[0]);


    // Show the submit button
    document.getElementById('mySubmit').style.display = 'block';
    document.getElementById('mySubmit').style.marginLeft = '30px'


});
