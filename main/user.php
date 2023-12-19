<?php
include '../user.php';
session_start ();
if(!isset($_SESSION["login"])) {
    header("location:../auth/login.html");
    exit();
}

$user = getUserByPhone($_SESSION['phone']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kaspi user</title>

	<!-- Bootstrap reboot (для сброса стилей) -->
	<link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap-reboot.min.css">

	<!-- Bootstrap сетка -->
	<link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap-grid.min.css">

	<!-- Шрифты с Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">

	<!-- Стили сайта -->
	<link rel="stylesheet" href="styleuser.css">
    <script src="scriptuser.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body>

<nav class="navbar">
    <div class="container">
        <a href="index1.html" class="navbar-brand">
            <svg width="141" height="33" viewBox="0 0 141 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.7475 17.6513C19.6113 18.0934 19.9984 19.7879 20.2299 21.365L20.2685 21.6339L20.2948 21.8169L20.4342 22.745C20.707 24.5171 21.2762 28.1955 21.2762 30.115C21.2762 30.5947 21.234 30.9629 21.1569 31.1652C21.0284 31.477 20.654 31.7762 20.137 32.0256C18.8861 32.3335 17.5786 32.5 16.2318 32.5C16.0892 32.5 15.9489 32.4931 15.8081 32.4889C15.2638 32.3343 14.8547 32.0762 14.6381 31.7235C13.9841 30.6589 13.9447 28.287 13.9316 25.5152L13.9301 25.1937L13.9248 24.3629C13.9035 21.4286 13.8852 18.8986 14.9513 17.9907C15.3642 17.6415 15.9509 17.5259 16.7475 17.6513ZM10.5037 24.0398C11.1243 24.0049 11.5234 27.0574 11.6036 29.3721C11.6598 30.9836 11.4906 31.6465 11.2204 31.8845C10.9145 31.7824 10.6139 31.6719 10.3177 31.5519C10.1201 31.1928 9.96907 30.628 9.87312 29.8882C9.58018 27.5633 9.83465 24.0808 10.5037 24.0398ZM26.0622 28.6014C26.0235 28.8134 25.9689 28.9772 25.9016 29.1154C25.371 29.5412 24.8133 29.9321 24.2297 30.2838C24.0438 30.3151 23.8787 30.2933 23.798 30.1569C23.0245 28.7978 22.7342 24.5342 23.4827 24.1631C24.4586 23.6917 26.2069 27.8643 26.0622 28.6014ZM16.0008 0.5C24.7145 0.5 31.8006 7.40062 31.996 15.9873L32 16.2841V16.4213C31.984 20.3 30.5566 23.8486 28.205 26.5952C28.1197 26.5524 27.9641 26.4123 27.6822 25.9906C27.3905 25.5667 24.8749 21.6953 24.8749 17.2581C24.8749 16.3873 26.1301 15.027 27.2408 13.833C28.0711 12.9345 28.8576 12.087 29.1472 11.4209C29.5161 10.5614 29.258 9.96125 28.8498 9.75782C28.4803 9.57703 27.9256 9.7089 27.5363 10.4003C26.8975 11.5193 26.6928 11.7284 25.761 12.4771C24.8441 13.2254 23.3864 13.9787 23.3864 13.0036C23.3864 12.4771 24.1983 11.2847 24.5994 10.4489C25.009 9.60377 24.5675 8.99196 23.7217 8.99196C22.0608 8.99196 20.9583 11.1077 20.9583 11.8407C20.9583 12.5731 21.3136 12.6774 21.3136 13.5303C21.3136 14.3896 19.4913 15.5042 17.7747 15.5042C16.122 15.5042 15.1636 15.1697 14.7665 14.2273L14.7158 14.095L14.601 13.7554C14.1938 12.5653 13.9017 11.7022 13.3932 10.8002C13.1232 10.3232 12.7066 9.99252 12.3463 9.70156C11.8754 9.33579 11.6311 8.99901 11.5801 8.74784C11.5331 8.49865 11.5078 8.02904 12.3128 6.9465C13.1161 5.87014 13.2287 5.057 12.8267 4.63743C12.681 4.48817 12.4326 4.39254 12.1136 4.39254C11.5494 4.39254 10.7654 4.69149 9.95745 5.51265C8.7015 6.7996 9.41451 8.02149 9.41451 8.55788C9.41451 9.09392 9.18442 9.39713 8.43071 10.1264C7.67148 10.8589 7.40945 11.4869 7.32262 14.0109C7.28935 15.3114 7.06031 16.06 6.85471 16.7238C6.67705 17.3056 6.51366 17.8526 6.50483 18.6429C6.49076 19.5187 6.63654 20.0831 6.80666 20.7343C6.97369 21.3362 7.15109 22.0259 7.26475 23.1796C7.44553 24.9655 7.38268 26.4741 7.054 28.016L6.96628 28.4023L6.94578 28.5133C6.87847 28.7843 6.79846 29.1134 6.69031 29.2367C2.64076 26.3604 0 21.663 0 16.3531C0 7.59843 7.1635 0.5 16.0008 0.5Z" fill="#F14635"/>
                <path d="M93.1086 11.4708C94.6917 11.4708 95.9225 12.0314 96.8012 13.1526C97.6797 14.2738 98.1189 15.815 98.1189 17.7761V17.9586C98.1189 19.8741 97.6698 21.4039 96.7715 22.5479C95.8729 23.6919 94.66 24.2639 93.1323 24.2639C91.953 24.2639 90.9833 23.8496 90.2234 23.0211V29.2461H86.2224V11.6989H89.9623L90.0811 12.8391C90.8488 11.9269 91.858 11.4708 93.1086 11.4708ZM65.2084 11.4708C66.8468 11.4708 68.1409 11.8547 69.0908 12.6224C70.0406 13.3902 70.5274 14.443 70.5511 15.7808V21.2424C70.567 22.375 70.749 23.2415 71.0973 23.842V24.0359H67.0961C66.9537 23.785 66.827 23.4164 66.7162 22.9299C65.9801 23.8192 64.9511 24.2639 63.6293 24.2639C62.4182 24.2639 61.3893 23.9123 60.5423 23.2092C59.6954 22.5061 59.2719 21.6224 59.2719 20.5582C59.2719 19.2204 59.7864 18.2094 60.8154 17.5253C61.8444 16.8412 63.3404 16.4991 65.3033 16.4991H66.5381V15.8492C66.5381 14.7166 66.0276 14.1503 65.0065 14.1503C64.0567 14.1503 63.5818 14.5988 63.5818 15.4957H59.5806C59.5806 14.3023 60.1089 13.3332 61.1657 12.5882C62.2223 11.8433 63.5699 11.4708 65.2084 11.4708ZM78.2325 11.4708C79.9262 11.4708 81.2876 11.8395 82.3166 12.5768C83.3457 13.3142 83.8601 14.2833 83.8601 15.4843H79.8472C79.8472 14.4962 79.3049 14.0021 78.2206 14.0021C77.801 14.0021 77.4488 14.1142 77.1639 14.3384C76.8789 14.5627 76.7364 14.842 76.7364 15.1765C76.7364 15.5186 76.9106 15.796 77.2588 16.0088C77.6071 16.2217 78.1631 16.3965 78.9269 16.5333C79.6907 16.6702 80.3616 16.8336 80.9395 17.0236C82.8708 17.6621 83.8363 18.8061 83.8363 20.4556C83.8363 21.5806 83.316 22.4966 82.2751 23.2035C81.2342 23.9104 79.8867 24.2639 78.2325 24.2639C77.1322 24.2639 76.1507 24.0739 75.288 23.6938C74.4252 23.3137 73.7524 22.7968 73.2695 22.1431C72.7867 21.4894 72.5453 20.8015 72.5453 20.0794H76.2853C76.3011 20.6494 76.4989 21.0656 76.8789 21.3279C77.2588 21.5901 77.7455 21.7212 78.3392 21.7212C78.8853 21.7212 79.2951 21.6148 79.5681 21.402C79.8412 21.1891 79.9776 20.9117 79.9776 20.5696C79.9776 20.2428 79.7997 19.9805 79.4434 19.7829C79.0872 19.5853 78.4104 19.38 77.4132 19.1672C76.4159 18.9544 75.5927 18.675 74.9436 18.3291C74.2946 17.9833 73.7999 17.5633 73.4595 17.0692C73.1192 16.5751 72.949 16.0088 72.949 15.3703C72.949 14.2377 73.4358 13.3047 74.4093 12.5711C75.3829 11.8376 76.6573 11.4708 78.2325 11.4708ZM48.1713 6.50049V14.7546L53.8342 6.50049H58.987L52.6592 14.7774L58.5007 24.0359H53.5616L49.881 17.856L48.1713 19.6575V24.0359H44.0039V6.50049H48.1713ZM104.589 11.6989V24.0359H100.576V11.6989H104.589ZM139.873 11.6989V13.774L134.151 21.0713H140.004V24.0359H129.093V21.8923L134.792 14.6634H128.078L130.752 11.6989H139.873ZM109.954 20.0563C111.049 20.0563 111.935 20.9112 111.935 21.9659C111.935 23.0205 111.049 23.8755 109.954 23.8755C108.86 23.8755 107.973 23.0205 107.973 21.9659C107.973 20.9112 108.86 20.0563 109.954 20.0563ZM119.246 6.5V15.7139L119.65 15.2058L122.674 11.6376H127.483L122.972 16.6624L127.781 23.8551H123.186L120.377 19.3046L119.246 20.3773V23.8551H115.234V6.5H119.246ZM66.5381 18.5515H65.3746C63.9815 18.5515 63.285 19.152 63.285 20.353C63.285 20.7027 63.4076 20.9858 63.653 21.2025C63.8984 21.4191 64.211 21.5274 64.591 21.5274C65.0896 21.5274 65.5032 21.4248 65.8317 21.2196C66.1602 21.0143 66.3956 20.7825 66.5381 20.524V18.5515ZM92.1232 14.4354C91.1734 14.4354 90.54 14.7622 90.2234 15.4159V20.2732C90.5717 20.9573 91.2129 21.2994 92.1469 21.2994C93.4213 21.2994 94.0782 20.2428 94.1177 18.1296V17.7191C94.1177 15.53 93.453 14.4354 92.1232 14.4354ZM102.637 6.5C103.731 6.5 104.618 7.39564 104.618 8.5005C104.618 9.60536 103.731 10.501 102.637 10.501C101.543 10.501 100.656 9.60536 100.656 8.5005C100.656 7.39564 101.543 6.5 102.637 6.5Z" fill="black"/>
            </svg>
        </a>

        <div class="navbar-wrap">
            <ul class="navbar-menu">
                <li>
                    <div id="clientLabel" class="navbar-title">Клиентам</div>
                    <div id="clientTooltip" class="tooltip-content">
                        <div class="tooltip-inner">
                            <ul class="tooltip-ul">
                                <li style="font-weight:bold; font-size: 17px;">Продукты Kaspi.kz</li>
                                <li>Kaspi Gold</li>
                                <li>Kaspi Gold для ребенка</li>
                                <li>Kaspi Red</li>
                                <li>Kaspi Депозит</li>
                                <li>Кредит на Покупки</li>
                                <li>Кредит для ИП</li>
                            </ul>
                            <ul  class="tooltip-ul">
                                <li style="font-weight:bold; font-size: 17px;">Сервисы Kaspi.kz</li>
                                <li>Магазин</li>
                                <li>Travel</li>
                                <li><a href=../transactions/index.php>Платежи</a></li>
                                <li><a href="#">Мой банк</a></li>
                                <li><a href="../transactions/perevody.php">Переводы</a></li>
                                <li>Акции</li>
                                <li>Госуслуги</li>
                                <li>Объявления</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <div id="businessLabel" class="navbar-title">Бизнесу</div>
                    <div id="businessTooltip" class="tooltip-content">
                        <div class="tooltip-inner">
                            <ul class="tooltip-ul">
                                <li>Kaspi Pay</li>
                                <li>Бизнес Кредит</li>
                                <li>Кредит для ИП</li>
                            </ul>
                            <ul class="tooltip-ul">
                                <li>Продавать в Интернет-магазине
                                    <br>
                                    на Kaspi.kz
                                </li>
                                <li>Принимать платежи с Kaspi.kz</li>
                                <li>Kaspi Гид</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <div id="guideLabel" class="navbar-title">Kaspi Гид</div>
                    <div id="guideTooltip" class="tooltip-content">
                        <div class="tooltip-inner">
                            <ul class="tooltip-ul">
                                <li >Клиентам</li>
                                <li>Бизнесу</li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <a href="user.php" class="navbar-user">Профиль</a>
    </div>
</nav>
    <div class="container">
        <div>
        <div class="profile-container">
            <a onclick="openPhoto()"><img src="users/<?php echo $user['user_image']?>" alt="<?php echo $user['user_image']?>" class="profile-image" width="40" height="40"></a>
            <a class="change-photo" onclick="openPhotoModal()">Изменить фото</a>
        </div>
        <div id="photoModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closePhotoModal()">&times;</span>
                <!-- Ваши формы или содержимое модального окна -->
                <h2>Сменить фото профиля</h2>
                <form id="uploadForm"
                      action="upload_image.php"
                      method="post"
                      enctype="multipart/form-data">
                    <img id="uploadedImage" src="#" alt="Uploaded Image" style="display: none;">
                    <input type="file" id="fileInput" name="my_image" required>
                    <button type="submit"
                            id="mySubmit"
                            name="submit"
                            style="display: none;"
                            value="Upload">Загрузить</button>                </form>
            </div>


        </div>
            <div id="my_photo" class="modal" style="display: none">
                <div class="modal-content">
                    <span class="close" onclick="closePhoto()">&times;</span>

                    <img style="width: 80%; height: auto" src="users/<?php echo $user['user_image']?>" alt="user_image">
                </div>
            </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <!-- Ваши формы или содержимое модального окна -->
                <h2>Изменить пароль</h2>
                <form action="change_password.php" method="post">
                    <label for="currentPassword">Текущий пароль:</label>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                    <br>
                    <br>
                    <label for="newPassword">Новый пароль:</label>
                    <input type="password" id="newPassword" name="newPassword" required>
                    
                    <label for="confirmPassword">Подтвердите пароль:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <br>
                    <button type="submit">Сохранить</button>
                </form>
            </div>
        </div>
        <div id="phoneModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closePhoneModal()">&times;</span>
                <!-- Ваши формы или содержимое модального окна -->
                <h2>Изменить номер телефона</h2>
                <form action="change_phone.php" method="post">
                    <label for="currentPhoneNumber">Текущий номер телефона:</label>
                    <input type="tel" id="currentPhoneNumber" name="currentPhoneNumber" pattern="^\+7\d{10}$" placeholder="8XXXXXXXXXX" required>
                    <br>
                    <br>
                    <!-- Добавлено поле для ввода нового номера телефона -->
                    <label for="newPhoneNumber">Новый номер телефона:</label>
                    <input type="tel" id="newPhoneNumber" name="newPhoneNumber" pattern="^\+7\d{10}$" placeholder="8XXXXXXXXXX" required>
                    <br>
                    <!-- Добавлено немного отступа между полями -->
                    <button type="submit">Сохранить</button>
                </form>

            </div>
        </div>
        
        <div class="nav-bar">
            <a href="index1.html" class="nav-item">Главная</a>
            <a href="../mybank/index.php" class="nav-item">Мой банк</a>
            <a href="../transactions/plateji.php" class="nav-item">Платежи</a>
            <a href="../transactions/perevody.php" class="nav-item">Переводы</a>
            <a class="nav-item" onclick="openModal()">Изменить пароль</a>
            <a class="nav-item" onclick="openPhoneModal()">Изменить номер телефона</a>

            <a href="../settings/logout.php" class="logout-button">Выйти</a>
        </div>
        </div>

        <div class="content">
            <h2>Основная информация</h2>
            <table class="table table-th-block">
                <tbody>
                <tr><td class="active">Фамилия:</td><td><?php echo $user['surname']?></td></tr>
                <tr><td class="active">Имя:</td><td><?php echo $user['name']?></td></tr>
                <tr><td class="active">Город:</td><td>Алматы</td></tr>
                <tr><td class="active">Дата создания:</td><td><?php echo $user['created_at']?></td></tr>
                <tr><td class="active">Номер телефона:</td><td><?php echo $user['phone']?></td></tr>
                </tbody>
            </table>
        </div>
    </div>



</body>
</html>