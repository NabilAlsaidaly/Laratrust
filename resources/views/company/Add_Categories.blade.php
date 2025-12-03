<!DOCTYPE html>
<html>
  <head>

    @include('company.css')
    <style type="text/css">
        /* تصميم العناصر */
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 30px; /* تكبير حجم خط النص */
            color: #333; /* لون النص */
            transition: color 0.5s; /* تأثير عند تغيير لون النص */
        }

        label:hover {
            color: #007bff; /* تغيير لون النص عند تحويل المؤشر */
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: calc(100% - 20px); /* تعيين العرض بناءً على عرض الصفحة */
            max-width: 400px; /* تحديد عرض أقصى لحقل الإدخال */
            padding: 8px; /* تقليص حجم الحشو */
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* لون الحدود */
            border-radius: 5px; /* شكل الحواف */
            font-size: 16px; /* تصغير حجم النص */
            transition: border-color 0.3s; /* تأثير عند تغيير لون الحدود */
        }

        input[type="text"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #007bff; /* لون الحدود عند التركيز */
        }

        .div_deg {
            margin-bottom: 20px; /* هامش أسفل العنصر */
        }

        .btn {
            background-color: #007bff; /* لون خلفية الزر */
            color: white; /* لون النص */
            padding: 10px 20px; /* هوامش الزر */
            border: none; /* إزالة الحدود */
            border-radius: 5px; /* شكل الحواف */
            cursor: pointer; /* تحويل المؤشر إلى يد عند التحويل */
            transition: background-color 0.3s; /* تأثير عند تغيير لون الخلفية */
        }

        .btn:hover {
            background-color: #0056b3; /* تغيير لون الخلفية عند تحويل المؤشر */
        }
    </style>
  </head>
  <body>
    @include('company.header')

    <div class="d-flex align-items-stretch">

      @include('company.sidebar')

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


            <div class="div_center">
            <h1 style="font-size: 40px; font-weight:bold">Add Categories</h1>
                <form action="{{url('create_categories')}}" method="Post" enctype="multipart/form-data">
                    @csrf
                <div class="div_deg">
                    <label>Categories Name</label>
                    <input type="text" name="title">
                </div>

                <div class="div_deg">
                    <label>Price</label>
                    <input type="text" name="price">
                </div>

                <div class="div_deg">
                    <label>Quantities</label>
                    <input type="number" name="quantities">
                </div>

                <div class="div_deg">
                    <label>Description</label>
                    <input type="text" name="type">
                </div>

                <div class="div_deg">
                    <label>Upload Image</label>
                    <input type="file" name="image"></input>
                </div>

                <div class="div_deg">
                    <input class="btn btn-primary" type="submit" value="Add Categories">
                </div>

                </form>
            </div>



          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admin/js/charts-home.js"></script>
    <script src="admin/js/front.js"></script>
  </body>
</html>
