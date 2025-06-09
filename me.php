<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SMS Preferences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="p-4">
    <div class="container">
        <h3>SMS Notification Settings</h3>
        <div class="mb-3">
            <label for="provider" class="form-label">Select SMS Provider</label>
            <select id="provider" class="form-select">
                <option value="">Select...</option>
                <option value="ntem">NTEM</option>
                <option value="smsonlinegh">SMSONLINEGH</option>
                <option value="hubtel">Hubtel</option>
            </select>
        </div>

        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="depositSwitch">
            <label class="form-check-label" for="depositSwitch">Deposit Notification</label>
        </div>
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="withdrawSwitch">
            <label class="form-check-label" for="withdrawSwitch">Withdrawal Notification</label>
        </div>
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="securitySwitch">
            <label class="form-check-label" for="securitySwitch">Security Alerts</label>
        </div>
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="promoSwitch">
            <label class="form-check-label" for="promoSwitch">Promotions</label>
        </div>
        <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="gameSwitch">
            <label class="form-check-label" for="gameSwitch">Game Updates</label>
        </div>
        <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input" id="vipSwitch">
            <label class="form-check-label" for="vipSwitch">VIP Notifications</label>
        </div>

        <button id="saveBtn" class="btn btn-primary">Save Preferences</button>

        <div id="result" class="mt-3"></div>
    </div>

    <script>
       $(document).ready(function () { 

         $.ajax({
        url: "getset.php",
        method: "GET",
        success: function (response) {
            let data = typeof response === "string" ? JSON.parse(response) : response;

            $("#depositSwitch").prop("checked", data.deposit == 1);
            $("#withdrawSwitch").prop("checked", data.withdraw == 1);
            $("#securitySwitch").prop("checked", data.security == 1);
            $("#promoSwitch").prop("checked", data.promo == 1);
            $("#gameSwitch").prop("checked", data.game == 1);
            $("#vipSwitch").prop("checked", data.vip == 1);
            $("#provider").val(data.provider);
        },
        error: function () {
            $("#result").html('<div class="alert alert-danger">Failed to load preferences.</div>');
        }
    });
    
        $("#saveBtn").click(function () {
            const payload = {
                provider: $("#provider").val(),
                deposit: $("#depositSwitch").is(":checked"),
                withdraw: $("#withdrawSwitch").is(":checked"),
                security: $("#securitySwitch").is(":checked"),
                promo: $("#promoSwitch").is(":checked"),
                game: $("#gameSwitch").is(":checked"),
                vip: $("#vipSwitch").is(":checked")
            };

            $.ajax({
                url: "save-preferences.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify(payload),
                success: function (response) {
                 let res = typeof response === "string" ? JSON.parse(response) : response;
             $("#result").html('<div class="alert alert-success">' + res.message + '</div>');
                const p = res.preferences;
                console.log(p);
                if (p) {
                    $("#provider").val(p.provider || "");
                    $("#depositSwitch").prop("checked", p.deposit);
                    $("#withdrawSwitch").prop("checked", p.withdraw);
                    $("#securitySwitch").prop("checked", p.security);
                    $("#promoSwitch").prop("checked", p.promo);
                    $("#gameSwitch").prop("checked", p.game);
                    $("#vipSwitch").prop("checked", p.vip);
                }
                },
                error: function () {
                    $("#result").html('<div class="alert alert-danger">Failed to save preferences.</div>');
                }
            });
        });

        });
    </script>
</body>
</html>
