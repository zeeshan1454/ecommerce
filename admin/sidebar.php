                    <div class="col-lg-3">
                        <div class="user-profile-sidebar">
                            <div class="user-profile-sidebar-top">
                                <div class="user-profile-img">
                                    <img src="assets/img/account/<?php if(!empty($row['image'])){
                                      echo $row['image'];
                                    } else { echo 'profile.jpg' ; } ?>" alt>
                                    <!-- <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button> 
                                    <input type="file" name="image" class="profile-img-file">  -->
                                </div>
                                <h4><?= $row['admin_username'] ?></h4>
                                <p><a href="mailto:<?= $row['admin_email'] ?>"><?= $row['admin_email'] ?></a>
                                </p>
                            </div>
                            <ul class="user-profile-sidebar-list">
                                                                <li><a href="profile.php" class="<?php if($page == 'profile'){ echo 'active' ; } ?>"><i class="far fa-user"></i>My Profile</a></li>
                                <li><a href="index.php" class="<?php if($page == 'admin'){ echo 'active' ; } ?>"><i class="far fa-clipboard-list"></i><?php
                                  if($row['admin_status'] == '1'){
                                    echo "All Product";
                                   } else {
                                    echo "My Product";
                                   }
                                ?></a>
                                </li>
                                <?php
                                  if($row['admin_status'] == '1'){
                                    ?>
                                    <li><a href="all_invoice.php" class="<?php if($page == 'invoice'){ echo 'active' ; } ?>"><i class="far fa-clipboard-list"></i>Invoice</a></li>
                                     <li><a href="agent.php" class="<?php if($page == 'agent'){ echo 'active' ; } ?>"><i class="far fa-user"></i>All Agents</a></li>
                                    <?php
                                   } else {
                                    echo "";
                                   }
                                ?>
                                <li><a href="user.php" class="<?php if($page == 'user'){ echo 'active' ; } ?>"><i class="far fa-user"></i><?php if($row['admin_status'] == '1'){
                                                echo "All Users";
                                               } else {
                                              echo "My Users";
                                               } ?></a></li>
                                <li><a href="logout.php"><i class="far fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>