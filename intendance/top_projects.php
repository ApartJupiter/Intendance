<?php include ('db_connect.php'); ?>

<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-body">
        <table class="table tabe-hover table-bordered">
          <thead>
            <tr>
              <th class="text-center">Project Name</th>
              <th class="text-center">Completed On</th>
              <th class="text-center">Project Score</th>
            </tr>
          </thead>
          <tbody>
              <?php 
              $employees = $conn->query("SELECT * FROM tp_data where status = 5 order by tp_rating desc"); 
              while($row= $employees->fetch_assoc()):?>
              <tr>
                  <td class="text-center">
                      <?php echo $row['name'] ?>
                  </td>
                  <td class="text-center">
								<?php echo ($row['end_date']) ?>
                  </td>
                  <td class="text-center">
                      <?php echo $row['tp_rating'] ?>
                  </td>
                  <td class="text-center">
                  <a class="btn btn-outline-primary btn-sm" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>">
                              View
                        </a>
                  </td>
              </tr>
              <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
