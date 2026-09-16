@extends('layouts.app')

@section('content')

<!-- HOME PAGE START -->

<div class="floating-bubbles">
    <span></span><span></span><span></span><span></span>
    <span></span><span></span><span></span><span></span>
</div>

<!-- ══ NAVBAR ══ -->
<nav class="navbar navbar-expand-lg">
  <div class="container d-flex align-items-center">

    <a class="navbar-brand" href="#">
      <svg class="nav-logo-svg" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#shieldGrad)" opacity="0.9"/>
        <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
        <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="url(#pulseGrad)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <defs>
          <linearGradient id="shieldGrad" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#1e40af"/><stop offset="100%" stop-color="#0891b2"/>
          </linearGradient>
          <linearGradient id="pulseGrad" x1="15" y1="18" x2="29" y2="18" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stop-color="#2563eb"/><stop offset="100%" stop-color="#06b6d4"/>
          </linearGradient>
        </defs>
      </svg>
      <div class="brand-text-wrap">
        <span class="brand-name">MaternalCare</span>
        <span class="brand-tagline" data-i18n="brand_tagline">Health Management System</span>
      </div>
    </a>

    <button class="navbar-toggler ms-auto me-3" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav mx-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="#home"     data-i18n="nav_home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about"    data-i18n="nav_about">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="#impact"   data-i18n="nav_impact">Impact</a></li>
        <li class="nav-item"><a class="nav-link" href="#services" data-i18n="nav_services">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="#gallery"  data-i18n="nav_gallery">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact"  data-i18n="nav_contact">Contact</a></li>
      </ul>

      <div class="nav-controls mt-3 mt-lg-0">

        <!-- Language Switcher -->
        <div class="dropdown">
          <button class="lang-btn dropdown-toggle" id="languageBtn" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-globe2"></i>
            <span id="langLabel">English</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" style="min-width:160px;">
            <li><a class="dropdown-item language-option active-lang" href="#" data-lang="en"><span class="lang-flag">🇬🇧</span> English</a></li>
            <li><a class="dropdown-item language-option" href="#" data-lang="si"><span class="lang-flag">🇱🇰</span> සිංහල</a></li>
            <li><a class="dropdown-item language-option" href="#" data-lang="ta"><span class="lang-flag">🇱🇰</span> தமிழ்</a></li>
          </ul>
        </div>

        <!-- Account -->
        <div class="dropdown">
          <a class="btn account-btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <span class="avatar-ring"><i class="bi bi-person-fill"></i></span>
            <span data-i18n="nav_account">Account</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item login-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                <span class="di-icon"><i class="bi bi-box-arrow-in-right"></i></span>
                <div>
                  <div style="font-size:13.5px;font-weight:600;" data-i18n="nav_login">Login</div>
                  <div style="font-size:11px;color:#94a3b8;font-family:'Poppins',sans-serif;" data-i18n="nav_login_sub">Access your dashboard</div>
                </div>
              </a>
            </li>
            <li><hr class="dropdown-divider mx-3 my-1"></li>
            <li>
              <a class="dropdown-item register-item" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">
                <span class="di-icon"><i class="bi bi-person-plus-fill"></i></span>
                <div>
                  <div style="font-size:13.5px;font-weight:600;" data-i18n="nav_register">Register</div>
                  <div style="font-size:11px;color:#94a3b8;font-family:'Poppins',sans-serif;" data-i18n="nav_register_sub">Create a new account</div>
                </div>
              </a>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>
</nav>


<!-- ══ HERO ══ -->
<section id="home" class="hero">
  <div class="col-md-6 text-white">
    <div class="hero-text">
      <h1 data-i18n="hero_title">Safe &amp; Smart Maternal Care System</h1>
      <p class="mt-3" data-i18n="hero_sub">A digital platform designed to help Admins, Midwives, and Mothers manage pregnancy care, clinic visits, and health records efficiently.</p>
      <div class="hero-buttons mt-4">
        <a href="#" class="btn hero-btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal" data-i18n="hero_btn_start">Get Started</a>
        <a href="#about" class="btn hero-btn-outline" data-i18n="hero_btn_learn">Learn More</a>
      </div>
    </div>
  </div>
</section>


