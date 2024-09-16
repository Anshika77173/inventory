<!DOCTYPE html>
<html>
<head>
    
    <title>About Us</title>
    <style>
        :root {
            --clr-primary: #7380ec;
            --clr-danger: #ff7782;
            --clr-success: #41f1b6;
            --clr-white: #fff;
            --clr-info-dark: #7d8da1;
            --clr-info-light: #dce1eb;
            --clr-dark: #363949;
            --clr-warnig: #ff4edc;
            --clr-light: rgba(132, 139, 200, 0.18);
            --clr-primary-variant: #111e88;
            --clr-dark-variant: #677483;
            --clr-color-background: #f6f6f9;

            --card-border-radius: 2rem;
            --border-radius-1: 0.4rem;
            --border-radius-2: 0.8rem;
            --border-radius-3: 1.2rem;

            --card-padding: 1.8rem;
            --padding-1: 1.2rem;
            --box-shadow: 0 2rem 3rem var(--clr-light);
        }

        .dark-theme-variables {
            --clr-color-background: #181a1e;
            --clr-white: #202528;
            --clr-light: rgba(0, 0, 0, 0.4);
            --clr-dark: #edeffd;
            --clr-dark-variant: #677483;
            --box-shadow: 0 2rem 3rem var(--clr-light);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            width: 100vw;
            height: 100vh;
            font-size: 0.88rem;
            user-select: none;
            overflow-x: hidden;
            background: var(--clr-color-background);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            display: grid;
            width: 96%;
            gap: 1.8rem;
            grid-template-columns: 14rem auto 14rem;
            margin: 0 auto;
            position: absolute;
        }

        .heading h1 {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--clr-dark);
        }

        .hero-content {
            color: var(--clr-dark-variant);
            text-align: center;
        }

        .hero-content h2 {
            /* font-size: 1.4rem; */
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        .hero-content p {
            color: var(--clr-dark-variant);
           
        }

        .hero-content .cta-button {
            background-color: var(--clr-primary);
            color: #fff;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: var(--border-radius-1);
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .hero-content .cta-button:hover {
            background-color: var(--clr-primary-variant);
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="heading">
            <h1>About Us</h1>
        </div>
        <div class="row p-5" >
            <div class="col-sm-12">
            <div class="hero-content">
                <h2>Welcome to Our Website</h2>
                <p>Welcome to KBPL, your premier partner in advanced inventory management solutions. At KBPL, we specialize in empowering businesses by providing robust systems that meticulously store and display asset details, precise location tracking, and comprehensive transaction records. Whether you're managing warehouses, retail outlets, or complex supply chains, our state-of-the-art platform ensures real-time visibility and control over your inventory. With a commitment to innovation and reliability, we tailor our solutions to optimize efficiency, minimize costs, and drive growth for your business. Join the ranks of satisfied clients who rely on KBPL to streamline their inventory operations with accuracy and ease.</p>
                <button class="cta-button">Learn More</button>
            </div>
        </div>
        <div class="col-sm-12" style="padding-top: 100px;">
            <div class="hero-image">
                <img src="about.jpg">
            </div>
           </div>
        </div>
    </section>
</body>
</html>
