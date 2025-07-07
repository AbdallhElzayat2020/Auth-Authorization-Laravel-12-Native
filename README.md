<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laravel 12 – Auth & Social Login (No Packages)</title>
  <style>
    :root {
      --brand: #2563eb;
      --bg: #0f172a;
      --bg-card: #1e293b;
      --text: #e2e8f0;
      --accent: #10b981;
      --border: #334155;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: "Segoe UI", Ubuntu, sans-serif;
      line-height: 1.6;
      background: var(--bg);
      color: var(--text);
      padding: 2rem;
    }
    h1, h2, h3 { color: var(--accent); margin-top: 1.2em; }
    code, pre { background: #0e1a26; color: #93c5fd; padding: .2em .4em; border-radius: 4px; }
    a { color: var(--brand); }
    .container {
      max-width: 920px;
      margin: auto;
      background: var(--bg-card);
      padding: 2.5rem 3rem;
      border: 1px solid var(--border);
      border-radius: 12px;
      box-shadow: 0 4px 16px rgb(0 0 0 / .35);
    }
    ul.fa-list { list-style: none; padding-left: 0; }
    ul.fa-list li::before {
      content: "\f00c";
      font-family: "Font Awesome 5 Free";
      font-weight: 900;
      margin-right: .6rem;
      color: var(--accent);
    }
    .badges img { height: 28px; margin-right: .35rem; vertical-align: middle; }
    .code-block {
      background: #0e1a26;
      border: 1px solid #1e293b;
      border-radius: 6px;
      padding: 1rem;
      overflow-x: auto;
      margin: 1rem 0;
    }
  </style>
  <!-- Font Awesome for decorative list icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <h1>🔐 Laravel 12 Auth & Social Login <span style="font-weight: 400;">— No Packages</span></h1>

    <p>A modern, secure <strong>Laravel 12</strong> authentication system <em>without</em> Laravel Breeze, Jetstream, or Fortify. Includes OTP account verification and social logins with <strong>Google, Facebook, GitHub</strong>.</p>

    <h2>🚀 Features</h2>
    <ul class="fa-list">
      <li><strong>Login & Registration</strong> (email / password)</li>
      <li>📧 OTP email verification (no external package)</li>
      <li>🔁 Password reset + change‑password flow</li>
      <li>👤 Profile &amp; password update</li>
      <li>🌐 Social login: Google, Facebook, GitHub</li>
      <li>🛡️ CSRF, validation, token throttling</li>
    </ul>

    <h2>📂 Tech Stack</h2>
    <div class="badges">
      <img src="https://img.shields.io/badge/Laravel-12-E73B36?logo=laravel&logoColor=white"/>
      <img src="https://img.shields.io/badge/TailwindCSS-2.x-38BDF8?logo=tailwindcss&logoColor=white"/>
      <img src="https://img.shields.io/badge/PHP-8.3-8892BF?logo=php&logoColor=white"/>
    </div>

    <h2>⚙️ Quick Start</h2>
    <div class="code-block"><pre><code># 1 · clone &amp; install
git clone https://github.com/your-name/laravel-auth-social.git
cd laravel-auth-social
composer install
npm install &amp;&amp; npm run dev

# 2 · env config
cp .env.example .env
php artisan key:generate

# 3 · migrate
php artisan migrate

# 4 · serve
php artisan serve</code></pre></div>

    <h2>🔑 Environment Example</h2>
    <div class="code-block"><pre><code>MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxxxxxx
MAIL_PASSWORD=xxxxxxxx

GOOGLE_CLIENT_ID=xxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=xxx
GOOGLE_CALLBACK_URL=http://localhost:8000/auth/google/callback</code></pre></div>

    <h2>🛠️ Folder Highlights</h2>
    <div class="code-block"><pre><code>app/
 ├─ Http/Controllers/Auth/
 │   ├─ LoginController.php
 │   ├─ RegisterController.php
 │   ├─ OTPVerificationController.php
 │   └─ Social/
 │       ├─ GoogleAuthController.php
 │       ├─ FacebookAuthController.php
 │       └─ GitHubAuthController.php
 ├─ Mail/SendResetLinkMail.php
 └─ Models/User.php</code></pre></div>

    <h2>🤝 Contributing</h2>
    <p>Pull requests and issues are welcome! Please open a PR if you find a bug or have an improvement.</p>

    <h2>📄 License</h2>
    <p>Released under the <a href="#">MIT License</a>.</p>

    <hr style="border: none; border-top: 1px solid var(--border)"/>

    <p style="text-align:center">Made with 💙 by <strong>Abdallh Elzayat</strong></p>
  </div>
</body>
</html>
