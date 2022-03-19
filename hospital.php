<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="kk";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
die("Connection failed:".mysqli_connect_error());
}
else{
echo"connected";
}
?>

<html lang="en">
<head>
<title>Form design and report generation</title>
<style>
        table{ width:75%;
            text:bold;
            margin:15px 15px 15px 100px;
            align:center;}
        
    tbody tr:nth-child(odd) {
    background-color: #ff33cc;
        }
    .top:input{
      width:50%;
        }

table {
    border-collapse: separate;
    border-spacing: 0 0.3em;
}
tr:input {
    border-collapse:separate;
    border-spacing:0 15px;
    padding:10px;
}
tbody tr:nth-child(even) {
  background-color: #e6d630;
}

table {
  background-color: #2cbade;
}
table {
  border: 4px solid green;
}
th, td {
  padding: 15px;
  text-align: left;
}
th, td {
  border-bottom: 1px solid #ddd;
}

tr:hover {
    background-color: coral;
}

th, td {
  padding: 15px;
  text-align: left;
}
.top{
    width:!important 50%;
    padding:5px;
}
body{
    background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
    /*background="student-database-500x500.jpg"*/
}
    </style>
</head>

<body>
<h1 style="color:blue; text-align: center;"><b>Hospital Database Management System</b></h1>
<form name="form1" action="" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>
Enter patient id:
</td>
<td><input type="text" name="pati"></td>
</tr>
<tr>
    <td>Photo:</td>
    <td> Select Image File to Upload:
    <input type="file" name="file">
    </td>
</tr>
<tr>
    <td>Name:</td>
    <td><input type="text" name="name"></td>
</tr>
<tr>
    <td>Phone no:</td>
    <td><input type="text" name="ph"></td>
</tr>
<tr>
    <td>Address:</td>
    <td><input type="text" name="addr"></td>
</tr>
<tr>
    <td>Illness:</td>
    <td><input type="text" name="ill"></td>
</tr>


<tr>
    <input type="submit" name="sub1" value="insert">
    <input style="color:red;" type="submit" name="sub2" value="delete">
    <input style="color:brown;" type="submit" name="sub3" value="update">
    <input style="color:orange;"type="submit" name="sub4" value="display">
    <input style="color:skyblue;" type="submit" name="sub5" value="search">
    <input type="submit" name="submit" value="Upload">
    </tr>
    </table>
    </form>
</body>
</html>

<?php
    
    $db=mysqli_connect($servername,$username,$password,$dbname);
    $fileName = basename($_FILES["file"]);
    if(isset($_POST["submit"]) && !empty($_FILES["file"])){
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($allowTypes)){
            // Upload file to server
           
                $insert = $db->query("INSERT into patient (file_name) VALUES ('".$fileName."')");
                if($insert){
                    $statusMsg = "The file has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                } 
            }
         }
        else{
        $statusMsg = 'Please select a file to upload.';
          }
    
    // Display status message
    echo $statusMsg;



    if(isset($_POST["sub1"]))
    {
        mysqli_query($conn,"insert into patient values('$_POST[pati]','$_POST[name]',$_POST[ph],'$_POST[addr]','$_POST[ill]')");
        echo "record inserted succesfully";
    }
    if(isset($_POST["sub2"]))
    {
        mysqli_query($conn,"delete from patient where pati='$_POST[pati]'");
        echo "record deleted succesfully";
    }
    if(isset($_POST["sub3"]))
    {
        mysqli_query($conn,"update patient set name='$_POST[name]',ph='$_POST[ph]',addr='$_POST[addr]',ill='$_POST[ill]' where pati='$_POST[pati]'");
        echo "updated succesfully";
    }
    
    if(isset($_POST["sub4"]))
    {
        $reg=mysqli_query($conn,"select * from patient");
        echo"<table border=1>";
            echo"<tr>";
            echo"<th>"; echo"Patient id"; echo"</th>";
            echo"<th>"; echo"Name"; echo"</th>";
            echo"<th>"; echo"Phone No"; echo"</th>";
            echo"<th>"; echo"Address"; echo"</th>";
            echo"<th>"; echo"Illness"; echo"</th>";
            echo"</tr>";
        while($row=mysqli_fetch_array($reg))
        {
            echo"<tr>";
            echo"<td>"; echo $row["pati"]; echo"</td>";
            echo"<td>"; echo $row["name"]; echo"</td>";
            echo"<td>"; echo $row["ph"]; echo"</td>";
            echo"<td>"; echo $row["addr"]; echo"</td>";
            echo"<td>"; echo $row["ill"]; echo"</td>";

            echo"</tr>";
        }
        echo"</table>";
    }
    
    if(isset($_POST["sub5"]))
    {
        $reg=mysqli_query($conn,"select * from patient where pati='$_POST[pati]'");
        echo"<table border=1>";
            echo"<tr>";
            echo"<th>"; echo"Patient id"; echo"</th>";
            echo"<th>"; echo"Name"; echo"</th>";
            echo"<th>"; echo"Phone No"; echo"</th>";
            echo"<th>"; echo"Address"; echo"</th>";
            echo"<th>"; echo"Illness"; echo"</th>";

            echo"</tr>";
        while($row=mysqli_fetch_array($reg))
        {
            echo"<tr>";
            echo"<td>"; echo $row["pati"]; echo"</td>";
            echo"<td>"; echo $row["name"]; echo"</td>";
            echo"<td>"; echo $row["ph"]; echo"</td>";
            echo"<td>"; echo $row["addr"]; echo"</td>";
            echo"<td>"; echo $row["ill"]; echo"</td>";

            echo"</tr>";
        }
        echo"</table>";
    }
/*
    if(isset($_POST["Upload"]))
    {

        // Get images from the database
        $query = $db->query("SELECT file_name FROM patient");
        
        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $imageURL = 'uploads/'.$row["file_name"];
        
            <img src=echo" $imageURL; " alt="" />
       
    }
        }
        else{ 
            <p>No image(s) found...</p>
         }*/
?>