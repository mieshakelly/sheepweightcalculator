<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheep Weight Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        body.dark-mode {
            background-color: #000; 
            color: #fff; 
        }
        .dark-mode .card {
            background-color: #181818; 
            border: 1px solid #fff;
            color:#fff;
        }
        .dark-mode .btn-secondary {
            background-color: #333; 
            color: #fff;
            border-color: #fff;
        }
        .miesha-mode { 
            background-color: #ffe4e1;
            color: #990066; 
        }
        .miesha-mode .btn-primary {
            background-color: #990066; 
            border-color: #990066; 
        }
        .miesha-mode .btn-secondary {
            background-color: #ff69b4;
            border-color: #ff69b4; 
        }
        .container {
            max-width: 90%; 
        }
        .btn {
            padding: 0.5rem 1rem; 
        }
        input[type="number"] {
            font-size: 1.2rem; 
        }
        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;      
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['isMetric'])) {
        $_SESSION['isMetric'] = false;
    }
    if (!isset($_SESSION['darkMode'])) {
        $_SESSION['darkMode'] = false;
    }
    if (!isset($_SESSION['mieshaMode'])) {
        $_SESSION['mieshaMode'] = false;
    }

    if (isset($_POST['toggleSystem'])) {
        $_SESSION['isMetric'] = !$_SESSION['isMetric'];
        header('Location: ' . $_SERVER['PHP_SELF']); 
        exit;
    }
    if (isset($_POST['toggleDarkMode'])) {
        $_SESSION['darkMode'] = !$_SESSION['darkMode'];
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
    if (isset($_POST['toggleMieshaMode'])) {
        $_SESSION['mieshaMode'] = !$_SESSION['mieshaMode'];
        header('Location: ' . $_SERVER['PHP_SELF']); 
        exit;
    }

    if (isset($_POST['calculate'])) {
        $heartGirth = floatval($_POST['heartGirth']);
        $length = floatval($_POST['length']);
        if ($_SESSION['isMetric']) {
            $weightLbs = ((($heartGirth/2.54)*($heartGirth/2.54)*($length/2.54))/300);
        } else {
            $weightLbs = ($heartGirth * $heartGirth * $length)/300;
        }
        $weightKg = $weightLbs * 0.45359237;
    }
    ?>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="mb-4">Sheep Weight Calculator</h2>

            <form method="post" class="mb-3 btn-group"> 
                <button type="submit" name="toggleSystem" class="btn btn-secondary">
                    Switch to <?php echo $_SESSION['isMetric'] ? 'Imperial (in)' : 'Metric (cm)'; ?>
                </button>
                <button type="submit" name="toggleDarkMode" class="btn btn-secondary">
                    <?php echo $_SESSION['darkMode'] ? 'Light Mode' : 'Dark Mode'; ?>
                </button>
                <button type="submit" name="toggleMieshaMode" class="btn btn-secondary">
                    <?php echo $_SESSION['mieshaMode'] ? 'No Flair' : 'Miesha Flair'; ?>
                </button>
            </form>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Heart Girth (<?php echo $_SESSION['isMetric'] ? 'cm' : 'in'; ?>)</label>
                    <input type="number" step="0.1" class="form-control" name="heartGirth" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Length (<?php echo $_SESSION['isMetric'] ? 'cm' : 'in'; ?>)</label>
                    <input type="number" step="0.1" class="form-control" name="length" required>
                </div>
                <button type="submit" name="calculate" class="btn btn-primary">Calculate Weight</button>
            </form>
            <?php if (isset($weightLbs) && isset($weightKg)): ?>
                <div class="mt-4">
                    <h4>Results:</h4>
                    <p><h2>Lbs: <?php echo number_format($weightLbs, 2); ?> lbs</h2></p>
                    <p><h2>Kg: <?php echo number_format($weightKg, 2); ?> kg</h2></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;

            const darkMode = <?php echo $_SESSION['darkMode'] ? 'true' : 'false'; ?>;
            const mieshaMode = <?php echo $_SESSION['mieshaMode'] ? 'true' : 'false'; ?>;

            if (darkMode) {
                body.classList.add('dark-mode');
            }

            if (mieshaMode) {
                body.classList.add('miesha-mode');
            }
        });
    </script>
</body>
</html>
