<?php

 include 'process.php';

 if(!isset($_SESSION["login"])) {
     header("location:../auth/login.html");
     exit();
 }

 $phone = $_SESSION['phone'];
$user = getUserByPhone($phone);
 $card = getUserCardNumberByPhone($phone);

if (isset($card)) {
    $cardnumber = substr($card, 12, 15);
    // Rest of your code using $cardnumber
} else {
    // Handle the case when $card is null or undefined
    echo "Error: The card variable is null or undefined.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kaspi.kz</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>

</head>
<body>
    <div class="container">
        <div class="left-container">
            <div class="left-top" >
                <div class="home-button"  style="margin-top: 15px">
                    <a class="home" href="../main/index1.html">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30" viewBox="0 -960 960 960" width="30"><path fill="#f24634" d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                    </a>
                </div>
                <div class="mybank-title" style="margin-top: 15px">
                    <div>Мой Банк</div>
                </div>
            </div>
            <div class="left-bottom">
                <div class="goldcard-tab" onclick="showSection('first')">
                    <div style="display:flex; flex-direction: row; align-items: center;">
                        <img src="gold-card.png" class="card-image">
                        <div class="card-title">
                            <div class="card-title-up">Kaspi Gold</div>
                            <div class="card-title-end">*<?php echo $cardnumber ?></div>
                        </div>
                    </div>
                    <div class="gold-money"><?php echo $user["amount_money"] ?>₸</div>
                </div>
                <?php if ($user['deposit'] == 0) : ?>
                    <div class="messages-tab" onclick="showSection('second')">
                        <div class="messages-title">Открытие Депозита</div>
                    </div>
                <?php else: ?>
                    <div class="bonus-tab" onclick="showSection('third')">
                        <div style="display:flex; flex-direction: row; align-items: center;">
                            <img src="deposit-card.png" class="card-image">
                            <div class="card-title-bonus">Депозит KZT</div>
                        </div>
                        <div class="gold-money"><?php echo $user["deposit"] ?>₸</div>
                    </div>
                <?php endif; ?>


                <div class="bonus-tab" style="margin-top: 65%;"  onclick="showSection('fifth')">
                    <div style="display:flex; flex-direction: row; align-items: center;">
                        <img src="bonus-card.png" class="card-image">
                        <div class="card-title-bonus">Бонусы</div>
                    </div>
                    <div class="gold-money"><?php echo $user["bonus"] ?>B̅</div>
                </div>
            </div>
        </div>
        <div class="right-container">

            <div id="default" >
                <img src="../transactions/images/logo.png" alt="logo">
                <h5>Выберите действие</h5>
            </div>


            <div id="first" style="display: none">
                <!--                Клиенту каспи -->


                <div class="info-block"
                     style="font-size: 25px; background-color: #deaf65; color: white; font-weight: bold; padding: 20px 10px">

                    Ваша история за весь период
                </div>


                <div class="history-content" >

                    <?php

                    $transactionHistory = getTransactionHistory($_SESSION['phone'], null);

                    if ($transactionHistory) {
                        foreach ($transactionHistory as $transaction) {
                            // Display transaction details
                            echo '<div class="history">';
                            echo '<p style="width: 250px">' . $transaction['name'] . ' ' . $transaction['amount'] . 'KZT ' . '  </p>';
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




            <div id="second" style="display: none">
                <!--                Клиенту каспи -->


                <div class="info-block"
                     style="font-size: 25px; background-color: #f9d300; color: white; font-weight: bold; padding: 20px 10px">


                    Kaspi Депозит — самый доступный и выгодный депозит от Kaspi.kz.
                </div>

                <div class="info-block">

                    Минимальная сумма открытия для тенгового депозита — 1 000 тенге, для валютного — 10 долларов.


                    Депозиты в Kaspi.kz застрахованы Казахстанским фондом гарантирования депозитов.


                    Эффективная ставка по депозитам в тенге составляет 15%, в долларах 1%.


                    Деньги с Kaspi Депозита можно снимать быстро и удобно в любое время без потери вознаграждения.


                    Пополнить Kaspi Депозит вы можете без комиссий через любой Kaspi Терминал, Kaspi Банкомат или
                    отделение Kaspi.kz по всей стране. А также переводом в мобильном приложении Kaspi.kz с Kaspi Gold
                    или другого своего депозита. Деньги на Kaspi Депозит поступают мгновенно.



                    В мобильном приложении Kaspi.kz в сервисе «Мой Банк» можно смотреть все операции по депозитам, легко
                    переводить деньги между тенговым и валютным вкладами. Переводы между своими счетами всегда без
                    комиссий.

                </div>

                <div>
                    <input id="amount_dep" type="number" placeholder=" min 1000 KZT" onclick="validateAmount()"
                           required>
                </div>

                <button onclick="transferDepo(<?php echo $phone ?>,  document.getElementById('amount_dep').value, 'пополнение депозита')">
                    Cоздать
                </button>
            </div>

            <div id="third" style="display: none">




                <div class="info-block">


                    Депозиты в Kaspi.kz застрахованы Казахстанским фондом гарантирования депозитов.


                    Эффективная ставка по депозитам в тенге составляет 15%, в долларах 1%.


                    Деньги с Kaspi Депозита можно снимать быстро и удобно в любое время без потери вознаграждения.


                    Пополнить Kaspi Депозит вы можете без комиссий через любой Kaspi Терминал, Kaspi Банкомат или
                    отделение Kaspi.kz по всей стране. А также переводом в мобильном приложении Kaspi.kz с Kaspi Gold
                    или другого своего депозита. Деньги на Kaspi Депозит поступают мгновенно.


                    В мобильном приложении Kaspi.kz в сервисе «Мой Банк» можно смотреть все операции по депозитам, легко
                    переводить деньги между тенговым и валютным вкладами. Переводы между своими счетами всегда без
                    комиссий.

                </div>
                <div class="info-block"
                     style="font-size: 25px; background-color: #f9d300; color: white; font-weight: bold; padding: 20px 10px">


                    Переводить между счетом Kaspi Gold и Kaspi Deposit можно в Переводах
                </div>
                <a href="../transactions/perevody.php">
                    <button>
                        Перейти в переводы
                    </button>
                </a>
            </div>


            <div id="fifth" style="display: none">
                <!--                Клиенту каспи -->


                <div class="info-block"
                     style="font-size: 25px; background-color: #59a001; color: white; font-weight: bold; padding: 20px 10px">


                    Kaspi Бонус — это спасибо нашим любимым клиентам, которые покупают и платят с Kaspi.kz.
                </div>

                <div class="info-block">

                    Участие в программе позволяет накапливать 0,1% бонусов за каждую покупку с Kaspi Gold при оплате по Kaspi QR.


                    По программе Kaspi Бонус также проходят акции с повышенными бонусами. Информацию о них можно узнать в мобильном приложении Kaspi.kz → Акции.

                    Накопленные бонусы можно сразу потратить полностью или частично на:
                    • большинство услуг в сервисе «Платежи» на Kaspi.kz;
                    • заказы в Магазине на Kaspi.kz;
                    • покупки с помощью Kaspi QR в магазинах партнёров Kaspi.kz.

                </div>


            </div>

        </div>
    </div>
</body>
</html>
