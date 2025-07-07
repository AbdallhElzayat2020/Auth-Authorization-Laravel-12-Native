# 🔐 Laravel 12 - Auth & Social Login System Without Packages

A clean and secure **Laravel 12** authentication and authorization system **without using any third-party packages** (like Laravel Breeze, Jetstream, Fortify, or Socialite UI). It includes full account management, OTP verification, and social logins via **Google, Facebook, and GitHub**.

---

## 🚀 Features

### ✅ User Authentication
- 🔑 **Login & Registration**
- 📧 **Email Verification using OTP** (no external package)
- 🔁 **Password Reset** via email with secure token
- 🔒 **Change Password** with current password validation
- 👤 **Profile Update** (name, username, email, password, image)
- 🗝️ **Remember Me** functionality
- ✉️ **Email Notifications** for password reset

---

### 🌐 Social Authentication (No UI Packages)
Social login via:
- 🟦 **Facebook**
- 🟥 **Google**
- ⬛ **GitHub**

Each social account is securely handled with:
- Email matching & linking to existing users
- Avatar support
- Email verification required before full access

---

## 📌 Technologies Used

- Laravel 12
- Laravel Mail (SMTP or Mailtrap for testing)
- Tailwind CSS (for frontend)
- Font Awesome (for social icons)
- OTP stored in DB and verified manually
- Social login logic using `Laravel\Socialite`

---


# Database
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=your password if exists

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="Laravel Auth"

# Social Auth
GOOGLE_CLIENT_ID=xxx.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=xxx
GOOGLE_CALLBACK_URL=http://localhost:8000/auth/google/callback

FACEBOOK_CLIENT_ID=your_fb_id
FACEBOOK_CLIENT_SECRET=your_fb_secret
FACEBOOK_CALLBACK_URL=http://localhost:8000/auth/facebook/callback

GITHUB_CLIENT_ID=your_github_id
GITHUB_CLIENT_SECRET=your_github_secret
GITHUB_CALLBACK_URL=http://localhost:8000/auth/github/callback


