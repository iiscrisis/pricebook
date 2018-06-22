<div id="dashboard_header" class="hidden-xs hidden-sm hidden-md _blue-bg">
  <div class="dashboard_header-shape">
    <div class="container-fluid">
      <div class="row relative">

        <div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2" id="register_header_left">
          <h2 class="white4 blue condensed"> ΕΓΓΡΑΦΗ ΕΠΑΓΓΕΛΜΑΤΙΑ</h2>

          <div class="dashboard_header_description grey5 light">
            <p>
              Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
              sed diam nonummy nibh euismod tincidunt ut laoreet dolore
              magna aliquam erat volutpat. Ut wisi enim ad minim
            </p>
          </div>
        </div>



      </div>
    </div>
  </div>
</div> <!-- Dashboard header -->

<div id="steps">
  <div class="container-fluid">
    <div class="row relative">

      <div class="col-xs-12 col-md-12 col-lg-10 col-lg-offset-2" id="register_steps_header_left">


        <div class="steps_shape text-left">

          <div class="single-step-transform  step_title">
            <div class="single-step-shape black2 bold hidden-xs hidden-xs-sm ">
              BHMATA
            </div>
          </div>

          <div class="single-step-transform <?php if($_step<2){echo 'active';} ?>">
            <div class="single-step-shape ">
              <a class="" href="?p=9&s=1&step=1">


              <div class="step-number-transform">
                  <div class="number-shape circle grey4-bg white2">
                    1                 </div>
                </div>

              <div class='step-image-transform'>
                <div class='step-image-shape'>

                  <img src='images/dashboard/register/steps/step1.svg' class="step-image" />



                </div>
              </div>

              <div class="step_title-transform">
                <div class="step_title-shape black3">
                  Γενικά Στοιχεία
                </div>
              </div>
              </a>
            </div>
          </div> <!-- single-filter-transform -->



          <div class="single-step-transform <?php if($_step==2){echo 'active';} ?>">
            <div class="single-step-shape ">
              <a class="" href="?p=9&s=1&step=2">
              <div class="step-number-transform">
                  <div class="number-shape circle grey4-bg white2">
                    2                 </div>
                </div>

              <div class='step-image-transform'>
                <div class='step-image-shape'>

                  <img src='images/dashboard/register/steps/step2.svg' class="step-image" />



                </div>
              </div>

              <div class="step_title-transform">
                <div class="step_title-shape black3">
                Κατηγορίες
                </div>
              </div>
            </a>
            </div>
          </div> <!-- single-filter-transform -->


          <div class="single-step-transform ">
            <div class="single-step-shape ">

              <div class="step-number-transform">
                  <div class="number-shape circle grey4-bg white2">
                    3                </div>
                </div>

              <div class='step-image-transform'>
                <div class='step-image-shape'>

                  <img src='images/dashboard/register/steps/step3.svg' class="step-image" />



                </div>
              </div>

              <div class="step_title-transform">
                <div class="step_title-shape">
                Συνδρομή
                </div>
              </div>

            </div>
          </div> <!-- single-filter-transform -->


          <div class="single-step-transform ">
            <div class="single-step-shape ">

              <div class="step-number-transform">
                  <div class="number-shape circle grey4-bg white2">
                    4                 </div>
                </div>

              <div class='step-image-transform'>
                <div class='step-image-shape'>

                  <img src='images/dashboard/register/steps/step4.svg' class="step-image" />



                </div>
              </div>

              <div class="step_title-transform">
                <div class="step_title-shape">
                Πληρωμή
                </div>
              </div>

            </div>
          </div> <!-- single-filter-transform -->





          </div>
        </div>
      </div>
  </div>
</div>
