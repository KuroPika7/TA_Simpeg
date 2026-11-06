@extends('layouts.user_type.guest')

@section('content')
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: relative;
      overflow: hidden;
    }

    .auth-container::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      top: -250px;
      right: -250px;
      animation: float 6s ease-in-out infinite;
    }

    .auth-container::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
      bottom: -200px;
      left: -200px;
      animation: float 8s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-20px);
      }
    }

    .auth-wrapper {
      display: flex;
      width: 100%;
      max-width: 1200px;
      min-height: 600px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
      margin: 2rem;
      position: relative;
      z-index: 1;
      animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .auth-form-section {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem 2.5rem;
      background: white;
    }

    .auth-form-container {
      width: 100%;
      max-width: 420px;
    }

    .auth-brand {
      margin-bottom: 2.5rem;
      animation: fadeIn 0.8s ease-out 0.2s both;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .auth-brand h2 {
      font-size: 2.25rem;
      font-weight: 800;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 0.5rem;
      letter-spacing: -0.5px;
    }

    .auth-brand p {
      color: #64748b;
      font-size: 1rem;
      font-weight: 400;
    }

    .auth-image-section {
      flex: 1;
      background-image: url('../assets/img/auth_placeholder.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
    }

    .auth-image-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.4) 0%, rgba(118, 75, 162, 0.85) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem;
    }

    .auth-image-content {
      text-align: center;
      color: white;
      animation: fadeIn 1s ease-out 0.4s both;
    }

    .auth-image-content h3 {
      font-size: 2.75rem;
      font-weight: 800;
      margin-bottom: 1rem;
      text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
      letter-spacing: -1px;
    }

    .auth-image-content p {
      font-size: 1.15rem;
      opacity: 0.95;
      font-weight: 300;
      line-height: 1.6;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      color: #334155;
      font-weight: 600;
      font-size: 0.875rem;
      letter-spacing: 0.3px;
    }

    .form-control-modern {
      width: 100%;
      padding: 0.875rem 1.125rem;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      font-size: 0.95rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      background: #f8fafc;
      font-weight: 400;
    }

    .form-control-modern:focus {
      outline: none;
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
      transform: translateY(-1px);
    }

    .form-group-modern {
      margin-bottom: 1.5rem;
      animation: fadeIn 0.8s ease-out 0.3s both;
    }

    .btn-primary-modern {
      width: 100%;
      padding: 1rem;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      margin-top: 1.5rem;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-size: 0.875rem;
    }

    .btn-primary-modern:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-primary-modern:active {
      transform: translateY(0);
    }

    .form-check-modern {
      display: flex;
      align-items: center;
      margin: 1.5rem 0;
      animation: fadeIn 0.8s ease-out 0.4s both;
    }

    .form-check-modern input {
      width: 20px;
      height: 20px;
      margin-right: 0.625rem;
      cursor: pointer;
      accent-color: #667eea;
    }

    .form-check-modern label {
      color: #475569;
      font-size: 0.9rem;
      cursor: pointer;
      margin: 0;
      font-weight: 500;
    }

    .auth-links {
      margin-top: 2rem;
      text-align: center;
      animation: fadeIn 0.8s ease-out 0.5s both;
    }

    .auth-links a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      position: relative;
    }

    .auth-links a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -2px;
      left: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .auth-links a:hover::after {
      width: 100%;
    }

    .auth-links a:hover {
      color: #764ba2;
    }

    .error-message {
      color: #ef4444;
      font-size: 0.8rem;
      margin-top: 0.375rem;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .auth-wrapper {
        flex-direction: column;
        margin: 1rem;
        min-height: auto;
      }

      .auth-image-section {
        min-height: 280px;
        order: -1;
      }

      .auth-form-section {
        padding: 2rem 1.5rem;
      }

      .auth-brand h2 {
        font-size: 1.875rem;
      }

      .auth-image-content h3 {
        font-size: 2rem;
      }

      .auth-image-content p {
        font-size: 0.95rem;
      }
    }
  </style>

  <div class="auth-container">
    <div class="auth-wrapper">
      <div class="auth-form-section">
        <div class="auth-form-container">
          <div class="auth-brand">
            <h2>Welcome Back</h2>
            <p>Sign in to continue your journey</p>
          </div>

          <form role="form" method="POST" action="/session">
            @csrf

            <div class="form-group-modern">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control-modern" name="email" id="email"
                placeholder="Enter your email" required>
              @error('email')
                <p class="error-message">{{ $message }}</p>
              @enderror
            </div>

            <div class="form-group-modern">
              <label class="form-label">Password</label>
              <input type="password" class="form-control-modern" name="password" id="password"
                placeholder="Enter your password" required>
              @error('password')
                <p class="error-message">{{ $message }}</p>
              @enderror
            </div>

            <div class="form-check-modern">
              <input type="checkbox" id="rememberMe" name="remember" checked>
              <label for="rememberMe">Remember me</label>
            </div>

            <button type="submit" class="btn-primary-modern">
              Sign In
            </button>
          </form>

          <div class="auth-links">
            <p style="margin-bottom: 0.875rem; color: #64748b; font-size: 0.9rem;">
              <a href="/login/forgot-password">Forgot your password?</a>
            </p>
            <p style="color: #64748b; margin: 0; font-size: 0.9rem;">
              Don't have an account?
              <a href="register">Create Account</a>
            </p>
          </div>
        </div>
      </div>

      <div class="auth-image-section">
        <div class="auth-image-overlay">
          <div class="auth-image-content">
            <h3 class="text-white">Start Your Journey</h3>
            <p>Access your dashboard and manage<br>everything in one place</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
