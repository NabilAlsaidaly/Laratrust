<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مصمم نظام شمسي</title>
    <style>
 /* تحسينات لستايل الصفحة */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    text-align: center;
    margin-top: 50px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 600px;
    margin: 0 auto;
}

h1 {
    color: #333;
}

.device-list {
    text-align: right;
    margin-bottom: 20px;
}

.device {
    margin-bottom: 10px;
}

.device-checkbox {
    display: none; /* لإخفاء علامات الاختيار الافتراضية */
}

.device label {
    display: block;
    position: relative;
    padding-left: 30px; /* إضافة تباعد للنص بجانب علامات الاختيار */
    cursor: pointer;
    color: #555;
    font-size: 16px;
}

.device label::before {
    content: "";
    display: inline-block;
    position: absolute;
    left: 0;
    top: 2px;
    width: 20px;
    height: 20px;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
}

.device label::after {
    content: "";
    display: none;
    position: absolute;
    left: 7px;
    top: 9px;
    width: 5px;
    height: 10px;
    border: solid #000;
    border-width: 0 3px 3px 0;
    transform: rotate(45deg);
}

.device input[type="checkbox"]:checked + label::after {
    display: block;
}

#calculate-btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 18px;
    margin-top: 20px;
}

#calculate-btn:hover {
    background-color: #45a049;
}

/* تحسينات للرسالة التي تظهر عند عدم تحديد الأجهزة */
.alert-message {
    color: #c0392b;
    font-size: 14px;
    margin-top: 10px;
}


    </style>
</head>
<body>
    
    <div class="container">
        <h1>مصمم نظام شمسي</h1>
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
                <input type="checkbox" id="refrigerator" class="device-checkbox" data-power="600">
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
                <input type="checkbox" id="plasma-tv" class="device-checkbox" data-power="240">
                <label for="plasma-tv">تلفاز (240 واط)</label>
            </div>
            <p>يرجى ملاحظة أن جميع هذه الأحمال تقريبية وتعتمد على نوع الجهاز</p>
        </div>
        <button id="calculate-btn">حساب</button>
        <div id="total-power"></div>
        <div id="solar-panels"></div>
    </div>
    <script>
        document.getElementById('calculate-btn').addEventListener('click', function() {
            var checkboxes = document.querySelectorAll('.device-checkbox');
            var totalPower = 0;
            checkboxes.forEach(function(checkbox) {
                var isChecked = checkbox.checked;
                if (isChecked) {
                    var powerRange = checkbox.getAttribute('data-power').split('-');
                    var maxPower = parseInt(powerRange[1]);
                    if (!isNaN(maxPower)) {
                        totalPower += maxPower;
                    }
                }
            });

            // التحقق من أن الطاقة الكلية صالحة
            if (totalPower > 0) {
                var panelCapacity = 585; // استطاعة اللوح الشمسي بالواط (ثابتة)
                var solarPanelsNeeded = Math.ceil(totalPower / panelCapacity);
                document.getElementById('total-power').innerText = 'القدرة الكلية: ' + totalPower + ' واط';
                document.getElementById('solar-panels').innerText = 'عدد الألواح الشمسية المطلوبة: ' + solarPanelsNeeded + ' وحدة';
            } else {
                alert('يرجى تحديد الأجهزة المطلوبة قبل الحساب.');
            }
        });
    </script>
</body>
</html>
