<x-guest-layout>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e0f7fa; /* خلفية فاتحة ذات لون أزرق باهت */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .authentication-card {
            max-width: 400px;
            width: 100%;
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #b0bec5; /* لون حد أزرق رمادي */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* ظل خفيف لبطاقة المصادقة */
            border-radius: 10px;
        }
        .authentication-card-logo {
            text-align: center;
            margin-bottom: 20px;
            font-size: 48px; /* حجم كبير للحروف BR */
            font-weight: bold; /* خط عريض للحروف */
            color: #0288d1; /* لون أزرق للحروف */
        }
        .validation-errors {
            margin-bottom: 16px;
            color: #d32f2f; /* لون أحمر للأخطاء */
        }
        .status-message {
            margin-bottom: 16px;
            font-size: 14px;
            color: #388e3c; /* لون أخضر للرسائل */
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #37474f; /* لون رمادي غامق */
        }
        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #90a4ae; /* لون حدود أزرق رمادي */
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
        }
        .form-input:focus {
            outline: none;
            border-color: #0288d1; /* لون حدود أزرق عند التركيز */
            box-shadow: 0 0 0 1px #0288d1;
        }
        .form-checkbox-label {
            font-size: 14px;
            color: #37474f; /* لون رمادي غامق */
        }
        .form-checkbox {
            height: 16px;
            width: 16px;
            margin-right: 8px;
        }
        .link {
            font-size: 14px;
            color: #0288d1; /* لون أزرق للرابط */
            text-decoration: none;
            transition: color 0.2s;
        }
        .link:hover {
            color: #01579b; /* لون أزرق غامق عند التمرير */
        }
        .submit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #ffffff;
            background-color: #0288d1; /* لون أزرق زاهي للزر */
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .submit-button:hover {
            background-color: #01579b; /* لون أزرق غامق عند التمرير */
        }
        .form-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>

    <div class="authentication-card">
        <div class="authentication-card-logo">
            BR
        </div>

        <x-validation-errors class="validation-errors" />

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" :value="old('email')" required autofocus autocomplete="username" class="form-input">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-checkbox-label">
                    <input id="remember_me" name="remember" type="checkbox" class="form-checkbox">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link">Forgot your password?</a>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="submit-button">Log in</button>
            </div>

            <div class="form-footer">
                Don't have an account?
                <a href="{{ route('register') }}" class="link">Register</a>
            </div>
        </form>
    </div>
</x-guest-layout>
