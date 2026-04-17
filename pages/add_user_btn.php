<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="assets/add_user.css">
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header">
            <button class="back-btn" onclick="window.location.href='admin_dashboard.php'">← BACK</button>
            <h2>Add User</h2>
        </div>

        <!-- FORM BOX -->
        <div class="form-box">

            <form action="save_user.php" method="POST">

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <!-- ADD DEVICE BUTTON -->
                <div class="center">
                    <button type="button" class="add-device-btn" onclick="showDevice()">Add Device</button>
                </div>

                <!-- DEVICE TYPE -->
                <div id="deviceTypeBox" style="display:none;">
                    <label>Select Device:</label>
                    <select name="device_type" id="deviceType" onchange="loadDeviceForm()">
                        <option value="">--Select--</option>
                        <option value="desktop">Desktop</option>
                        <option value="laptop">Laptop</option>
                        <option value="printer">Printer</option>
                        <option value="router">Router</option>
                    </select>
                </div>

                <!-- DYNAMIC FORM -->
                <div id="deviceForm"></div>

                <!-- ACTION BUTTONS -->
                <div class="actions">
                    <button type="button" class="cancel-btn"
                        onclick="window.location.href='admin_dashboard.php'">Cancel</button>
                    <button type="submit" class="save-btn">Save</button>
                </div>

            </form>

        </div>

    </div>

    <script>
        function showDevice() {
            document.getElementById("deviceTypeBox").style.display = "block";
        }

        function loadDeviceForm() {
            let type = document.getElementById("deviceType").value;
            let form = document.getElementById("deviceForm");

            if (type === "desktop") {
                form.innerHTML = `
        <h3>Desktop</h3>
        <input name="division" placeholder="Division">
        <input name="username" placeholder="User Name">
        <input type="date" name="acq_date">
        <input name="brand" placeholder="Brand">
        <input name="model" placeholder="Model">
        <input name="ip" placeholder="IP Address">
        <input name="processor" placeholder="Processor">
        <input name="memory" placeholder="Memory">
        <input name="ssd" placeholder="SSD">
        <input name="hdd" placeholder="HDD">
        `;
            }

            else if (type === "laptop") {
                form.innerHTML = `
        <h3>Laptop</h3>
        <input name="division" placeholder="Division">
        <input name="username" placeholder="User Name">
        <input name="brand" placeholder="Brand">
        <input name="model" placeholder="Model">
        <input name="processor" placeholder="Processor">
        `;
            }

            else if (type === "printer") {
                form.innerHTML = `
        <h3>Printer</h3>
        <input name="division" placeholder="Division">
        <input name="username" placeholder="User Name">
        <input name="brand" placeholder="Brand">
        <input name="model" placeholder="Model">
        `;
            }

            else if (type === "router") {
                form.innerHTML = `
        <h3>Router</h3>
        <input name="username" placeholder="User Name">
        <input name="brand" placeholder="Brand">
        <input name="model" placeholder="Model">
        `;
            }
        }
    </script>

</body>

</html>