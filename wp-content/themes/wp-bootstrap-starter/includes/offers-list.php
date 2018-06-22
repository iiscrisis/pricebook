<?php
  //flag to show make interesting
  $make_interesting_btn = 0;
  $remove_interesting_btn = 0;
 //var_dump($offers);
 ?>



<div class="list-tools-transform">
  <div class="list-offer-title blue-bg white"><?php echo $post->post_title;?> ( ref : <?php echo $post->ID;?>)</div>
  <div class="list-tools-transform-shape shadow white-bg" id="application-info-tools">

    <div class="single-list-tool certificate-button certificate-shape" data-wenk="Αφού αποδεχτείς την προσφορά που θεωρείς καλύτερη, μπορείς να εκτυπώσεις ΔΩΡΕΑΝ το πιστοποιητικό έρευνας αγοράς που πραγματοποίησες." data-wenk-pos="right">
      <a class="btnGenerateCert" data-seller="<?php echo $succeeded['inquiry_seller']['ID']; ?>" data-postid=<?php echo $post->ID;?> href="#">

        <img src="<?php echo get_template_directory_uri() ;?>/images/certificate/cert.svg"/>

        </a>
    </div>




    <?php if ($status  != 'complete')
    { ?>


      <?php if (empty($offers['succeeded']) &&  empty($offers['failed'])){
        ?>





        <div class="options-wrapper">



        <div class="option-cell-transform ">
          <div class="option-cell-shape white text-center action updateInquiry" data-value="<?php echo $post->ID; ?>">

            <div class="option-button-transform">
              <div class="option-button-shape">
                <i class="material-icons md-24 blue">autorenew</i>
              </div>
            </div>

            <div class='option-button-title _condensed  _semi-bold grey'>
              Ανανέωση
            </div>

          </div>
        </div> <!-- Single cell -->


        <div class="option-cell-transform">
          <div class="option-cell-shape white text-center action deleteInquiryConfirm" d>

            <div class="option-button-transform">
              <div class="option-button-shape">
                <i class="material-icons md-24 red">no_sim</i>
              </div>
            </div>

            <div class='option-button-title _condensed _semi-bold grey'>
              Διαγραφή
            </div>

          </div>
        </div> <!-- Single cell -->

        <div class="option-cell-transform-confirm hidden">
          <div class="option-cell-shape white text-center action " data-value="<?php echo $post->ID; ?>">

            <div class="delete-confirm-transform inline-block">
              <div class="delete-confirm-shape black3 bold">
                Είστε σίγουροι για την διαγραφή;
              </div>
            </div>

            <div class="confirm-options inline-block">

              <div class="single-confirm-options inline-block deleteInquiry" data-value="<?php echo $post->ID; ?>">
                <div class="option-button-transform">
                  <div class="option-button-shape">
                    <i class="material-icons md-24 red">no_sim</i>
                  </div>
                </div>

                <div class='option-button-title _condensed _semi-bold grey'>
                  Διαγραφή
                </div>
              </div>

              <div class="single-confirm-options inline-block canceldeleteInquiry">
                <div class="option-button-transform">
                  <div class="option-button-shape">
                    <i class="material-icons md-24 blue">block</i>
                  </div>
                </div>

                <div class='option-button-title _condensed _semi-bold grey'>
                  Ακύρωση
                </div>
              </div>

            </div>
          </div>
        </div> <!-- Single cell -->

        </div>
        <?php
      }
      ?>



    <?php }
?>



  </div>
</div>

  <?php// var_dump($offers);?>

<?php if (!empty($offers['succeeded']) && $status == 'complete') { ?>
  <div class="open_application_list_main-transform best_offer" id="offers_list">
    <div class="open_application_list_main-shape white4 white2-bg radius2">
      <div class="list-title black2 bold">
      <i class="material-icons  md-24 blue">redeem</i>  Αγορά Από
      </div>
      <?php

      //  $offer = $offers['best'][0];
      //    var_dump($offers['best']);
      ?>
      <?php
      foreach($offers['succeeded'] as $offer)
      {

        include('application-info-row.php');

      }?>

    </div>
  </div>
<?php } ?>


