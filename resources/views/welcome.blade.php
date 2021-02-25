<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Web Assessment</title>
  <meta content="Web Assessment adalah platform assessment tools yang membantu perusahaan dalam mengembangkan sumber daya manusia." name="description">
  <meta content="Platform Assessment Tools, Assessment Tools, Profile Matching, Appraisal, Optimization Team, Training and Development" name="keywords">
  <meta property="og:title" content="Web Assessment">
  <meta property="og:description" content="Web Assessment adalah platform assessment tools yang membantu perusahaan dalam mengembangkan sumber daya manusia.">
  <meta property="og:image" content="https://assessment.virtualfri.id/landing_page/assets/img/favicon.png">
  <meta property="og:url" content="https://assessment.virtualfri.id">

  <link href="{{asset('landing_page/assets/img/favicon.png')}}" rel="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('landing_page/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('landing_page/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage - v2.2.0
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="{{url('home')}}">Web Assessment</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#hero">Beranda</a></li>
          <li><a href="#about">Tentang Kami</a></li>
          <li><a href="#contact">Kontak Kami</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      @if (Route::has('login'))

                    @auth
                        <a href="{{ url('/home') }}" class="get-started-btn scrollto">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="get-started-btn scrollto">Login</a>
                    @endauth

            @endif

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="margin-top: 90px">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h1>Platform Assessment Tools</h1>
          <h2>Platform yang membantu perusahaan dalam mengembangkan sumber daya manusia.</h2>
        </div>
      </div>
      <div class="text-center">
        <a href="#about" class="btn-get-started scrollto">Lainnya</a>
      </div>

      <div class="row icon-boxes">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box">
            <div class="icon"><span class="iconify" data-icon="icomoon-free:profile" data-inline="false"></span></div>
            <h4 class="title"><a href="">Profile Matching</a></h4>
            <p class="description">Memetakan peran karyawan sesuai dengan kompetensi yang dimiliki.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box">
            <div class="icon"><span class="iconify" data-icon="bx:bx-task" data-inline="false"></span></div>
            <h4 class="title"><a href="">Appraisal</a></h4>
            <p class="description">Mengetahui kompetensi individu dari berbagai sumber seperti penilaian atasan, bawahan, rekan kerja, dan diri sendiri.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="400">
          <div class="icon-box">
            <div class="icon"><span class="iconify" data-icon="mdi:account-multiple-check-outline" data-inline="false"></span></div>
            <h4 class="title"><a href="">Optimasi Tim</a></h4>
            <p class="description">Membentuk tim secara optimal.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="500">
          <div class="icon-box">
            <div class="icon"><span class="iconify" data-icon="uil:arrow-growth" data-inline="false"></span></div>
            <h4 class="title"><a href="">Training and Development</a></h4>
            <p class="description">Mengajukan pelatihan dan melihat rekam jejak karyawan untuk pengembangan karier karyawan.</p>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tentang Kami</h2>
          <p></p>
        </div>

        <div class="row justify-content-center content">
            <p>
              Sebuah platform assessment tools berbasis web yang bertujuan untuk melakukan pengukuran kompetensi dan pengelolaan karyawan sehingga dapat meminimalisir resiko kegagalan proyek di perusahaan.
            </p>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <span data-toggle="counter-up">{{$company}}</span>
              <p>Perusahaan</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-5 col-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <span data-toggle="counter-up">{{$employee}}</span>
              <p>Karyawan</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- Section Video -->

    <!-- ======= Clients / Perusahaan terkait Section ======= -->


    <!-- ======= Testimonials Section ======= -->


    <!-- ======= Services Section ======= -->


    <!-- ======= Cta Section ======= -->


    <!-- ======= Portfolio Section ======= -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team portfolio">
      <div class="container" data-aos="fade-up">
        
        <div class="section-title">
          <h2>Researchers</h2>
          <br>
          <div class="row justify-content-center">

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="member">
                <div class="member-img">
                  <img src="{{asset('landing_page/assets/img/team/researcher-1.png')}}" class="img-fluid" alt=""> 
                </div>
                <div class="member-info">
                  <h4>Dr. Tien Fabrianti Kusumasari</h4>
                  <span></span>
                </div>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
              <div class="member">
                <div class="member-img">
                  <img src="{{asset('landing_page/assets/img/team/researcher-2.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="member-info">
                  <h4>Ekky Novriza Alam, S.Kom, M.T</h4>
                  <span></span>
                </div>
              </div>
            </div>
  
          </div>
        </div>
        <div class="section-title">
          <h2>Developers</h2>
          <p>Empat orang mahasiswa jurusan S1 Sistem Informasi dengan peminatan EISD (Enterprise Intelligent System Developer).</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-img">
                <img src="{{asset('landing_page/assets/img/team/developer-1.png')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href="https://www.facebook.com/syfanr"><i class="icofont-facebook"></i></a>
                  <a href="https://www.instagram.com/syfanr/"><i class="icofont-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/syfanur/"><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Syfa Nur Lathifah</h4>
                <span>Modul Profile Matching</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="member-img">
                <img src="{{asset('landing_page/assets/img/team/team-2.jpg')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="icofont-twitter"></i></a>
                  <a href="https://www.facebook.com/andhi.kurniawan.399041"><i class="icofont-facebook"></i></a>
                  <a href="https://www.instagram.com/andhikurniawannn/"><i class="icofont-instagram"></i></a>
                  <a href=""><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>I Komang Gede Andhi Kurniawan</h4>
                <span>Modul Appraisal</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="member-img">
                <img src="{{asset('landing_page/assets/img/team/team-3.png')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://twitter.com/arrasyidrkh"><i class="icofont-twitter"></i></a>
                  <a href=""><i class="icofont-facebook"></i></a>
                  <a href="https://www.instagram.com/arrasyidrkh/"><i class="icofont-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/arrasyidrkh/"><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Muhammad Arrasyid Rakhmadaszan</h4>
                <span>Modul Optimasi Tim</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <div class="member-img">
                <img src="{{asset('landing_page/assets/img/team/team-4.jpeg')}}" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://twitter.com/adhityapaf"><i class="icofont-twitter"></i></a>
                  <a href="https://www.facebook.com/adhitya.santika/"><i class="icofont-facebook"></i></a>
                  <a href="https://www.instagram.com/adhityapaf/"><i class="icofont-instagram"></i></a>
                  <a href="https://www.linkedin.com/in/adhityakusumadinatha/"><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Made Adhitya Kusumadinatha S.</h4>
                <span>Modul Training and Development</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->


    <!-- ======= Frequently Asked Questions Section ======= -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Kontak Kami</h2>
          <p></p>
        </div>

        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.279261594125!2d107.62826351477321!3d-6.976341094960147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x864485f26a388f95!2sTelkom%20University!5e0!3m2!1sid!2sid!4v1610355608745!5m2!1sid!2sid" width="100%" height="270" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>Jalan Telekomunikasi No. 1 Bandung, Jawa Barat, Indonesia</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>web.assessment.bubat@gmail.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+62 812 345 6789</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="{{asset('landing_page/forms/contact.php')}}" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama Anda" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Apa pesan anda" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Memuat</div>
                <div class="error-message"></div>
                <div class="sent-message">Pesan Anda telah dikirim. Terima Kasih!</div>
              </div>
              <div class="text-center"><button type="submit">Kirim Pesan</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Web Assessment</h3>
            <p>
              Jalan Telekomunikasi No. 1 Bandung <br>
              Jawa Barat<br>
              Indonesia <br><br>
              <strong>Phone:</strong> +62 8123456790<br>
              <strong>Email:</strong> web.assessment.bubat@gmail.com<br>
            </p>
          </div>

          <!-- useful link section -->

          <!-- Our services section -->

          <!-- Join our newsletter section -->

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Web Assessment</span></strong> {{ date('Y')}}
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <!-- Social links -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('landing_page/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('landing_page/assets/vendor/aos/aos.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('landing_page/assets/js/main.js')}}"></script>
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

</body>

</html>