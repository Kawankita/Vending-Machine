<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Vending Machine dengan Koin</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <style>
        p {
            font-size: 20px;
        }

        .item {
            cursor: pointer;
        }

        .item img {
            border-radius: 15px;
            width: 300px;
            height: 300px;
        }

        .item.selected {
            border: 2px solid red;
            border-radius: 15px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .popup.visible {
            display: block;
        }

        .coin {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 5px;
            padding: 10px;
            background-color: aliceblue;
            cursor: pointer;
        }

        .coin img {
            height: 100px;
        }

        .close {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
        }

        .button {
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        button {
            width: 80px;
            border-radius: 10px;
            background-color: #7776b3;

        }
    </style>
</head>

<body>

    <h1 class="text-center mt-5 mb-4">Vending Machine</h1>
    <form id="vendingForm" method="POST">
        <div class="row align-items-center text-center">
            <div class="col">
                <div class="item" data-name="Cokelat" data-price="10000" data-image="img/brett-jordan-aKYu-H5pHJY-unsplash.jpg">
                    <img src="img/brett-jordan-aKYu-H5pHJY-unsplash.jpg" alt="Cokelat" class="drink-1">
                    <p>Cokelat - Rp10.000</p>
                </div>
                <div class="item" data-name="Minuman Soda" data-price="8000" data-image="img/nagy-arnold-CqY5To2ZU8E-unsplash.jpg">
                    <img src="img/nagy-arnold-CqY5To2ZU8E-unsplash.jpg" alt="Minuman Soda" class="drink-2">
                    <p>Minuman Soda - Rp8.000</p>
                </div>
            </div>
            <div class="col">
                <div class="item" data-name="Keripik" data-price="5000" data-image="img/qasim-malick-tDU7_HgwdlI-unsplash.jpg">
                    <img src="img/qasim-malick-tDU7_HgwdlI-unsplash.jpg" alt="Keripik" class="drink-3">
                    <p>Keripik - Rp5.000</p>
                </div>
                <div class="item" data-name="Keripik" data-price="5000" data-image="img/1.jpg">
                    <img src="img/1.jpg" alt="Keripik" class="drink-4">
                    <p>Keripik - Rp5.000</p>
                </div>

            </div>
        </div>
        <input type="hidden" name="selectedItems" id="selectedItems">
        <input type="hidden" name="money" id="money" value="0">
        <div>
            <label>Total Uang (Rp):</label>
            <span id="totalMoney">0</span>
        </div>

        <div>
            <div class="coin" data-value="500"><img src="uang/500.jpg" alt="Rp500"></div>
            <div class="coin" data-value="1000"><img src="uang/download.jpg" alt="Rp1000"></div>
            <div class="coin" data-value="2000"><img src="uang/download1.jpg" alt="Rp2000"></div>
            <div class="coin" data-value="5000"><img src="uang/download2.jpg" alt="Rp5000"></div>
            <div class="coin" data-value="10000"><img src="uang/Indonesia - Best of Banknotes.jpg" alt="Rp5000"></div>
            <div class="coin" data-value="20000"><img src="uang/download3.jpg" alt="Rp5000"></div>
        </div>
        <div class="button">
            <button type="button" onclick="submitForm()">Beli</button>
            <button type="reset" onclick="resetForm()">Reset</button>
        </div>
    </form>

    <div id="popup" class="popup">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>Purchase Details</h2>
        <p id="itemName"></p>
        <p id="itemPrice"></p>
        <p id="sisaUang"></p>
        <img id="itemImage" src="" alt="Item Image" style="width: 100px; height: 100px;">
        <h2>Berhasil</h2>
    </div>

    <script>
        document.querySelectorAll('.item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('selected');
            });
        });

        document.querySelectorAll('.coin').forEach(coin => {
            coin.addEventListener('click', () => {
                const value = parseInt(coin.getAttribute('data-value'));
                let currentMoney = parseInt(document.getElementById('money').value);
                currentMoney += value;
                document.getElementById('money').value = currentMoney;
                document.getElementById('totalMoney').textContent = currentMoney;
            });
        });

        function submitForm() {
            const selectedItems = [];
            document.querySelectorAll('.item.selected').forEach(item => {
                const name = item.getAttribute('data-name');
                const price = item.getAttribute('data-price');
                const image = item.getAttribute('data-image');
                selectedItems.push({
                    name,
                    price,
                    image
                });
            });

            const money = parseInt(document.getElementById('money').value);
            let totalPrice = 0;

            selectedItems.forEach(item => {
                totalPrice += parseInt(item.price);
            });

            if (money >= totalPrice) {
                const sisaUang = money - totalPrice;
                showPopup({
                    itemName: selectedItems.map(item => item.name).join(', '),
                    itemPrice: totalPrice,
                    sisaUang: sisaUang,
                    itemImage: selectedItems[0].image // Display the image of the first selected item
                });
            } else {
                showPopup({
                    itemName: 'Uang tidak cukup!',
                    itemPrice: '',
                    sisaUang: '',
                    itemImage: ''
                });
            }
        }

        function resetForm() {
            document.getElementById('popup').classList.remove('visible');
            document.querySelectorAll('.item').forEach(item => {
                item.classList.remove('selected');
            });
            document.getElementById('money').value = 0;
            document.getElementById('totalMoney').textContent = 0;
        }

        function showPopup(data) {
            document.getElementById('itemName').innerText = 'Item: ' + data.itemName;
            document.getElementById('itemPrice').innerText = 'Price: Rp ' + data.itemPrice;
            document.getElementById('sisaUang').innerText = 'Remaining Money: Rp ' + data.sisaUang;
            document.getElementById('itemImage').src = data.itemImage;
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedItems = isset($_POST['selectedItems']) ? explode(',', $_POST['selectedItems']) : [];
        $money = isset($_POST['money']) ? intval($_POST['money']) : 0;

        $totalPrice = 0;
        $itemDetails = [];

        foreach ($selectedItems as $item) {
            list($itemName, $itemPrice) = explode('|', $item);
            $itemPrice = intval($itemPrice);
            $totalPrice += $itemPrice;
            $itemDetails[] = [
                'name' => $itemName,
                'price' => $itemPrice
            ];
        }

        if ($money >= $totalPrice) {
            $change = $money - $totalPrice;
            echo "<script>
                showPopup({
                    itemName: '" . implode(', ', array_column($itemDetails, 'name')) . "',
                    itemPrice: " . $totalPrice . ",
                    sisaUang: " . $change . ",
                    itemImage: '" . $itemDetails[0]['name'] . "'
                });
            </script>";
        } else {
            echo "<script>
                showPopup({
                    itemName: 'Uang tidak cukup!',
                    itemPrice: '',
                    sisaUang: '',
                    itemImage: ''
                });
            </script>";
        }
    }
    ?>
</body>

</html>