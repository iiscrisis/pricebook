<div class='seller-rating-transform'>
  <div class='seller-rating-shape text-center'>

    <?php

     $totalrating =  get_field('seller_rank_1',$user) ;;
     $newRating_numbers = get_field('seller_rank_2',$user) ;

     if($newRating_numbers >= 1)
     {
     $rating = $totalrating/$newRating_numbers;


       $rating = round($rating,1);
       $wholeIntegers = floor($rating);
       $decimal = $rating - $wholeIntegers;
       $counter = 0;
       for($i=0;$i<$wholeIntegers;$i++)
       {  $counter++;
         ?>
         <div class="seller-rating circle yellow active"></div>
         <?php
       }

       if($decimal>0.2 && $decimal <0.7)
       {$counter++;
         ?>
         <div class="seller-rating  yellow active halfcircle"></div>
         <?php
       }else if($decimal >= 0.7)
       {$counter++;

         ?>
         <div class="seller-rating circle yellow active"></div>
         <?php
       }


        for($i=$counter;$i<5;$i++)
        {?>

          <div class="seller-rating hidden circle white5"></div>
      <?php
        }
       ?>





       <?php
     }
    ?>

  </div>
</div>