<!-- ══ ABOUT ══ -->
<section id="about" class="about-section">
  <div class="container">
    <div class="about-grid">
      <div class="fade-in">
        <span class="section-tag" data-i18n="about_tag">Who We Are</span>
        <h2 class="section-title" data-i18n="about_title">Empowering <em>maternal health</em> through digital innovation</h2>
        <p class="section-sub" data-i18n="about_sub">The Maternal Care Management System is a modern web-based platform designed to support pregnant mothers, midwives, and healthcare staff. Our system helps manage clinic visits, health records, and maternal services efficiently and securely.</p>
        <div class="about-features">
          <div class="about-feat">
            <div class="feat-icon"><i class="bi bi-shield-check"></i></div>
            <div class="feat-text">
              <h5 data-i18n="feat1_title">Secure Health Records</h5>
              <p data-i18n="feat1_sub">Store and manage maternal health information safely with protected digital access.</p>
            </div>
          </div>
          <div class="about-feat">
            <div class="feat-icon"><i class="bi bi-people-fill"></i></div>
            <div class="feat-text">
              <h5 data-i18n="feat2_title">Multi-Role Access</h5>
              <p data-i18n="feat2_sub">Separate dashboards for Admins, Midwives, and Mothers with easy system management.</p>
            </div>
          </div>
          <div class="about-feat">
            <div class="feat-icon"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="feat-text">
              <h5 data-i18n="feat3_title">Real-Time Monitoring</h5>
              <p data-i18n="feat3_sub">Track clinic visits, pregnancy progress, and healthcare reports in real time.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="about-visual fade-in">
        <div class="about-img-wrap"><img src="{{ asset('images/about.jpg') }}" alt="Maternal Care"></div>
        <div class="about-badge">
          <div class="about-badge-num">800+</div>
          <div class="about-badge-label" data-i18n="about_badge">Safe Deliveries</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ══ IMPACT ══ -->
<section id="impact" class="impact-section">
  <div class="container">
    <div class="impact-header fade-in">
      <span class="section-tag" data-i18n="impact_tag">Our Impact</span>
      <h2 class="section-title" data-i18n="impact_title">Making a real <em>difference</em></h2>
      <p class="section-sub" data-i18n="impact_sub">Improving maternal healthcare outcomes through smart digital solutions.</p>
    </div>
    <div class="impact-grid">
      <div class="impact-card fade-in"><div class="impact-icon">🤱</div><div class="impact-num">1,200<span>+</span></div><div class="impact-label" data-i18n="impact_1">Mothers Registered</div></div>
      <div class="impact-card fade-in"><div class="impact-icon">👶</div><div class="impact-num">800<span>+</span></div><div class="impact-label" data-i18n="impact_2">Safe Deliveries</div></div>
      <div class="impact-card fade-in"><div class="impact-icon">🏥</div><div class="impact-num">50<span>+</span></div><div class="impact-label" data-i18n="impact_3">Healthcare Staff</div></div>
      <div class="impact-card fade-in"><div class="impact-icon">⚡</div><div class="impact-num">24<span>/7</span></div><div class="impact-label" data-i18n="impact_4">System Availability</div></div>
    </div>
  </div>
</section>


<!-- ══ SERVICES ══ -->
<section id="services" class="services-section">
  <div class="container">
    <div class="services-header fade-in">
      <span class="section-tag" data-i18n="svc_tag">What We Offer</span>
      <h2 class="section-title" data-i18n="svc_title">Comprehensive <em>care services</em></h2>
      <p class="section-sub" data-i18n="svc_sub">Digital healthcare solutions designed to improve every stage of maternal care management.</p>
    </div>
    <div class="services-grid">
      <div class="svc-card fade-in"><div class="svc-icon"><i class="bi bi-person-plus-fill"></i></div><h4 data-i18n="svc1_title">Mother Registration</h4><p data-i18n="svc1_sub">Easily register pregnant mothers and manage complete profile information securely.</p><a href="#" class="svc-link" data-i18n="svc_link">Learn More <i class="bi bi-arrow-right"></i></a></div>
      <div class="svc-card fade-in"><div class="svc-icon"><i class="bi bi-heart-pulse-fill"></i></div><h4 data-i18n="svc2_title">Pregnancy Monitoring</h4><p data-i18n="svc2_sub">Track pregnancy progress, maternal health conditions, and medical updates in real time.</p><a href="#" class="svc-link" data-i18n="svc_link">Learn More <i class="bi bi-arrow-right"></i></a></div>
      <div class="svc-card fade-in"><div class="svc-icon"><i class="bi bi-calendar2-check-fill"></i></div><h4 data-i18n="svc3_title">Clinic Scheduling</h4><p data-i18n="svc3_sub">Manage clinic visits, appointment dates, and follow-up schedules efficiently.</p><a href="#" class="svc-link" data-i18n="svc_link">Learn More <i class="bi bi-arrow-right"></i></a></div>
      <div class="svc-card fade-in"><div class="svc-icon"><i class="bi bi-file-earmark-medical-fill"></i></div><h4 data-i18n="svc4_title">Health Reports</h4><p data-i18n="svc4_sub">Generate digital maternal healthcare reports and monitor medical history quickly.</p><a href="#" class="svc-link" data-i18n="svc_link">Learn More <i class="bi bi-arrow-right"></i></a></div>
    </div>
  </div>
