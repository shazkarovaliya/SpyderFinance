<!DOCTYPE html>
<html lang="en">

<head>
    <title>Spyder Banking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/fc50e8e5b6.js" crossorigin="anonymous"></script>

</head>

<body>

<header>
<div class="banner">
  <div class="logo">
    <img src="images/spider.png">
    <a href="backoffice.html">Spyder</a>
  </div>
  <nav>
    <ul>
      <li><a href="#">Settings</a></li>
      <li><a href="#">Contact Us</a></li>
      <li><button class="logout"><a href="frontpage.html">Logout</a></button></li>
    <script src="js/home.js"></script>
    </ul>
  </nav>
</div>
</header>

<section id="drop">
  <div class="sidenav">
    <a href="backoffice.html">Home</a>
    <button class="dropdown-btn">Investor 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="memberinfo.php">Member Information</a>
      <a href="addmem.html">Add Member</a>
    </div>

    <button class="dropdown-btn">Database 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="member_collection.php">Member Collection</a>
      <a href="borrower_collection.php">Borrower Collection</a>
      <a href="#">Investments</a>
      <a href="#">Expenses</a>
      <a href="#">Incomes</a>
    </div>

    <button class="dropdown-btn">Banking 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="#">Dashboard</a>
      <a href="#">Bank Entry</a>
      <a href="#">Bank Reconcilliation</a>
      <a href="#">Print Checks</a>
      <a href="#">Bank Accounts</a>
      <a href="#">Bank Statements</a>
    </div>

    <button class="dropdown-btn">Report 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
      <a href="#">Investor Collection</a>
      <a href="#">Network</a>
      <a href="#">Profit</a>
      <a href="#">CPA Report</a>
      <a href="#">Other Income</a>
      <a href="#">Expenses</a>
      <a href="#">Borrower Report</a>
    </div>

  </div>
</section>

<h1 id="meminfo">Member Information</h1>
<form action="" class="search-table" method="post">
  <div class="form">
    <div class="input-group">
      <input class="search" type="text" name="search-name" value="" placeholder="Search name...">
      <input class="search" type="number" name="search-number" value="" placeholder="Search phone number...">
      <select class="search" name="role" id="role">
        <option value="">Select role...</option>
        <option value="member">Member</option>
        <option value="investor">Investor</option>
        <option value="borrower">Borrower</option>
      </select>
      <input type="submit" name="submit" class="btn-primary" value="Search">
      <a href="addmem.html" class="add"><i class="fa-regular fa-plus"></i></a>
    </div>  
  </div>
</form>

<style>
  @media print {
    body * {
      visibility: hidden;
    }
    .myTable, .myTable * {
      visibility: visible;
    }
    .myTable {
      position: absolute;
      left: -250px;
      top: 0px;
    }
    td {
      padding: 0 10px;
    }
    th {
      padding: 0 10px;
    }
    td:nth-child(6), td:nth-child(7) {
      display: none
    }
  }
</style>



<table class="myTable">
  <thead>
    <tr>
      <th>Account No.</th>
      <th>Name</th>
      <th>Role</th>
      <th>Phone Number</th>
      <th>Email</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      $dbServername = "localhost";
      $dbUsername = "root";
      $dbPassword = "";
      $dbName = "spyder";
      
      $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

      $nameVal = $_POST['search-name'];
      $numberVal = $_POST['search-number'];

      if(isset($_POST['submit'])) {
        if(!empty($_POST['role'])) {
            $roleVal = $_POST['role'];
        }
      }

      if(isset($nameVal) && empty($numberVal) && empty($roleVal)) {
        $filtervalues = $nameVal;
      }
      else if(isset($numberVal) && empty($nameVal) && empty($roleVal)) {
        $filtervalues = $numberVal;
      }
      else if(empty($nameVal) && empty($numberVal)) {
        $filtervalues = $roleVal;
      }
      else {
        ?>
        <tr>
          <td colspan="4">Search only one</td>
        </tr>
        <?php
      }

      if(isset($filtervalues)) {

        if($filtervalues==$nameVal) {
          $query = "select * from list where concat(name) like '%$filtervalues%'";
        }
        else if($filtervalues==$numberVal) {
          $query = "select * from list where concat(phone) like '%$filtervalues%'";
        }
        else if($filtervalues==$roleVal) {
          $query = "select * from list where concat(role) like '%$filtervalues%'";
        }
        
        $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0) {
          foreach($query_run as $items) {
            echo
            "<tr>
              <td>".$items['account_number']."</td>
              <td>".$items['name']."</td>
              <td>".$items['role']."</td>
              <td>".$items['phone']."</td>
              <td>".$items['email']."</td>
              <td><button class='icon'><a href='edit.php?an=$items[account_number]&n=$items[name]&p=$items[phone]&ba=$items[balance_amount]&ca=$items[collection_amount]&s=$items[shares]&a=$items[address]&ssn=$items[ssn]&dln=$items[dln]&e=$items[email]&i=$items[id]'><i class='fa-regular fa-pen-to-square'></i></button>
              </td>
              <td><button class='icon'><a href='view.php?r=$items[role]&an=$items[account_number]&n=$items[name]&p=$items[phone]&ba=$items[balance_amount]&ca=$items[collection_amount]&s=$items[shares]&a=$items[address]&ssn=$items[ssn]&dln=$items[dln]&e=$items[email]&i=$items[id]&dle=$items[dle]&dlsi=$items[dlsi]     &cn=$items[corp_name]&cd=$items[corp_address]&cp=$items[corp_phone]&ce=$items[corp_email]&ci=$items[ein]    &lt=$items[loan_type]&la=$items[loan_amount]&on=$items[g1_name]&oa=$items[g1_address]&op=$items[g1_phone]&oe=$items[g1_email]&od=$items[g1_dln]&ode=$items[g1_dle]&ods=$items[g1_dlsi]&os=$items[g1_ssn]&tn=$items[g2_name]&ta=$items[g2_address]&tp=$items[g2_phone]&te=$items[g2_email]&td=$items[g2_dln]&tde=$items[g2_dle]&tds=$items[g2_dlsi]&ts=$items[g2_ssn]'><i class='fa-solid fa-print'></i></button></td>
              
            </tr>";
          }
        }
        else {
          ?>
          <tr>
            <td colspan="4">No Record Found</td>
          </tr>
          <?php
        }
      }
    ?>
    <tr>
      <td></td>
    </tr>
  </tbody>
</table>

<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - 
   This allows the user to have multiple dropdowns without any conflict */


var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");

const optionsList = document.querySelectorAll(".option");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
  });
});


</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html> 
