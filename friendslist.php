<?php include_once('includes/header.php'); // include the header; header.php is a file where the nav bar is located
 // add security sessions here
 // only logged in users can access this page


//  $friendsList = $fControl->getFriends($user_data['user_id']);
//  print_r($friendsList);
//
// $requestList = $fControl->getRequests($user_data['user_id']);
// print_r($requestList);

  if (isset($_POST['exec_AcceptRequest'])) {
      $data = array(  'from_user_id' => $_POST['from_user_id'],
                      'to_user_id' => $_POST['to_user_id'],
          );

      $confirmFriendRquest = $fControl->confirmFriendRquest($data['from_user_id'], $data['to_user_id'], "friendslist.php");
      if ($confirmFriendRquest === false) {
          echo "ERROR";
      }
  }

  if (isset($_POST['exec_Unfriend'])) {
      $data = array(  'from_user_id' => $_POST['from_user_id'],
                      'to_user_id' => $_POST['to_user_id'],
          );

      $unfriend = $fControl->unfriend($data['from_user_id'], $data['to_user_id'], "friendslist.php");
      if ($unfriend === false) {
          echo "ERROR";
      }
  }

  if (isset($_POST['exec_DeclineRequest'])) {
      $data = array(  'from_user_id' => $_POST['from_user_id'],
                      'to_user_id' => $_POST['to_user_id'],
          );

      $declineRequeset = $fControl->declineFriendRquest($data['to_user_id'], $data['from_user_id'], "friendslist.php");
      if ($declineRequeset === false) {
          echo "ERROR";
      }
  }
?>

<h3 class="my-3 mt-5">Friend Requests </h3>

<div class="card mb-4">
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <?php
          $requestList = $fControl->getRequests($user_data['user_id']);

          if(is_array($requestList)) {
              for ($index = 0; $index < sizeof($requestList); $index++) {
                  $data_requestFrom = $up->getUserInformation($requestList[$index]);
                  if($fControl->hasRequested($user_data['user_id'], $data_requestFrom['user_id'])) {
        ?>
                    <li class="list-group-item">
                      <div class="media mb-2">
                        <img class="align-self-center mr-3 profile-img-60" src="<?php echo $up->getProfilePicture($data_requestFrom['user_id']) ?>" alt="Generic placeholder image">
                      <div class="align-self-center media-body">
                      <a href="friendsprofile.php?id=<?php echo $data_requestFrom['user_id'] ?>">
                        <h5 class="mt-0"><?php echo "".$data_requestFrom["firstname"]." ".$data_requestFrom["lastname"]; ?></h5>
                      </a>
                      <div>
                        <form class="" method="post">

                               <input type="hidden" name="from_user_id" value="<?php echo $data_requestFrom['user_id'] ?>">
                               <input type="hidden" name="to_user_id" value="<?php echo $user_data['user_id'] ?>">

                               <div class="btn-group float-right" role="group">

                                 <button id="exec_AcceptRequest" name="exec_AcceptRequest" class="btn btn-sm btn-success align-self-center float-right">
                                     <span class="fa fa fa-check"></span> Accept
                                 </button>

                                 <button id="exec_DeclineRequest" name="exec_DeclineRequest" class="btn btn-sm btn-warning align-self-center float-right">
                                     <span class="fa fa-times"></span> Decline
                                 </button>

                               </div>

                                <!-- <span class="fa fa-user-plus"></span> Add Friend -->
                         </form>
                        <!-- <a href="#" class="btn btn-sm btn-success align-self-center float-right"> <span class="fas fa-check-circle "></span> Accept</a> -->
                      </div>
                    </li>

        <?php
                    }
                }
            }
        ?>
      </ul>
    </div>
</div>

<h3 class="my-3 mt-5">Friends List</h3>

<!-- Blog Post -->
<div class="card mb-4">
  <div class="card-body">
    <ul class="list-group list-group-flush">

      <?php
        $friendsList = $fControl->getFriends($user_data['user_id']);
        if(is_array($friendsList)) {
            for ($index = 0; $index < sizeof($friendsList); $index++) {
                $data_of_Friends = $up->getUserInformation($friendsList[$index]);
       ?>
                <li class="list-group-item">
                 <div class="media mb-2">
                   <img class="align-self-center mr-3 profile-img-60" src="<?php echo $up->getProfilePicture($data_of_Friends['user_id']) ?>" alt="Generic placeholder image">
                   <div class="align-self-center media-body">
                     <a href="friendsprofile.php?id=<?php echo $data_of_Friends['user_id'] ?>">
                       <h5 class="mt-0"><?php echo "".$data_of_Friends["firstname"]." ".$data_of_Friends["lastname"]; ?></h5>
                     </a>
                   </div>
                 <!-- <a href="#" class="btn btn-sm btn-danger align-self-center float-right"> <span class="fas fa-trash"></span> Remove</a> -->
                   <form class="" method="post">

                          <input type="hidden" name="from_user_id" value="<?php echo $data_of_Friends['user_id'] ?>">
                          <input type="hidden" name="to_user_id" value="<?php echo $user_data['user_id'] ?>">

                          <button id="exec_Unfriend" name="exec_Unfriend" class="btn btn-sm btn-danger align-self-center float-right">
                              <span class="fas fa-trash"></span> Unfriend
                          </button>
                           <!-- <span class="fa fa-user-plus"></span> Add Friend -->
                    </form>
               </div>
             </li>

      <?php
           }
       }
      ?>

      <!-- <li class="list-group-item">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="./images/dp.jpg" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <a href="#">
              <h5 class="mt-0">Boy Kolit</h5>
            </a>
          </div>
          <a href="#" class="btn btn-sm btn-danger align-self-center float-right"> <span class="fas fa-trash"></span> Remove</a>
        </div>
      </li>

      <li class="list-group-item">
        <div class="media mb-2">
          <img class="align-self-center mr-3 profile-img-60" src="./images/dp.jpg" alt="Generic placeholder image">
          <div class="align-self-center media-body">
            <a href="#">
              <h5 class="mt-0">Boy Coolot</h5>
            </a>
          </div>
          <a href="#" class="btn btn-sm btn-danger align-self-center float-right"> <span class="fas fa-trash"></span> Remove</a>
        </div>
      </li> -->

    </ul>
  </div>
</div>




<?php include 'includes/footer.php';
  // include the header; header.php is a file where the nav bar is located
?>
