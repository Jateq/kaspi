function showPlusSeven() {
    var phoneInput = document.getElementById('phone');
    if (!phoneInput.value.startsWith('+7')) {
        phoneInput.value = '+7' + phoneInput.value;
    }
}