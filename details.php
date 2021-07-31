<?php
	
	include('config/db_connect.php');

	if(isset($_POST['delete'])){
		$id_to_delete = $_POST['id_to_delete'];

		$sql = "DELETE from pizzas WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		}
		else{
			echo"Query error: ". mysqli_error($conn); 
		}

		mysqli_close($conn);

	}

	//checking get request id
	if(isset($_GET['id'])){
		$id= mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT *FROM pizzas WHERE id = $id";

		$result = mysqli_query($conn, $sql);

		$pizza = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

		mysqli_close($conn);

		//print_r($pizza);
	}



?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>
	<div class="card z-depth-0">
		<div class="card-content center">
			<h5>Pizza details</h5>
			<?php if(isset($pizza)): ?>
				<p>Title: <?php echo htmlspecialchars($pizza['title']); ?></p>
				<p>Ingredients: <?php echo htmlspecialchars($pizza['ingredients']); ?> </p>
				<p>Date: <?php echo date($pizza['created_at']); ?></p>
				<p>Owned by: <?php echo htmlspecialchars($pizza['email']); ?></p>

				<form action="details.php" method="POST">
					<input type="hidden" name="id_to_delete" value="<?php echo $id; ?>">
					<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
				</form>

			<?php else: ?>
				<p>No such pizza.</p>
			<?php endif; ?>
		</div>
	</div>
	<?php include('templates/footer.php'); ?>

</html>