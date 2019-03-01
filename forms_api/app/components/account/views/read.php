            <?php if(is_object($this->user)) { ?>
            <section class="jumbo">
                <a href="/admin">
                    <i class="icon ion-ios-arrow-round-back"></i>
                    <?= $this->escape($this->user->name); ?>
                </a>
            </section>

            <section class="edit-meta trigger-save">
                <form id="identity-form" class="card parsley-form">
                    <div class="form-group input-material">
                        <input type="text" class="form-control" id="name-field" name="name" value="<?= $this->escape($this->user->name); ?>" minlength="2" maxlength="50">
                        <label for="name-field">Name</label>
                    </div>
                    <div class="form-group input-material">
                        <input type="text" class="form-control" id="email-field" name="email" value="<?= $this->escape($this->user->email); ?>" data-parsley-type="email">
                        <label for="email-field">Email address</label>
                    </div>
                </form>
            </section>

            <section class="edit-meta">
                <div class="card" style="flex-direction: row; align-items: center;">
                    <button type="button" class="btn btn-outline-primary icon-padding mr-4" data-toggle="modal" data-target="#passwordModal" onclick="$('#password-success').collapse('hide');">
                        <i class="icon ion-ios-key icon-md"></i> Change Password
                    </button>
                    <span id="password-success" class="collapse text-success" style="margin-right: auto;">
                        <i class="icon ion-ios-checkmark icon-md"></i> Password changed!
                    </span>
                </div>
            </section>

            <!-- Modal -->
            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form id="password-form" class="parsley-form">
                                <div class="form-group input-material">
                                    <input type="password" class="form-control" id="old-password-field" name="old-password" required>
                                    <label for="old-password-field">Old Password</label>
                                </div>
                                <div class="form-group input-material">
                                    <input type="password" class="form-control" id="new-password-field" name="new-password" minlength="5">
                                    <label for="new-password-field">New Password</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-noline-primary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="submitPassword();">Set Password</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                layoutArea::appendFile('scripts', path::component('account', 'partials/parsley.js'), 'script');
                layoutArea::appendFile('scripts', path::component('account', 'partials/submitEditForm.js'), 'script');
                layoutArea::appendFile('scripts', path::component('account', 'partials/submitPassword.js'), 'script');
            ?>

            <?php } else { // if not object ?>
                <div class="jumbotron text-center mt-5">
                    <h3>Error Fetching User Data</h3>
                </div>
            <?php } ?>