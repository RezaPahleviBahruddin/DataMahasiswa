<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "@reza27#";
$dbname = "DATAMAHASISWA";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error()); 
$requestData= $_REQUEST;


$columns = array( 
	0 => 'NIS',
    1 => 'NAMA', 
	2 => 'TGL_LAHIR',
	3 => 'JENIS_KELAMIN',
    4 => 'ALAMAT'  
);

$sql = "SELECT NIS, NAMA, TGL_LAHIR, JENIS_KELAMIN, ALAMAT";
$sql.=" FROM MAHASISWA";
$query=mysqli_query($conn, $sql) or die("ajax_lists.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 

if( !empty($requestData['search']['value']) ) {
	$sql = "SELECT NIS, NAMA, TGL_LAHIR, JENIS_KELAMIN, ALAMAT";
	$sql.=" FROM MAHASISWA";
	$sql.=" WHERE NAMA LIKE '%".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR TGL_LAHIR LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR JENIS_KELAMIN LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR ALAMAT LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR JURUSAN LIKE '%".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax_lists.php: get PO");
	$totalFiltered = mysqli_num_rows($query); 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; 
	$query=mysqli_query($conn, $sql) or die("ajax_lists.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT NIS, NAMA, TGL_LAHIR, JENIS_KELAMIN, ALAMAT, JURUSAN";
	$sql.=" FROM MAHASISWA";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax_lists.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) { 
	$nestedData=array(); 

	$nestedData[] = $row["NIS"];
    $nestedData[] = $row["NAMA"];
	$nestedData[] = $row["TGL_LAHIR"];
	$nestedData[] = $row["JENIS_KELAMIN"];
    $nestedData[] = $row["ALAMAT"];
    $nestedData[] = $row["JURUSAN"];
    $nestedData[] = '<td><center>
                     <a href="edit.php?kd='.$row['NIS'].'"  data-toggle="tooltip" title="Edit" class="glyphicon glyphicon-edit"> <i class="menu-icon icon-pencil"></i> </a>
                     <a href="home.php?hal=hapus&kd='.$row['NIS'].'"  data-toggle="tooltip" title="Hapus" class="glyphicon glyphicon-remove"> <i class="menu-icon icon-trash"></i> </a>
				     </center></td>';		
	
	$data[] = $nestedData;
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data  
			);

echo json_encode($json_data); 

?>