<?php// var_dump($offers);?>
<?php if (!empty($offers['failed']) && $status == 'complete') { ?>
<div class="open_application_list_main-transform">
  <div class="open_application_list_main-shape white2-bg white4 radius2 all-offers-list">
      <div class="list-title black2 bold">
        <i class="material-icons  md-24 grey4">reorder</i>  Λοιπές Προσφορές
      </div>
      <?php

      //  $offer = $offers['best'][0];
      //    var_dump($offers['best']);
      ?>
      <?php
      foreach($offers['failed'] as $offer)
      {

        include('application-info-row.php');

      }?>

    </div>
  </div>
<?php } ?>

<?php
//get post_author blacklist if seller in black list delete all offers from specific seller
// $post->ID


 ?>
<?php if (!empty($offers['best']) && $status != 'complete') {

  $remove_interesting_btn = 0;
    $make_interesting_btn = 0;
   ?>
  <div class="open_application_list_main-transform best_offer" id="offers_list">
    <div class="open_application_list_main-shape white4 white2-bg radius2">
      <div class="list-title black2 bold">
      <i class="material-icons  md-24 blue">redeem</i>  Καλύτερη Προσφορά
      </div>
      <?php

      //  $offer = $offers['best'][0];
      //    var_dump($offers['best']);
      ?>
      <?php
      foreach($offers['best'] as $offer)
      {

        include('application-info-row.php');

      }?>

    </div>
  </div>
<?php } ?>



<?php if (!empty($offers['pending']) || !empty($offers['interesting'])) {



        $make_interesting_btn = 1;
?>


  <div class="open_application_list_main-transform interesting_offers" id="interesting_offers">
    <div class="open_application_list_main-shape white4 white2-bg radius2">
      <div class="list-title black2 bold">

      <i class="material-icons md-24 _md-dark red">favorite</i>  Ενδιαφέρουσες Προσφορές
      </div>
      <div class="drag-container" id="containerInteresting">
        <div class="box-for-dragging">

        </div>
        <?php if (!empty($offers['interesting']) && $status != 'complete') { ?>

        <?php foreach($offers['interesting'] as $offer)
        {
          include('application-info-row.php');
        }

          $make_interesting_btn = 0;
      }

      ?>
      </div>
    </div>
  </div>







<div class="open_application_list_main-transform" id="other_offers">
  <div class="open_application_list_main-shape white2-bg white4 radius2 all-offers-list">
    <div class="list-title black2 bold">
    <i class="material-icons  md-24 green">reorder</i>  Λοιπές Προσφορές
    </div>
    <div class="drag-container " id="containerAll">

      <div class="box-for-dragging">

      </div>
      <?php


        $make_interesting_btn = 1;

       ?>
      <?php if (!empty($offers['pending']) && $status != 'complete') {


        ?>
        <?php foreach ($offers['pending'] as $offer)
        {
          include('application-info-row.php');

        }
      }

      $make_interesting_btn = 0;
      ?>
    </div>

    <?php if (!empty($offers['succeeded']) && $status == 'complete') { ?>
      <?php foreach ($offers['succeeded'] as $offer)
      {
        include('application-info-row.php');

        ?>
        <?php
      }
    }
    ?>


    <?php if (!empty($offers['failed']) && $status == 'complete') { ?>
      <?php foreach ($offers['failed'] as $offer)
      {
        include('application-info-row.php');

        ?>
        <?php
      }
    }
    ?>

  </div>
</div>
<?php
}?>

<?php
$thread_counter = 0;
if (!empty($threadStarters) && $status != 'complete') { ?>


  <?php foreach ($threadStarters as $starter)
  {
    $offer = array();
    $offer['inquiry_seller']['ID'] = $starter;
    if (empty(getOffer($post->ID,$starter)['pending'] ) && empty(getOffer($post->ID,$starter)['ignored'] ) && empty(getOffer($post->ID,$starter)['interesting'] ) && empty(getOffer($post->ID,$starter)['best'] ))
    {
      if($thread_counter == 0)
      {
        ?>
        <div class="open_application_list_main-transform" id="no_offers">
          <div class="open_application_list_main-shape white2-bg white4 radius2 no-offers-list">
            <div class="list-title black2 bold">
            <i class="material-icons md-24 orange">chat</i>  Ενδιαφερομένοι Χωρίς Προσφορά
            </div>
            <?php
          }

          include('application-info-row.php');

          ?>
          <?php


          if($thread_counter == 0)
          {
            ?>

          </div>
        </div>
        <?php
        $thread_counter++;
      }

    }
  }

  ?>



  <?php
}

