<?php
$db = new db('localhost', 'root', '', 'gallery');
if (!empty($_POST)) {
    $db->insert('categories', array('title' => $_POST['title'], 'parent_id' => $_POST['parent_id'], 'is_active' => $_POST['is_active']));
}
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Add New Category</h3>
    </div>
    <div class="panel-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Category Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Category Title">
            </div>
            <div class="form-group">
                <label for="title">Parent Category</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Please Select</option>
                    <?php
                    foreach ($db->getAll('categories') as $cat) {
                        echo "<option value='" . $cat['id'] . "'>" . $cat['title'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_active" value="1" checked> Active
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Add New</button>
            <button type="reset" class="btn btn-default">Cancel</button>
        </form>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Category List</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Parent</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($db->getAll('categories', 1) as $cat) {
                ?>
                <tr>
                    <td><?php echo $cat['id']?></td>
                    <td><?php echo $cat['title']?></td>
                    <td><?php echo $cat['parent_title']?></td>
                    <td>
                        <div class="btn-group">
                            <a href="" class="btn btn-info btn-group-sm">Edit</a>
                            <a href="" class="btn btn-warning btn-group-sm">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">Total Categories = <?php echo $db->count('categories'); ?></div>
</div>