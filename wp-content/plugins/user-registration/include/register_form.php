<form method="post" action="http://pricebook.gr/pricebook/seller-register/" id="subscription-form">
  <input name="reg_name" type="hidden" />

  <div class="login-form">

    <div id="subscription" data-step="1" class="step step_1" >

  <div class="col-xs-12 register_step_title hidden">
    <h3 class="text-left"><i class="material-icons">card_membership</i>Eπιλογή Πακέτου </h3>

  <?php include("next-button.php"); ?>

  </div>


      <div class="subscription_shape">

        <?php

        $subscriptions = get_posts(array(
          'post_type'		=>	'subscription',
          'hide_empty'	=>	0,
          'post_parent'	=>	0,
          'numberposts'	=>	-1
        ));

        $counter = 0;
        foreach ($subscriptions as $subscription) {
          if($counter==0)
          {
            $checked = "checked";
          }else {
            $checked="";
          }

          $counter++;

          $subscription_details = get_fields($subscription->ID);

          $subscription_length = $subscription_details['subscription_length'];
          $subscription_type= $subscription_details['subscription_type'];
          $subscription_price= $subscription_details['subscription_price'];
          $subscription_description= $subscription_details['subscription_description'];
          $subscription_bg_color = $subscription_details['subscription_bg_color'];
          $subscription_image = $subscription_details['subscription_image'];

          ?>
          <div class="single_sub-transform col-xs-12 col-md-4 ">
            <div class="single_sub-shape form-group black shadow _radius2 <?php echo $checked; ?>">

              <div class="sub_title text-left white"  style="background-color:<?php echo $subscription_bg_color;?>">

                <div class="icon_action inline-block">
                  <i class="material-icons md-24 white check ">check_box</i>
                  <i class="material-icons  md-24 white uncheck">check_box_outline_blank</i>
                </div>
                <div class="sub_title_title inline-block">
                  <?php echo $subscription->post_title;?>
                </div>

                <div class="right sub_image-transform">
                  <div class="sub_image-shape circle white-bg">
                    <img src="<?php echo get_template_directory_uri() ;?>/<?php echo $subscription_image;?>" />
                  </div>
                </div>

              </div>
              <div class=" subscription-details">

                <div class=" sub_price">
                  <div class=" grey inline-block text-center grey4">
                  <i class="material-icons "  style="color:<?php echo $subscription_bg_color;?>">local_offer</i>

                    Τιμή  <br/>
                    <span class="price  bold"  style="color:<?php echo $subscription_bg_color;?>"><?php echo $subscription_price;?>&euro;</span>
                  </div>

                </div>

                <div class="sub_length">
                  <div class=" grey inline-block text-center grey4">
                    <i class="material-icons grey4">date_range</i>
                    Διάρκεια :
                     <span class="black bold"><?php echo $subscription_length;?> μήνες</span>
                   </div>
                </div>


                <div class="col-xs-12">
                    <div class="sub_description light"><?php echo $subscription_description;?></div>
                </div>
              </div>




              <input class="hidden" data-type="subscription" type="radio" name="reg_subscription" value="<?php echo $subscription->ID; ?>" <?php echo $checked; ?> required/>
              <input class="hidden subscription_length" data-type="subscription_length" type="radio" name="reg_subscriptionlength" value="<?php echo $subscription_length; ?>" <?php echo $checked; ?> required/>
              <div class="help-block with-errors"></div>


            </div>
          </div>




        <?php } ?>
        <div class="clearer">

        </div>

      </div>
    </div>

    <div id="user_details" data-step="2" class="step text-left  step_2">

      <h3 class="text-left  white-bg blue "><i class="material-icons">account_circle</i> Στοιχεια Λογαριασμού  </h3>



      <div class="input_row black shadow radius2 text-center inline-block">
        <div class="row">

          <div class="col-xs-12 col-md-12 single_seller_form-transform  inline-block text-left">
            <div class="single_seller_form-shape form-group inline-block">
              <div class="input_label bold black">
                email
              </div>
              <div class="input_info grey ">
                Με αυτό θα εισέρχεστε στην πλατφόρμα.
                <br/>Το κάθε email μπορει να χρησιμοποιηθεί μόνο μια φορά.
              </div>
              <label class="login-field-icon fui-mail" for="reg-email"></label>
              <input name="reg_email" type="email" class="form-control login-field" value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>"	placeholder="Email" id="reg-email" required="required" />
              <div class="help-block with-errors"></div>
            </div>


            <div class="single_seller_form-shape form-group inline-block">
              <div class="input_label bold black">
                Eπωνυμία (username)
              </div>
              <div class="input_info grey ">
                Με αυτη θα εμφανίζεστε στους αγοραστές σας.
              </div>
              <label class="login-field-icon fui-mail" for="reg-email"></label>
              <input name="reg_companyName" type="text" class="form-control login-field" value="<?php echo(isset($_POST['reg_companyName']) ? $_POST['reg_companyName'] : null); ?>"
              placeholder="Eπωνυμία" id="reg-companyName" required/>
              <div class="help-block with-errors"></div>
            </div>


            <div class="single_seller_form-shape form-group inline-block" >

              <div class="input_label bold black">
                Password
              </div>
              <div class="view_password pointer">
                <i class="material-icons">remove_red_eye</i>
              </div>
              <input name="reg_pass" type="password" class="form-control login-field"
              value="<?php echo(isset($_POST['reg_pass']) ? $_POST['reg_pass'] : null); ?>"
              placeholder="Password" id="reg_pass" required/>
              <label class="login-field-icon fui-lock" for="reg-pass"></label>
              <meter max="4" id="password-strength-meter"></meter>
              <p id="password-strength-text"></p>
              <div class="help-block with-errors"></div>
            </div>


            <div class="single_seller_form-shape form-group inline-block">

              <div class="input_label bold black">
                Eπαληθευση
              </div>
              <div class="view_password pointer">
                <i class="material-icons">remove_red_eye</i>
              </div>
              <input name="reg_pass2" type="password" class="form-control login-field"
              value=""
              placeholder="Password Επαλήθευση" id="reg_pass2" required/>
              <label class="login-field-icon fui-lock" for="reg-pass2"></label>
              <div class="help-block with-errors"></div>
              <div id="divCheckPasswordMatch">

              </div>
            </div>
          </div>
        </div>
      </div>

      <div>

      </div>




    </div>


    <div id="receipt_info" data-step="3" class="step text-center  step_3">


      <h3 class="text-left white-bg blue"><i class="material-icons">receipt</i>Στοιχεία Τιμολόγησης   </h3>






      <div class="receipt_info-shape">

        <div class="input_row black shadow radius2 text-center inline-block">
          <div class="row">

            <div class="col-xs-12 text-left">


            <div class="single_seller_form-transform  inline-block text-left">
              <div class="single_seller_form-shape ">


                <div class="input_label bold black">
                  Eταιρική Eπωνυμία
                </div>
                <div class="input_info grey">
                  Με αυτη θα εμφανίζεστε στο τιμολόγιο
                </div>
                <label class="login-field-icon fui-mail" for="reg-email"></label>
                <input name="reg_companyName_receipt" type="text" class="form-control login-field" value="<?php echo(isset($_POST['reg_companyName_receipt']) ? $_POST['reg_companyName_receipt'] : null); ?>"
                placeholder="Eπωνυμία" id="reg_companyName_receipt" required/>
                <div class="help-block with-errors"></div>


                  </div>
              </div>
            </div>

            <div class="col-xs-12 text-left">


            <div class="single_seller_form-transform  inline-block text-left">
              <div class="single_seller_form-shape seller_details_company">


                <div class="input_label bold black">
                  Eίδος Επαγγελματία
                </div>
                <div class="input_info grey">
                  Eπιλέξτε εαν θέλετε να τιμολογηθέιτε ως φυσικο, πρόσωπο.
                </div>
                <div class="inline-block single_seller_form-transform text-left">
                  <div class="form-group">
                    <div class="inline-block">
                      <div class="sublabel  grey">
                        Φυσικό Πρόσωπο
                      </div>

                    </div>


                    <div class="icon_action radio_action inline-block pointer">
                      <i class="material-icons md-24 yellow _md-dark check ">check_box</i>
                      <i class="material-icons  md-24 yellow _md-dark uncheck">check_box_outline_blank</i>
                    </div>

                    <input type="radio" class="seller_details_company hidden" name="reg_fysiko" data-classname="seller_details_company" value="1"/>
                  </div>
                </div>

                <div class="inline-block  single_seller_form-transform text-left">
                  <div class=" form-group">
                    <div class="inline-block">
                      <div class="sublabel  grey">
                        Nομικό Πρόσωπο
                      </div>

                    </div>


                    <div class="icon_action radio_action inline-block checked pointer">
                      <i class="material-icons md-24 yellow _md-dark check ">check_box</i>
                      <i class="material-icons  md-24 yellow _md-dark uncheck">check_box_outline_blank</i>
                    </div>

                    <input type="radio" class="seller_details_company hidden" name="reg_fysiko" value="2" data-classname="seller_details_company" checked/>
                  </div>
                </div>




                  </div>
              </div>
            </div>

            <div class="col-xs-12  single_seller_form-transform  inline-block text-left  " id="seller_details_ctype">
              <div class="single_seller_form-shape form-group inline-block companyOnly">
                <div class="input_label bold black">
                  Νομική μορφή
                </div>

                <label class="login-field-icon fui-chat" for="reg_ctype"></label>
                <input id="legal_entity" name="reg_ctype" type="text" class="form-control login-field"
                value="<?php echo(isset($_POST['reg_ctype']) ? $_POST['reg_ctype'] : NULL); ?>"
                placeholder="Νομική μορφή" id="reg_ctype" required/>
                <div class="help-block with-errors"></div>
              </div>




            </div>





          </div>




        </div>

        <div class="clearer">

        </div>
        <div class="input_row black shadow radius2 text-center _inline-block personOnly hidden" id="parastatiko">
          <div class="row">
            <div class="col-xs-12 single_seller_form-transform inline-block text-left personOnly" id="seller_details_receipt">
              <div class="single_seller_form-shape  form-group">

                <div class="inline-block">
                  <div class="input_label bold black">
                    Τύπος παραστατικού
                  </div>
                  <div class="input_info grey ">
                    Eπιλέξτε εαν θέλετε να εκδοθει τιμολόγιο ή απόδειξη λιανικης. <span class="grey">(Mόνο Φυσικά Πρόσωπα)</span>
                  </div>
                </div>

                <select name="reg_receipt_type" class="right">
                  <option value="0" class="timologio blue">
                    Τιμολόγιο
                  </option>
                  <option value="1" class="personOnly blue">
                    Απόδειξη Λιανικής
                  </option>
                </select>

              </div>
            </div>

            <div class="clearer">

            </div>
          </div>
        </div>


        <div class="clearer">

        </div>

        <div class="input_row black shadow radius2 text-center _inline-block  " id="afm">
          <div class="row">
            <div class="col-xs-12 single_seller_form-transform inline-block text-left personOnly" id="seller_details_receipt">
              <div class="single_seller_form-shape  form-group">

                <div class="inline-block">
                  <div class="input_label bold black">
                    ΑΦΜ
                  </div>
                  <div class="input_info grey ">
                    Θα γίνει έλεγχος του ΑΦΜ
                  </div>
                </div>

