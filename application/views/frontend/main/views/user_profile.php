<?php
echo <<<HTML
  <section class="page-section">
    <div class="main-section">
      <div class="section-header">
        <h2>Profile Settings</h2>
      </div>

      <div class="Proliee-Box">

        <div class="Proliee-Part1">
          <div class="Proliee-Part10">
            <div class="Proliee-Part100">
              <img src="$user_profile_photo" />
            </div>
            <div class="Proliee-Part101">
              <h3>{$user_details['first_name']} {$user_details['last_name']}</h3>
              <h4>ID: $id</h4>
              <p>A.R.T.S Student</p>
            </div>
          </div>
          <div class="Proliee-Part11 d-none">
            <button><i class="icon-pencil"></i> Edit</button>
          </div>
        </div>

        <div class="Proliee-Part2">
          <h2>personal Information</h2>

          <form class="prolif-Form" action='$system_base_url/home/update_profile/update_basics' method=post enctype="multipart/form-data">

            <div class="prolif-Grid">
            <div class="Reg_Input">
              <label>First Name</label>
              <input type="text" name="first_name" value="{$user_details['first_name']}">
            </div>
            <div class="Reg_Input">
              <label>Last Name</label>
              <input type="text" name="last_name" value="{$user_details['last_name']}">
            </div>

            <div class="Reg_Input">
              <label>Phone Number</label>
              <input type="phone" name="phone" value="{$user_details['phone']}">
            </div>

            <div class="Reg_Input">
              <label>Country</label>
              <select name='country'>
                <option >-- Select country --</option>
                <option {$user_details_country_selected['Afghanistan']}>Afghanistan</option>
                <option {$user_details_country_selected['Albania']}>Albania</option>
                <option {$user_details_country_selected['Algeria']}>Algeria</option>
                <option {$user_details_country_selected['Andorra']}>Andorra</option>
                <option {$user_details_country_selected['Angola']}>Angola</option>
                <option {$user_details_country_selected['Antigua and Barbuda']}>Antigua and Barbuda</option>
                <option {$user_details_country_selected['Argentina']}>Argentina</option>
                <option {$user_details_country_selected['Armenia']}>Armenia</option>
                <option {$user_details_country_selected['Australia']}>Australia</option>
                <option {$user_details_country_selected['Austria']}>Austria</option>
                <option {$user_details_country_selected['Azerbaijan']}>Azerbaijan</option>
                <option {$user_details_country_selected['Bahamas']}>Bahamas</option>
                <option {$user_details_country_selected['Bahrain']}>Bahrain</option>
                <option {$user_details_country_selected['Bangladesh']}>Bangladesh</option>
                <option {$user_details_country_selected['Barbados']}>Barbados</option>
                <option {$user_details_country_selected['Belarus']}>Belarus</option>
                <option {$user_details_country_selected['Belgium']}>Belgium</option>
                <option {$user_details_country_selected['Belize']}>Belize</option>
                <option {$user_details_country_selected['Benin']}>Benin</option>
                <option {$user_details_country_selected['Bhutan']}>Bhutan</option>
                <option {$user_details_country_selected['Bolivia']}>Bolivia</option>
                <option {$user_details_country_selected['Bosnia and Herzegovina']}>Bosnia and Herzegovina</option>
                <option {$user_details_country_selected['Botswana']}>Botswana</option>
                <option {$user_details_country_selected['Brazil']}>Brazil</option>
                <option {$user_details_country_selected['Brunei']}>Brunei</option>
                <option {$user_details_country_selected['Bulgaria']}>Bulgaria</option>
                <option {$user_details_country_selected['Burkina']}>Burkina Faso</option>
                <option {$user_details_country_selected['Burundi']}>Burundi</option>
                <option {$user_details_country_selected['Cambodia']}>Cambodia</option>
                <option {$user_details_country_selected['Cameroon']}>Cameroon</option>
                <option {$user_details_country_selected['Canada']}>Canada</option>
                <option {$user_details_country_selected['Cape Verde']}>Cape Verde</option>
                <option {$user_details_country_selected['Central African Republic']}>Central African Republic</option>
                <option {$user_details_country_selected['Chad']}>Chad</option>
                <option {$user_details_country_selected['Chile']}>Chile</option>
                <option {$user_details_country_selected['China']}>China</option>
                <option {$user_details_country_selected['Colombia']}>Colombia</option>
                <option {$user_details_country_selected['Comoros']}>Comoros</option>
                <option {$user_details_country_selected['Congo']}>Congo</option>
                <option {$user_details_country_selected['Congo (DRC)']}>Congo (DRC)</option>
                <option {$user_details_country_selected['Costa Rica']}>Costa Rica</option>
                <option {$user_details_country_selected["Côte d'Ivoire"]}>Côte d'Ivoire</option>
                <option {$user_details_country_selected['Croatia']}>Croatia</option>
                <option {$user_details_country_selected['Cuba']}>Cuba</option>
                <option {$user_details_country_selected['Cyprus']}>Cyprus</option>
                <option {$user_details_country_selected['Czech Republic']}>Czech Republic</option>
                <option {$user_details_country_selected['Denmark']}>Denmark</option>
                <option {$user_details_country_selected['Djibouti']}>Djibouti</option>
                <option {$user_details_country_selected['Dominica']}>Dominica</option>
                <option {$user_details_country_selected['Dominican Republic']}>Dominican Republic</option>
                <option {$user_details_country_selected['Ecuador']}>Ecuador</option>
                <option {$user_details_country_selected['Egypt']}>Egypt</option>
                <option {$user_details_country_selected['El Salvador']}>El Salvador</option>
                <option {$user_details_country_selected['Equatorial Guinea']}>Equatorial Guinea</option>
                <option {$user_details_country_selected['Eritrea']}>Eritrea</option>
                <option {$user_details_country_selected['Estonia']}>Estonia</option>
                <option {$user_details_country_selected['Ethiopia']}>Ethiopia</option>
                <option {$user_details_country_selected['Fiji']}>Fiji</option>
                <option {$user_details_country_selected['Finland']}>Finland</option>
                <option {$user_details_country_selected['France']}>France</option>
                <option {$user_details_country_selected['Gabon']}>Gabon</option>
                <option {$user_details_country_selected['Gambia']}>Gambia</option>
                <option {$user_details_country_selected['Georgia']}>Georgia</option>
                <option {$user_details_country_selected['Germany']}>Germany</option>
                <option {$user_details_country_selected['Ghana']}>Ghana</option>
                <option {$user_details_country_selected['Greece']}>Greece</option>
                <option {$user_details_country_selected['Grenada']}>Grenada</option>
                <option {$user_details_country_selected['Guatemala']}>Guatemala</option>
                <option {$user_details_country_selected['Guinea']}>Guinea</option>
                <option {$user_details_country_selected['Guyana']}>Guyana</option>
                <option {$user_details_country_selected['Haiti']}>Haiti</option>
                <option {$user_details_country_selected['Honduras']}>Honduras</option>
                <option {$user_details_country_selected['Hungary']}>Hungary</option>
                <option {$user_details_country_selected['Iceland']}>Iceland</option>
                <option {$user_details_country_selected['India']}>India</option>
                <option {$user_details_country_selected['Indonesia']}>Indonesia</option>
                <option {$user_details_country_selected['Iran']}>Iran</option>
                <option {$user_details_country_selected['Iraq']}>Iraq</option>
                <option {$user_details_country_selected['Ireland']}>Ireland</option>
                <option {$user_details_country_selected['Israel']}>Israel</option>
                <option {$user_details_country_selected['Italy']}>Italy</option>
                <option {$user_details_country_selected['Jamaica']}>Jamaica</option>
                <option {$user_details_country_selected['Japan']}>Japan</option>
                <option {$user_details_country_selected['Jordan']}>Jordan</option>
                <option {$user_details_country_selected['Kazakhstan']}>Kazakhstan</option>
                <option {$user_details_country_selected['Kenya']}>Kenya</option>
                <option {$user_details_country_selected['Kiribati']}>Kiribati</option>
                <option {$user_details_country_selected['Kuwait']}>Kuwait</option>
                <option {$user_details_country_selected['Kyrgyzstan']}>Kyrgyzstan</option>
                <option {$user_details_country_selected['Laos']}>Laos</option>
                <option {$user_details_country_selected['Latvia']}>Latvia</option>
                <option {$user_details_country_selected['Lebanon']}>Lebanon</option>
                <option {$user_details_country_selected['Lesotho']}>Lesotho</option>
                <option {$user_details_country_selected['Liberia']}>Liberia</option>
                <option {$user_details_country_selected['Libya']}>Libya</option>
                <option {$user_details_country_selected['Lithuania']}>Lithuania</option>
                <option {$user_details_country_selected['Luxembourg']}>Luxembourg</option>
                <option {$user_details_country_selected['Madagascar']}>Madagascar</option>
                <option {$user_details_country_selected['Malawi']}>Malawi</option>
                <option {$user_details_country_selected['Malaysia']}>Malaysia</option>
                <option {$user_details_country_selected['Maldives']}>Maldives</option>
                <option {$user_details_country_selected['Mali']}>Mali</option>
                <option {$user_details_country_selected['Malta']}>Malta</option>
                <option {$user_details_country_selected['Mexico']}>Mexico</option>
                <option {$user_details_country_selected['Moldova']}>Moldova</option>
                <option {$user_details_country_selected['Monaco']}>Monaco</option>
                <option {$user_details_country_selected['Mongolia']}>Mongolia</option>
                <option {$user_details_country_selected['Montenegro']}>Montenegro</option>
                <option {$user_details_country_selected['Morocco']}>Morocco</option>
                <option {$user_details_country_selected['Mozambique']}>Mozambique</option>
                <option {$user_details_country_selected['Myanmar']}>Myanmar</option>
                <option {$user_details_country_selected['Namibia']}>Namibia</option>
                <option {$user_details_country_selected['Nepal']}>Nepal</option>
                <option {$user_details_country_selected['Netherlands']}>Netherlands</option>
                <option {$user_details_country_selected['New Zealand']}>New Zealand</option>
                <option {$user_details_country_selected['Nicaragua']}>Nicaragua</option>
                <option {$user_details_country_selected['Niger']}>Niger</option>
                <option {$user_details_country_selected['Nigeria']}>Nigeria</option>
                <option {$user_details_country_selected['Norway']}>Norway</option>
                <option {$user_details_country_selected['Oman']}>Oman</option>
                <option {$user_details_country_selected['Pakistan']}>Pakistan</option>
                <option {$user_details_country_selected['Panama']}>Panama</option>
                <option {$user_details_country_selected['Paraguay']}>Paraguay</option>
                <option {$user_details_country_selected['Peru']}>Peru</option>
                <option {$user_details_country_selected['Philippines']}>Philippines</option>
                <option {$user_details_country_selected['Poland']}>Poland</option>
                <option {$user_details_country_selected['Portugal']}>Portugal</option>
                <option {$user_details_country_selected['Qatar']}>Qatar</option>
                <option {$user_details_country_selected['Romania']}>Romania</option>
                <option {$user_details_country_selected['Russia']}>Russia</option>
                <option {$user_details_country_selected['Saudi Arabia']}>Saudi Arabia</option>
                <option {$user_details_country_selected['Senegal']}>Senegal</option>
                <option {$user_details_country_selected['Singapore']}>Singapore</option>
                <option {$user_details_country_selected['South Africa']}>South Africa</option>
                <option {$user_details_country_selected['Spain']}>Spain</option>
                <option {$user_details_country_selected['Sweden']}>Sweden</option>
                <option {$user_details_country_selected['Switzerland']}>Switzerland</option>
                <option {$user_details_country_selected['Thailand']}>Thailand</option>
                <option {$user_details_country_selected['Tunisia']}>Tunisia</option>
                <option {$user_details_country_selected['Turkey']}>Turkey</option>
                <option {$user_details_country_selected['Ukraine']}>Ukraine</option>
                <option {$user_details_country_selected['United Arab Emirates']}>United Arab Emirates</option>
                <option {$user_details_country_selected['United Kingdom']}>United Kingdom</option>
                <option {$user_details_country_selected['United States']}>United States</option>
                <option {$user_details_country_selected['Vietnam']}>Vietnam</option>
                <option {$user_details_country_selected['Yemen']}>Yemen</option>
                <option {$user_details_country_selected['Zimbabwe']}>Zimbabwe</option>
            </select>
            </div>

            <div class="Reg_Input">
              <label>City</label>
              <input type="text" name="city" value="{$user_details['city']}" placeholder="Enter City">
            </div>
              <div class="Reg_Input">
              <label>Post code</label>
              <input type="text" name="post_code" value="{$user_details['post_code']}" placeholder="Enter Post Code">
            </div>


          </div>
          <div class="Reg_Input">
              <label>Photo</label>
              <input type='file' name='user_image'/>
          </div>

          <div class="Reg_Input">
            <input type="submit" name="" value="Save Changes">
          </div>


          </form>
        </div>
      </div>



      

    </div><!-- main-section -->
HTML;
?>
