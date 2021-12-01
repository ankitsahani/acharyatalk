<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Management</h4>
                   <a href="<?php echo base_url();?>index.php/admin/adduser"> <button type="button" class="btn btn-primary btn-sm" style="margin-left:90%; margin-top:-80px;">Add User</button></a>
                   <div class=" table-responsive"> 
                   <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> User </th>
                          <th> User Name </th>
                          <th> User Email </th>
                          <th> Mobile No. </th>
                          <th> Gender </th>
                          <th> User Status </th>
                          <th> View </th>
                          <th> Edit </th>
                          <th> Delete </th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          foreach($user_list as $user){
                          ?>
                        <tr>
                          <td class="py-1">
                            <img src="<?php echo base_url(); ?>assets/images/faces-clipart/pic-1.png" alt="image" />
                          </td>
                          <td> <?php echo $user->name; ?> </td>
                          <td> <?php echo $user->email; ?> </td>
                          <td> <?php echo $user->mobile; ?> </td>
                          <td> <?php echo $user->gender; ?> </td>
                          <td> <?php echo $user->status; ?> </td>
                          <td><button type="button" data-toggle="modal" data-target="#viewuser<?php echo $user->id;?>" class="btn btn-sm btn-icon btn-rounded btn-primary"> view </button></td>
                          <td><button type="button" data-toggle="modal" data-target="#edituser<?php echo $user->id;?>" class="btn btn-sm btn-icon btn-rounded btn-primary"> edit</button></td>
                          <td><a href="<?php echo base_url();?>index.php/admin/users/userdelete/<?php echo $user->id;?>"> <button onclick="return confirm('Are you sure you want to delete this category?');"  class="btn btn-sm btn-icon btn-rounded btn-primary"> delete </button></a></td>
                        </tr>

                    <!-- edit user modal     -->
                       <div class="modal fade" id="edituser<?php echo $user->id;?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit User</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          <form class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/admin/users/useredit">
                            <div class="modal-body">
                                  <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Name</label>
                                    <div class="col-sm-12">
                                          <input type="hidden" class="form-control" name="id" value="<?php echo $user->id;?>">
                                      <input type="text" class="form-control" id="name" name="name" required placeholder="User name" data-toggle="modal" data-target="#modal-default" value="<?php echo $user->name;?>">
                                      <h5 id="username"></h5>
                                    </div>
                                  </div>
                                    <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Email</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" id="email" name="email" required placeholder="User Email" value="<?php echo $user->email;?>">
                                      <h5 id="useremail"></h5>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Phone</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" id="mobile" name="mobile" required placeholder="User Phone" value="<?php echo $user->mobile;?>">
                                      <h5 id="usernumber"></h5>
                                   </div>
                                   </div>
                                   <div class="form-group row">
                                  <label class="col-sm-12 col-form-label">Gender</label>
                                  <div class="col-sm-12">
                                    <select class="form-control" required name="gender">
                                            <option value="<?php echo $user->gender;?>"><?php echo $user->gender;?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="other">Other</option>
                                          </select>
                                  </div>
                                </div> 
                                  <div class="form-group row">
                    <label class="col-sm-12 col-form-label">User Status</label>
                    <div class="col-sm-12">
                      <select class="form-control" required name="status">
                              <option value="<?php echo $user->status;?>"><?php echo $user->status;?></option>
                              <option value="A">Active</option>
                              <option value="IA">InActive</option>
                            </select>
                    </div>
                  </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" id="submitform" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>    
                          </div>
                        </div>
                      </div>

                      <!-- view user modal -->
                     
                      <div class="modal fade" id="viewuser<?php echo $user->id;?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">View User</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          <form class="form-horizontal">
                            <div class="modal-body">
                                  <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Name</label>
                                    <div class="col-sm-12">
                                          <input type="hidden" class="form-control" name="id" value="<?php echo $user->id;?>">
                                      <input type="text" class="form-control" name="name" readonly required placeholder="User name" data-toggle="modal" data-target="#modal-default" value="<?php echo $user->name;?>">
                                    </div>
                                  </div>
                                    <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Email</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="email" readonly required placeholder="User Email" value="<?php echo $user->email;?>">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Phone</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="mobile" readonly required placeholder="User Phone" value="<?php echo $user->mobile;?>">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                  <label class="col-sm-12 col-form-label">Gender</label>
                                  <div class="col-sm-12">
                                    <select class="form-control" required name="gender" readonly>
                                            <option value="<?php echo $user->gender;?>"><?php echo $user->gender;?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="other">Other</option>
                                          </select>
                                  </div>
                                </div>
                                  <div class="form-group row">
                                    <label for="category_id" class="col-sm-12 col-form-label">User Status</label>
                                    <div class="col-sm-12">
                                    <select class="form-control" id="status" required name="status" readonly>
                                              <option value="<?php echo $user->status;?>"><?php echo $user->status;?></option>
                                              <option value="A">Active</option>
                                              <option value="IA">Inactive</option>
                                            </select>
                                    </div>
                                  </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin-left:40%;">Close</button>
                            </div>
                        </form>    
                          </div>
                        </div>
                      </div>
                                    <?php } ?>
                      </tbody>
                    </table>
                          </div>
                  </div>
                </div>
              </div>