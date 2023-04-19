<?php
$search_param = $_POST["search"];
$search_area = $_POST["area"];

if($search_param==""||$search_area==""){
    echo '<div class="text">Please Enter Doctor Type & Area Name</div>';
return 0;
    
}

if(isset($_POST["search"]) && isset($_POST["area"])){ 
// echo $search_param;
// echo $search_area;

$host= "localhost";
$dbuser= "id20430870_docmatch";
$dbpass= "Admin@123456";
$dbname= "id20430870_doctordb";

$conn= new mysqli($host, $dbuser, $dbpass, $dbname);


$sql = "SELECT * from doctors
where DoctorArea like '%".$search_area."%' and
DoctorCategory like '%".$search_param."%' ";

$result=$conn->query($sql);

if($result->num_rows > 0)
{
    $data = '<div class="text">Doctor Found in Your Area</div>';
    $doctor_data="";
 
   while($row = $result->fetch_assoc()){
       $doctorid = $row["ID"];
       $doctorname = $row["DoctorName"];
       $doctorinfo = $row["DoctorInformation"];
	$doctorimg = $row["DoctorImage"];

    $doctor_data = $doctor_data.'   <div class="service1">
    <img class="circle1-icon" alt="" src="public/circle1.svg" /> <img class="searchlogo-icon" alt=""
      src="'.$doctorimg.'" />
    <div class="xyz name">'.$doctorname.'</div>
   <div class "xyz" style="font-size:15px;">'.$doctorinfo.'</div> </div>';
   }
$data = $data.$doctor_data;

}else{
    $data = '<div class="text">No Doctor Found</div>';
}

}else{
    $data = '<div class="text">Bad Qury...</div>';
}
echo $data;
?>