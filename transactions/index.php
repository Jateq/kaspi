<?php

session_start ();
if(!isset($_SESSION["login"])) {
    header("location:../auth/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaspi.kz</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>


<div>
    <img src="images/plateji.png">
</div>
<button>Оплатить услуги</button>

<div style="margin-top: 120px"></div>
<p>Преимущества платежей с Kaspi.kz</p>
<div>
    <img src="images/opl.png">
</div>

<p>Уже более 10 000 услуг</p>

<div>
    <img src="images/plo.png">
</div>

<p>Популярные вопросы</p>

<div style="display: flex; flex-direction: column; gap: 30px">

    <div class="info" id="info1" onclick="toggleDescription(this)">
        <div class="info-vis">
            <p>Как в Платежах на Kaspi.kz найти услугу, которую хочу оплатить?</p>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path fill="#f24634" d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                </svg>
            </div>
        </div>

        <div class="info-description">
            <p class="info-text">Просто введите необходимую услугу или название поставщика услуги в строку поиска в сервисе «Платежи».
                Напечатать название услуги можно как на латинице, так и на кириллице.
            </p>
        </div>
    </div>

    <div class="info" id="info2" onclick="toggleDescription(this)">
        <div class="info-vis">
            <p>Что можно делать в мобильном приложении Kaspi.kz?</p>
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path fill="#f24634" d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                </svg>
            </div>
        </div>

        <div class="info-description">
            <p class="info-text">В мобильном приложении Kaspi.kz возможно без комиссии пополнять баланс мобильного, оплачивать счёта за коммуналку, Казахтелеком, детский садик, штрафы ПДД и ещё более 10 000 различных услуг по всему Казахстану.
                Также вы можете смотреть информацию по своим депозитам и кредитам и делать переводы между своими счетами, не приходя в отделение Kaspi.kz.
            </p>
        </div>


    </div>

        <div class="info" id="info3" onclick="toggleDescription(this)">
            <div class="info-vis">
                <p>Как быстро пройдет мой платёж на Kaspi.kz?</p>
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path fill="#f24634" d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </div>
            </div>

            <div class="info-description">
                <p class="info-text">В пользу большинства поставщиков услуг платёж доходит в течение 1 минуты.
                    Только в некоторых исключительных случаях с региональными коммунальными компаниями, платежи проходят в течение суток.
                    В таких случаях рекомендуем вам оплачивать коммунальные платежи заранее.
                </p>
            </div>

        </div>


    </div>



    <footer>
        <div>
            <p>Kazakhstan</p>
            <p>&copy; 2023 Kaspi </p>
        </div>
    </footer>

</div>


<script>
    function toggleDescription(info) {
        const description = info.querySelector('.info-description');
        const icon = info.querySelector('.icon');

        if (description.style.display === 'none' || description.style.display === '') {
            // Hide all descriptions and reset rotations
            document.querySelectorAll('.info-description').forEach(desc => desc.style.display = 'none');
            document.querySelectorAll('.icon').forEach(ic => ic.classList.remove('rotate'));

            // Show the clicked description and rotate the clicked icon
            description.style.display = 'block';
            icon.classList.add('rotate');
        } else {
            // Hide the clicked description and reset rotation
            description.style.display = 'none';
            icon.classList.remove('rotate');
        }
    }
</script>

</body>
</html>
