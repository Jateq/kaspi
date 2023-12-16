<?php

session_start ();
if(!isset($_SESSION["login"])) {
    header("location:../auth/login.html");
    exit();
}

include "../user.php";

$users = getAllUsers();

$phone = $_SESSION['phone']; // Replace with the actual phone number
$user = getUserByPhone($phone);

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
<body class="body-pl">
<div>
    <div class="block">
        <div>
            <a class="home" href="../main/index1.html">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
            </a>

            <h6>Переводы</h6>
        </div>
        <div class="tab">
            <div class="active" onclick="showTabContent(this)">Мои переводы</div>
            <div onclick="showTabContent(this)">История</div>
        </div>


<!--        show this if first one active-->
        <div class="elements">
            <div class="elements-div">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M280-160 80-360l200-200 56 57-103 103h287v80H233l103 103-56 57Zm400-240-56-57 103-103H440v-80h287L624-743l56-57 200 200-200 200Z"/></svg>
                <p>Между своими счетами</p>
            </div>

            <div class="elements-div">

                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                <p>Клиенту каспи</p>
            </div>

            <div class="elements-div">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/></svg>
                <p>Карта другого банка</p>
            </div>

            <div class="elements-div">

                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z"/></svg>
                <p>Международные переводы</p>
            </div>

            <div class="elements-div">

                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M80-680v-200h200v80H160v120H80Zm0 600v-200h80v120h120v80H80Zm600 0v-80h120v-120h80v200H680Zm120-600v-120H680v-80h200v200h-80ZM700-260h60v60h-60v-60Zm0-120h60v60h-60v-60Zm-60 60h60v60h-60v-60Zm-60 60h60v60h-60v-60Zm-60-60h60v60h-60v-60Zm120-120h60v60h-60v-60Zm-60 60h60v60h-60v-60Zm-60-60h60v60h-60v-60Zm240-320v240H520v-240h240ZM440-440v240H200v-240h240Zm0-320v240H200v-240h240Zm-60 500v-120H260v120h120Zm0-320v-120H260v120h120Zm320 0v-120H580v120h120Z"/></svg>
                <p>Kaspi QR</p>
            </div>




        </div>

        <div class="history-content">

            <div>
                <p class="smaller">Вы еще не совершали никакие переводы</p>
            </div>
        </div>
    </div>

        <div class="displaying">

                <div id="default" style="display: none">
                    <img src="images/logo.png" alt="logo">
                    <h5>Выберите действие</h5>
                </div>

            <div id="first">
                <select id="source" name="source" class="select-placeholder" onchange="updateDestination('source')">
                    <option value="" disabled selected>Откуда</option>
                    <option value="gold">Kaspi Gold <?php echo $user["amount_money"] ?>KZT </option>
                    <option value="deposit">Deposit</option>
                </select>

                <select id="destination" name="destination" class="select-placeholder" onchange="updateDestination('destination')">
                    <option value="" disabled selected>Куда</option>
                    <option value="gold">Kaspi Gold</option>
                    <option value="deposit">Deposit</option>
                </select>
            </div>



            <div>

        </div>
    </div>



</div>
</body>
</html>
