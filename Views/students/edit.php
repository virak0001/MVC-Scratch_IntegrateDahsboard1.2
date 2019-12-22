<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-center text-white">
                    <h2>Student Information Form</h2>
                </div>
                <?php
                if (isset($data['student'])) {
                    foreach ($data['student'] as $row) {
                ?>
                        <form action="index.php?action=edit_data&" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Firstname</label>
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="firstname" id="name" value="<?php echo $row['firstname'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name">Lastname</label>
                                    <input type="text" name="lastname" id="name" value="<?php echo $row['lastname'] ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="class">Class:</label>
                                    <select name="class" id="class" class="form-control">
                                    <?php
                                        foreach ($data['class'] as $rows) {
                                        ?>
                                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['title']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sex">Gender:</label><br>
                                    <input type="radio" <?php if ($row['sex'] == 'Male') { ?> checked="checked" <?php } ?> name="sex" value="Male">Male <br>
                                    <input type="radio" <?php if ($row['sex'] == 'Female') { ?> checked="checked" <?php } ?> name="sex" value="Female">Female
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subjects:</label>
                                    <select name="subjects[]" class="form-control" multiple>
                                        <?php
                                        foreach ($data['subject_data'] as $rows) {
                                        ?>
                                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['sub_title']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="index.php?action=view" class="btn btn-success">Go Back</a>
                                <input type="submit" name="create" value="Submit" class="btn btn-primary float-right">
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>