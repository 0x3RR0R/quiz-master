<link rel="stylesheet" href="includes/css/bootstrap.min.css">
<link rel="stylesheet" href="includes/css/main.css">
<link rel="stylesheet" href="includes/css/animate.css">  


<body id="bground" >

  <div class="jumbotron jumbotron-fluid">
    <h1 class="display-4 animated flipInY header
">Welcome to Meteor Mash</h1>      
    <h3 class=" animated fadein"><span class="ityped"></span></h3>
    <hr>
  </div>  
</div>

<script src="includes/js/ityped.js"></script>
  <script>
    window.ityped.init(document.querySelector('.ityped'), {
            strings : ['We hope you will enjoy the quiz!', 'Have fun! All the best!'],
            loop : true
        });
  </script>


<div  class="container">
<?php
session_start();
include('includes/DB.php');

if(isset($_POST['submit'])) {
  if(isset($_POST['team']) && !empty($_POST['team']))
  {
    $_SESSION['team'] = $_POST['team'];
    $team_name = $_POST['team'];
    if(!DB::query("SELECT name FROM teams WHERE name=:name", array(':name' => $team_name)))
    {
      DB::query("INSERT INTO teams VALUES(DEFAULT, :team, 0)", array(':team' => $team_name));
      setcookie("team_name", $team_name);
      $_SESSION['pageLoaded'] = 0;
      header('Location: quiz.php');
    }
    else
    {
      echo '<div class="alert alert-warning">Duplicate team name found!</div>';
    }
  }
  else
  {
    echo '<div class="alert alert-warning">Team name cannot be empty!</div>';
  }
}

?>
  <div class="card" id="team-entry">
    <div class="container">
      <div clas="card-body">
        <h4 class="card-title">
          Enter the team name
        </h4>
        <form method="post">
          <div class="form-group">
            <input class="form-control" type="text" name="team" placeholder="Type the team name...">
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
<style type="text/css">
  #bground {
     background: linear-gradient(to right, #83a4d4, #b6fbff); 
  }

  .jumbotron {
    text-align: center;
    background-color: white;
  }

  .card {
    border-radius: 8px;
  }
</style>