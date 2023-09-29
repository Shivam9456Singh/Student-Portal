<?php Session_Start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Online Admission Form</title>

    <meta charset="utf-8" />
    <meta content="#343a40" name="theme-color" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- viewport -->
    <!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
    <meta name="viewport" content="width=1024px" />
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <style>
      .reg label {
        font-weight: 500;
      }
      .reg label > span {
        color: #ff0000;
      }
      .f-14 {
        font-size: 14px;
      }
    </style>
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/css/swiper.min.css"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/animation.css" />

    <link
      href="https://fonts.googleapis.com/css?family=Merriweather&display=swap"
      rel="stylesheet"
    />
    <!-- fontawesome -->
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"
    ></script>
  </head>
  <body>
    <div class="head-wrap">
      <header>
        <div class="container">
          <div class="row">
            <div class="col-8">
              <div class="d-flex justify-content-center">
                <div class="img-logo">
                  <a href="index.php"
                    ><img src="assets/img/logo1.png" alt="GGC Logo"
                  /></a>
                </div>
                <div class="info">
                  <span>Gautam Group Of Colleges</span>
                  <p>Hamirpur (H.P.)</p>
                </div>
              </div>
            </div>
            <div class="col-4">
              <form name="search" method="GET" action="search.html">
                <div class="search-box">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control"
                      name="search"
                      placeholder="Search"
                      required=""
                    />
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>

              <div></div>
              
            </div>
          </div>
        </div>
      </header>
    </div>
    <div class="slider-wrap">
      <div class="row">
        <div class="col-9">
          <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-ride="carousel"
          >
            <ol class="carousel-indicators">
              <li
                data-target="#carouselExampleIndicators"
                data-slide-to="0"
                class="active"
              ></li>
              <li
                data-target="#carouselExampleIndicators"
                data-slide-to="1"
              ></li>
              <li
                data-target="#carouselExampleIndicators"
                data-slide-to="2"
              ></li>
              <li
                data-target="#carouselExampleIndicators"
                data-slide-to="3"
              ></li>
              <li
                data-target="#carouselExampleIndicators"
                data-slide-to="4"
              ></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item mh-250 active">
                <img
                  class="d-block w-100 h-220"
                  src="assets/img/clgweb.webp"
                  alt="First slide"
                />
              </div>
              <div class="carousel-item">
                <img
                  class="d-block w-100 h-220"
                  src="assets/img/clgloc.webp"
                  alt="Second slide"
                />
              </div>
              <div class="carousel-item">
                <img
                  class="d-block w-100 h-220"
                  src="assets/img/fest2.webp"
                  alt="Third slide"
                />
              </div>
              <div class="carousel-item">
                <img
                  class="d-block w-100 h-220"
                  src="assets/img/clgview.webp"
                  alt="Third slide"
                />
              </div>
              <div class="carousel-item">
                <img
                  class="d-block w-100 h-220"
                  src="assets/img/winpic.webp"
                  alt="Third slide"
                />
              </div>
            </div>
            <a
              class="carousel-control-prev"
              href="#carouselExampleIndicators"
              role="button"
              data-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Previous</span>
            </a>
            <a
              class="carousel-control-next"
              href="#carouselExampleIndicators"
              role="button"
              data-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div class="col-3">
          <div class="row">
            <div class="col-6">
              <div class="img-wrapper">
                <img
                  src="assets/img/hvpi2.webp"
                  alt="Meritorious Students Receiving Gold Medals From Sh. Mohammad Hamid Ansari, Hon'ble Vice President of India"
                  title="Meritorious Students Receiving Gold Medals From Sh. Mohammad Hamid Ansari, Hon'ble Vice President of India"
                />
              </div>
              <div class="img-wrapper">
                <img
                  src="assets/img/principal.webp"
                  alt="Dr. Rajneesh Gautam Principal Cum Secretary"
                  title="Dr. Rajneesh Gautam Principal Cum Secretary"
                />
              </div>
            </div>
            <div class="col-6">
              <div class="img-wrapper">
                <img
                  src="assets/img/hvpi1.webp"
                  alt="Meritorious Students Receiving Gold Medals From Sh. Mohammad Hamid Ansari, Hon'ble Vice President of India"
                  title="Meritorious Students Receiving Gold Medals From Sh. Mohammad Hamid Ansari, Hon'ble Vice President of India"
                />
              </div>
              <div class="img-wrapper">
                <img
                  src="assets/img/founder.webp"
                  alt="Shri Jai Ram Thakur, Hon'ble Chief Minister Himachal Pradesh"
                  title="Sh. Jagdish Gautam,Founder of GGC"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <main>
      <div class="row">
        <div class="col-3">
          <div class="sidenav-wrap">
            <nav>
              <ul id="main-nav" class="list-unstyled main-ul">
                <li><a href="index.php">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="vision-mission.html">Vision & Mission</a></li>
                <li><a href="founder-message.html">Founder Message</a></li>
                <li><a href="principal-message.html">Principal Message</a></li>
                <li>
                  <a href="academic.html">Academic</a>
                  <ul id="submenu" class="list-unstyled">
                    <li>
                      <a href="ug.html">UG</a>
                      <ul id="submenu-inner" class="list-unstyled">
                        <li><a href="bsc.html">B.Sc.(MED./N-MED.)</a></li>
                        <li><a href="bcom.html">BCOM</a></li>
                        <li><a href="ba.html">BA</a></li>
                        <li><a href="bba.html">BBA</a></li>
                        <li><a href="bhm.html">BHM</a></li>
                        <li><a href="gnm.html">GNM</a></li>
                        <li><a href="bsc-nursing.html">B.Sc .Nursing</a></li>
                        <li><a href="#">Post B.Sc. Nursing</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="pg.html">PG</a>
                      <ul id="submenu-inner" class="list-unstyled">
                        <li><a href="msc-botany.html">M.Sc. Botony</a></li>
                        <li>
                          <a href="msc-biotech.html">M.Sc. Biotechnology</a>
                        </li>
                        <li>
                          <a href="msc-chemistry.html">M.Sc. Chemistry</a>
                        </li>
                        <li><a href="msc-physics.html">M.Sc. Physics</a></li>
                        <li>
                          <a href="msc-mathematics.html">M.Sc. Mathematics</a>
                        </li>
                        <li>
                          <a href="msc-microbio.html">M.Sc. Microbiology</a>
                        </li>
                        <li><a href="mapolsci.html">MA Pol. Sci.</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="professional.html">PROFESSIONAL</a>
                      <ul id="submenu-inner" class="list-unstyled">
                        <li><a href="bba.html">BBA</a></li>
                        <li><a href="bca.html">BCA</a></li>
                        <li><a href="mba.html">MBA</a></li>
                        <li><a href="pgdca.html">PGDCA</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="pharmacy.html">PARMACY</a>
                      <ul id="submenu-inner" class="list-unstyled">
                        <li><a href="bpharmacy.html">B. PARMACY</a></li>
					 <li><a href="dpharmacy.html">D. PARMACY</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="cells.html">Cells</a>
                  <ul id="submenu" class="list-unstyled" style="width: 280px;">
                    <li>
                      <a href="anti-ragging-cell.html">Anti Ragging Cell</a>
                    </li>
                    <li>
                      <a href="student-grievance-redressal-cell.html"
                        >Student Grievance Redressal Cell</a
                      >
                    </li>
                    <li>
                      <a href="sc-st-grievance-redressal.html"
                        >SC/ST Grievance Redressal</a
                      >
                    </li>
                    <li>
                      <a href="sexual-harassment.html">Sexual Harassment</a>
                    </li>
                    <li>
                      <a href="caste-discri.html"
                        >Caste Discrimination Committee</a
                      >
                    </li>
                    <li><a target="_blank" href="http://mooc.org/">MOOC</a></li>
                    <li>
                      <a href="university-industrial-cell.html"
                        >University Industry Cell</a
                      >
                    </li>
                  </ul>
                </li>

                <li>
                  <a href="student-zone.html">Student Zone</a>
                  <ul id="submenu" class="list-unstyled">
                    <li><a href="feedback.html">Feedback</a></li>
                  </ul>
                </li>
                <li><a href="fee-structure.html">Fee Structure</a></li>
                <li><a href="notification.php">Notifications</a></li>
                <li><a href="faculty.html">Faculty</a></li>
                <li><a href="contact-us.html">Contact Us</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-9">
          <div class="p-3 bg-dark text-white">
            <h4>Free Registration for Admission</h4>
          </div>
          <div class="container">
            <?php 
												if(isset($_SESSION['msg-1'])) {
													echo $_SESSION['msg-1'];
													unset($_SESSION['msg-1']);
												}
											?></div>
          <form
            method="POST"
            name="admissionForm"
            enctype="multipart/form-data"
            action="includes/admission.php"
            class="reg bg-light p-4"
          >
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name">Name of Student <span>*</span></label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  placeholder="Name"
                  required
                />
              </div>
              <div class="form-group col-md-6">
                <label for="fname">Father Name <span>*</span></label>
                <input
                  type="text"
                  class="form-control"
                  name="fname"
                  placeholder="Father Name"
                  required
                />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="dob">Date Of Registration <span>*</span></label>
                <input type="date" class="form-control" name="dob" required />
                <small class="form-text text-muted">Format: MM/DD/YYYY</small>
              </div>
              <div class="form-group col-md-4">
                <label for="course">Course <span>*</span></label>
                <select class="form-control" name="course" required>
                  <option value="">Select Course</option>
					 <option value="Diploma Veterinary Pharmacist">Diploma Veterinary Pharmacist</option>
                  <option value="B.Pharmacy">B. Pharmacy</option>
					<option value="B.Pharma Second year(Lateral Entry">B.Pharma Second year(Lateral Entry</option>
                  <option value="D.Pharmacy">D. Pharmacy</option>
                  <option value="BHM">BHM</option>
                  <option value="BBA">BBA</option>
                  <option value="BCA">BCA</option>
                  <option value="B.A.">B. A.</option>
                  <option value="B.Com.">B. Com.</option>
                  <option value="B.Sc (Med.)">B.Sc (Med.)</option>
                  <option value="B.Sc (Non-Med.)">B.Sc (Non-Med.)</option>
                  <option value="PGDCA">PGDCA</option>
                  <option value="MBA">MBA</option>
                  <option value="GNM">GNM</option>
                  <option value="B.Sc Nursing">B.Sc Nursing</option>
                  <option value="Post Basic Nursing">Post Basic Nursing</option>
                  <option value="M.A. (English)">M.A. ( English )</option>
                  <option value="M.A. (Pol.Sci.)">M.A. ( Pol.Sci. )</option>
					<option value="M.Sc (Chemistry)">M.Sc ( Chemistry )</option>
                  <option value="M.Sc (Physics)">M.Sc ( Physics )</option>
                  <option value="M.Sc (Botany)">M.Sc ( Botany )</option>
                  <option value="M.Sc (Zoology)">M.Sc ( Zoology )</option>
                  <option value="M.Sc (Mathematics)"
                  >M.Sc ( Mathematics )</option
                  >
                  <option value="M.Sc ( Bio-Tech )">M.Sc ( Bio-Tech )</option>
                  <option value="M.Sc ( Microbiology )"
                    >M.Sc ( Microbiology )</option
                  >
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="number">Contact Number <span>*</span></label>
                <input
                  type="tel"
                  class="form-control"
                  name="contactNo"
                  pattern="[0-9]*"
                  title="Number only"
                  placeholder="Number Here.."
                  autocomplete="off"
                  maxlength="10"
                  minlength="10"
                  required
                />
              </div>
            </div>
            <div class="form-group">
              <label for="address">Address ( Permanent ) <span>*</span></label>
              <textarea
                class="form-control"
                name="address"
                rows="3"
                required
              ></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="qualification"
                  >Qualification with % of marks <span>*</span></label
                >
                <input
                  type="text"
                  class="form-control"
                  name="qualification"
                  placeholder="Total Marks"
                  required
                />
              </div>
              <div class="form-group col-md-6">
                <label for="yearPass">Year of Passing <span>*</span></label>
                <input
                  type="text"
                  class="form-control"
                  name="yearPass"
                  pattern="[0-9]*"
                  maxlength="4"
                  minlength="4"
                  placeholder="YYYY"
                  required
                />
              </div>
            </div>
            <div class="form-group col-md-12">
              <label for="regType">Type of Registration<span>*</span></label>
              <div class="radio-btn">
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="regType"
                    id="free"
                    value="Free"
                    onclick="handleCheck();"
                    required
                  />
                  <label class="form-check-label" for="inlineRadio1"
                    >Free Registration</label
                  >
                </div>
                <div class="form-check form-check-inline">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="regType"
                    id="paid"
                    value="Paid"
                    onclick="handleCheck();"
                  />
                  <label class="form-check-label" for="inlineRadio2"
                    >Confirmation of Admission</label
                  >
                </div>
              </div>
            </div>
            <div class="form-row d-flex justify-content-center my-4">
              <button
                type="submit"
                name="admissionForm"
                id="regFreeBtn"
                class="btn btn-success col-6 p-3 h3"
              >
                Submit
              </button>
            </div>
            <div id="radioSelection">
              <div class="form-group py-2">
                <h5>
                  Bank Details for NEFT/RTGS Only: Registration Amount - INR
                  10,000
                </h5>
                <h6 class="text-center">
                  <strong
                    >For BA / B.Sc /B.Com / BHM / BBA / BCA / M.Sc / MBA
                    :</strong
                  >
                </h6>
                <p class="m-0">
                  Bank Name: <b>CENTRAL BANK OF INDIA, Hamirpur</b>
                </p>
                <p class="m-0">Beneficiary Name: <b>Gautam Girl College</b></p>
                <p class="m-0">Bank Account No: <b>2185819387</b></p>
                <p class="m-0">IFSC Code: <b>CBIN0282210</b></p>
                <!-- for nursing -->
                <h6 class="text-center">
                  <strong>For Nursing / GNM / Post Basic Nursing :</strong>
                </h6>
                <p class="m-0">Bank Name: <b>HDFC BANK LTD, Hamirpur</b></p>
                <p class="m-0">
                  Beneficiary Name: <b>Gautam Girl College Mgt. Committee</b>
                </p>
                <p class="m-0">Bank Account No: <b>50100056864601</b></p>
                <p class="m-0">IFSC Code: <b>HDFC0000802</b></p>
                <!-- for pharmacy -->
                <h6 class="text-center">
                  <strong>For B. Pharmacy / D. Pharmacy :</strong>
                </h6>
                <p class="m-0">Bank Name: <b>HDFC BANK LTD, Hamirpur</b></p>
                <p class="m-0">
                  Beneficiary Name: <b>Gautam College of Pharmacy</b>
                </p>
                <p class="m-0">Bank Account No: <b>50100294134970</b></p>
                <p class="m-0">IFSC Code: <b>HDFC0000802</b></p>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="transaction"
                    >Bank Transaction ID <span>*</span></label
                  >
                  <input
                    type="text"
                    class="form-control"
                    name="transaction"
                    placeholder="Transaction ID"
                  />
                </div>
                <div class="form-group col-md-6">
                  <label for="BankTransDate"
                    >Bank Transaction Date <span>*</span></label
                  >
                  <input
                    type="date"
                    class="form-control"
                    name="BankTransDate"
                    max="<?php echo date('Y-m-d')?>"
                  />
                  <small class="form-text text-muted">Format: MM/DD/YYYY</small>
                </div>
              </div>
              <div class="form-group">
                <label for="bankSlip"
                  >Upload Bank Transaction slip <span>*</span></label
                >
                <input type="file" class="form-control-file" name="bankSlip" />
                <label class="f-14"
                  ><span
                    >Only JPG, PNG and JPEG files are allowed. Max File Size
                    2MB</span
                  ></label
                >
              </div>
              <div class="form-row d-flex justify-content-center my-4">
                <button
                  type="submit"
                  name="admissionForm"
                  class="btn btn-success col-6 p-3 h3"
                >
                  Submit
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </main>
    <!-- footer -->
    <section class="footer-link">
      <div class="container">
        <div class="row">
          <div class="col-3">
            <div class="ins-detail text-center">
              <img
                src="assets/img/logo1.png"
                style="height: 60px; width: 60px;"
              />
              <br />
              <a href="">Gautam Group Of Colleges</a>
              <p>Near Bus Stand Hamirpur</p>
              <p>HP 177001</p>
            </div>
          </div>
          <div class="col-3">
            <div class="links">
              <span>General Information</span>
              <hr class="full" />
              <ul class="list-unstyled">
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="about-us.html"> About Us</a>
                </li>
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="contact-us.html"> Contact Us</a>
                </li>
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="anti-ragging-cell.html"> Anti-Ragging</a>
                </li>
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="faculty.html">Faculty</a>
                </li>
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="feedback.html"> Feedback</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-3">
            <div class="links">
              <span>Quick links</span>
              <hr class="full" />
              <ul class="list-unstyled">
                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="vision-mission.html">Vision & Mission</a>
                </li>

                <li>
                  <i class="fa fa-angle-right"></i>
                  <a href="notification.php">Notifications</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-3">
            <div class="links">
              <span>Social Contact</span>
              <hr class="full" />
              <section class="social-contact">
                <ul class="list-inline list-social text-center">
                  <li class="social-facebook">
                    <a
                      target="_blank"
                      href="https://m.facebook.com/pages/category/School/Gautam-Group-Of-Colleges-1397929340472669/"
                      ><i class="fab fa-facebook-f"></i
                    ></a>
                  </li>
                  <li class="social-insta">
                    <a
                      target="_blank"
                      href="https://instagram.com/ggc_hamirpur?igshid=1pww3htnuhwj1"
                      ><i class="fab fa-instagram"></i
                    ></a>
                  </li>
                  <li class="social-twitter">
                    <a target="_blank" href="https://twitter.com/ggchmr?s=08"
                      ><i class="fab fa-twitter"></i
                    ></a>
                  </li>
                </ul>
              </section>
            </div>
          </div>
        </div>
      </div>
    </section>
    <a href="#top"
      ><button id="scrollTop" class="animatable">
        <i class="fas fa-angle-up"></i></button
    ></a>
    <footer class="text-center">
      Copyright &copy; 2019 | All Rights Reserved.
      <span>Gautam Group Of College</span> Hamirpur (H.P.)
      <br />
      Developed By
      <a target="_blank" href="http://internwell.com/"> InternWell</a>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
      function handleCheck() {
        if (document.getElementById("free").checked) {
          document.getElementById("radioSelection").style.display = "none";
          if (document.getElementById("regFreeBtn").style.display == "none") {
            document.getElementById("regFreeBtn").style.display = "block";
          }
        } else {
          document.getElementById("radioSelection").style.display = "block";
          document.getElementById("regFreeBtn").style.display = "none";
        }
      }
    </script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
