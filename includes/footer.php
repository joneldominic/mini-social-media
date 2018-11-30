      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Side Widget -->
        <div class="card my-4">
          <!-- <h5 class="card-header">  </h5> -->
          <div class="card-body">
            <!-- <img src="./images/dp.jpg" class="img-fluid" alt="Responsive image"> -->
            <img src=<?php echo $up->getProfilePicture($user_data['user_id']) ?> class="img-fluid" alt="Profile Picture">

            <ul class="list-group">
              <li class="list-group-item"><?php echo $user_data['firstname']." ".$user_data['lastname'] ?></li>
              <li class="list-group-item"><?php echo $user_data['email'] ?></li>
            </ul>

          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- Footer -->
  <footer class="py-3 bg-dark fixed-bottom">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Mini Social media Project 2018</p>
    </div>
  <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="./assets/jquery/jquery.min.js"></script>
  <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom user script -->
  <script src="./assets/js/userdefined.js"></script>

  </body>

</html>
