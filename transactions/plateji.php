<?php
include "../user.php";
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
<body class="body-pl">
<div>
<div class="block">
    <div>
        <a class="home" href="../main/index1.html">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
        </a>

        <h6>Платежи</h6>
    </div>
    <div class="tab">
        <div class="active" onclick="showTabContent(this)">Мои переводы</div>
        <div onclick="showTabContent(this)">История</div>
    </div>
    <div class="my_search">
        <svg xmlns="http://www.w3.org/2000/svg" height="24"   viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
        <input id="searchInput" placeholder="Search" oninput="filterElements()">
    </div>
    <div class="elements">
        <div class="elements-div" onclick="showSection('mobilnyi')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M280-40q-33 0-56.5-23.5T200-120v-720q0-33 23.5-56.5T280-920h400q33 0 56.5 23.5T760-840v720q0 33-23.5 56.5T680-40H280Zm0-200v120h400v-120H280Zm200 100q17 0 28.5-11.5T520-180q0-17-11.5-28.5T480-220q-17 0-28.5 11.5T440-180q0 17 11.5 28.5T480-140ZM280-320h400v-400H280v400Zm0-480h400v-40H280v40Zm0 560v120-120Zm0-560v-40 40Z"/></svg>
            <p>Мобильный</p>
        </div>

        <div class="elements-div" onclick="showSection('komunalka')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M120-120v-560h160v-160h400v320h160v400H520v-160h-80v160H120Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm160 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z"/></svg>
            <p>Коммунальные услуги</p>
        </div>

        <div class="elements-div" onclick="showSection('transport')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M240-120q-17 0-28.5-11.5T200-160v-82q-18-20-29-44.5T160-340v-380q0-83 77-121.5T480-880q172 0 246 37t74 123v380q0 29-11 53.5T760-242v82q0 17-11.5 28.5T720-120h-40q-17 0-28.5-11.5T640-160v-40H320v40q0 17-11.5 28.5T280-120h-40Zm242-640h224-448 224Zm158 280H240h480-80Zm-400-80h480v-120H240v120Zm100 240q25 0 42.5-17.5T400-380q0-25-17.5-42.5T340-440q-25 0-42.5 17.5T280-380q0 25 17.5 42.5T340-320Zm280 0q25 0 42.5-17.5T680-380q0-25-17.5-42.5T620-440q-25 0-42.5 17.5T560-380q0 25 17.5 42.5T620-320ZM258-760h448q-15-17-64.5-28.5T482-800q-107 0-156.5 12.5T258-760Zm62 480h320q33 0 56.5-23.5T720-360v-120H240v120q0 33 23.5 56.5T320-280Z"/></svg>
            <p>Транспорт</p>
        </div>

        <div class="elements-div" onclick="showSection('internet')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M80-160v-120h80v-440q0-33 23.5-56.5T240-800h600v80H240v440h240v120H80Zm520 0q-17 0-28.5-11.5T560-200v-400q0-17 11.5-28.5T600-640h240q17 0 28.5 11.5T880-600v400q0 17-11.5 28.5T840-160H600Zm40-120h160v-280H640v280Zm0 0h160-160Z"/></svg>
            <p>Интернет и ТВ</p>
        </div>

        <div class="elements-div" onclick="showSection('obraz')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg>
            <p>Образование</p>
        </div>

        <div class="elements-div" onclick="showSection('shtraf')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M200-280v-280h80v280h-80Zm240 0v-280h80v280h-80ZM80-120v-80h800v80H80Zm600-160v-280h80v280h-80ZM80-640v-80l400-200 400 200v80H80Zm178-80h444-444Zm0 0h444L480-830 258-720Z"/></svg>
            <p>Штрафы и налоги</p>
        </div>

        <div class="elements-div" onclick="showSection('finan')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>
            <p>Финансовые услуги</p>
        </div>

        <div class="elements-div" onclick="showSection('blago')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M640-440 474-602q-31-30-52.5-66.5T400-748q0-55 38.5-93.5T532-880q32 0 60 13.5t48 36.5q20-23 48-36.5t60-13.5q55 0 93.5 38.5T880-748q0 43-21 79.5T807-602L640-440Zm0-112 109-107q19-19 35-40.5t16-48.5q0-22-15-37t-37-15q-14 0-26.5 5.5T700-778l-60 72-60-72q-9-11-21.5-16.5T532-800q-22 0-37 15t-15 37q0 27 16 48.5t35 40.5l109 107ZM280-220l278 76 238-74q-5-9-14.5-15.5T760-240H558q-27 0-43-2t-33-8l-93-31 22-78 81 27q17 5 40 8t68 4q0-11-6.5-21T578-354l-234-86h-64v220ZM40-80v-440h304q7 0 14 1.5t13 3.5l235 87q33 12 53.5 42t20.5 66h80q50 0 85 33t35 87v40L560-60l-280-78v58H40Zm80-80h80v-280h-80v280Zm520-546Z"/></svg>
            <p>Благотворительность</p>
        </div>

        <div class="elements-div" onclick="showSection('krasota')">
            <svg xmlns="http://www.w3.org/2000/svg" height="24"  viewBox="0 -960 960 960" width="24"><path fill="#f24634" d="M480-80q-73-9-145-39.5T206.5-207Q150-264 115-351T80-560v-40h40q51 0 105 13t101 39q12-86 54.5-176.5T480-880q57 65 99.5 155.5T634-548q47-26 101-39t105-13h40v40q0 122-35 209t-91.5 144q-56.5 57-128 87.5T480-80Zm-2-82q-11-166-98.5-251T162-518q11 171 101.5 255T478-162Zm2-254q15-22 36.5-45.5T558-502q-2-57-22.5-119T480-742q-35 59-55.5 121T402-502q20 17 42 40.5t36 45.5Zm78 236q37-12 77-35t74.5-62.5q34.5-39.5 59-98.5T798-518q-94 14-165 62.5T524-332q12 32 20.5 70t13.5 82Zm-78-236Zm78 236Zm-80 18Zm46-170ZM480-80Z"/></svg>
            <p>Красота и здоровье</p>
        </div>


    </div>

    <div class="history-content" style="display: none">

        <?php

        $transactionHistory = getTransactionHistory($_SESSION['phone'], 'platej');

        if ($transactionHistory) {
            foreach ($transactionHistory as $transaction) {
                // Display transaction details
                echo '<div class="history">';
                echo '<p style="width: 250px">' . $transaction['name']. ' ' . $transaction['amount']  . 'KZT '.'  </p>';
                echo '<p>' . $transaction['created_at'] . '</p>';
                echo '</div>';
            }
        } else {
            // Display message if there are no transactions
            echo '<div>';
            echo '<p class="smaller">Вы еще не совершали никакие платежи</p>';
            echo '</div>';
        }
        ?>




