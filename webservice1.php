<?php
$search_param = $_POST["search"];
$search_area = $_POST["area"];

if($search_param==""||$search_area==""){
    echo '<div class="experienced-doctors-near">Please Enter Doctor Type & Area Name</div>';
return 0;

}

if(isset($_POST["search"]) && isset($_POST["area"])){
// echo $search_param;
// echo $search_area;

$host= "localhost";
$dbuser= "root";
$dbpass= "abcd@1A.";
$dbname= "docfind_database";

$conn= new mysqli($host, $dbuser, $dbpass, $dbname);


$sql = "SELECT * from doctors
where DoctorArea like '%".$search_area."%' and
DoctorCategory like '%".$search_param."%' ";

$result=$conn->query($sql);

if($result->num_rows > 0){
    $data = '<div class="experienced-doctors-near">Doctors Found Near You... </div>';
    $doctor_data="";

    while($row = $result->fetch_assoc()){
      $doctorid = $row["ID"];
      $doctorname = $row["DoctorName"];
      $doctorinfo = $row["DoctorInformation"];
      $doctorimg = $row["DoctorImage"];

      $doctor_data .= '<div class="search-section">
         <div class="search-box">
            <img class="rectangle-icon" alt="" src="'.$doctorimg.'" />
            <div class="dr-tony-stark" href="#">'.$doctorname.'</div>
            <div class="mit-katraj-pune">'.$doctorinfo.'</div>
         </div>
      </div>';
   }



}else{
    $data = '<div class="experienced-doctors-near"> No Doctor Found In Your Area </div>';
}

}else{
    $data =  '<div class="experienced-doctors-near"> Bad Query </div>';
}
$data = $data.$doctor_data;
echo $data;
?>