</section>


<!-- ══ GALLERY ══ -->
<section id="gallery" class="gallery-section">
  <div class="container">
    <div class="gallery-header fade-in">
      <span class="section-tag" data-i18n="gal_tag">Our Gallery</span>
      <h2 class="section-title" data-i18n="gal_title">Moments from <em>maternal care services</em></h2>
      <p class="section-sub" data-i18n="gal_sub">Explore our healthcare environment, clinic services, and support activities for mothers and babies.</p>
    </div>
    <div class="gallery-grid">
      <div class="gallery-item fade-in"><img src="{{ asset('images/image4.jfif') }}"><div class="gallery-overlay"><h4 data-i18n="gal1_title">Prenatal Care</h4><p data-i18n="gal1_sub">Safe and professional healthcare services.</p></div></div>
      <div class="gallery-item fade-in"><img src="{{ asset('images/image2.jfif') }}"><div class="gallery-overlay"><h4 data-i18n="gal2_title">Clinic Visits</h4><p data-i18n="gal2_sub">Organized appointment and clinic management.</p></div></div>
      <div class="gallery-item fade-in"><img src="{{ asset('images/set3.jpg') }}"><div class="gallery-overlay"><h4 data-i18n="gal3_title">Mother Support</h4><p data-i18n="gal3_sub">Helping mothers throughout pregnancy care.</p></div></div>
      <div class="gallery-item fade-in"><img src="{{ asset('images/image1.jfif') }}"><div class="gallery-overlay"><h4 data-i18n="gal4_title">Healthcare Staff</h4><p data-i18n="gal4_sub">Experienced medical and midwife professionals.</p></div></div>
      <div class="gallery-item fade-in"><img src="{{ asset('images/new3.jfif') }}"><div class="gallery-overlay"><h4 data-i18n="gal5_title">Digital Records</h4><p data-i18n="gal5_sub">Modern digital healthcare management system.</p></div></div>
      <div class="gallery-item fade-in"><img src="{{ asset('images/image3.jfif') }}"><div class="gallery-overlay"><h4 data-i18n="gal6_title">Happy Mothers</h4><p data-i18n="gal6_sub">Improving maternal healthcare experiences.</p></div></div>
    </div>
  </div>
</section>


<!-- ══ CONTACT ══ -->
<section id="contact" class="contact-section">
  <div class="container">
    <div class="contact-header text-center fade-in">
      <span class="section-tag" data-i18n="con_tag">Contact Us</span>
      <h2 class="section-title" data-i18n="con_title">We are always here to <em>support mothers</em></h2>
      <p class="section-sub" data-i18n="con_sub">Connect with our maternal healthcare team anytime for support, clinic information, and healthcare guidance.</p>
    </div>
    <div class="contact-grid">
      <div class="contact-box fade-in"><div class="contact-icon"><i class="bi bi-geo-alt-fill"></i></div><h4 data-i18n="con1_title">Our Location</h4><p data-i18n="con1_sub">Colombo, Sri Lanka<br>Maternal Healthcare Center</p></div>
      <div class="contact-box fade-in"><div class="contact-icon"><i class="bi bi-telephone-fill"></i></div><h4 data-i18n="con2_title">Phone Number</h4><p>+94 71 234 5678<br>+94 11 234 5678</p></div>
      <div class="contact-box fade-in"><div class="contact-icon"><i class="bi bi-envelope-fill"></i></div><h4 data-i18n="con3_title">Email Address</h4><p>maternalcare@gmail.com<br>support@maternalcare.lk</p></div>
      <div class="contact-box fade-in"><div class="contact-icon"><i class="bi bi-clock-fill"></i></div><h4 data-i18n="con4_title">Working Hours</h4><p data-i18n="con4_sub">Monday - Friday<br>8.00 AM - 6.00 PM</p></div>
    </div>
    <div class="social-wrapper text-center fade-in">
      <h5 class="mb-4" data-i18n="social_title">Follow Us</h5>
      <div class="social-icons">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-whatsapp"></i></a>
        <a href="#"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom text-center fade-in">
    <p data-i18n="footer">© 2026 MaternalCare System | Designed with care for mothers and babies 💙❤️</p>
  </div>
</section>


