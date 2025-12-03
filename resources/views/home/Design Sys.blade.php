<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: rgb(255, 255, 255);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .container-custom {
            text-align: center;
            margin-top: 50px;
            background-color: rgb(126, 197, 255);
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                transform: translate3d(0, 40px, 0);
                opacity: 0;
            }

            to {
                transform: translate3d(0, 0, 0);
                opacity: 1;
            }
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: bold;
            animation: fadeIn 1.5s ease-out;
        }

        .panel-selection {
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-out;
        }

        .panel-selection label {
            color: #555;
            font-size: 18px;
        }

        .panel-selection select {
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            transition: border-color 0.3s ease, background-color 0.3s ease;
            appearance: none;
            background-image: url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/svgs/solid/caret-down.svg');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }

        .panel-selection select:focus {
            border-color: #4CAF50;
            background-color: #f0fff0;
        }

        .device-list {
            text-align: right;
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-out;
        }

        .device {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .device-checkbox {
            display: none;
        }

        .device label {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
            color: #555;
            font-size: 18px;
            margin: 0;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .device label:hover {
            color: #4CAF50;
        }

        .device label::before {
            content: "\f096";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            display: inline-block;
            position: absolute;
            left: 0;
            top: 0;
            font-size: 20px;
            color: #ccc;
            transition: color 0.3s ease;
        }

        .device input[type="checkbox"]:checked+label::before {
            content: "\f14a";
            color: #4CAF50;
        }

        #calculate-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 18px;
            margin-top: 20px;
        }

        #calculate-btn:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
            animation: fadeIn 1.5s ease-out;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .alert-message {
            color: #c0392b;
            font-size: 14px;
            margin-top: 10px;
            animation: fadeIn 1.5s ease-out;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #e74c3c;
            background-color: #f9dcdc;
            font-family: 'Roboto', sans-serif;
        }

        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 50%;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .back-to-top:hover {
            background-color: #45a049;
            transform: scale(1.1);
        }

        .back-to-top i {
            font-size: 24px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <!-- Navbar Start -->
    @include('home.navbar')
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Designer Page</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-custom">
        <h1>مصمم نظام شمسي</h1>
        <div class="panel-selection">
            <label for="panel-type">اختر نوع اللوح الشمسي:</label>
            <select id="panel-type" class="form-control">
                <option value="300">300 واط</option>
                <option value="400">400 واط</option>
                <option value="500">500 واط</option>
                <option value="585">585 واط</option>
            </select>
        </div>
        <div class="device-list">
            <div class="device">
                <input type="checkbox" id="coffee-maker" class="device-checkbox" data-power="600-1200">
                <label for="coffee-maker">آلة صنع القهوة (1200 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="blender" class="device-checkbox" data-power="300-1000">
                <label for="blender">خلاط (1000 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="microwave" class="device-checkbox" data-power="1000-2000">
                <label for="microwave">مايكرويف (2000 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="food-warmer" class="device-checkbox" data-power="800-1500">
                <label for="food-warmer">سخانة طعام ليزرية (1500 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="hair-dryer" class="device-checkbox" data-power="1000-1875">
                <label for="hair-dryer">مجفف شعر (1875 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="vacuum-cleaner" class="device-checkbox" data-power="300-1500">
                <label for="vacuum-cleaner">مكنسة كهربائية (1500 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="iron" class="device-checkbox" data-power="1000-1500">
                <label for="iron">مكواة ملابس (1500 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="fridge" class="device-checkbox" data-power="500-750">
                <label for="fridge">براد (750 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="refrigerator" class="device-checkbox" data-power="600-600">
                <label for="refrigerator">ثلاجة (600 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="washer" class="device-checkbox" data-power="500-1000">
                <label for="washer">غسالة (1000 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="home-fan" class="device-checkbox" data-power="50-120">
                <label for="home-fan">مروحة منزلية (120 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="computer-screen" class="device-checkbox" data-power="200-400">
                <label for="computer-screen">جهاز كومبيوتر مع شاشة (400 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="printer" class="device-checkbox" data-power="15-75">
                <label for="printer">طابعة (75 واط)</label>
            </div>
            <div class="device">
                <input type="checkbox" id="plasma-tv" class="device-checkbox" data-power="240-240">
                <label for="plasma-tv">تلفاز (240 واط)</label>
            </div>
            <h4><p class="alert-message">يرجى ملاحظة أن جميع هذه الأحمال تقريبية وتعتمد على نوع الجهاز</p></h4>
        </div>
        <button id="calculate-btn" class="btn btn-success">حساب</button>
        <div id="total-power" class="result"></div>
        <div id="solar-panels" class="result"></div>
        <div id="inverter-recommendation" class="result"></div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Custom Script -->
    <script>
        document.getElementById('calculate-btn').addEventListener('click', function() {
            const devices = document.querySelectorAll('.device-checkbox:checked');
            let totalPower = 0;

            devices.forEach(device => {
                const powerRange = device.getAttribute('data-power').split('-');
                const maxPower = parseInt(powerRange[1]);
                totalPower += maxPower;
            });

            const panelType = parseInt(document.getElementById('panel-type').value);
            const numPanels = Math.ceil(totalPower / panelType);

            // الفئات المتغيرة للإنفرتر بناءً على الطاقة الشمسية المحسوبة
            let inverterPower = 0;

            // قائمة الحدود التقريبية للفئات - يمكن ضبطها لزيادة دقة التوصيات
            const boundaries = [1000, 1500, 2000, 2500, 3000, 3200, 3500, 4000, 4200, 4500, 5000, 5500, 6000, 7000,
                8000, 9000
            ];
            let closestBoundaryIndex = 0;

            // التعيين الذكي لقوة الإنفرتر
            for (let i = 0; i < boundaries.length; i++) {
                if (totalPower <= boundaries[i]) {
                    inverterPower = 1000 + (i + 1) * 500; // تعيين قوة الإنفرتر بشكل ديناميكي
                    closestBoundaryIndex = i; // حفظ الفهرس الأقرب
                    break;
                }
            }

            // إذا تجاوزت الطاقة الحد الأعلى للفئات
            if (totalPower > boundaries[boundaries.length - 1]) {
                inverterPower = 10000;
            } else {
                // تقريب القيمة لأقرب عنصر في المصفوفة
                const currentBoundary = boundaries[closestBoundaryIndex];
                const nextBoundary = boundaries[closestBoundaryIndex + 1];
                if (totalPower > currentBoundary && totalPower <= nextBoundary) {
                    const diffCurrent = Math.abs(totalPower - currentBoundary);
                    const diffNext = Math.abs(nextBoundary - totalPower);
                    if (diffCurrent < diffNext) {
                        inverterPower = 1000 + (closestBoundaryIndex + 1) * 500; // تقريب لأقرب عنصر
                    } else {
                        inverterPower = 1000 + (closestBoundaryIndex + 2) * 500; // تقريب للعنصر التالي
                    }
                }
            }



            const totalPowerElement = document.getElementById('total-power');
            const solarPanelsElement = document.getElementById('solar-panels');
            const inverterElement = document.getElementById('inverter-recommendation');

            totalPowerElement.innerHTML =
                `<div class="alert alert-info"><strong>إجمالي الطاقة المطلوبة:</strong> ${totalPower} واط</div>`;
            solarPanelsElement.innerHTML =
                `<div class="alert alert-success"><strong>عدد الألواح الشمسية المطلوبة:</strong> ${numPanels}</div>`;
            inverterElement.innerHTML =
                `<div class="alert alert-warning"><strong>الإنفرتر الموصى به:</strong> ${inverterPower} واط</div>`;
        });
    </script>
</body>

</html>
