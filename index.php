<?php include('server.php');?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$edit_state = true;
		$rec = mysqli_query($db, " SELECT * FROM info WHERE id=$id");

        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $address = $record['address'];
        $id = $record['id'];
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php if (isset($_SESSION['msg'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['msg']; 
			unset($_SESSION['msg']);
		?>
	</div>
<?php endif ?>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<tbody>
    <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <a hr href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
            </td>
            <td>
                <a onclick="return confirm('Delete this record?')" href="server.php?del=<?php echo $row['id'] ?>"class="del_btn;">Delete</a>
            </td>
        </tr>
  <?php }
   ?>
		
	</tbody>
</table>
	<form method="post" action="server.php" >
    <input type="hidden" name="id" value="<?php echo $id;?>">
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name;?>">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="<?php echo $address;?>">
		</div>
		<div class="input-group">
        <?php if($edit_state == false): ?>
			<button class="btn" type="submit" name="save" >Save</button>
        <?php else: ?>    
            <button class="btn" type="submit" name="update" >update</button>
        <?php endif?>
		</div>
	</form>

    <!-- <script>
     delete = document.getElementsByClassName('del_btn');
    Array.from(delete).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        id = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/php_crud/index.php?delete=${id}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script> -->
</body>
</html>