<div class="right">
  <label class="login-field-icon fui-chat" for="reg_afm"></label>
  <input name="reg_afm" type="text" class="form-control login-field"
  value="<?php echo(isset($_POST['reg_afm']) ? $_POST['reg_afm'] : NULL); ?>"
  placeholder="ΑΦΜ" id="reg_afm" required/>
  <div class="help-block with-errors"></div>
</div>


              </div>
            </div>

            <div class="clearer">

            </div>
          </div>
        </div>


        <div class="clearer">

        </div>




        <div class="input_row black shadow radius2 text-center inline-block">
          <div class="row">



            <div class="col-xs-12  single_seller_form-transform  inline-block text-left " >
              <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                <div class="input_label bold black">
                  Περιοχή
                </div>

                <input name="reg_area" type="text" class="form-control login-field"
                value="<?php echo(isset($_POST['reg_area']) ? $_POST['reg_area'] : null); ?>"
                placeholder="Περιοχή" id="reg_area" required/>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                <div class="input_label bold black">
                  Διεύθυνση
                </div>

                <textarea name="reg_address"  class="form-control login-field"
                value="<?php echo(isset($_POST['reg_address']) ? $_POST['reg_address'] : null); ?>"
                placeholder=" (Οδός & Αριθμός)" id="reg_address" required></textarea>
                <div class="help-block with-errors"></div>
              </div>


              <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                <div class="input_label bold black">
                  Πόλη
                </div>

                <input name="reg_city" type="text" class="form-control login-field"
                value="<?php echo(isset($_POST['reg_city']) ? $_POST['reg_city'] : null); ?>"
                placeholder="Πόλη" id="reg_city" required/>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block"  id="seller_details_area">
                <div class="input_label bold black">
                    Δ.Ο.Υ
                </div>

                <input name="reg_doy" type="text" class="form-control login-field"
                value="<?php echo(isset($_POST['reg_doy']) ? $_POST['reg_doy'] : null); ?>"
                placeholder="Δ.Ο.Υ" id="reg_doy" required/>
                <div class="help-block with-errors"></div>
              </div>

              <div class="single_seller_form-shape form-group inline-block" id="seller_details_address">
                <div class="input_label bold black">
                  Δραστηριότητες
                </div>

                <textarea name="reg_activities"  class="form-control login-field"
                value="<?php echo(isset($_POST['reg_activities']) ? $_POST['reg_activities'] : null); ?>"
                placeholder="Δραστηριότητες" id="reg_activities" required></textarea>
                <div class="help-block with-errors"></div>
              </div>


              <div class="single_seller_form-shape form-group inline-block">
                <div class="input_label bold black">
                  Email αποστολής τιμολογίων
                </div>
                <div class="input_info grey ">
                  Συμπληρώστε το email που επιθυμείτε να αποστέλλονται τα τιμολόγια
                </div>

                <input name="reg_email_receipt" type="email" class="form-control login-field" value="<?php echo(isset($_POST['email_receipt']) ? $_POST['email_receipt'] : null); ?>"
                placeholder="Email" id="reg-email_receipt"  />
                <div class="help-block with-errors"></div>
              </div>

            </div>




            <div class="col-xs-12 single_seller_form-transform inline-block text-left">



              <div class="single_seller_form-shape form-group inline-block" id="seller_details_postcode">
                <div class="input_label bold black">
                  Τ.Κ
                </div>

                <input name="reg_pc" type="text" class="form-control login-field"
                value="<?php echo(isset($_POST['reg_pc']) ? $_POST['reg_pc'] : null); ?>"
                placeholder="T.Κ" id="reg_pc" required="required" />
                <div class="help-block with-errors"></div>
              </div>



              <div class="single_seller_form-shape form-group inline-block" id="seller_details_telephone">
                <div class="input_label bold black">
                  Tηλέφωνο Επικοινωνίας.
                </div>
                <div class="country-code-transform inline-block ">
                  <div class="country-code-shape  grey bold">
                    +30
                  </div>
                </div>
                <input name="reg_contactPhone" type="tel" class="form-control login-field telephone_input"
                value="<?php echo(isset($_POST['reg_contactPhone']) ? $_POST['reg_contactPhone'] : ""); ?>"
                placeholder="XXXXXXXXXX" id="reg-contactPhone" size="20" minlength="10" maxlength="10" onkeypress='return isNumber(event)'  required/>
                <label class="login-field-icon fui-user" for="reg-contactPhone"></label>
                <div class="help-block with-errors"></div>
              </div>
            </div>


          </div>
        </div>

        <div class="input_row black shadow radius2 text-center _inline-block col-xs-6  "  id="terms">
          <div class="row">
            <div class=" single_seller_form-transform text-left">
              <div class="single_seller_form-shape form-group">
                <div class="inline-block">
                  <div class="input_label bold black">
                    Όροι χρήσης
                  </div>
                  <div class="input_info grey ">
                    Μπορείτε να τους διαβάσετε <a class="yellow" href="/terms">εδω</a>
                  </div>
                </div>
                <div class="right">
                  <div class="icon_action checkbox_action inline-block pointer">
                    <i class="material-icons md-24 md-dark check ">check_box</i>
                    <i class="material-icons  md-24 md-dark uncheck">check_box_outline_blank</i>
                  </div>

                  <input type="checkbox" name="reg_terms" value="accepted"  class="hidden form-control login-field" required></input>
                  <div class="help-block with-errors"></div>
                </div>

              </div>
            </div>
          </div>

            <input type="submit" class="btn btn-success btn-send " value="Εγγραφή" name="reg_submit" />
        </div>

      </div>
    </div>








  </form>
