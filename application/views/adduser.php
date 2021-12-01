<div class="row">
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New User</h4>
                    <form class="forms-sample" method="POST" action="<?php echo base_url();?>index.php/admin/adduser/adduser">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        <h5 id="username"></h5>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <h5 id="useremail"></h5>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Mobile No.</label>
                        <input type="text" class="form-control"  id="mobile" name="mobile" placeholder="Enter Mobile Number">
                        <h5 id="usernumber"></h5>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="gender"  name="gender">
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="other">Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">User Status</label>
                        <select class="form-control" id="status" name="status">
                          <option value="A">Active</option>
                          <option value="IA">InActive</option>
                        </select>
                      </div>
                      <!-- <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div> -->
                      <button type="submit" id="submitform" class="btn btn-gradient-primary mr-2">Submit</button>
                    </form>
                    <a href="<?php echo base_url();?>index.php/admin/users"><button class="btn btn-light" style="margin-left:80%; margin-top:-67px;">Back</button></a>
                  </div>
                </div>
              </div>
            </div>