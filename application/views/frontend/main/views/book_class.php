<?php
echo <<<HTML
  <section class="All-Book-Secc margon-topGen">
    <div class="booking-banner-sec">
      <img src="$system_assets_base_url/img/book-a-class-banner.jpg" />
    </div>
    <div class="book-class-Mina">
      <div class="book-class-Mina-Top">
        <h2 class="big-text">Book a class</h2>
      </div>

      <form class="booking-form">
        <div class="Part1-Grid">
          <div class="Reg_Input">
            <label>Level</label>
            <select>
              <option>--Select Level--</option>
              <option>Level 1</option>
              <option>Level 2</option>
              <option>Level 3</option>
              <option>Level 4</option>
            </select>
          </div>

        <div class="Reg_Input">
          <label>Course category</label>
          <select>
            <option>--Select course category--</option>
            <option>Healthcare courses</option>
            <option>Childcare courses</option>
            <option>Teaching and Learning</option>
          </select>
        </div>

      </div>

      <div class="Sells-Booked-cssa">
        <div class="Top-Sells-Booked-cssa">
        <h3>Level 1</h3>
        <p>Healthcare courses</p>
        </div>
        <div class="dddura-secc">
          <h5>
            <span>
              <span><i class="ti-time"></i>Duration: 6 months</span>
              <span><i class="ti-book"></i>Courses: 4</span>
            </span>
            <b>£449.00</b>
          </h5>
        </div>
        <div class="Sub-Sells-Booked-cssa">
          <ul>
            <h4>MANDATORY COURSES</h4>
           
            <li><input type="checkbox" checked /> 
              <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
            </li>

            <li><input type="checkbox" checked /> 
              <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
            </li>

            <li><input type="checkbox" checked /> 
              <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
            </li>

            <li><input type="checkbox" checked /> 
              <span>Ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
            </li>

          </ul>

          <ul class="choose-course-ul">
            <h4 class="show-info-drop"><i class="fa fa-info-circle"></i>Qualifications
            <div class="courser-notice-box">
              <p>You can select more courses that you want to learn here</p>
            </div>
            </h4>
            <li>
              <label>
                <input type="checkbox" />
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </label>
            </li>
          
            <li>
              <label>
                <input type="checkbox" />
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              </label>
            </li>
          
            <li>
              <label>
                <input type="checkbox" />
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </label>
            </li>

          </ul>


        </div>
      </div>

        <div class="Reg_Input_HRef">
        <span>Show courses <i class="ti-angle-down"></i></span>
        </div>

        <div class="Reg_OPP">
          <h3>Personal details</h3>
        </div>

        <div class="Part2-Grid">
        <div class="Reg_Input">
          <label>First Name</label>
            <input type="text" placeholder="Enter first name" />
        </div>

        <div class="Reg_Input">
          <label>Last Name</label>
            <input type="text" placeholder="Enter Last name" />
        </div>
        </div>


        <div class="Reg_Input">
          <label>Address</label>
            <input type="text" placeholder="Enter your address" />
        </div>
        <div class="Part2-Grid">
        <div class="Reg_Input">
          <label>Email</label>
            <input type="text" placeholder="Enter email Address" />
        </div>

        
        <div class="Reg_Input">
          <label>Phone number</label>
            <input type="text" placeholder="Enter phone number" />
        </div>

        </div>

        <div class="Reg_Input">
          <label>Gender</label>
          <select>
            <option>--Select gender--</option>
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>

        <div class="Reg_Box_Foot">
          <p>
            <input type="checkbox" />
            <span>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua <a href="terms.html">Terms and conditions</a> and <a href="privacy.html">Privacy policy</a>
            </span>
          </p>
        </div>

        <div class="Reg_Input">
          <input type="submit" name="" value="Proceed" class="primary-background-color">
        </div>

      </form>

      <div class="Reg_Box_Foot">
        <p>For more enquires <a href="contact.html">contact us </a></p>
      </div>

      <footer class="Booking-Page-footer">

      <div class="Sub-Footer">
          <div class="Sub-Footer-Content">
      
            <div class="kaj-sec">
      
              <div class="social-icons">
                <a href='{$system_settings['linkedin']}' target='_blank' rel='noopener noreferrer'>
                  <svg viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="SocialMediaLinks_m-social-media-links__icon__aLbPt"><path d="M7.734 27V9.48H2.285V27h5.45zM4.98 7.137c1.758 0 3.165-1.465 3.165-3.223C8.145 2.214 6.738.81 4.98.81a3.126 3.126 0 00-3.105 3.105c0 1.758 1.406 3.223 3.105 3.223zM28.066 27h.059v-9.61c0-4.687-1.055-8.32-6.563-8.32-2.636 0-4.394 1.465-5.156 2.813h-.058V9.48h-5.215V27h5.449v-8.672c0-2.285.41-4.453 3.223-4.453 2.812 0 2.87 2.578 2.87 4.629V27h5.391z" fill="currentColor"></path></svg>
                </a>
                <a href='{$system_settings['twitter']}' target='_blank' rel='noopener noreferrer'>
                  <svg viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="SocialMediaLinks_m-social-media-links__icon__aLbPt"><path d="M4.054 4l8.493 12.136L4 26h1.924l7.483-8.637L19.455 26H26l-8.972-12.817L24.984 4H23.06l-6.891 7.953L10.599 4H4.055zm2.829 1.514H9.89l13.28 18.971h-3.007L6.883 5.515z" fill="currentColor"></path></svg>
                </a>
                <a href='{$system_settings['facebook']}' target='_blank' rel='noopener noreferrer'>
                  <svg viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="SocialMediaLinks_m-social-media-links__icon__aLbPt"><path d="M21.973 17.625l.82-5.39h-5.215V8.718c0-1.524.703-2.93 3.047-2.93h2.402V1.16S20.86.75 18.81.75c-4.278 0-7.09 2.637-7.09 7.324v4.16H6.914v5.391h4.805V30.75h5.86V17.625h4.394z" fill="currentColor"></path></svg>
                </a>
               
            </div>
            <div class="kaj-TXT">
            <p>© <script>document.write(new Date().getFullYear());</script> A.R.T.S</p>
            <span>Developed by<a href="https://prolianceltd.com/"> Proliance LTD</a></span>
            </div>
          </div>
      
          </div>
        </div>
      
      </footer>


    </div>
  </section>
HTML;
?>