<!-- ══ LOGIN MODAL ══ -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered auth-dialog">
    <div class="modal-content auth-modal">
      <div class="auth-banner">
        <div class="auth-logo">
          <svg class="auth-logo-svg" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#mShieldG2)" opacity="0.9"/>
            <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
            <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <defs><linearGradient id="mShieldG2" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#1e40af"/><stop offset="100%" stop-color="#0891b2"/></linearGradient></defs>
          </svg>
          <span class="auth-logo-name">Maternal<span>Care</span></span>
        </div>
        <h2 data-i18n="login_title">Welcome back</h2>
        <p data-i18n="login_sub">Sign in to your account to continue</p>
      </div>
      <div class="auth-body">
        
       <form method="POST" action="{{ route('login') }}">
    @csrf

    <span class="auth-label">User ID</span>

    <div class="auth-field">
        <input
            type="text"
            id="loginEmail"
            name="email"
            placeholder="Enter User ID"
            required
        >
        <i class="bi bi-person field-icon"></i>
    </div>

    <span class="auth-label">Password</span>

    <div class="auth-field">
        <input
            type="password"
            id="loginPass"
            name="password"
            placeholder="Enter Password"
            required
        >
        <i class="bi bi-lock field-icon"></i>
        <i class="bi bi-eye eye-toggle" id="loginEye"></i>
    </div>

    <div class="auth-check-row">
        <label>
            <input type="checkbox" id="showLoginPass" style="accent-color:#2563eb;">
            Show password
        </label>

        <a href="#">Forgot password?</a>
    </div>

    <button type="submit" class="auth-submit-btn">
        <i class="bi bi-box-arrow-in-right me-2"></i>
        Sign In
    </button>

    <p class="auth-switch">
        Don't have an account?
        <a href="#"
           data-bs-toggle="modal"
           data-bs-target="#registerModal"
           data-bs-dismiss="modal">
            Create one
        </a>
    </p>
</form>      </div>
    </div>
  </div>
</div>

<!-- ══ REGISTER MODAL ══ -->
<div class="modal fade" id="registerModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered auth-dialog">
    <div class="modal-content auth-modal">
      <div class="auth-banner">
        <div class="auth-logo">
          <svg class="auth-logo-svg" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#rShieldG)" opacity="0.9"/>
            <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
            <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <defs><linearGradient id="rShieldG" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#1e40af"/><stop offset="100%" stop-color="#0891b2"/></linearGradient></defs>
          </svg>
          <span class="auth-logo-name">Maternal<span>Care</span></span>
        </div>
        <h2 data-i18n="reg_title">Midwife Registration</h2>
        <p data-i18n="reg_sub">Complete the form below to request a Midwife account.
                    Your account will be activated after Admin approval.</p>
      </div>
      <div class="auth-body">
       <form method="POST" action="{{ route('midwife.register') }}">
    @csrf
    <!-- Full Name -->
    <span class="auth-label">Full Name</span>
    <div class="auth-field">
        <input type="text" id="name" name="name" placeholder="Enter Full Name">
        <i class="bi bi-person field-icon"></i>
    </div>

    <!-- Email -->
    <span class="auth-label">Email Address</span>
    <div class="auth-field">
        <input type="email" id="email" name="email" placeholder="Enter Email Address">
        <i class="bi bi-envelope field-icon"></i>
    </div>

    <!-- Phone -->
    <span class="auth-label">Phone Number</span>
    <div class="auth-field">
        <input type="tel" id="phone" name="phone" placeholder="+94 71 234 5678">
        <i class="bi bi-telephone field-icon"></i>
    </div>

    <!-- NIC -->
    <span class="auth-label">NIC Number</span>
    <div class="auth-field">
        <input type="text" id="nic" name="nic" placeholder="Enter NIC Number">
        <i class="bi bi-credit-card field-icon"></i>
    </div>

    <!-- Address -->
    <span class="auth-label">Address</span>
    <div class="auth-field">
        <input type="text" id="address" name="address" placeholder="Enter Address">
        <i class="bi bi-geo-alt field-icon"></i>
    </div>

    <!-- Password -->
    <span class="auth-label">Password</span>
    <div class="auth-field">
        <input type="password" id="regPass" name="password" placeholder="Create Password">
        <i class="bi bi-lock field-icon"></i>
        <i class="bi bi-eye eye-toggle" id="regEye"></i>
    </div>

    <!-- Confirm Password -->
    <span class="auth-label">Confirm Password</span>
    <div class="auth-field">
        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password">
        <i class="bi bi-lock field-icon"></i>
    </div>

    <!-- Show Password -->
    <div class="auth-check-row" style="margin-top:4px;margin-bottom:22px;">
        <label>
            <input type="checkbox" id="showRegPass" style="accent-color:#2563eb;">
            Show Password
        </label>
    </div>

    <!-- Register Button -->
    <button type="submit" class="auth-submit-btn">
        <i class="bi bi-person-check-fill me-2"></i>
        Request Registration
    </button>

    <p class="auth-switch">
        Already have an account?
        <a href="#" data-bs-toggle="modal"
           data-bs-target="#loginModal"
           data-bs-dismiss="modal">
            Sign In
        </a>
    </p>

</form>
      </div>
    </div>
  </div>
</div>



@endsection