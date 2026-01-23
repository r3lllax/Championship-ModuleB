<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оплата картой</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial;
        }

        .payment-card {
            background: #fff;
            width: 360px;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,.2);
        }

        .payment-card h1 {
            margin: 0 0 20px;
            font-size: 22px;
            text-align: center;
        }

        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-bottom: 16px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            border-radius: 12px;
            border: none;
            background: #2563eb;
            color: white;
            cursor: pointer;
            transition: .2s;
        }

        button:hover {
            background: #1e40af;
        }

        .status {
            margin-top: 16px;
            text-align: center;
            font-weight: 600;
        }

        .success { color: #16a34a; }
        .failed { color: #dc2626; }
        .error { color: #f59e0b; }
    </style>
</head>
<body>

<div class="payment-card">
    <h1>Оплата банковской картой</h1>

    <label>Номер карты</label>
    <input
        id="card"
        type="text"
        placeholder="8888 0000 0000 1111"
        maxlength="19"
    >

    <button onclick="pay()">Оплатить</button>

    <div id="status" class="status"></div>
</div>

<script>
    const WEBHOOK_URL = `http://localhost:8000/api/payment-webhook/`;
    function pay() {
        const card = document.getElementById("card").value.trim();
        const statusEl = document.getElementById("status");
        let order_id = window.location.href.split('/')
        order_id = order_id[order_id.length-1];


        let status;
        let text;

        if (card === "8888 0000 0000 1111") {
            status = "success";
            text = "✅ Платеж успешно выполнен";
        } else if (card === "8888 0000 0000 2222") {
            status = "failed";
            text = "❌ Платеж отклонен";
        } else {
            status = "failed";
            text = "⚠️ Неверные реквизиты карты";
        }

        statusEl.className = "status " + status;
        statusEl.textContent = text;

        fetch(WEBHOOK_URL + `${order_id}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ order_id,status })
        }).catch(() => {});
    }
</script>

</body>
</html>