?>


<div id="renewInquiry">

  <div class="renewInquiry-shape shadow radius4 white3-bg">

    <div class="close_renew">
      <div class="close-renew-image text-right pointer">
        <i class="material-icons md-24 md-dark">clear</i>
      </div>
    </div>
    <h3 class="black2">Επιλέξτε νέα ημ/νια λήξης αιτήματος</h3>
    <div class="renewInquiry-inner green">
      <form>
        <input type="hidden" name="inquiryId" value="" />
        <input type="text" class="form-control black2" name="inquiry_end_date" required />
        <input type="submit" class="btn btn-primary aqua-bg" value="Ανανέωση" />
      </form>
    </div>
  </div>

</div>

<script type="text/javascript">
	jQuery('#renewInquiry input[name="inquiry_end_date"]').datepicker({	minDate: '+7D' }).datepicker("option", "maxDate", '+32D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+5");
  function reorderOfferBoxes()
  {
    console.log("reorder");
    jQuery(".drag-container").each(function(){
      var container = jQuery(this);
      var divList = container.find(".single-open_application_list-transform");
          divList.sort(function(a, b){
              return jQuery(a).data("ranking")-jQuery(b).data("ranking");
          });
          console.log(divList);
          container.html(divList);

          /*<div class="box-for-dragging">

          </div>*/

          var drag_box = jQuery('<div>',{class:"box-for-dragging"});
          drag_box.prependTo(container);

    });
  }

  var containerInteresting = document.getElementById("containerInteresting");
  var containerAll = document.getElementById("containerAll");
  Sortable.create(containerInteresting, {
    group:"drag-offer",
    onAdd: function (/**Event*/evt) {
      // same properties as onEnd
      //var item = evt.item;
      console.log("adding "+evt.item.dataset.seller);
      commonAjaxOfferActions('MarkInterestingOffer',<?php echo $post->ID;?>,evt.item.dataset.seller,reorderOfferBoxes);
    }

  });
  Sortable.create(containerAll, {
    group:"drag-offer",
    onAdd: function (/**Event*/evt) {
      // same properties as onEnd
      //var item = evt.item;
      console.log("adding "+evt.item.dataset.seller);
      commonAjaxOfferActions('MarkInterestingOffer',<?php echo $post->ID;?>,evt.item.dataset.seller,reorderOfferBoxes);
    }

  });

  jQuery(document).ready(function() {

    jQuery("#interesting_offers").find(".make_interesting_btn").live("click",function(){
      var $parent =   jQuery(this).closest(".single-open_application_list-transform");
      TweenMax.to($parent,0.3,{opacity:0,onComplete:function(){

        $parent.appendTo(containerAll);
        TweenMax.to($parent,0.3,{opacity:1});
      }});
      commonAjaxOfferActions('MarkInterestingOffer',<?php echo $post->ID;?>,$parent.data("seller"),reorderOfferBoxes);

    //  reorderOfferBoxes();

    });

    jQuery("#other_offers").find(".make_interesting_btn").live("click",function(){
      var $parent =   jQuery(this).closest(".single-open_application_list-transform");
      TweenMax.to($parent,0.3,{opacity:0,onComplete:function(){
        $parent.appendTo(containerInteresting);
        TweenMax.to($parent,0.3,{opacity:1});
      }});
      commonAjaxOfferActions('MarkInterestingOffer',<?php echo $post->ID;?>,$parent.data("seller"),reorderOfferBoxes);

    });

  });


  function commonAjaxOfferActions(action,postId,sellerId,callback)
  {
  //  alert(action+" "+postId+" "+sellerId);
    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      dataType	: 'html',
      data : {
        action     : action,
        inquiryId  : postId,
        seller     : sellerId
      },
      success: function(response) {
        var result = JSON.parse(response);
      //  alert("success");
        if (result.status == 0) {

        //  alert(result.message);
          display_success(result.message);
          callback();
          //  window.location.reload();
        }
        else {
          display_error(result.message);
        //alert(result.message);
          return false;
        }
      }
    });
  }




</script>
