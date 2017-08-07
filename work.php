<?php
require ('core.inc.php');
include_once 'connect.php';
if (loggedin()) {
  include ('headerlogin.php');
}else {
  include ('header.php');
}
 ?>
<html>
<head>
  <script type="text/javascript">
  function load1 () {
    if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    }else {
      xmlhttp = new ActiveObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        document.getElementById('typeOfQuery').innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open('POST', 'hire.form.php', true)
    xmlhttp.send ();
  }
  </script>
  <title> Find Developers | The Hub </title>
</head>
<body>

  <div id="typeOfQuery">
      <div id="intro" class="text-xs-center">
        <div class="text-center" id="intro-section">
          <img src="img/thehub.jpg" width="60" height="60">
          <div class="col-md-6 container">
<a onclick="load1()" onmouseover="toastr.info('For developers.');"><button class="btn btn-md indigo" type="submit">POST AD HERE</button></a><hr>
  <form action="work.php" method="Get">
              <div class="md-form input-group">
          <input type="text" class="form-control inherit" name="search_skill" placeholder="Filter by skill" required>
                 <button class="btn btn-indigo btn-md" type="submit"><i class="fa fa-search"></i></button>
        </div>
        </form>
           </div>
        </div>
      </div>
      <?php
      if (isset($_GET['search_skill'])&&!empty($_GET['search_skill'])) {
        $search_skill = mysqli_real_escape_string($link, $_GET['search_skill']);
        $query = "SELECT * FROM job_ad WHERE skill LIKE '%".$search_skill."%'";
        $query_run = mysqli_query($link, $query);
        @$count = mysqli_num_rows($query_run);
        if ($count<1) {
          echo '<div class="alert alert-danger">
          No results found for "'.$search_skill.'". Please try with another skill
          </div>';
        }
        else {
          echo '<div class="alert alert-info">
          '.$count .' results found for "'.$search_skill.'"
          </div>';
        }
          while (@$row = mysqli_fetch_array($query_run)) {
          echo '
          <table class="table">
          <tbody>
              <tr>
                  <th scope="row">'.$row['id'].'</th>
                  <td><i class="fa fa-user blue-text"></i> '.$row['first_name'].'</td>
                  <td><i class="fa fa-user blue-text"></i> '.$row['last_name'].'</td>
                  <td><i class="fa fa-envelope red-text"></i> '.$row['email'].'</td>
                  <td><i class="fa fa-phone green-text"></i> '.$row['phone'].'</td>
                  <td><i class="fa fa-globe cyan-text"></i> '.$row['location'].'</td>
                  <td><i class="fa fa-gears"></i> '.$row['skill'].'</td>
                  <td><i class="fa fa-pencil indigo-text"></i> '.$row['text1'].'</td>
              </tr>
              </tbody>
              </table>
             </div>
             </div>
          ';
         }
       }
       ?>
  <div class="container-fluid">
    <table class="table">
    	<thead>
    			<tr>
    					<th>#</th>
    					<th>First Name</th>
    					<th>Last Name</th>
    					<th>Email</th>
    					<th>Phone</th>
    					<th>Location</th>
    					<th>Skill</th>
    					<th>Extras</th>
    			</tr>
    	</thead>
    <?php
    include 'connect.php';
    $sql= "SELECT * FROM job_ad ORDER BY id ASC";
    $result = mysqli_query($link, $sql);
    while (@$row = mysqli_fetch_array($result)) { echo '


    	<tbody>
    			<tr>
    					<th scope="row">'.$row['id'].'</th>
    					<td><i class="fa fa-user blue-text"></i> '.$row['first_name'].'</td>
    					<td><i class="fa fa-user blue-text"></i> '.$row['last_name'].'</td>
    					<td><i class="fa fa-envelope red-text"></i> '.$row['email'].'</td>
    					<td><i class="fa fa-phone green-text"></i> '.$row['phone'].'</td>
    					<td><i class="fa fa-globe cyan-text"></i> '.$row['location'].'</td>
    					<td><i class="fa fa-gears"></i> '.$row['skill'].'</td>
    					<td><i class="fa fa-pencil indigo-text"></i> '.$row['text1'].'</td>
    			</tr>


    ';}
    ?>
    </tbody>
    </table>
   </div>
   </div>
</body>
<!-- Central Modal Medium Info -->
<div class="modal fade" id="tipsss" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-bottom-right modal-side modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <p class="heading lead">Tips from Hubbot</p>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
            </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <section>
          <div class="mdb-feed">
            <div class="news">
                 <!--Label-->
                 <div class="label">
                     <img src="img/thehub.ico.jpg" alt="logo" class="rounded-circle z-depth-1-half">
                 </div>
          <div class="excerpt">
                                  <!--Added text-->
                                  <div class="added-text">Hi there ! <span style="color: indigo">Your personal programming companion once again.</span> <p style="font-family: georgia;"> Find developers here to work together on projects. If you are a developer and available for some extra work, post your ad here.</p></div>
          </div>
          </div>
          </div>
          </section>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
$("#tipsss").modal('show');
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('.launch-modal').click(function() {
$('#tipsss').modal({
  backdrop:'static'
});
});
});
</script>
</html>
<?php include 'footer.php';?>
