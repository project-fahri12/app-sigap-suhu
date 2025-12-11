<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Sistem Informasi Gerbang Pendaftaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --dark-blue: #004D99;
            --tosca: #00CC99;
            --light-gray: #F8F9FA;
            --medium-gray: #E9ECEF;
            --text-dark: #333333;
            --text-light: #6C757D;
            --white: #FFFFFF;
            --shadow: rgba(0, 0, 0, 0.08);
            --shadow-hover: rgba(0, 0, 0, 0.12);
        }

        body {
            font-family: 'Nunito Sans', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--white);
        }

        h1,
        h2,
        h3,
        h4 {
            font-weight: 700;
            line-height: 1.3;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        section {
            padding: 80px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: var(--dark-blue);
        }

        .section-title h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .btn {
            display: inline-block;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--tosca);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #00b386;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 204, 153, 0.2);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--dark-blue);
            border: 2px solid var(--dark-blue);
        }

        .btn-secondary:hover {
            background-color: rgba(0, 77, 153, 0.05);
            transform: translateY(-3px);
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 15px var(--shadow);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px var(--shadow-hover);
        }

        /* Header Styles */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            width: 70%;
            height: auto;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: var(--tosca);
        }

        .nav-menu .login-btn {
            background-color: var(--dark-blue);
            color: var(--white);
            padding: 10px 25px;
            border-radius: 50px;
        }

        .nav-menu .login-btn:hover {
            background-color: #003d7a;
            color: var(--white);
        }

        .mobile-menu-btn {
            display: none;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: var(--dark-blue);
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background-color: var(--light-gray);
            padding: 100px 0;
        }

        .hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .hero-content {
            flex: 1;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            color: var(--dark-blue);
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 35px;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-illustration {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--tosca) 0%, var(--dark-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            color: white;
            font-size: 1.5rem;
            text-align: center;
        }

        /* Gelombang Section */
        .gelombang-section {
            background-color: var(--white);
        }

        .gelombang-cards {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .gelombang-card {
            flex: 1;
            min-width: 280px;
            max-width: 350px;
            text-align: center;
        }

        .gelombang-icon {
            width: 70px;
            height: 70px;
            background-color: rgba(0, 204, 153, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: var(--tosca);
            font-size: 1.8rem;
        }

        .gelombang-card h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            color: var(--dark-blue);
        }

        .gelombang-dates {
            font-weight: 600;
            color: var(--tosca);
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        /* Visi Misi Section */
        .visi-misi-section {
            background-color: var(--light-gray);
        }

        .visi-misi-container {
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
        }

        .visi-card,
        .misi-card {
            flex: 1;
            min-width: 300px;
        }

        .visi-misi-icon {
            font-size: 2.5rem;
            color: var(--tosca);
            margin-bottom: 25px;
        }

        .misi-list {
            list-style: none;
        }

        .misi-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .misi-list i {
            color: var(--tosca);
            margin-top: 5px;
        }

        /* Fasilitas Section */
        .fasilitas-section {
            background-color: var(--white);
        }

        .fasilitas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .fasilitas-card {
            text-align: center;
            padding: 25px;
        }

        .fasilitas-icon {
            font-size: 2.5rem;
            color: var(--tosca);
            margin-bottom: 20px;
        }

        .fasilitas-card h3 {
            color: var(--dark-blue);
            margin-bottom: 15px;
        }

        /* Persyaratan Section */
        .persyaratan-section {
            background-color: var(--light-gray);
        }

        .persyaratan-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .persyaratan-list {
            list-style: none;
        }

        .persyaratan-list li {
            padding: 20px;
            background-color: var(--white);
            margin-bottom: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 3px 10px var(--shadow);
        }

        .persyaratan-list i {
            color: var(--tosca);
            font-size: 1.5rem;
        }

        /* Alur Section */
        .alur-section {
            background-color: var(--white);
        }

        .alur-steps {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
        }

        .alur-steps::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 10%;
            right: 10%;
            height: 3px;
            background-color: var(--medium-gray);
            z-index: 1;
        }

        .alur-step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
            min-width: 150px;
            margin-bottom: 30px;
        }

        .step-number {
            width: 80px;
            height: 80px;
            background-color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--tosca);
            font-size: 1.8rem;
            font-weight: 700;
            border: 3px solid var(--medium-gray);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .alur-step h3 {
            font-size: 1.2rem;
            color: var(--dark-blue);
        }

        /* Pengumuman Section */
        .pengumuman-section {
            background-color: var(--light-gray);
        }

        .pengumuman-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .pengumuman-card {
            padding: 25px;
        }

        .pengumuman-date {
            color: var(--tosca);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pengumuman-card h3 {
            color: var(--dark-blue);
            margin-bottom: 15px;
        }

        /* Kontak Section */
        .kontak-section {
            background-color: var(--white);
        }

        .kontak-container {
            display: flex;
            gap: 50px;
            flex-wrap: wrap;
        }

        .kontak-info {
            flex: 1;
            min-width: 300px;
        }

        .kontak-form {
            flex: 1;
            min-width: 300px;
        }

        .kontak-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 30px;
        }

        .kontak-icon {
            width: 50px;
            height: 50px;
            background-color: rgba(0, 204, 153, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--tosca);
            font-size: 1.3rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-blue);
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 1rem;
        }

        .map-placeholder {
            width: 100%;
            height: 200px;
            background-color: var(--light-gray);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            margin-top: 30px;
            border: 2px dashed var(--medium-gray);
        }

        /* Footer */
        footer {
            background-color: var(--dark-blue);
            color: var(--white);
            padding: 70px 0 30px;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 40px;
            margin-bottom: 50px;
        }

        .footer-logo {
            flex: 2;
            min-width: 250px;
        }

        .footer-links {
            flex: 1;
            min-width: 150px;
        }

        .footer-links h3 {
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--tosca);
        }

        .social-icons {
            display: flex;
            gap: 20px;
            margin-top: 25px;
        }

        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-icons a:hover {
            background-color: var(--tosca);
            transform: translateY(-5px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .alur-steps::before {
                display: none;
            }

            .alur-step {
                margin-bottom: 40px;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-menu {
                position: fixed;
                top: 80px;
                left: 0;
                width: 100%;
                background-color: var(--white);
                flex-direction: column;
                align-items: center;
                padding: 30px 0;
                gap: 25px;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                transform: translateY(-100%);
                opacity: 0;
                transition: all 0.3s ease;
            }

            .nav-menu.active {
                transform: translateY(0);
                opacity: 1;
            }

            .hero-content h1 {
                font-size: 2.2rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            section {
                padding: 60px 0;
            }
        }

        @media (max-width: 576px) {
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 250px;
                text-align: center;
            }

            .gelombang-card {
                min-width: 100%;
            }
        }

        /* Hero Section dengan Background Pattern */
.hero {
    position: relative;
    background-color: var(--light-gray);
    overflow: hidden;
    padding: 120px 0 100px;
}

/* Background Pattern */
.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.pattern-dots {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: radial-gradient(var(--tosca) 2px, transparent 2px);
    background-size: 40px 40px;
    opacity: 0.1;
    animation: float-dots 20s linear infinite;
}

.pattern-waves {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        url("data:image/svg+xml,%3Csvg width='100' height='20' viewBox='0 0 100 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21.184 20c.357-.13.72-.264 1.088-.402l1.768-.661C33.64 15.347 39.647 14 50 14c10.271 0 15.362 1.222 24.629 4.928.955.383 1.869.74 2.75 1.072h6.225c-2.51-.73-5.139-1.691-8.233-2.928C65.888 13.278 60.562 12 50 12c-10.626 0-16.855 1.397-26.66 5.063l-1.767.662c-2.475.923-4.66 1.674-6.724 2.275h6.335zm0-20C13.258 2.892 8.077 4 0 4V2c5.744 0 9.951-.574 14.85-2h6.334zM77.38 0C85.239 2.966 90.502 4 100 4V2c-6.842 0-11.386-.542-16.396-2h-6.225zM0 14c8.44 0 13.718-1.21 22.272-4.402l1.768-.661C33.64 5.347 39.647 4 50 4c10.271 0 15.362 1.222 24.629 4.928C84.112 12.722 89.438 14 100 14v-2c-10.271 0-15.362-1.222-24.629-4.928C65.888 3.278 60.562 2 50 2 39.374 2 33.145 3.397 23.34 7.063l-1.767.662C13.223 10.84 8.163 12 0 12v2z' fill='%23004D99' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.15;
    animation: wave-animation 25s linear infinite;
}

.pattern-squares {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: 
        linear-gradient(to right, rgba(0, 77, 153, 0.03) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(0, 77, 153, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: float-squares 30s linear infinite;
}

/* Animations */
@keyframes float-dots {
    0% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-20px) translateX(20px); }
    100% { transform: translateY(0) translateX(0); }
}

@keyframes wave-animation {
    0% { background-position: 0 0; }
    100% { background-position: 1000px 0; }
}

@keyframes float-squares {
    0% { background-position: 0 0; }
    100% { background-position: 100px 100px; }
}

/* Hero Container */
.hero-container {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.hero-content {
    flex: 1;
}

.hero-content h1 {
    font-size: 2.8rem;
    color: var(--dark-blue);
    margin-bottom: 20px;
    line-height: 1.2;
    font-weight: 700;
}

.hero-subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    margin-bottom: 35px;
    max-width: 500px;
    line-height: 1.6;
}

/* Hero Buttons */
.hero-buttons {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.btn-primary {
    background-color: var(--tosca);
    border-color: var(--tosca);
    color: var(--white);
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #00b386;
    border-color: #00b386;
    color: var(--white);
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 204, 153, 0.2);
}

.btn-secondary {
    background-color: transparent;
    border: 2px solid var(--dark-blue);
    color: var(--dark-blue);
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background-color: rgba(0, 77, 153, 0.05);
    color: var(--dark-blue);
    transform: translateY(-3px);
}

/* Hero Stats */
.hero-stats {
    display: flex;
    gap: 30px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    padding: 15px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    min-width: 120px;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--tosca);
    margin-bottom: 5px;
}

.stat-text {
    font-size: 0.9rem;
    color: var(--text-light);
    font-weight: 500;
}

/* Hero Image */
.hero-image {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-illustration {
    width: 100%;
    max-width: 500px;
    height: 400px;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--tosca) 0%, var(--dark-blue) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 77, 153, 0.2);
}

/* Floating Elements */
.floating-element {
    position: absolute;
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    animation: float 6s ease-in-out infinite;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.element-1 {
    top: 20px;
    left: 20px;
    animation-delay: 0s;
}

.element-2 {
    top: 20px;
    right: 20px;
    animation-delay: 2s;
}

.element-3 {
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

/* Illustration Content */
.illustration-content {
    position: relative;
    z-index: 2;
}

.illustration-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.hero-illustration h3 {
    color: white;
    font-size: 1.8rem;
    margin-bottom: 10px;
    font-weight: 600;
}

.hero-illustration p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin-bottom: 20px;
}

.illustration-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    padding: 8px 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.badge-text {
    font-weight: 600;
    font-size: 0.9rem;
    color: white;
}

.badge-subtext {
    display: block;
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.8);
}

/* Responsive Design */
@media (max-width: 992px) {
    .hero-container {
        flex-direction: column;
        text-align: center;
    }
    
    .hero-content {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .hero-stats {
        justify-content: center;
    }
    
    .hero-content h1 {
        font-size: 2.2rem;
    }
    
    .hero-illustration {
        height: 350px;
        margin-top: 30px;
    }
}

@media (max-width: 768px) {
    .hero {
        padding: 100px 0 60px;
    }
    
    .hero-content h1 {
        font-size: 1.8rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
        max-width: 250px;
    }
    
    .hero-stats {
        gap: 15px;
    }
    
    .stat-item {
        min-width: 100px;
        padding: 10px;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-illustration {
        height: 300px;
        padding: 20px;
    }
    
    .illustration-icon {
        font-size: 3rem;
    }
    
    .hero-illustration h3 {
        font-size: 1.5rem;
    }
}
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav class="nav-container">

                <!-- Logo -->
                <div class="logo">
                    <img src="{{ asset('assets/logo-sigap.svg') }}" alt="SIGAP Logo" class="logo-img">
                </div>

                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#pendaftaran">Pendaftaran</a></li>
                    <li><a href="#validasi">Validasi</a></li>
                    <li><a href="#pengumuman">Pengumuman</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                    <li><a href="#" class="login-btn">Login</a></li>
                </ul>

            </nav>
        </div>
    </header>
{{-- import components --}}
    @yield('contnet ')
   <!-- Hero Section -->
<section class="hero" id="home">
    <!-- Background Pattern -->
    <div class="hero-pattern">
        <div class="pattern-dots"></div>
        <div class="pattern-waves"></div>
        <div class="pattern-squares"></div>
    </div>
    
    <div class="container">
        <div class="hero-container">
            <div class="hero-content">
                <h1>SIGAP – Sistem Informasi Gerbang Pendaftaran</h1>
                <p class="hero-subtitle">PPDB Online Cepat, Mudah, dan Transparan untuk masa depan pendidikan yang lebih baik.</p>
                <div class="hero-buttons">
                    <a href="#pendaftaran" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </a>
                    <a href="#persyaratan" class="btn btn-secondary">
                        <i class="fas fa-file-alt me-2"></i> Lihat Persyaratan
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">1.500+</div>
                        <div class="stat-text">Pendaftar Tahun Ini</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-text">Kepuasan Pengguna</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-text">Layanan Online</div>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-illustration">
                    <!-- Floating elements -->
                    <div class="floating-element element-1">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="floating-element element-2">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="floating-element element-3">
                        <i class="fas fa-laptop"></i>
                    </div>
                    
                    <!-- Main illustration -->
                    <div class="illustration-content">
                        <div class="illustration-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>PPDB Online 2024</h3>
                        <p>Pendaftaran Peserta Didik Baru</p>
                        <div class="illustration-badge">
                            <span class="badge-text">Gelombang 2</span>
                            <span class="badge-subtext">Berlangsung</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Gelombang Pendaftaran Section -->
    <section class="gelombang-section" id="pendaftaran">
        <div class="container">
            <div class="section-title">
                <h2>Gelombang Pendaftaran PPDB</h2>
                <p>Pilih gelombang pendaftaran yang sesuai dengan waktu Anda</p>
            </div>
            <div class="gelombang-cards">
                <div class="gelombang-card card">
                    <div class="gelombang-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Gelombang 1</h3>
                    <div class="gelombang-dates">15 Januari - 15 Februari 2024</div>
                    <p>Pendaftaran awal dengan kuota terbatas. Dapatkan potongan biaya pendaftaran 20%.</p>
                </div>
                <div class="gelombang-card card">
                    <div class="gelombang-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Gelombang 2</h3>
                    <div class="gelombang-dates">1 Maret - 1 April 2024</div>
                    <p>Pendaftaran reguler dengan kuota lebih banyak. Waktu optimal untuk pendaftaran.</p>
                </div>
                <div class="gelombang-card card">
                    <div class="gelombang-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <h3>Gelombang 3</h3>
                    <div class="gelombang-dates">15 April - 15 Mei 2024</div>
                    <p>Pendaftaran akhir. Kuota terbatas dan hanya tersedia untuk program tertentu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="visi-misi-section">
        <div class="container">
            <div class="section-title">
                <h2>Visi & Misi Sekolah</h2>
                <p>Mewujudkan pendidikan berkualitas untuk generasi unggul</p>
            </div>
            <div class="visi-misi-container">
                <div class="visi-card card">
                    <div class="visi-misi-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Visi</h3>
                    <p>Menjadi lembaga pendidikan unggul yang menghasilkan lulusan berkarakter, berdaya saing global,
                        dan berakhlak mulia, serta mampu berkontribusi positif bagi masyarakat dan bangsa.</p>
                </div>
                <div class="misi-card card">
                    <div class="visi-misi-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Misi</h3>
                    <ul class="misi-list">
                        <li><i class="fas fa-check-circle"></i> Menyelenggarakan pendidikan berkualitas dengan kurikulum
                            yang relevan dan inovatif</li>
                        <li><i class="fas fa-check-circle"></i> Mengembangkan karakter siswa melalui pendidikan akhlak
                            dan kepemimpinan</li>
                        <li><i class="fas fa-check-circle"></i> Meningkatkan kompetensi guru dan tenaga kependidikan
                            secara berkelanjutan</li>
                        <li><i class="fas fa-check-circle"></i> Menyediakan fasilitas pendidikan yang memadai dan
                            teknologi terkini</li>
                        <li><i class="fas fa-check-circle"></i> Menjalin kerjasama dengan orang tua dan masyarakat untuk
                            mendukung proses pendidikan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="fasilitas-section">
        <div class="container">
            <div class="section-title">
                <h2>Fasilitas Sekolah</h2>
                <p>Dukung pembelajaran optimal dengan fasilitas lengkap dan modern</p>
            </div>
            <div class="fasilitas-grid">
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3>Laboratorium</h3>
                    <p>Laboratorium sains dan komputer dengan peralatan modern untuk eksperimen dan penelitian.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3>Perpustakaan Digital</h3>
                    <p>Koleksi buku lengkap dengan akses digital dan ruang baca yang nyaman.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Asrama</h3>
                    <p>Asrama nyaman dengan pengawasan 24 jam untuk siswa yang membutuhkan.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3>Lapangan Olahraga</h3>
                    <p>Lapangan sepak bola, basket, voli, dan fasilitas olahraga lainnya.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3>Multimedia Center</h3>
                    <p>Studio audio visual dan ruang kreatif untuk pengembangan bakat siswa.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Kantin Sehat</h3>
                    <p>Kantin dengan makanan bergizi dan suasana yang bersih serta nyaman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Persyaratan Section -->
    <section class="persyaratan-section" id="persyaratan">
        <div class="container">
            <div class="section-title">
                <h2>Persyaratan Pendaftaran</h2>
                <p>Siapkan dokumen-dokumen berikut untuk proses pendaftaran</p>
            </div>
            <div class="persyaratan-container">
                <ul class="persyaratan-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Fotokopi Kartu Keluarga (KK)</h3>
                            <p>Fotokopi KK yang masih berlaku dan terbaru</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Akta Kelahiran</h3>
                            <p>Fotokopi akta kelahiran calon siswa</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Ijazah / Surat Keterangan Lulus</h3>
                            <p>Ijazah sekolah sebelumnya atau surat keterangan lulus</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Pas Foto</h3>
                            <p>4 lembar pas foto ukuran 3x4 dengan latar belakang merah</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Rapor Semester</h3>
                            <p>Fotokopi rapor semester 1-5 untuk SMA/SMK atau semester 1-5 untuk SMP</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Berkas Tambahan</h3>
                            <p>Surat keterangan lain sesuai dengan program yang dipilih</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran Section -->
    <section class="alur-section">
        <div class="container">
            <div class="section-title">
                <h2>Alur Pendaftaran</h2>
                <p>Proses pendaftaran yang mudah dan terstruktur</p>
            </div>
            <div class="alur-steps">

                <div class="alur-step">
                    <div class="step-number">1</div>
                    <h3>Isi Formulir</h3>
                    <p>Mengisi formulir awal dan mendapatkan Kode Pendaftaran SIGAP.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">2</div>
                    <h3>Login</h3>
                    <p>Masuk menggunakan Kode Pendaftaran sebagai username dan tanggal lahir sebagai password.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">3</div>
                    <h3>Pembayaran Pendaftaran</h3>
                    <p>Melakukan pembayaran biaya pendaftaran.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">4</div>
                    <h3>Lengkapi Data & Upload Berkas</h3>
                    <p>Mengisi data lengkap dan mengunggah berkas dalam format PDF.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">5</div>
                    <h3>Validasi</h3>
                    <p>Menunggu proses verifikasi data oleh admin.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">6</div>
                    <h3>Cetak Bukti</h3>
                    <p>Mencetak bukti pendaftaran untuk keperluan daftar ulang.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- Pengumuman Section -->
    <section class="pengumuman-section" id="pengumuman">
        <div class="container">
            <div class="section-title">
                <h2>Informasi & Pengumuman Terbaru</h2>
                <p>Update terkini seputar PPDB dan kegiatan sekolah</p>
            </div>
            <div class="pengumuman-grid">
                <div class="pengumuman-card card">
                    <div class="pengumuman-date">
                        <i class="far fa-calendar"></i> 20 Maret 2024
                    </div>
                    <h3>Jadwal Tes Masuk Gelombang 2</h3>
                    <p>Tes masuk untuk pendaftar gelombang 2 akan dilaksanakan pada tanggal 5 April 2024. Peserta
                        diharapkan hadir 30 menit sebelum tes dimulai.</p>
                </div>
                <div class="pengumuman-card card">
                    <div class="pengumuman-date">
                        <i class="far fa-calendar"></i> 15 Maret 2024
                    </div>
                    <h3>Pengumuman Hasil Seleksi Gelombang 1</h3>
                    <p>Hasil seleksi gelombang 1 telah diumumkan. Silakan cek di akun SIGAP masing-masing. Daftar ulang
                        paling lambat 25 Maret 2024.</p>
                </div>
                <div class="pengumuman-card card">
                    <div class="pengumuman-date">
                        <i class="far fa-calendar"></i> 10 Maret 2024
                    </div>
                    <h3>Open House Virtual 2024</h3>
                    <p>Ikuti open house virtual kami pada 28 Maret 2024 untuk mengenal lebih dekat program dan fasilitas
                        sekolah. Daftar melalui link di website.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section class="kontak-section" id="kontak">
        <div class="container">
            <div class="section-title">
                <h2>Kontak Kami</h2>
                <p>Hubungi kami untuk informasi lebih lanjut</p>
            </div>
            <div class="kontak-container">
                <div class="kontak-info">
                    <div class="kontak-item">
                        <div class="kontak-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Alamat</h3>
                            <p>Jl. Pendidikan No. 123, Kota Pendidikan, Jawa Barat 40123</p>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3>Telepon</h3>
                            <p>(022) 1234567</p>
                            <p>Senin - Jumat, 08:00 - 16:00 WIB</p>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3>Email</h3>
                            <p>info@sigap-ppdb.sch.id</p>
                            <p>ppdb@sigap-ppdb.sch.id</p>
                        </div>
                    </div>
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt" style="font-size: 2rem; margin-right: 10px;"></i>
                        <span>Google Maps Integration</span>
                    </div>
                </div>
                <div class="kontak-form card">
                    <h3 style="margin-bottom: 25px; color: var(--dark-blue);">Kirim Pesan</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" class="form-control"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control"
                                placeholder="Masukkan alamat email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subjek pesan">
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" class="form-control" rows="5" placeholder="Tulis pesan Anda"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-logo">
                    <div class="logo" style="margin-bottom: 25px;">
                        <img src="{{ asset('assets/logo-sigap-transparan.svg') }}" alt="SIGAP Logo" class="logo-img">

                    </div>
                    <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 25px;">Sistem Informasi Gerbang
                        Pendaftaran - Platform PPDB online yang cepat, mudah, dan transparan untuk masa depan pendidikan
                        yang lebih baik.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Menu Cepat</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#pendaftaran">Pendaftaran</a></li>
                        <li><a href="#pengumuman">Pengumuman</a></li>
                        <li><a href="#persyaratan">Persyaratan</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Layanan</h3>
                    <ul>
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Download Brosur</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Informasi</h3>
                    <ul>
                        <li><a href="#">Tentang Sekolah</a></li>
                        <li><a href="#">Program Studi</a></li>
                        <li><a href="#">Ekstrakurikuler</a></li>
                        <li><a href="#">Prestasi</a></li>
                        <li><a href="#">Berita</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 SIGAP - Sistem Informasi Gerbang Pendaftaran. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.getElementById('navMenu');

        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            mobileMenuBtn.innerHTML = navMenu.classList.contains('active') ?
                '<i class="fas fa-times"></i>' :
                '<i class="fas fa-bars"></i>';
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            });
        });

        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Terima kasih! Pesan Anda telah berhasil dikirim. Kami akan membalas dalam 1-2 hari kerja.');
            this.reset();
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
