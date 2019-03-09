            <section class="jumbo">
                <a href="/admin">
                    <i class="icon ion-ios-arrow-round-back"></i>
                    User Manager
                </a>
            </section>
            
            <section class="listings pt-0" data-var="user-index">
                <?php
                if (isset($this->users) && is_array($this->users)) {
                    foreach ($this->users as $key => $user) {
                ?>
                <div class="card" id="card-user-<?= $user->id; ?>">
                    <div class="details">
                        <div class="small-title"><?= $this->escape($user->name); ?></div>
                        <div class="text-muted form-id"><?= $this->escape($user->email); ?></div>
                    </div>
                    <div class="buttons dropdown">
                        <a href="/user/<?= $user->id; ?>" class="icon-btn" data-toggle="tooltip" data-placement="left" title="Edit User">
                            <i class="icon ion-md-create"></i>
                        </a>
                        <a href="javascript:void(0)" class="icon-btn" data-toggle="dropdown" onclick="$(this).elevateCard();">
                            <i class="icon ion-ios-arrow-down"></i>
                        </a>
                        <div id="dropdown-user-<?= $user->id; ?>" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item button-text" href="/user/<?= $user->id; ?>"><i class="icon ion-md-create icon-md"></i> Edit</a>
                            <button type="button" class="dropdown-item button-text text-danger" data-toggle="modal" data-target="#confirm-delete-<?= $user->id; ?>"><i class="icon ion-ios-trash icon-md"></i> Delete</button>
                        </div>
                    </div>
                </div>
                <!-- Delete Modal -->
                <div class="modal fade" id="confirm-delete-<?= $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-<?= $user->id; ?>Title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirm-delete-<?= $user->id; ?>Title">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to permanently delete this account? This cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-noline-primary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-outline-danger icon-padding" onclick="deleteRequest('<?= $user->id; ?>');"><i class="icon ion-ios-trash icon-md"></i> Yes, delete forever</button>
                    </div>
                    </div>
                </div>
                </div>
                <?php
                    } // end foreach
                } else { ?>
                    <div class="text-muted text-center font-italic mb-5 small">No users found.</div>
                <?php } ?>
            </section>

            <section class="create-section">
                <button type="button" class="btn btn-primary icon-padding" data-toggle="modal" data-target="#createUserModal">
                    <i class="icon ion-ios-add-circle-outline icon-md"></i> New User
                </button>
                <div id="create-form-collapse" class="collapse">
                </div>
            </section>

            <!-- Modal -->
            <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalTitle">Create New User Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="createForm" class="card parsley-form" onsubmit="submitCreateForm();">
                            <div class="form-group input-material">
                                <input type="text" class="form-control" id="name-field" name="name" required minlength="2">
                                <label for="name-field">Name</label>
                            </div>
                            <div class="form-group input-material">
                                <input type="email" class="form-control" id="email-field" name="email" required>
                                <label for="email-field">Email address</label>
                            </div>
                            <div class="form-group input-material">
                                <input type="password" class="form-control" id="password-field" name="password" required minlength="5">
                                <label for="password-field">Password</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-noline-primary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitCreateForm();">Create Account</button>
                    </div>
                </div>
            </div>
            </div>

            <!-- Not Found Modal -->
            <div class="modal fade error-modal" id="unknown_error-modal" tabindex="-1" role="dialog" aria-labelledby="unknown_error-modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="unknown_error-modalTitle">Something went wrong!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        The user you tried to delete could not be found!<br>
                        Please try again or contact an administrator.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay then...</button>
                    </div>
                    </div>
                </div>
            </div>

            <?php
                layoutArea::appendFile('scripts', path::component('users', 'partials/parsley.js'), 'script');
                layoutArea::appendFile('scripts', path::component('users', 'partials/submitCreateForm.js'), 'script');
                layoutArea::appendFile('scripts', path::component('users', 'partials/elevateCard.js'), 'script');
                layoutArea::appendFile('scripts', path::component('users', 'partials/deleteRequest.js'), 'script');
            ?>