</div>
</div>
    <div class="displaying">
        <div id="default" >
            <img src="images/logo.png" alt="logo">
            <h5>Выберите действие</h5>
        </div>

    <div id="mobilnyi" class="platej-block" style="display: none">
<div style="margin-top: 55px"></div>
        <input placeholder="Номер телефона" id="phone_receiver" type="tel">
        <input placeholder="Сумма" id="amounter" type="number">
        <?php
        $user = getUserByPhone($_SESSION['phone']);
        $money = $user['amount_money'];
        ?>
        <div class="main">
            <div class="kaspian">
                <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                     width="24">
                    <path fill="#deaf65"
                          d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                </svg>
                <h1>Kaspi Gold</h1>
            </div>
            <p><?php echo $money?> KZT</p>


        </div>
        <div class="main" style="font-size: 15px; display: flex; justify-content: space-between">
            <input type="checkbox" id="spendBonuses" class="main">
            <p>Потратить бонусы <?php echo $user['bonus']?></p>
        </div>
        <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'пополнение мобильного', document.getElementById('amounter').value)">
            К оплате
        </button>
    </div>

        <div id="komunalka" class="platej-block" style="display: none">
            <div id="hide1" style="cursor: pointer" onclick="shower('hide1', 'show1')">
                <div class="main">Горячая вода и отопление</div>
                <div class="main">Газ</div>
                <div class="main">Вывоз мусора</div>
                <div class="main">Лифт</div>
                <div class="main">Домофон</div>
                <div class="main">Видеонаблюдение</div>
            </div>
            <div style="display: none;" id="show1">


                <input placeholder="Адрес" id="adress" type="tel">
                <input placeholder="Сумма" id="amounter2" type="number">
                <?php
                $user = getUserByPhone($_SESSION['phone']);
                $money = $user['amount_money'];
                ?>
                <div class="main">
                    <div class="kaspian">
                        <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                             width="24">
                            <path fill="#deaf65"
                                  d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                        </svg>
                        <h1>Kaspi Gold</h1>
                    </div>
                    <p><?php echo $money?> KZT</p>


                </div>
                <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'комунальные услуги', document.getElementById('amounter2').value)">
                    К оплате
                </button>
            </div>
        </div>


        <div id="transport" class="platej-block" style="display: none">
            <div id="hide2" style="cursor: pointer" onclick="shower('hide2', 'show2')">
                <div class="main">Автобус</div>
                <div class="main">Парковка</div>
                <div class="main">Автовокзал</div>
                <div class="main">Такси</div>
                <div class="main">Прокат</div>
            </div>
            <div style="display: none;" id="show2">


                <input placeholder="Идентификационный номер" id="ident" type="text">
                <input placeholder="Сумма" id="amounter3" type="number">
                <?php
                $user = getUserByPhone($_SESSION['phone']);
                $money = $user['amount_money'];
                ?>
                <div class="main">
                    <div class="kaspian">
                        <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                             width="24">
                            <path fill="#deaf65"
                                  d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                        </svg>
                        <h1>Kaspi Gold</h1>
                    </div>
                    <p><?php echo $money?> KZT</p>


                </div>
                <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'оплата за транспорт', document.getElementById('amounter3').value)">
                    К оплате
                </button>
            </div>
        </div>

            <div id="internet" class="platej-block" style="display: none">

                <div id="show3">
                    <input placeholder="Лицевой счет" id="lisev" type="text">
                    <input placeholder="Пакет" id="lisev" type="text">
                    <input placeholder="Сумма" id="amounter4" type="number">
                    <?php
                    $user = getUserByPhone($_SESSION['phone']);
                    $money = $user['amount_money'];
                    ?>
                    <div class="main">
                        <div class="kaspian">
                            <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                                 width="24">
                                <path fill="#deaf65"
                                      d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                            </svg>
                            <h1>Kaspi Gold</h1>
                        </div>
                        <p><?php echo $money?> KZT</p>


                    </div>
                    <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'интернет услуги', document.getElementById('amounter4').value)">
                        К оплате
                    </button>
                </div>
        </div>

        <div id="obraz" class="platej-block" style="display: none">
            <div id="hide5" style="cursor: pointer" onclick="shower('hide5', 'show5')">
                <div class="main">Детские сады</div>
                <div class="main">Школы</div>
                <div class="main">Вузы и Колледжи</div>
                <div class="main">Доп. Образование</div>
                <div class="main">Питание в школах</div>
            </div>
            <div style="display: none;" id="show5">


                <input placeholder="Город" id="ident" type="text">
                <input placeholder="Название учебного заведения" id="ident" type="text">
                <input placeholder="Класс" id="ident" type="text">
                <input placeholder="ФИО" id="ident" type="text">
                <input placeholder="Сумма" id="amounter5" type="number">
                <?php
                $user = getUserByPhone($_SESSION['phone']);
                $money = $user['amount_money'];
                ?>
                <div class="main">
                    <div class="kaspian">
                        <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                             width="24">
                            <path fill="#deaf65"
                                  d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                        </svg>
                        <h1>Kaspi Gold</h1>
                    </div>
                    <p><?php echo $money?> KZT</p>


                </div>
                <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'образовательные услуги', document.getElementById('amounter5').value)">
                    К оплате
                </button>
            </div>
        </div>

        <div id="shtraf" class="platej-block" style="display: none">

            <div id="show6">

                Услуга временно недоступна

            </div>
        </div>

        <div id="finan" class="platej-block" style="display: none">
            <div id="hide7" style="cursor: pointer" onclick="shower('hide7', 'show7')">
                <div class="main">Ипотека</div>
                <div class="main">Недвижимость</div>
                <div class="main">Арендка</div>
                <div class="main">Ломбарды</div>
                <div class="main">Страховые компании</div>
            </div>
            <div style="display: none;" id="show7">


                <input placeholder="Выберите Адрес" id="ident" type="text">
                <input placeholder="ИИН" id="ident" type="text">
                <input placeholder="Номер Договора" id="ident" type="text">
                <input placeholder="Сумма" id="amounter7" type="number">
                <?php
                $user = getUserByPhone($_SESSION['phone']);
                $money = $user['amount_money'];
                ?>
                <div class="main">
                    <div class="kaspian">
                        <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                             width="24">
                            <path fill="#deaf65"
                                  d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                        </svg>
                        <h1>Kaspi Gold</h1>
                    </div>
                    <p><?php echo $money?> KZT</p>


                </div>
                <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'финансовые услуги', document.getElementById('amounter7').value)">
                    К оплате
                </button>
            </div>
        </div>

        <div id="blago" class="platej-block" style="display: none">
            <div style="margin-top: 55px"></div>
            <input placeholder="Название заведения" id="phone_receiver" type="tel">
            <input placeholder="Сумма" id="amounter8" type="number">
            <?php
            $user = getUserByPhone($_SESSION['phone']);
            $money = $user['amount_money'];
            ?>
            <div class="main">
                <div class="kaspian">
                    <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                         width="24">
                        <path fill="#deaf65"
                              d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                    </svg>
                    <h1>Kaspi Gold</h1>
                </div>
                <p><?php echo $money?> KZT</p>


            </div>
            <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'благотворительность', document.getElementById('amounter8').value)">
                К оплате
            </button>
        </div>

        <div id="krasota" class="platej-block" style="display: none">
            <div id="hide9" style="cursor: pointer" onclick="shower('hide9', 'show9')">
                <div class="main">Косметика</div>
                <div class="main">Для здоровья</div>
                <div class="main">Мед. Центры</div>
                <div class="main">Спорт. клубы</div>
            </div>
            <div style="display: none;" id="show9">


                <input placeholder="Выберите Адрес" id="ident" type="text">
                <input placeholder="ИИН" id="ident" type="text">
                <input placeholder="Номер Договора" id="ident" type="text">
                <input placeholder="Сумма" id="amounter9" type="number">
                <?php
                $user = getUserByPhone($_SESSION['phone']);
                $money = $user['amount_money'];
                ?>
                <div class="main">
                    <div class="kaspian">
                        <svg xmlns="http://www.w3.org/2000/svg" color="#deaf65" height="24" viewBox="0 -960 960 960"
                             width="24">
                            <path fill="#deaf65"
                                  d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/>
                        </svg>
                        <h1>Kaspi Gold</h1>
                    </div>
                    <p><?php echo $money?> KZT</p>


                </div>
                <button onclick="transferPlatej(<?php echo $_SESSION['phone'] ?>, 'красота и здоровье', document.getElementById('amounter9').value)">
                    К оплате
                </button>
            </div>
        </div>

</div>
</body>
</html>
